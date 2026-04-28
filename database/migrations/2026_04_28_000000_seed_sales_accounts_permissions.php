<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeedSalesAccountsPermissions extends Migration
{
    /**
     * Module IDs from imagefootage_modules table.
     */
    const MODULE_ADMIN_USER_MANAGEMENT = 1;
    const MODULE_PRODUCTS = 4;
    const MODULE_CLIENTS = 5;
    const MODULE_CONTRIBUTORS = 6;
    const MODULE_SUBSCRIPTIONS = 7;
    const MODULE_PLANS_PACKAGES = 8;
    const MODULE_TRANSACTIONS = 10;
    const MODULE_REPORTS = 11;
    const MODULE_HISTORY_CHECK = 12;
    const MODULE_PURCHASES = 13;
    const MODULE_REMINDER = 14;
    const MODULE_CATEGORIES = 15;
    const MODULE_FILTERS = 16;
    const MODULE_KEYWORDS = 17;
    const MODULE_AUTHENTICATION = 18;
    const MODULE_BULK_UPLOAD = 77;
    const MODULE_USERS = 82;
    const MODULE_PROMOTION = 88;
    const MODULE_MODULES = 91;
    const MODULE_DISCOUNT_MESSAGES = 101;
    const MODULE_PROMO_CODES = 104;

    /**
     * Department IDs.
     */
    const DEPT_SALES = 2;
    const DEPT_ACCOUNTS = 3;

    /**
     * Role IDs.
     */
    const ROLE_SUPER_ADMIN = 1;
    const ROLE_ADMIN = 2;
    const ROLE_AGENT = 3;

    /**
     * All parent module IDs to seed permissions for.
     */
    protected $allModules = [
        self::MODULE_ADMIN_USER_MANAGEMENT,
        self::MODULE_PRODUCTS,
        self::MODULE_CLIENTS,
        self::MODULE_CONTRIBUTORS,
        self::MODULE_SUBSCRIPTIONS,
        self::MODULE_PLANS_PACKAGES,
        self::MODULE_TRANSACTIONS,
        self::MODULE_REPORTS,
        self::MODULE_HISTORY_CHECK,
        self::MODULE_PURCHASES,
        self::MODULE_REMINDER,
        self::MODULE_CATEGORIES,
        self::MODULE_FILTERS,
        self::MODULE_KEYWORDS,
        self::MODULE_AUTHENTICATION,
        self::MODULE_BULK_UPLOAD,
        self::MODULE_USERS,
        self::MODULE_PROMOTION,
        self::MODULE_MODULES,
        self::MODULE_DISCOUNT_MESSAGES,
        self::MODULE_PROMO_CODES,
    ];

    /**
     * Run the migrations.
     *
     * Seeds the permission mappings for Sales and Accounts departments.
     *
     * SALES DEPARTMENT:
     *   Super Admin - Full access to everything
     *   Admin       - Create, View & Edit: Invoice, All Client Info, Plans & Packages, Discount codes, Payment links
     *   Agent       - Create: Client, Invoice, PO. View everything. Limited edit (Proforma Invoice only). Reports for region only.
     *
     * ACCOUNTS DEPARTMENT:
     *   Super Admin - Full access to everything
     *   Admin       - Create, View & Edit: Client Info, GST details, Payment info, Download reports
     *   Agent       - Create: Client, Invoice. Update Payment status/details. View & download all reports.
     */
    public function up()
    {
        // =============================================
        // SALES DEPARTMENT (ID: 2)
        // =============================================

        // --- Sales Super Admin: Full access to all modules ---
        foreach ($this->allModules as $moduleId) {
            $this->upsertPermission(self::DEPT_SALES, self::ROLE_SUPER_ADMIN, $moduleId, 1, 1, 1, 1);
        }

        // --- Sales Admin: Create, View & Edit specific modules ---
        // Clients - full CRUD
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_ADMIN, self::MODULE_CLIENTS, 1, 1, 1, 0);
        // Transactions/Invoices - create, view, edit
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_ADMIN, self::MODULE_TRANSACTIONS, 1, 1, 1, 0);
        // Plans & Packages - create, view, edit
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_ADMIN, self::MODULE_PLANS_PACKAGES, 1, 1, 1, 0);
        // Discount Messages - create, view, edit
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_ADMIN, self::MODULE_DISCOUNT_MESSAGES, 1, 1, 1, 0);
        // Promo Codes (Discount codes) - create, view, edit
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_ADMIN, self::MODULE_PROMO_CODES, 1, 1, 1, 0);
        // Reports - view only
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_ADMIN, self::MODULE_REPORTS, 0, 0, 1, 0);
        // Products - view only
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_ADMIN, self::MODULE_PRODUCTS, 0, 0, 1, 0);
        // Subscriptions - view only
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_ADMIN, self::MODULE_SUBSCRIPTIONS, 0, 0, 1, 0);
        // Contributors - view only
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_ADMIN, self::MODULE_CONTRIBUTORS, 0, 0, 1, 0);
        // Users (Staff) - no access
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_ADMIN, self::MODULE_USERS, 0, 0, 0, 0);
        // Admin User Management - no access
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_ADMIN, self::MODULE_ADMIN_USER_MANAGEMENT, 0, 0, 0, 0);
        // Promotion - view only
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_ADMIN, self::MODULE_PROMOTION, 0, 0, 1, 0);
        // Modules management - no access
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_ADMIN, self::MODULE_MODULES, 0, 0, 0, 0);
        // Other view-only modules
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_ADMIN, self::MODULE_CATEGORIES, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_ADMIN, self::MODULE_FILTERS, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_ADMIN, self::MODULE_HISTORY_CHECK, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_ADMIN, self::MODULE_PURCHASES, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_ADMIN, self::MODULE_REMINDER, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_ADMIN, self::MODULE_KEYWORDS, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_ADMIN, self::MODULE_AUTHENTICATION, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_ADMIN, self::MODULE_BULK_UPLOAD, 0, 0, 0, 0);

        // --- Sales Agent (User): Create Client, Invoice, PO. View everything. Edit Proforma Invoice only. ---
        // Clients - create & view (no edit, no delete)
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_AGENT, self::MODULE_CLIENTS, 1, 0, 1, 0);
        // Transactions/Invoices - create & view, edit (for Proforma Invoice editing)
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_AGENT, self::MODULE_TRANSACTIONS, 1, 1, 1, 0);
        // Reports - view only (region-restricted - handled in controller)
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_AGENT, self::MODULE_REPORTS, 0, 0, 1, 0);
        // Plans & Packages - view only
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_AGENT, self::MODULE_PLANS_PACKAGES, 0, 0, 1, 0);
        // Discount Messages - view only
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_AGENT, self::MODULE_DISCOUNT_MESSAGES, 0, 0, 1, 0);
        // Promo Codes - view only
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_AGENT, self::MODULE_PROMO_CODES, 0, 0, 1, 0);
        // Products - view only
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_AGENT, self::MODULE_PRODUCTS, 0, 0, 1, 0);
        // Subscriptions - view only
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_AGENT, self::MODULE_SUBSCRIPTIONS, 0, 0, 1, 0);
        // Contributors - view only
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_AGENT, self::MODULE_CONTRIBUTORS, 0, 0, 1, 0);
        // Users (Staff) - no access
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_AGENT, self::MODULE_USERS, 0, 0, 0, 0);
        // Admin User Management - no access
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_AGENT, self::MODULE_ADMIN_USER_MANAGEMENT, 0, 0, 0, 0);
        // Promotion - view only
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_AGENT, self::MODULE_PROMOTION, 0, 0, 1, 0);
        // Modules - no access
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_AGENT, self::MODULE_MODULES, 0, 0, 0, 0);
        // Other view-only modules
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_AGENT, self::MODULE_CATEGORIES, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_AGENT, self::MODULE_FILTERS, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_AGENT, self::MODULE_HISTORY_CHECK, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_AGENT, self::MODULE_PURCHASES, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_AGENT, self::MODULE_REMINDER, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_AGENT, self::MODULE_KEYWORDS, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_AGENT, self::MODULE_AUTHENTICATION, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_SALES, self::ROLE_AGENT, self::MODULE_BULK_UPLOAD, 0, 0, 0, 0);

        // =============================================
        // ACCOUNTS DEPARTMENT (ID: 3)
        // =============================================

        // --- Accounts Super Admin: Full access to all modules ---
        foreach ($this->allModules as $moduleId) {
            $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_SUPER_ADMIN, $moduleId, 1, 1, 1, 1);
        }

        // --- Accounts Admin: Create, View & Edit Client Info, GST, Payment info, Download reports ---
        // Clients - create, view, edit (for Client Info & GST details)
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_ADMIN, self::MODULE_CLIENTS, 1, 1, 1, 0);
        // Transactions - create, view, edit (for Payment info updates)
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_ADMIN, self::MODULE_TRANSACTIONS, 1, 1, 1, 0);
        // Reports - view (for download reports)
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_ADMIN, self::MODULE_REPORTS, 0, 0, 1, 0);
        // Plans & Packages - view only
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_ADMIN, self::MODULE_PLANS_PACKAGES, 0, 0, 1, 0);
        // Products - view only
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_ADMIN, self::MODULE_PRODUCTS, 0, 0, 1, 0);
        // Subscriptions - view only
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_ADMIN, self::MODULE_SUBSCRIPTIONS, 0, 0, 1, 0);
        // Contributors - view only
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_ADMIN, self::MODULE_CONTRIBUTORS, 0, 0, 1, 0);
        // Users (Staff) - no access
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_ADMIN, self::MODULE_USERS, 0, 0, 0, 0);
        // Admin User Management - no access
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_ADMIN, self::MODULE_ADMIN_USER_MANAGEMENT, 0, 0, 0, 0);
        // Discount Messages - view only
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_ADMIN, self::MODULE_DISCOUNT_MESSAGES, 0, 0, 1, 0);
        // Promo Codes - view only
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_ADMIN, self::MODULE_PROMO_CODES, 0, 0, 1, 0);
        // Promotion - view only
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_ADMIN, self::MODULE_PROMOTION, 0, 0, 1, 0);
        // Modules - no access
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_ADMIN, self::MODULE_MODULES, 0, 0, 0, 0);
        // Other view-only modules
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_ADMIN, self::MODULE_CATEGORIES, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_ADMIN, self::MODULE_FILTERS, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_ADMIN, self::MODULE_HISTORY_CHECK, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_ADMIN, self::MODULE_PURCHASES, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_ADMIN, self::MODULE_REMINDER, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_ADMIN, self::MODULE_KEYWORDS, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_ADMIN, self::MODULE_AUTHENTICATION, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_ADMIN, self::MODULE_BULK_UPLOAD, 0, 0, 0, 0);

        // --- Accounts Agent (User): Create Client & Invoice, Update Payment, View & download reports ---
        // Clients - create & view (no full edit, no delete)
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_AGENT, self::MODULE_CLIENTS, 1, 0, 1, 0);
        // Transactions - create & edit (for Payment status updates)
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_AGENT, self::MODULE_TRANSACTIONS, 1, 1, 1, 0);
        // Reports - view (download all reports)
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_AGENT, self::MODULE_REPORTS, 0, 0, 1, 0);
        // Plans & Packages - view only
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_AGENT, self::MODULE_PLANS_PACKAGES, 0, 0, 1, 0);
        // Products - view only
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_AGENT, self::MODULE_PRODUCTS, 0, 0, 1, 0);
        // Subscriptions - view only
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_AGENT, self::MODULE_SUBSCRIPTIONS, 0, 0, 1, 0);
        // Contributors - view only
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_AGENT, self::MODULE_CONTRIBUTORS, 0, 0, 1, 0);
        // Users (Staff) - no access
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_AGENT, self::MODULE_USERS, 0, 0, 0, 0);
        // Admin User Management - no access
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_AGENT, self::MODULE_ADMIN_USER_MANAGEMENT, 0, 0, 0, 0);
        // Discount Messages - view only
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_AGENT, self::MODULE_DISCOUNT_MESSAGES, 0, 0, 1, 0);
        // Promo Codes - view only
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_AGENT, self::MODULE_PROMO_CODES, 0, 0, 1, 0);
        // Promotion - no access
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_AGENT, self::MODULE_PROMOTION, 0, 0, 0, 0);
        // Modules - no access
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_AGENT, self::MODULE_MODULES, 0, 0, 0, 0);
        // Other view-only modules
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_AGENT, self::MODULE_CATEGORIES, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_AGENT, self::MODULE_FILTERS, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_AGENT, self::MODULE_HISTORY_CHECK, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_AGENT, self::MODULE_PURCHASES, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_AGENT, self::MODULE_REMINDER, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_AGENT, self::MODULE_KEYWORDS, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_AGENT, self::MODULE_AUTHENTICATION, 0, 0, 1, 0);
        $this->upsertPermission(self::DEPT_ACCOUNTS, self::ROLE_AGENT, self::MODULE_BULK_UPLOAD, 0, 0, 0, 0);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Remove all seeded permissions for Sales and Accounts departments
        DB::table('imagefootage_roles_modules_mapping')
            ->whereIn('department_id', [self::DEPT_SALES, self::DEPT_ACCOUNTS])
            ->delete();
    }

    /**
     * Insert or update a permission mapping.
     *
     * @param int $deptId
     * @param int $roleId
     * @param int $moduleId
     * @param int $canAdd
     * @param int $canEdit
     * @param int $canView
     * @param int $canDelete
     */
    protected function upsertPermission($deptId, $roleId, $moduleId, $canAdd, $canEdit, $canView, $canDelete)
    {
        $existing = DB::table('imagefootage_roles_modules_mapping')
            ->where('department_id', $deptId)
            ->where('role_id', $roleId)
            ->where('module_id', $moduleId)
            ->first();

        if ($existing) {
            DB::table('imagefootage_roles_modules_mapping')
                ->where('id', $existing->id)
                ->update([
                    'can_add' => $canAdd,
                    'can_edit' => $canEdit,
                    'can_view' => $canView,
                    'can_delete' => $canDelete,
                    'updated_at' => now(),
                ]);
        } else {
            DB::table('imagefootage_roles_modules_mapping')->insert([
                'department_id' => $deptId,
                'role_id' => $roleId,
                'module_id' => $moduleId,
                'can_add' => $canAdd,
                'can_edit' => $canEdit,
                'can_view' => $canView,
                'can_delete' => $canDelete,
                'status' => 'A',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
