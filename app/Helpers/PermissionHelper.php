<?php

namespace App\Helpers;

use App\Models\RolesModulesMapping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PermissionHelper
{
    /**
     * Module ID constants matching imagefootage_modules table.
     */
    const MODULE_ADMIN_USER_MANAGEMENT = 1;
    const MODULE_PRODUCTS = 4;
    const MODULE_CLIENTS = 5;
    const MODULE_CONTRIBUTORS = 6;
    const MODULE_SUBSCRIPTIONS = 7;
    const MODULE_PLANS_PACKAGES = 8;
    const MODULE_TRANSACTIONS = 10;
    const MODULE_REPORTS = 11;
    const MODULE_PURCHASES = 13;
    const MODULE_CATEGORIES = 15;
    const MODULE_FILTERS = 16;
    const MODULE_USERS = 82;
    const MODULE_PROMOTION = 88;
    const MODULE_MODULES = 91;
    const MODULE_DISCOUNT_MESSAGES = 101;
    const MODULE_PROMO_CODES = 104;

    /**
     * Department ID constants.
     */
    const DEPT_OPERATIONS = 1;
    const DEPT_SALES = 2;
    const DEPT_ACCOUNTS = 3;

    /**
     * Role ID constants.
     */
    const ROLE_SUPER_ADMIN = 1;
    const ROLE_ADMIN = 2;
    const ROLE_AGENT = 3;

    /**
     * Map of URL patterns to parent module IDs.
     */
    protected static $urlModuleMap = [
        // Admin User Management (module 1)
        'subadmin' => self::MODULE_ADMIN_USER_MANAGEMENT,
        'accounts' => self::MODULE_USERS,

        // Products (module 4)
        'add_product' => self::MODULE_PRODUCTS,
        'all_products' => self::MODULE_PRODUCTS,
        'createproduct' => self::MODULE_PRODUCTS,
        'editproduct' => self::MODULE_PRODUCTS,
        'viewproduct' => self::MODULE_PRODUCTS,
        'deleteproduct' => self::MODULE_PRODUCTS,
        'product' => self::MODULE_PRODUCTS,
        'upload_products_csv' => self::MODULE_PRODUCTS,

        // Clients (module 5)
        'users' => self::MODULE_CLIENTS,
        'new_registrants' => self::MODULE_CLIENTS,
        'opportunities' => self::MODULE_CLIENTS,
        'add_po' => self::MODULE_CLIENTS,
        'save_po' => self::MODULE_CLIENTS,
        'update_po' => self::MODULE_CLIENTS,

        // Contributors (module 6)
        'contributor' => self::MODULE_CONTRIBUTORS,
        'add_contributor' => self::MODULE_CONTRIBUTORS,
        'contributor_list' => self::MODULE_CONTRIBUTORS,

        // Subscriptions (module 7)
        'subscribers' => self::MODULE_SUBSCRIPTIONS,

        // Plans & Packages (module 8)
        'create_package' => self::MODULE_PLANS_PACKAGES,
        'package_list' => self::MODULE_PLANS_PACKAGES,
        'addpackage' => self::MODULE_PLANS_PACKAGES,
        'updatepackage' => self::MODULE_PLANS_PACKAGES,
        'editpackage' => self::MODULE_PLANS_PACKAGES,
        'deletepackage' => self::MODULE_PLANS_PACKAGES,
        'package' => self::MODULE_PLANS_PACKAGES,
        'plans' => self::MODULE_PLANS_PACKAGES,
        'add_api_quota' => self::MODULE_PLANS_PACKAGES,
        'api_quota_list' => self::MODULE_PLANS_PACKAGES,

        // Transactions (module 10)
        'send_invoice' => self::MODULE_TRANSACTIONS,
        'purchase_orders' => self::MODULE_TRANSACTIONS,
        'create_invoice' => self::MODULE_TRANSACTIONS,
        'saveInvoice' => self::MODULE_TRANSACTIONS,
        'quotation' => self::MODULE_TRANSACTIONS,
        'edit_quotation' => self::MODULE_TRANSACTIONS,
        'invoice' => self::MODULE_TRANSACTIONS,
        'invoice_cancel' => self::MODULE_TRANSACTIONS,
        'change_invoice_status' => self::MODULE_TRANSACTIONS,
        'saveSubscriptionInvoice' => self::MODULE_TRANSACTIONS,
        'saveDownloadInvoice' => self::MODULE_TRANSACTIONS,
        'create_invoice_subcription' => self::MODULE_TRANSACTIONS,

        // Reports (module 11)
        'orders' => self::MODULE_REPORTS,
        'abandoned_cart' => self::MODULE_REPORTS,
        'new_client_sales' => self::MODULE_REPORTS,
        'quotation_report' => self::MODULE_REPORTS,
        'outstanding_report' => self::MODULE_REPORTS,
        'outstanding-report-data' => self::MODULE_REPORTS,

        // Categories (module 15)
        'add_product_category' => self::MODULE_CATEGORIES,
        'all_product_category' => self::MODULE_CATEGORIES,
        'add_product_subcategory' => self::MODULE_CATEGORIES,
        'all_product_subcategory' => self::MODULE_CATEGORIES,

        // Filters (module 16)
        'add_product_colors' => self::MODULE_FILTERS,
        'product_colors_list' => self::MODULE_FILTERS,
        'add_product_gender' => self::MODULE_FILTERS,
        'product_gender_list' => self::MODULE_FILTERS,
        'add_product_ethinicities' => self::MODULE_FILTERS,
        'product_ethinicities_list' => self::MODULE_FILTERS,
        'add_product_locations' => self::MODULE_FILTERS,
        'product_locations_list' => self::MODULE_FILTERS,
        'add_product_image_sizes' => self::MODULE_FILTERS,
        'product_image_sizes_list' => self::MODULE_FILTERS,
        'add_product_image_types' => self::MODULE_FILTERS,
        'product_image_types_list' => self::MODULE_FILTERS,
        'add_product_image_peoples' => self::MODULE_FILTERS,
        'product_image_peoples_list' => self::MODULE_FILTERS,
        'add_product_orientations' => self::MODULE_FILTERS,
        'product_orientations_list' => self::MODULE_FILTERS,
        'add_product_sort_type' => self::MODULE_FILTERS,
        'product_sort_type_list' => self::MODULE_FILTERS,

        // Promotion (module 88)
        'add_promotion' => self::MODULE_PROMOTION,
        'list_promotion' => self::MODULE_PROMOTION,

        // Discount Messages (module 101)
        'list_discount_message' => self::MODULE_DISCOUNT_MESSAGES,
        'add_discount_message' => self::MODULE_DISCOUNT_MESSAGES,

        // Promo Codes (module 104)
        'promo-codes' => self::MODULE_PROMO_CODES,

        // Modules management (module 91)
        'add_module' => self::MODULE_MODULES,
        'list_module' => self::MODULE_MODULES,
    ];

    /**
     * Get current admin user.
     */
    public static function getAdmin()
    {
        return Auth::guard('admins')->user();
    }

    /**
     * Check if the current user has a specific permission on a module.
     *
     * @param int $moduleId
     * @param string $action  One of: 'view', 'add', 'edit', 'delete'
     * @return bool
     */
    public static function hasPermission($moduleId, $action = 'view')
    {
        $user = self::getAdmin();
        if (!$user) {
            return false;
        }

        // Super Admin of Operations can do everything
        if ($user->role_id == self::ROLE_SUPER_ADMIN && $user->department_id == self::DEPT_OPERATIONS) {
            return true;
        }

        // Super Admin of any department can do everything within their scope
        if ($user->role_id == self::ROLE_SUPER_ADMIN) {
            return true;
        }

        $cacheKey = "permissions_{$user->department_id}_{$user->role_id}_{$moduleId}";

        $mapping = Cache::remember($cacheKey, 300, function () use ($user, $moduleId) {
            return RolesModulesMapping::where('department_id', $user->department_id)
                ->where('role_id', $user->role_id)
                ->where('module_id', $moduleId)
                ->first();
        });

        if (!$mapping) {
            return false;
        }

        $columnMap = [
            'view' => 'can_view',
            'add' => 'can_add',
            'edit' => 'can_edit',
            'delete' => 'can_delete',
        ];

        $column = $columnMap[$action] ?? null;
        if (!$column) {
            return false;
        }

        return (int) $mapping->$column === 1;
    }

    /**
     * Check permission and abort if denied.
     *
     * @param int $moduleId
     * @param string $action
     */
    public static function authorize($moduleId, $action = 'view')
    {
        if (!self::hasPermission($moduleId, $action)) {
            abort(403, 'You do not have permission to perform this action.');
        }
    }

    /**
     * Resolve module ID from a URL segment.
     *
     * @param string $url
     * @return int|null
     */
    public static function getModuleIdFromUrl($url)
    {
        // Remove /admin/ prefix and get first segment
        $path = trim($url, '/');
        $path = preg_replace('#^admin/#', '', $path);
        $firstSegment = explode('/', $path)[0];

        return self::$urlModuleMap[$firstSegment] ?? null;
    }

    /**
     * Determine the action type from the HTTP method and URL.
     *
     * @param string $method
     * @param string $url
     * @return string
     */
    public static function getActionFromRequest($method, $url)
    {
        $path = trim($url, '/');
        $path = preg_replace('#^admin/#', '', $path);

        // DELETE requests
        if ($method === 'DELETE' || strpos($path, 'delete') !== false) {
            return 'delete';
        }

        // POST/PUT/PATCH for updates
        if (in_array($method, ['PUT', 'PATCH'])) {
            return 'edit';
        }

        // POST requests - check if it's a create or update
        if ($method === 'POST') {
            if (strpos($path, 'edit') !== false || strpos($path, 'update') !== false) {
                return 'edit';
            }
            return 'add';
        }

        // GET requests - check if it's a create form or edit form
        if (strpos($path, '/create') !== false || strpos($path, 'add_') !== false || strpos($path, 'create_') !== false) {
            return 'add';
        }
        if (strpos($path, '/edit') !== false || strpos($path, 'update') !== false || strpos($path, 'edit') !== false) {
            return 'edit';
        }

        return 'view';
    }

    /**
     * Get all permissions for the current user as a keyed array.
     * Useful for passing to views.
     *
     * @return array  [module_id => ['can_view' => 1, 'can_add' => 0, ...]]
     */
    public static function getAllPermissions()
    {
        $user = self::getAdmin();
        if (!$user) {
            return [];
        }

        $cacheKey = "all_permissions_{$user->department_id}_{$user->role_id}";

        return Cache::remember($cacheKey, 300, function () use ($user) {
            return RolesModulesMapping::where('department_id', $user->department_id)
                ->where('role_id', $user->role_id)
                ->get()
                ->keyBy('module_id')
                ->map(function ($item) {
                    return [
                        'can_view' => (int) $item->can_view,
                        'can_add' => (int) $item->can_add,
                        'can_edit' => (int) $item->can_edit,
                        'can_delete' => (int) $item->can_delete,
                    ];
                })
                ->toArray();
        });
    }

    /**
     * Check if user belongs to a specific department.
     *
     * @param int $departmentId
     * @return bool
     */
    public static function isDepartment($departmentId)
    {
        $user = self::getAdmin();
        return $user && (int) $user->department_id === $departmentId;
    }

    /**
     * Check if user has a specific role.
     *
     * @param int $roleId
     * @return bool
     */
    public static function isRole($roleId)
    {
        $user = self::getAdmin();
        return $user && (int) $user->role_id === $roleId;
    }

    /**
     * Check if user is Super Admin.
     *
     * @return bool
     */
    public static function isSuperAdmin()
    {
        return self::isRole(self::ROLE_SUPER_ADMIN);
    }

    /**
     * Clear permission cache for a specific department/role combination.
     *
     * @param int $departmentId
     * @param int $roleId
     */
    public static function clearCache($departmentId = null, $roleId = null)
    {
        if ($departmentId && $roleId) {
            Cache::forget("all_permissions_{$departmentId}_{$roleId}");
        }
    }
}
