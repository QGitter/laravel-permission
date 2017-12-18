<?php
/**
 * Created by PhpStorm.
 * User: liulj
 * Date: 2017/12/6
 * Time: 16:33
 */
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class Manager extends Controller{

    /**
     * 管理员列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $users = DB::table('admin')
            ->select('admin.id','admin.username','admin.nickname','role.name','admin.email','admin.logintime','admin.status','role.pid')
            ->leftJoin('admin_map_role', 'admin.id', '=', 'admin_map_role.uid')
            ->leftJoin('role', 'admin_map_role.roleid', '=', 'role.id')
            ->orderBy('admin.id','asc')
            ->paginate(8);
        return view('authority.manager',[
            'users'=>$users
        ]);
    }

    /**
     * 删除管理员
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function del(Request $request){
        try{
            DB::transaction(function () use ($request) {
                DB::table("admin")->where('id',$request->input('id'))->delete();
                DB::table('admin_map_role')->where('uid',$request->input('id'))->delete();
            });
            $this->result['msg']=Lang::get('manager.remove_success');
            return response()->json($this->result);
        }catch (\Exception $e){
            $this->result['code']=-1;
            $this->result['msg'] =Lang::get('manager.remove_fail');
            return response()->json($this->result);
        }
    }

    /**
     * 编辑管理员
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request){
        if($request->isMethod('get')){
            $targetRoleItems = array();
            $rolegroups = DB::table('role')->get();
            $targetRoleItems = $this->getTree($rolegroups,$targetRoleItems);
            $mangerObj = DB::table('admin')->where('id',$request->input('id'))->get();
            $fagaObj = DB::table('admin_map_role')->where('uid',$mangerObj[0]->id)->first();
            $selectrole = $fagaObj !=null ? $fagaObj->roleid : "";
            return view('authority.addmanager',[
                'managerObj'=>$mangerObj[0],
                'rolegroups'=>$targetRoleItems,
                'selectrole'=>$selectrole,
                'action'=>'edit'
            ]);
        }elseif ($request->isMethod('post')){

            $validate=Validator::make($request->all(),[
                'rolegroup'=>'required',
                'username' => 'required',
                'email' => 'required|email',
                'nickname' => 'required',
            ]);

            if(!empty($validate->errors()->first('rolegroup'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('manager.rolegroup_empty');
                return response()->json($this->result);
            }

            if(!empty($validate->errors()->first('username'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('manager.username_empty');
                return response()->json($this->result);
            }

            if(!empty($validate->errors()->first('email'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('manager.email_illegal');
                return response()->json($this->result);
            }

            if(!empty($validate->errors()->first('nickname'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('manager.nickname_illegal');
                return response()->json($this->result);
            }


            try {
                DB::transaction(function () use ($request) {
                    DB::table('admin')->where('id',$request->input('mangerid'))->update([
                        'username' => $request->input('username'),
                        'nickname' => $request->input('nickname'),
                        'email' => $request->input('email'),
                        'token' => $request->input('username'),
                        'status'=> $request->input('status'),
                        'updatetime'=>time()
                    ]);
                    DB::table('admin_map_role')->where('uid',$request->input('mangerid'))->update([
                        'roleid' => $request->input('rolegroup'),
                    ]);
                });
                $this->result['code'] =0;
                $this->result['msg'] = Lang::get('manager.editmanager_success');
                return response()->json($this->result);
            }catch (\Exception $e){
                $this->result['code'] =-1;
                $this->result['msg'] = Lang::get('manager.editmanager_fail');
                return response()->json($this->result);
            }
        }
    }

    /**
     * 新增管理员
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request){
        if($request->isMethod('get')){
            $targetRoleItems = array();
            $rolegroups = DB::table('role')->get();
            $targetRoleItems = $this->getTree($rolegroups,$targetRoleItems);
            return view('authority.addmanager',[
                'rolegroups'=>$targetRoleItems,
                'action'=>'add'
            ]);
        }elseif ($request->isMethod('post')){
            $validate=Validator::make($request->all(),[
                'rolegroup'=>'required',
                'username' => 'required',
                'email' => 'required|email',
                'nickname' => 'required',
            ]);

            if(!empty($validate->errors()->first('rolegroup'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('manager.rolegroup_empty');
                return response()->json($this->result);
            }

            if(!empty($validate->errors()->first('username'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('manager.username_empty');
                return response()->json($this->result);
            }

            if(!empty($validate->errors()->first('email'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('manager.email_illegal');
                return response()->json($this->result);
            }

            if(!empty($validate->errors()->first('nickname'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('manager.nickname_illegal');
                return response()->json($this->result);
            }


            if(DB::table('admin')->where('username',$request->input('username'))->first()){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('manager.username_exists');
                return response()->json($this->result);
            }

            try {
                DB::transaction(function () use ($request) {
                    $uid = DB::table('admin')->insertGetId([
                        'username' => $request->input('username'),
                        'nickname' => $request->input('nickname'),
                        'password' => sha1('123456'.$this->getSalt()),
                        'salt' => $this->getSalt(),
                        'email' => $request->input('email'),
                        'token' => $request->input('username'),
                        'status' =>$request->input('status'),
                        'createtime'=>time(),
                        'updatetime'=>time()
                    ]);
                    DB::table('admin_map_role')->insert([
                        'roleid' => $request->input('rolegroup'),
                        'uid' => $uid
                    ]);

                });
                $this->result['code'] =0;
                $this->result['msg'] = Lang::get('manager.password_empty');
                return response()->json($this->result);
            }catch (\Exception $e){
                $this->result['code'] =-1;
                $this->result['msg'] = Lang::get('manager.password_empty');
                return response()->json($this->result);
            }
        }
    }

    /**
     * 管理员重置密码
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetpwd(Request $request){
        try{
            DB::table('admin')->where('id',$request->input('id'))->update([
                'password' => sha1('123456'.$this->getSalt()),
                'salt' =>$this->getSalt(),
                'updatetime'=>time()
            ]);

            $this->result['code'] =0;
            $this->result['msg'] = Lang::get('manager.resetpwd_success');
            return response()->json($this->result);
        }catch (\Exception $e){
            $this->result['code'] =-1;
            $this->result['msg'] = Lang::get('manager.resetpwd_fail');
            return response()->json($this->result);
        }
    }

    public function editpwd(Request $request){
        if($request->isMethod('get')){
            $username = $request->session()->get('userinfo.username');
            return view('authority.editpassword',[
                'username'=>$username
            ]);
        }elseif($request->isMethod('post')){


            $validate=Validator::make($request->all(),[
                'oldpassword'=>'required',
                'newpassword' => 'required',
                'repeatpassword' => 'required',
            ]);

            if($request->input('newpassword') != $request->input('repeatpassword')){
                $this->result['code'] =-1;
                $this->result['msg'] = Lang::get('manager.password_inequality');
                return response()->json($this->result);
            }

            if(!empty($validate->errors()->first('oldpassword'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('manager.oldpassword_empty');
                return response()->json($this->result);
            }

            if(!empty($validate->errors()->first('newpassword'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('manager.newpassword_empty');
                return response()->json($this->result);
            }

            if(!empty($validate->errors()->first('repeatpassword'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('manager.repeatpassword_empty');
                return response()->json($this->result);
            }
            try{
                $managerid = $request->session()->get('userinfo.id');
                $managerObj = DB::table('admin')->select('password','salt')->where('id',$managerid)->first();
                if(sha1($request->input('oldpassword').$managerObj->salt) != $managerObj->password){
                    $this->result['code']=-1;
                    $this->result['msg'] = Lang::get('manager.oldpassword_error');
                    return response()->json($this->result);
                }
                DB::table('admin')->where('id',$managerid)->update([
                    'password' => sha1($request->input('newpassword').$this->getSalt()),
                    'salt' =>$this->getSalt(),
                    'updatetime'=>time()
                ]);

                $this->result['code'] =0;
                $this->result['msg'] = Lang::get('manager.resetpwd_success');
                return response()->json($this->result);
            }catch (\Exception $e){
                $this->result['code'] =-1;
                $this->result['msg'] = Lang::get('manager.resetpwd_fail');
                return response()->json($this->result);
            }

        }
    }



}