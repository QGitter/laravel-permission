<?php
/**
 * Created by PhpStorm.
 * User: liulj
 * Date: 2017/12/9
 * Time: 16:00
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class RoleGroup extends Controller{


    /**
     * 角色组列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $rolegroup = DB::table('role')->select('id','pid','name','status')
            ->orderBy('id','asc')
            ->get();
        $role = array();
        $roles = $this->getTree($rolegroup,$role);
        return view('authority.role',[
            'roles'=>$roles,
        ]);
    }

    /**
     * 删除角色组
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function del(Request $request){
        try{
            //判断该角色组下面是否有管理员
            if(DB::table('admin_map_role')->where('roleid',$request->input('id'))->first() !=null){
                $this->result['code'] =-1;
                $this->result['msg'] = Lang::get('rolegroup.members_exists');
                return response()->json($this->result);
            }
            try{
                DB::transaction(function () use ($request) {
                    //删除角色组记录
                    DB::table('role')->where('id',$request->input('id'))->delete();
                    //删除管理员与角色对应记录
                    DB::table('admin_map_role')->where('roleid',$request->input('id'))->delete();
                    //删除角色组与菜单对应记录
                    DB::table('role_map_menu')->where('roleid',$request->input('id'))->delete();
                });
                $this->result['code'] = 0;
                $this->result['msg'] = Lang::get('remove_success');
                return response()->json($this->result);
            }catch (\Exception $e){
                $this->result['code'] =-1;
                $this->result['msg'] = Lang::get('manager.remove_fail');
                return response()->json($this->result);
            }
        }catch (\Exception $e){
            $this->result['code'] =-1;
            $this->result['msg'] = Lang::get('manager.remove_fail');
            return response()->json($this->result);
        }
    }

    /**
     * 增加角色组
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function add(Request $request){
        if($request->isMethod('get')){
            //获取父级角色组
            $sourcerolegroups = DB::table('role')->select('id','pid','name','status')->get();
            $targetrolegroups = array();
            $targetrolegroups = $this->getTree($sourcerolegroups,$targetrolegroups);
            //获取所有菜单项
            $menusTemp = DB::table('menu')->select('id','name','pid')->orderBy('weigh','asc')->get()->toArray();
            $menus = $this->getMenusTreeData(array_map('get_object_vars',$menusTemp));
            return view('authority.addrole',[
                'rolegroups' => $targetrolegroups,
                'action'=> 'add',
                'menus'=>$menus
            ]);
        }elseif($request->isMethod('post')){
            //验证表单字段
            $validate=Validator::make($request->all(),[
                'rolegroup'=>'required',
                'name' => 'required',
                'menustr'=>'required'
            ]);
            if(!empty($validate->errors()->first('rolegroup'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('rolegroup.rolegroup_empty');
                return response()->json($this->result);
            }

            if(!empty($validate->errors()->first('name'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('rolegroup.name_empty');
                return response()->json($this->result);
            }

            if(!empty($validate->errors()->first('menustr'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('rolegroup.menustr_empty');
                return response()->json($this->result);
            }

            try{
                DB::transaction(function () use ($request) {
                    //往角色组表添加记录
                    $roleid = DB::table('role')->insertGetId([
                        'pid' => $request->input('rolegroup'),
                        'name' => $request->input('name'),
                        'createtime' => time(),
                        'updatetime' => time(),
                        'status' => $request->input('status')
                    ]);
                    $menustrArray = explode(',', rtrim($request->input('menustr'), ','));
                    $rolegroupData = array();
                    foreach ($menustrArray as $key => $value) {
                        $rolegroupData[$key]['roleid'] = $roleid;
                        $rolegroupData[$key]['menuid'] = $value;
                    }
                    //往角色组与菜单对应表插入记录
                    DB::table('role_map_menu')->insert($rolegroupData);

                });
                $this->result['code']= 0;
                $this->result['msg'] = Lang::get('rolegroup.add_success');
                return response()->json($this->result);

            }catch (\Exception $e){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('rolegroup.add_fail');
                return response()->json($this->result);
            }
        }
    }

    /**
     * 编辑角色组
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function edit(Request $request){
        if($request->isMethod('get')){
            //获取父级角色组
            $sourcerolegroups = DB::table('role')->select('id','pid','name','status')->get();
            $targetrolegroups = array();
            $targetrolegroups = $this->getTree($sourcerolegroups,$targetrolegroups);

            //获取该角色父级pid
            $rolegroupsObjById = DB::table('role')->where('id',$request->input('id'))->first();
            $pid = DB::table('role')->where(['pid'=>$rolegroupsObjById->pid,'id'=>$request->input('id')])->pluck('pid');

            //获取所有菜单项
            $menusTemp = DB::table('menu')->select('id','name','pid')->orderBy('weigh','asc')->get()->toArray();
            $menus = $this->getMenusTreeData(array_map('get_object_vars',$menusTemp));

            //获取选中的菜单项
            $selectmenus = DB::table('role_map_menu')->select('menuid')->where('roleid',$request->input('id'))->pluck('menuid')->toArray();

            return view('authority.addrole',[
                'rolegroups' => $targetrolegroups,
                'rolegroupsObjById'=>$rolegroupsObjById,
                'action'=> 'edit',
                'pid'=>$pid[0],
                'menus'=>$menus,
                'selectmenus'=>$selectmenus
            ]);
        }elseif($request->isMethod('post')){
            $validate=Validator::make($request->all(),[
                'rolegroup'=>'required',
                'name' => 'required',
            ]);
            if(!empty($validate->errors()->first('rolegroup'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('rolegroup.rolegroup_empty');
                return response()->json($this->result);
            }

            if(!empty($validate->errors()->first('name'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('rolegroup.name_empty');
                return response()->json($this->result);
            }



            try{

                DB::transaction(function () use ($request) {
                    //删除菜单和角色组对应关系表中数据
                    DB::table('role_map_menu')->where('roleid', $request->input('roleid'))->delete();

                    //插入删除菜单和角色组记录
                    $menustrArray = explode(',', rtrim($request->input('menustr'), ','));
                    $rolegroupData = array();
                    foreach ($menustrArray as $key => $value) {
                        $rolegroupData[$key]['roleid'] = $request->input('roleid');
                        $rolegroupData[$key]['menuid'] = $value;
                    }
                    DB::table('role_map_menu')->insert($rolegroupData);

                    //更新角色组信息
                    DB::table('role')->where('id', $request->input('roleid'))->update([
                        'pid' => $request->input('rolegroup'),
                        'name' => $request->input('name'),
                        'updatetime' => time(),
                        'status' => $request->input('status')
                    ]);
                });

                $this->result['code']= 0;
                $this->result['msg'] = Lang::get('rolegroup.edit_success');
                return response()->json($this->result);

            }catch (\Exception $e){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('rolegroup.edit_fail');
                return response()->json($this->result);
            }
        }
    }





    /**
     * 递归菜单树
     * @param $menus
     * @param int $pid
     * @return array
     */
    private function getMenusTreeData($menus,$pid=0)
    {
        $arr = [];
        if (empty($menus)) {
            return array();
        }
        foreach ($menus as $key => $v) {
            if ($v['pid'] == $pid) {
                $arr[$key] = $v;
                $arr[$key]['child'] = $this->getMenusTreeData($menus,$v['id']);
            }
        }
        return $arr;
    }




}