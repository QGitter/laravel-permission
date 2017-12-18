<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::any('/', 'User@login');

Route::get('register', function () {
    return view('user.register');
});


/*Route::group(['middleware'=>'checklogin'],function(){*/
    //管理员部分路由
    Route::get('manager', 'Manager@index');
    Route::post('delmanager', 'Manager@del');
    Route::match(['get', 'post'],'editmanager', 'Manager@edit');
    Route::match(['get', 'post'],'addmanager','Manager@add');
    Route::post('resetpassword','Manager@resetpwd');
    Route::match(['get','post'],'editpassword','Manager@editpwd');

    //角色部分路由
    Route::get('role','RoleGroup@index');
    Route::post('delrole','RoleGroup@del');
    Route::match(['get', 'post'],'addrole','RoleGroup@add');
    Route::match(['get','post'],'editrole','RoleGroup@edit');

    //菜单部分路由
    Route::get('menu', 'Menu@index');
    Route::post('delmenu', 'Menu@del');
    Route::match(['get', 'post'],'addmenu', 'Menu@add');
    Route::match(['get', 'post'],'editmenu', 'Menu@edit');

    //登出
    Route::get('logout','User@logout');
    //主界面
    Route::get('main', function () {
        return view('main');
    });
    //搜索图标
    Route::get('searchicon', function () {
        return view('authority.searchicon');
    });



/*});*/





