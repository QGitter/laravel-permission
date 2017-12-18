<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table->increments('id')->comment('角色组id');
            $table->integer('pid')->default('0')->comment('父角色组id');
            $table->string('name',100)->default('')->comment('组名');
            $table->integer('createtime')->default(0)->comment('创建时间');
            $table->integer('updatetime')->default(0)->comment('更新时间');
            $table->tinyInteger('status')->default(1)->comment('状态');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role');
    }
}
