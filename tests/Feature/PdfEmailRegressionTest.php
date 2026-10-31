<?php
namespace Tests\Feature;

use App\Jobs\SendEmail;
use App\Jobs\SendPlanEmail;
use App\Mail\EmailForQueuing;
use App\Mail\EmailForPlanQueuing;
use App\Support\BrowserPdf;
use Illuminate\Support\Facades\Mail;
use Tests\Support\Fixtures;
use Tests\Support\Isolation;
use Tests\TestCase;

class PdfEmailRegressionTest extends TestCase
{
    public function testCommonPdfFallbackProducesContentAndMultiplePagesFromSyntheticHtml()
    {
        $html = file_get_contents(__DIR__.'/../Fixtures/invoice.html');
        $image = imagecreatetruecolor(2, 2);
        ob_start();
        imagepng($image);
        $png = ob_get_clean();
        imagedestroy($image);
        $html = str_replace('</body>', '<img alt="Synthetic logo" src="data:image/png;base64,'.base64_encode($png).'" /></body>', $html);
        $target = storage_path('app/phase2-invoice.pdf');
        $wrapper = app('dompdf.wrapper');
        $this->app->instance('dompdf.wrapper', $wrapper);
        Fixtures::invoke(Fixtures::common(), 'savePdfFromHtml', [$html, $target, [
            'isRemoteEnabled' => false, 'fontDir' => Isolation::$root.'/fonts',
            'fontCache' => Isolation::$root.'/fonts', 'tempDir' => Isolation::$root,
        ]]);
        $this->assertFileExists($target);
        $this->assertSame('%PDF-', substr(file_get_contents($target), 0, 5));
        $this->assertGreaterThan(500, filesize($target));
        $pdf = $wrapper->output(['compress' => false]);
        // save() may already have compressed/cached the stream in Dompdf 0.8.
        preg_match_all('/stream\r?\n(.*?)\r?\nendstream/s', $pdf, $matches);
        $content = '';
        foreach ($matches[1] as $stream) {
            $decoded = @gzuncompress($stream);
            $content .= $decoded === false ? $stream : $decoded;
        }
        $this->assertContains('118.00', $content);
        $this->assertContains('Synthetic Studio', $content);
        $this->assertContains('http://phase2.invalid/pay', $pdf);
        $this->assertContains('/Subtype /Image', $pdf);
        $this->assertGreaterThanOrEqual(2, $wrapper->getDomPDF()->getCanvas()->get_page_count());
        $this->assertSame([], \Tests\Support\GatewayTransport::$requests);
        Mail::assertNothingSent();
    }

    public function testBrowserlessEndpointIsAbsentAndProcessExecutionIsDisabled()
    {
        $this->assertNull(BrowserPdf::browserlessBaseUrl());
        $this->assertContains('proc_open', explode(',', ini_get('disable_functions')));
        // Chromium/Browserless visual acceptance is explicitly blocked in the Integration suite.
    }

    public function testCustomQuotationTemplateContractIsPreserved()
    {
        $html = file_get_contents(base_path('email_task/Send Custom Quotation/Custom/Quotation-CP.html'));
        $document = new \DOMDocument();
        @$document->loadHTML($html);
        $text = preg_replace('/\s+/', ' ', $document->textContent);
        $this->assertContains('Estimate No.', $text);
        $this->assertContains('Estimate Date', $text);
        $this->assertContains('Quotation To', $text);
        $this->assertContains('[CLIENT_TAX_ROWS]', $html);
        $this->assertContains('[Client Contact Number]', preg_replace('/\s+/', ' ', $html));
        $this->assertContains('Conceptual Pictures Worldwide Pvt. Ltd', $text);
        // Template contract only: optional tax-row construction in save_proforma needs the blocked SQL lifecycle fixture.
    }

    public function testOrderEmailJobUsesSyntheticRecipientSubjectAndViewData()
    {
        $details = ['order_email' => 'one@example.invalid', 'txn_id' => 'PHASE2-ORDER-1'];
        (new SendEmail([$details]))->handle();
        Mail::assertSent(EmailForQueuing::class, function ($mail) use ($details) {
            $mail->build();
            return $mail->hasTo('one@example.invalid') && $mail->subject === 'Your Order (PHASE2-ORDER-1) has been successfull!!'
                && $mail->view === 'email.orders_invoice' && $mail->viewData['orders'] === $details;
        });
    }

    public function testPlanEmailJobDoesNotLeakRecipientOrDetailsBetweenMessages()
    {
        foreach (['one', 'two'] as $name) {
            (new SendPlanEmail(['user' => ['email' => $name.'@example.invalid'], 'transaction_id' => 'PHASE2-'.$name]))->handle();
        }
        Mail::assertSent(EmailForPlanQueuing::class, 2);
        foreach (['one', 'two'] as $name) {
            Mail::assertSent(EmailForPlanQueuing::class, function ($mail) use ($name) {
                $mail->build();
                return $mail->hasTo($name.'@example.invalid') && count($mail->to) === 1
                    && $mail->viewData['orders']['transaction_id'] === 'PHASE2-'.$name
                    && $mail->subject === 'Your Plan Order (PHASE2-'.$name.') has been successfull!!';
            });
        }
    }

    public function testEmailJobPropagatesSyntheticTransportFailureForWorkerRetry()
    {
        $pending = \Mockery::mock();
        $pending->shouldReceive('send')->once()->andThrow(new \RuntimeException('Synthetic mail failure'));
        Mail::shouldReceive('to')->once()->with('failure@example.invalid')->andReturn($pending);
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Synthetic mail failure');
        (new SendEmail([['order_email' => 'failure@example.invalid', 'txn_id' => 'PHASE2-FAILED']]))->handle();
    }
}
