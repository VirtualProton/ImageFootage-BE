<?php
namespace Tests\Unit;

use App\Helpers\PermissionHelper;
use App\Http\Middleware\CheckPermission;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class PermissionRegressionTest extends TestCase
{
    /** @dataProvider moduleCases */
    public function testUrlToModuleMapping($url, $module)
    {
        $this->assertSame($module, PermissionHelper::getModuleIdFromUrl($url));
    }

    public function moduleCases()
    {
        return [['admin/quotation/1', 10], ['/admin/users', 5], ['admin/accounts', 82],
            ['admin/product/7', 4], ['admin/subscribers', 7], ['admin/quotation_report', 11],
            ['admin/unmapped', null], ['admin/create_invoice', 10]];
    }

    /** @dataProvider actions */
    public function testRequestActionClassification($method, $url, $expected)
    {
        $this->assertSame($expected, PermissionHelper::getActionFromRequest($method, $url));
    }

    public function actions()
    {
        return [['DELETE', 'admin/product/1', 'delete'], ['GET', 'admin/deleteproduct/1', 'delete'],
            ['PATCH', 'admin/product/1', 'edit'], ['POST', 'admin/edit_quotation_data', 'edit'],
            ['POST', 'admin/saveInvoice', 'add'], ['GET', 'admin/add_product', 'add'],
            ['GET', 'admin/product/1/edit', 'edit'], ['GET', 'admin/quotation/1', 'view']];
    }

    public function testGuestHasNoPermissions()
    {
        $this->assertFalse(PermissionHelper::hasPermission(10, 'edit'));
    }

    public function testSuperAdminPassesProtectedMiddleware()
    {
        $admin = new Admin();
        $admin->setRawAttributes(['id' => 700001, 'role_id' => 1, 'department_id' => 1]);
        Auth::guard('admins')->setUser($admin);
        $response = (new CheckPermission())->handle(Request::create('/admin/quotation/1'), function () { return response('allowed'); }, 10, 'edit');
        $this->assertSame('allowed', $response->getContent());
    }

    public function testSubadminCanViewButCannotEditFromIndependentCachedPermissionFixture()
    {
        $admin = new Admin();
        $admin->setRawAttributes(['id' => 700002, 'role_id' => 3, 'department_id' => 2]);
        Auth::guard('admins')->setUser($admin);
        Cache::put('permissions_2_3_10', (object) ['can_view' => 1, 'can_add' => 0, 'can_edit' => 0, 'can_delete' => 0], 5);
        $this->assertTrue(PermissionHelper::hasPermission(10, 'view'));
        $this->assertFalse(PermissionHelper::hasPermission(10, 'edit'));
        $this->assertFalse(PermissionHelper::hasPermission(10, 'unknown'));
        $request = Request::create('/admin/quotation/1', 'POST');
        $request->headers->set('Accept', 'application/json');
        $response = (new CheckPermission())->handle($request, function () { throw new \RuntimeException('Forbidden next reached'); }, 10, 'edit');
        $this->assertSame(403, $response->getStatusCode());
        $this->assertSame(['error' => true, 'message' => 'You do not have permission to perform this action.'], $response->getData(true));
    }
}
