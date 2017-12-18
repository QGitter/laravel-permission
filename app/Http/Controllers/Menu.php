<?php
/**
 * Created by PhpStorm.
 * User: yangqing
 * Date: 2017/12/10
 * Time: 11:48
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class Menu extends Controller{
    /**
     * 菜单列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $sourcemens = DB::table('menu')
            ->orderBy('id','asc')
            ->get();
        $targetmenus = array();
        $targetmenus = $this->getTree($sourcemens,$targetmenus);
        return view('authority.menu',[
            'targetmenus'=>$targetmenus
        ]);
    }

    /**
     * 添加菜单功能
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request){
        if($request->isMethod('get')){
            $sourcemens = DB::table('menu')
                ->where('ismenu','<>',3)
                ->orderBy('id','asc')
                ->get();
            $targetmenus = array();
            $targetmenus = $this->getTree($sourcemens,$targetmenus);
            return view('authority.addmenu',[
                'targetmenus'=>$targetmenus,
                'action'=>'add'
            ]);
        }elseif ($request->isMethod('post')){
            $ismenu = $request->input('ismenu');
            switch ($ismenu){
                case 1:
                    $validate=Validator::make($request->all(),[
                        'name' => 'required',
                        'icon' => 'required',
                    ]);
                    break;
                case 2:
                    $validate=Validator::make($request->all(),[
                        'name' => 'required',
                        'icon' => 'required',
                        'url'  => 'required'
                    ]);
                    break;
                case 3:
                    $validate=Validator::make($request->all(),[
                        'buttonstr'  => 'required'
                    ]);
                    break;
            }

            if(!empty($validate->errors()->first('url'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('menu.url_empty');
                return response()->json($this->result);
            }
            if(!empty($validate->errors()->first('name'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('menu.name_empty');
                return response()->json($this->result);
            }
            if(!empty($validate->errors()->first('icon'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('menu.icon_empty');
                return response()->json($this->result);
            }
            if(!empty($validate->errors()->first('buttonstr'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('menu.buttonstr_empty');
                return response()->json($this->result);
            }

            try {
                if($ismenu == 3){
                    $buttonStrArray = explode(',', rtrim($request->input('buttonstr'), ','));
                    $buttonInsertData = array();
                    foreach ($buttonStrArray as $key => $value){
                        $buttonInfoArray = explode("#",$value);
                        $buttonInsertData[$key]['pid'] = $request->input('parentmenu');
                        $buttonInsertData[$key]['url'] = $request->input('url',"");
                        $buttonInsertData[$key]['name'] = $buttonInfoArray[1];
                        $buttonInsertData[$key]['icon'] = $buttonInfoArray[2];
                        $buttonInsertData[$key]['ismenu'] = $request->input('ismenu');
                        $buttonInsertData[$key]['buttonmark'] = $buttonInfoArray[0];
                        $buttonInsertData[$key]['createtime'] = time();
                        $buttonInsertData[$key]['updatetime'] = time();
                        $buttonInsertData[$key]['weigh']=$request->input('weigh');
                        $buttonInsertData[$key]['status']=$request->input('status');
                    }
                    DB::table('menu')->insert($buttonInsertData);
                    $this->result['code'] =0;
                    $this->result['msg'] = Lang::get('menu.add_success');
                    return response()->json($this->result);
                }

                DB::table('menu')->insert([
                    'pid' => $request->input('parentmenu'),
                    'url' => $request->input('url','#'),
                    'name' => $request->input('name'),
                    'icon' => $request->input('icon'),
                    'ismenu'=> $request->input('ismenu'),
                    'createtime'=>time(),
                    'updatetime'=>time(),
                    'weigh'=>$request->input('weigh'),
                    'status'=>$request->input('status')
                ]);

                $this->result['code'] =0;
                $this->result['msg'] = Lang::get('menu.add_success');
                return response()->json($this->result);
            }catch (\Exception $e){
                $this->result['code'] =-1;
                $this->result['msg'] = Lang::get('menu.add_fail');
                return response()->json($this->result);
            }
        }
    }


    /**
     * 删除菜单栏
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function del(Request $request){
        try{
            if(!is_null(DB::table("menu")->where('pid',$request->input('id'))->first())){
                $this->result['code']=-1;
                $this->result['msg'] =Lang::get('menu.submenu_exists');
                return response()->json($this->result);
            }
            DB::transaction(function () use ($request) {
                DB::table("menu")->where('id', $request->input('id'))->delete();
                DB::table("role_map_menu")->where('menuid', $request->input('id'))->delete();
            });

            $this->result['msg']=Lang::get('menu.remove_success');
            return response()->json($this->result);
        }catch (\Exception $e){
            $this->result['code']=-1;
            $this->result['msg'] =Lang::get('menu.remove_fail');
            return response()->json($this->result);
        }
    }

    /**
     * 编辑菜单
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function edit(Request $request){
        if($request->isMethod('get')){
            $menus = DB::table("menu")->where('id',$request->input('id'))->first();
            $sourcemens = DB::table('menu')
                ->where('ismenu',1)
                ->orderBy('id','asc')
                ->get();
            $targetmenus = array();
            $targetmenus = $this->getTree($sourcemens,$targetmenus);
            return view('authority.addmenu',[
                'menus'=>$menus,
                'targetmenus'=>$targetmenus,
                'action'=>'edit'
            ]);
        }elseif($request->isMethod('post')){
            $ismenu = $request->input('ismenu');
            switch ($ismenu){
                case 1:
                    $validate=Validator::make($request->all(),[
                        'name' => 'required',
                        'icon' => 'required',
                    ]);
                    break;
                case 2:
                    $validate=Validator::make($request->all(),[
                        'name' => 'required',
                        'icon' => 'required',
                        'url'  => 'required'
                    ]);
                    break;
            }
            if(!empty($validate->errors()->first('url'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('menu.url_empty');
                return response()->json($this->result);
            }
            if(!empty($validate->errors()->first('name'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('menu.name_empty');
                return response()->json($this->result);
            }
            if(!empty($validate->errors()->first('icon'))){
                $this->result['code']=-1;
                $this->result['msg'] = Lang::get('menu.icon_empty');
                return response()->json($this->result);
            }
            try{
                DB::table("menu")->where('id',$request->input('id'))->update([
                    'pid' => $request->input('parentmenu'),
                    'url' => $request->input('url',"#"),
                    'name' => $request->input('name'),
                    'icon' => $request->input('icon'),
                    'ismenu'=> $request->input('ismenu'),
                    'updatetime'=>time(),
                    'weigh'=>$request->input('weigh'),
                    'status'=>$request->input('status')
                ]);
                $this->result['code'] =0;
                $this->result['msg'] = Lang::get('menu.update_success');
                return response()->json($this->result);
            }catch (\Exception $e){
                $this->result['code']=-1;
                $this->result['msg'] =Lang::get('menu.update_fail');
                return response()->json($this->result);
            }
        }
    }
}