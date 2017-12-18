<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id')->comment('用户id');
            $table->string('username', 100)->default('')->comment('用户名');
            $table->string('nickname', 100)->default('')->comment('昵称');
            $table->string('password', 40)->default('')->comment('密码');
            $table->string('salt', 10)->default('')->comment('密码盐');
            $table->string('email', 100)->default('')->comment('电子邮件');
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
        Schema::dropIfExists('admin');
    }
}
