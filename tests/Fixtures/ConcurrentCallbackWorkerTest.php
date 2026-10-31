<?php
// Explicitly invoked by run-concurrent.php; excluded from default PHPUnit discovery.
use App\Models\Common;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Tests\Support\BusinessFixtures;
use Tests\Support\Fixtures;
use Tests\Support\GatewayTransport;
use Tests\Support\UploadSink;

class ConcurrentCallbackWorkerTest extends Tests\TestCase
{
    use BusinessFixtures;

    public function testIsolatedWorker()
    {
        $directory = realpath(getenv('PHASE2_CALLBACK_DIRECTORY'));
        $workspace = realpath(getenv('PHASE2_CALLBACK_WORKSPACE'));
        $this->assertNotFalse($directory);
        $this->assertSame($workspace, dirname($directory));
        $this->assertSame(0, strpos(basename($directory), 'callbacks-'));
        $job = getenv('PHASE2_CALLBACK_JOB');
        $this->assertContains($job, ['seed', 'a', 'b']);
        $this->businessFixtures($job === 'seed');
        if ($job === 'seed') {
            $this->expectQuotationLink();
            (new Common())->save_proforma($this->quotationRequest());
            $invoice = Invoice::firstOrFail();
            if (getenv('PHASE2_CALLBACK_COMPLETED') === '1') {
                Invoice::where('id', $invoice->id)->update(['status' => 1, 'payment_status' => 'Transction Success',
                    'proforma_type' => 2, 'invoice_url' => 'http://phase2.invalid/existing.pdf']);
            }
            file_put_contents($directory.'/invoice.json', json_encode(['id' => $invoice->id, 'name' => $invoice->invoice_name]));
            return;
        }
        $invoice = json_decode(file_get_contents($directory.'/invoice.json'), true);
        $status = getenv('PHASE2_CALLBACK_STATUS');
        $this->assertContains($status, ['paid', 'pending', 'cancelled']);
        $payload = ['id' => 'plink_phase22', 'reference_id' => 'QTN-'.$invoice['name'], 'amount' => 11800,
            'amount_paid' => 11800, 'currency' => 'INR', 'status' => $status];
        GatewayTransport::respond('GET', '/v1/payment_links/plink_phase22', $payload);
        // Only the winning conversion consumes this response. Transport still refuses any other request.
        GatewayTransport::respond('POST', '/v1/payment_links', ['id' => 'plink_phase23_invoice',
            'short_url' => 'http://phase2.invalid/invoice', 'status' => 'created']);
        $callback = Fixtures::callback(['razorpay_payment_link_id' => 'plink_phase22',
            'razorpay_payment_link_reference_id' => $payload['reference_id'], 'razorpay_payment_link_status' => $status]);
        file_put_contents($directory.'/'.$job.'.ready', (string) DB::selectOne('select connection_id() as id')->id);
        $this->get('/api/razorpayInvoiceResponse?'.http_build_query($callback))->assertStatus(302);
        file_put_contents($directory.'/'.$job.'.result', json_encode(['mail' => $this->mailTransport->messages()->count(),
            'uploads' => count(UploadSink::$uploads)]));
    }
}
