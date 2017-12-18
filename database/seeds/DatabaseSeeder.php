<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_map_role')->insert([
            'uid' => 1,
            'roleid' => 1,
        ]);

        DB::table('admin')->insert([
            'username' => 'admin',
            'nickname' => 'admin',
            'password' => '2415473b2ff0c1e5dcddfb61739b6375276d3b01',
            'salt'=>'8eb337ac54',
            'email'=>'admin@admin.com',
            'createtime'=>1513579220,
            'updatetime'=>1513579220,
            'status'=>1
        ]);

        DB::table('menu')->insert([
            [
                'pid' => 0,
                'url' => '#',
                'name' => '权限管理',
                'icon'=>'fa fa-bell',
                'ismenu'=>1,
                'createtime'=>1513579054,
                'updatetime'=>1513579054,
                'weigh'=>1,
                'status'=>1
            ],
            [
                'pid' => 1,
                'url' => 'role',
                'name' => '角色管理',
                'icon'=>'fa fa-bell',
                'ismenu'=>2,
                'createtime'=>1513579054,
                'updatetime'=>1513579054,
                'weigh'=>1,
                'status'=>1
            ],
            [
                'pid' => 1,
                'url' => 'manager',
                'name' => '管理员管理',
                'icon'=>'fa fa-bell',
                'ismenu'=>2,
                'createtime'=>1513579054,
                'updatetime'=>1513579054,
                'weigh'=>1,
                'status'=>1
            ],
            [
                'pid' => 1,
                'url' => 'menu',
                'name' => '菜单管理',
                'icon'=>'fa fa-bell',
                'ismenu'=>2,
                'createtime'=>1513579054,
                'updatetime'=>1513579054,
                'weigh'=>1,
                'status'=>1
            ],

        ]);
        DB::table('role_map_menu')->insert([
            'menuid'=>1,
            'roleid'=>1
        ]);

        DB::table('role')->insert([
            'pid' => 0,
            'name' => '超级管理员',
            'createtime'=>1513579191,
            'updatetime'=>1513579191,
            'status'=>1
        ]);
    }
}
