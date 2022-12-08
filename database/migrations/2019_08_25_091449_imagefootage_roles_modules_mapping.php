<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImagefootageRolesModulesMapping extends Migration
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
            $table->integer('role_id')->nullable(false);
            $table->integer('module_id')->nullable(false);
            $table->enum('can_add',["1","0"])->nullable("0");
            $table->enum('can_edit',["1","0"])->nullable("0");
            $table->enum('can_view',["1","0"])->nullable("0");
            $table->enum('can_delete',["1","0"])->default("0");
            $table->enum('status',['A', 'I'])->default("A")->comment('1=>Active,0=>Inactiive');
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
