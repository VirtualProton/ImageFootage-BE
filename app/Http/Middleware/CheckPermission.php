<?php

namespace App\Http\Middleware;

use App\Helpers\PermissionHelper;
use App\Models\Invoice;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    private function resolveTransactionInvoiceId($request): ?int
    {
        if ($request->route('id')) {
            return (int) $request->route('id');
        }

        foreach (['quotation_id', 'quotation'] as $key) {
            if ($request->filled($key)) {
                return (int) $request->input($key);
            }
        }

        return null;
    }

    private function shouldBypassPackAndCustomTransactionPermission($request, $user): bool
    {
        if ((int) $user->department_id !== PermissionHelper::DEPT_ACCOUNTS) {
            return false;
        }

        $route = $request->route();
        if (!$route) {
            return false;
        }

        $supportedActions = [
            'edit_quotation',
            'edit_quotation_data',
            'create_invoice',
            'create_invoice_subcription',
            'change_invoice_status',
            'invoiceCancel',
        ];

        if (!in_array((string) $route->getActionMethod(), $supportedActions, true)) {
            return false;
        }

        $invoiceId = $this->resolveTransactionInvoiceId($request);
        if ($invoiceId <= 0) {
            return false;
        }

        $invoice = Invoice::select('id', 'invoice_type')->find($invoiceId);

        return $invoice && in_array((int) $invoice->invoice_type, [2, 3], true);
    }

    /**
     * Handle an incoming request.
     *
     * Check if the authenticated admin has the required permission
     * for the module being accessed.
     *
     * Usage in routes:
     *   ->middleware('check.permission:5,view')     // module_id, action
     *   ->middleware('check.permission:5')           // defaults to auto-detect action
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int|null  $moduleId
     * @param  string|null  $action
     * @return mixed
     */
    public function handle($request, Closure $next, $moduleId = null, $action = null)
    {
        $user = Auth::guard('admins')->user();

        if (!$user) {
            return redirect('/admin/login');
        }

        // Super Admin bypasses all checks
        if ((int) $user->role_id === PermissionHelper::ROLE_SUPER_ADMIN) {
            return $next($request);
        }

        // If no module ID provided, try to resolve from URL
        if (!$moduleId) {
            $moduleId = PermissionHelper::getModuleIdFromUrl($request->path());
        }

        // If we still can't determine the module, allow access (unprotected route)
        if (!$moduleId) {
            return $next($request);
        }

        // If no action specified, auto-detect from HTTP method + URL
        if (!$action) {
            $action = PermissionHelper::getActionFromRequest($request->method(), $request->path());
        }

        if ($this->shouldBypassPackAndCustomTransactionPermission($request, $user)) {
            return $next($request);
        }

        if (!PermissionHelper::hasPermission((int) $moduleId, $action)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['error' => true, 'message' => 'You do not have permission to perform this action.'], 403);
            }
            return redirect()->back()->with('error', 'You do not have permission to perform this action.');
        }

        return $next($request);
    }
}
