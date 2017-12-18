<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id')->comment('菜单id');
            $table->integer('pid')->comment('父菜单id');
            $table->string('url',50)->default('#')->comment('规则url');
            $table->string('name',50)->default('')->comment('规则名称');
            $table->string('icon',50)->default('')->comment('图标');
            $table->tinyInteger('ismenu')->default(0)->comment('是否为菜单');
            $table->string('buttonmark',50)->default('')->comment('按钮标识');
            $table->integer('createtime')->default(0)->comment('创建时间');
            $table->integer('updatetime')->default(0)->comment('更新时间');
            $table->integer('weigh')->default(0)->comment('权重');
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
        Schema::dropIfExists('menu');
    }
}
