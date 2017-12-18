<?php
/**
 * Created by PhpStorm.
 * User: yangqing
 * Date: 2017/12/11
 * Time: 22:00
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Mews\Captcha\Facades\Captcha;


class User extends Controller{

    /**
     * 管理员登录接口
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function login(Request $request){
        if($request->isMethod('get')) {
            return view('user.login');
        }elseif($request->isMethod('post')){
            try{
                if(!Captcha::check($request->input('captcha'))){
                    $this->result['code'] = -1;
                    $this->result['msg'] =Lang::get('user.captcha_error');
                    $this->result['data'] = array($request->all());
                    return response()->json($this->result);
                }
                $userObj = DB::table('admin')->where(['username'=>$request->input('username'),'status'=>1])->first();
                if(is_null($userObj)){
                    $this->result['code'] = -1;
                    $this->result['msg'] = Lang::get('user.user_nonexistent');
                    $this->result['data'] = array($request->all());
                    return response()->json($this->result);
                }

                if($userObj->password != sha1($request->input('password').$userObj->salt)){
                    $this->result['code'] = -1;
                    $this->result['msg'] =Lang::get('user.password_error');
                    $this->result['data'] = array($request->all());
                    return response()->json($this->result);
                }

                $sessionUserData = array(
                    'id'=>$userObj->id,
                    'username'=>$userObj->username
                );
                $request->session()->put('userinfo',$sessionUserData);

                $this->result['code'] = 0;
                $this->result['msg'] =Lang::get('user.login_success');
                $this->result['data'] = array($request->all());
                return response()->json($this->result);
            }catch (\Exception $e){
                echo $e->getMessage();
                $this->result['code'] = -1;
                $this->result['msg'] =Lang::get('user.login_fail');
                $this->result['data'] = array($request->all());
                return response()->json($this->result);
            }

        }
    }

    /**
     * 退出登录
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/');
    }
}