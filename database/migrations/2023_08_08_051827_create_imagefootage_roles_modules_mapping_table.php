<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageRolesModulesMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_roles_modules_mapping', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('department_id')->nullable();
            $table->integer('role_id');
            $table->integer('module_id');
            $table->smallInteger('can_add');
            $table->smallInteger('can_edit');
            $table->smallInteger('can_view');
            $table->smallInteger('can_delete');
            $table->enum('status', ['A', 'I'])->default('A')->comment('1=>Active,0=>Inactiive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_roles_modules_mapping');
    }
}
