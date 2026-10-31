<?php
namespace Tests\Feature;

use App\Console\Commands\QuotationDeactive;
use App\Jobs\SendEmail;
use App\Jobs\SendPlanEmail;
use App\Jobs\FetchThirdPartyData;
use App\Models\Common;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Queue;
use Tests\Support\ObservedConnection;
use Tests\TestCase;

class QueueSchedulerRegressionTest extends TestCase
{
    public function testEmailAndMediaJobsDispatchWithoutRunningHandles()
    {
        $details = ['type' => 'Image', 'category_id' => 700001, 'page_number' => 2, 'all_request' => []];
        dispatch(new FetchThirdPartyData($details));
        dispatch(new SendEmail([['order_email' => 'synthetic@example.invalid', 'txn_id' => 'PHASE2-ORDER']]));
        dispatch(new SendPlanEmail(['user' => ['email' => 'synthetic@example.invalid'], 'transaction_id' => 'PHASE2-PLAN']));
        Queue::assertPushed(FetchThirdPartyData::class, function ($job) use ($details) {
            $property = new \ReflectionProperty($job, 'details');
            $property->setAccessible(true);
            return $property->getValue($job) === $details;
        });
        Queue::assertPushed(SendEmail::class, 1);
        Queue::assertPushed(SendPlanEmail::class, 1);
        \Illuminate\Support\Facades\Mail::assertNothingSent();
    }

    public function testSchedulerRegistersOnlyExistingActiveBusinessCadences()
    {
        $events = $this->app->make(Schedule::class)->events();
        $found = [];
        foreach ($events as $event) {
            foreach (['quotation:deactive', 'package:to-credit-balance'] as $command) {
                if (strpos($event->command, $command) !== false) {
                    $found[$command] = $event->expression;
                }
            }
        }
        $this->assertSame('0 * * * *', $found['quotation:deactive']);
        $this->assertSame('0 0 * * *', $found['package:to-credit-balance']);
        $this->assertCount(2, $events);
    }

    public function testQuotationExpiryDelegatesGatewayCancellationAndCompilesScopedUpdate()
    {
        $connection = new ObservedConnection($this->app);
        $connection->rows = [(object) ['id' => 700001, 'status' => 0, 'proforma_type' => 1, 'cancelled_on' => '2026-10-29 12:00:00']];
        $common = \Mockery::mock(Common::class);
        $common->shouldReceive('cancelRazorpayPaymentLinkForInvoice')->once()
            ->with(\Mockery::on(function ($invoice) { return $invoice->id === 700001; }), 'quotation_expired');
        $this->app->instance(Common::class, $common);
        (new QuotationDeactive())->handle();
        $this->assertContains('`cancelled_on` <= ?', $connection->reads[0]['query']);
        $this->assertContains('`proforma_type` = ?', $connection->reads[0]['query']);
        $this->assertContains('`status` = ?', $connection->reads[0]['query']);
        $this->assertCount(1, $connection->writes);
        $this->assertContains(3, $connection->writes[0]['bindings']);
        $this->assertContains('2026-10-29 12:00:00', $connection->writes[0]['bindings']);
    }

    public function testNoEligibleQuotationCausesNoWrite()
    {
        $connection = new ObservedConnection($this->app);
        $common = \Mockery::mock(Common::class);
        $common->shouldNotReceive('cancelRazorpayPaymentLinkForInvoice');
        $this->app->instance(Common::class, $common);
        (new QuotationDeactive())->handle();
        $this->assertSame([], $connection->writes);
    }

    public function testEmptyOrAlreadyProcessedExpiryQueryIsRepeatableAtBoundary()
    {
        $connection = new ObservedConnection($this->app);
        (new QuotationDeactive())->handle();
        Carbon::setTestNow(Carbon::now()->addSecond());
        (new QuotationDeactive())->handle();
        $this->assertCount(2, $connection->reads);
        $this->assertSame([], $connection->writes);
        $first = $connection->reads[0]['bindings'][0];
        $second = $connection->reads[1]['bindings'][0];
        $this->assertSame(1, $second->timestamp - $first->timestamp);
    }
}
