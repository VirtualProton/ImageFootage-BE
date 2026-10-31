<?php
namespace Tests\Feature;

use App\Http\Controllers\Admin\InvoiceController;
use App\Models\Common;
use App\Models\User;
use Tests\Support\Fixtures;
use Tests\Support\ObservedConnection;
use Tests\TestCase;

class QuotationRegressionTest extends TestCase
{
    /** @dataProvider creationRequests */
    public function testExistingInvoiceCreationValidation(array $data, $valid)
    {
        $result = Fixtures::invoke(new InvoiceController(), 'validateInvoiceCreationRequest', [$data]);
        if ($valid) {
            $this->assertNull($result);
        } else {
            $this->assertSame(422, $result->getStatusCode());
            $this->assertSame('0', $result->getData(true)['resp']['statuscode']);
            $this->assertNotEmpty($result->getData(true)['resp']['statusdesc']);
        }
    }

    public function creationRequests()
    {
        return [[[], false], [['quotation_id' => 1, 'user_id' => 2, 'payment_method' => 'invalid'], false],
            [['quotation_id' => 1, 'user_id' => 2, 'payment_method' => 'chq'], false],
            [['quotation_id' => 1, 'user_id' => 2, 'payment_method' => 'chq', 'expiry_due_date' => 8], false],
            [['quotation_id' => 1, 'user_id' => 2, 'payment_method' => 'online'], true],
            [['quotation_id' => 1, 'user_id' => 2, 'payment_method' => 'chq', 'expiry_due_date' => 15], true]];
    }

    public function testMissingCustomerAddressListsRequiredFields()
    {
        $user = new User();
        $user->setRawAttributes(['country' => null, 'state' => null, 'city' => null, 'address' => null]);
        $response = Fixtures::invoke(new InvoiceController(), 'validateInvoiceUserDetails', [[], $user]);
        $this->assertSame(422, $response->getStatusCode());
        $this->assertSame('Please fill the required fields: Country, State, City, Street.', $response->getData(true)['resp']['statusdesc']);
    }

    public function testValidCustomerAddressCanComeFromRequest()
    {
        $this->assertNull(Fixtures::invoke(new InvoiceController(), 'validateInvoiceUserDetails', [
            ['country' => 1, 'state' => 2, 'city' => 3, 'address' => 'Synthetic Street'], new User()]));
    }

    /** @dataProvider statusChanges */
    public function testCommonStatusTransitionSqlAndGatewayCancellation($status, $paymentStatus)
    {
        $observer = new ObservedConnection($this->app);
        $common = \Mockery::mock(Common::class)->makePartial();
        if ($status === 3) {
            $common->shouldReceive('cancelRazorpayPaymentLinkForInvoice')->once()->with(700001, 'quotation_status_changed');
        } else {
            $common->shouldNotReceive('cancelRazorpayPaymentLinkForInvoice');
        }
        $response = $common->change_invoice_status(700001, $status);
        $this->assertSame('1', $response->getData(true)['resp']['statuscode']);
        $this->assertCount(1, $observer->writes);
        $this->assertContains('`imagefootage_performa_invoices`', $observer->writes[0]['query']);
        $this->assertContains($paymentStatus, $observer->writes[0]['bindings']);
        $this->assertContains(700001, $observer->writes[0]['bindings']);
    }

    public function statusChanges() { return [[0, 'Pending'], [1, 'Transction Success'], [3, 'Failed']]; }

    public function testMissingStatusUpdateReturnsExistingFailureContract()
    {
        $observer = new ObservedConnection($this->app);
        $observer->affected = 0;
        $response = Fixtures::common()->change_invoice_status(700001, 0);
        $this->assertSame('0', $response->getData(true)['resp']['statuscode']);
    }

    public function testAdminCancellationDelegatesGatewayCancellationAfterSuccessfulUpdate()
    {
        $observer = new ObservedConnection($this->app);
        $controller = new InvoiceController();
        $controller->Common = \Mockery::mock(Common::class);
        $controller->Common->shouldReceive('cancelRazorpayPaymentLinkForInvoice')->once()->with(700001, 'quotation_cancelled');
        $response = $controller->quotationCancel(700001);
        $this->assertContains('admin/quotation_report', $response->getTargetUrl());
        $this->assertContains('3', $observer->writes[0]['bindings']);
        $this->assertSame('Quotation Cancelled !!!', session('success'));
    }
}
