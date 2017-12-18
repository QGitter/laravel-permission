<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminMapRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_map_role', function (Blueprint $table) {
            $table->increments('id')->comment('自增id');
            $table->integer('uid')->comment('用户id');
            $table->integer('roleid')->default('0')->comment('角色组id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_map_role');
    }
}
