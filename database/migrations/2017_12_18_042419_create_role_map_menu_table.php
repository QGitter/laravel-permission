<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleMapMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_map_menu', function (Blueprint $table) {
            $table->increments('id')->comment('自增id');
            $table->integer('menuid')->default(0)->comment('菜单id');
            $table->integer('roleid')->default(0)->comment('角色组id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_map_menu');
    }
}
