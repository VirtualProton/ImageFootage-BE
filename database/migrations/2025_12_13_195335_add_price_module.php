<?php

use Illuminate\Database\Migrations\Migration;

/**
 * 
 * Add Price Module Migration
 */
class AddPriceModule extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Find editorial parent module or create new parent
        $parentModule = DB::table('imagefootage_modules')->where('module_name', 'Settings')->first();
        
        if (!$parentModule) {
            // Create parent module if doesn't exist
            $parentId = DB::table('imagefootage_modules')->insertGetId([
                'module_name' => 'Price Management',
                'module_icon' => 'fa fa-cog',
                'url' => NULL,
                'parent_module_id' => 0,
                'status' => 1,
                'sort_order' => 100,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } else {
            $parentId = $parentModule->id;
        }
        
        // Insert Price module
        $listPriceModuleId = DB::table('imagefootage_modules')->insertGetId([
            'module_name' => 'List Price',
            'url' => 'price',
            'parent_module_id' => $parentId,
            'status' => 1,
            'sort_order' => 101,
            'created_at' => now(),
            'updated_at' => now()
        ]);

         $addPriceModuleId = DB::table('imagefootage_modules')->insertGetId([
            'module_name' => 'Add Price',
            'url' => 'price/create',
            'parent_module_id' => $parentId,
            'status' => 1,
            'sort_order' => 102,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        // Assign to all roles and departments
        $rolesMapping = [
            ['role_id' => 1, 'department_id' => 1], // Super Admin Operations
            ['role_id' => 2, 'department_id' => 1], // Admin Operations
            ['role_id' => 1, 'department_id' => 2], // Super Admin Sales
            ['role_id' => 2, 'department_id' => 2], // Admin Sales
            ['role_id' => 1, 'department_id' => 3], // Super Admin Accounts
            ['role_id' => 2, 'department_id' => 3], // Admin Accounts
        ];
        
        foreach ($rolesMapping as $mapping) {
            DB::table('imagefootage_roles_modules_mapping')->insert([
                'role_id' => $mapping['role_id'],
                'department_id' => $mapping['department_id'],
                'module_id' => $listPriceModuleId,
                'can_view' => 1,
                'can_add' => 1,
                'can_edit' => 1,
                'can_delete' => 0,
                'status' => 'A',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::table('imagefootage_roles_modules_mapping')->insert([
                'role_id' => $mapping['role_id'],
                'department_id' => $mapping['department_id'],
                'module_id' => $addPriceModuleId,
                'can_view' => 1,
                'can_add' => 1,
                'can_edit' => 1,
                'can_delete' => 0,
                'status' => 'A',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
                // Delete List Price module
        $listPriceModule = DB::table('imagefootage_modules')->where('module_name', 'List Price')->first();
        if ($listPriceModule) {
            DB::table('imagefootage_roles_modules_mapping')->where('module_id', $listPriceModule->id)->delete();
            DB::table('imagefootage_modules')->where('id', $listPriceModule->id)->delete();
        }
        
        // Delete Add Price module
        $addPriceModule = DB::table('imagefootage_modules')->where('module_name', 'Add Price')->first();
        if ($addPriceModule) {
            DB::table('imagefootage_roles_modules_mapping')->where('module_id', $addPriceModule->id)->delete();
            DB::table('imagefootage_modules')->where('id', $addPriceModule->id)->delete();
        }
        
        // Delete parent module if no other children
        $parentModule = DB::table('imagefootage_modules')->where('module_name', 'Price Management')->first();
        if ($parentModule) {
            $hasChildren = DB::table('imagefootage_modules')->where('parent_module_id', $parentModule->id)->exists();
            if (!$hasChildren) {
                DB::table('imagefootage_modules')->where('id', $parentModule->id)->delete();
            }
        }
    }
}