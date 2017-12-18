<?php
namespace App\Http\ViewComposer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class MenuComposer
{

    public function compose(View $view)
    {
        //获取菜单
        $targerMenus = array();
        $sourceMenus = array_map('get_object_vars',$this->getMenusData());
        $targerMenus = $this->getMenusTreeData($sourceMenus);
        $menus = $this->createMenusView($targerMenus);
        $view->with([
            'menuslist'=>$menus,
            'buttons'=>$this->getButtonByUrl(),
            'isadimin'=> $this->isAdmin()
        ]);
    }

    /**
     * 创建菜单字符串
     * @param array $items
     * @return string
     */
    private function createMenusView($items = array()){
        if(empty($items)){
            return '';
        }
        $str = "";
        foreach ($items as $key => $value){
            $str.= "<li>";
            if($value['pid'] == 0){
                if(!empty($value['child'])) {
                    $str .= '<a href="javascript:;">';
                }else{
                    $str .= '<a href="' . $value['url'] . '">';
                }
                $str.=        '<i class="'.$value['icon'].'"></i>';
                $str.=        '<span class="text">'.$value['name'].'</span>';
                if(!empty($value['child'])) {
                    $str .= '<span class="fa fa-angle-down pull-right"></span>';
                }
                $str.=    '</a>';
                if(!empty($value['child'])){
                    $str .= "<ul class=\"nav sub\">";
                    foreach ($value['child'] as $kc=>$vc){
                        $str.='<li><a href="'.$vc['url'].'"><i class="'.$vc['icon'].'"></i><span class="text"> '.$vc['name'].'</span></a></li>';
                    }
                    $str.="</ul>";
                }
            }
            $str.= "</li>";
        }
        return $str;
    }

    /**
     * 获取菜单项
     * @return mixed
     */
    private function getMenusData(){


        $pids = DB::table('admin_map_role')
            ->select('role.pid')
            ->leftjoin('role','admin_map_role.roleid','=','role.id')
            ->where('admin_map_role.uid', Session::get('userinfo.id'))
            ->first();

        if( $pids != null && $pids->pid == 0){
            return DB::table('menu')
                ->select('url','name','icon','id','pid')
                ->where([
                    ['menu.ismenu','<>',3],
                    ['menu.status',1]
                ])
                ->orderBy('weigh','asc')
                ->get()->toArray();
        }else{
            return DB::table('admin_map_role')
                ->select('menu.url','menu.name','menu.icon','menu.id','menu.pid')
                ->leftjoin('role_map_menu','admin_map_role.roleid','=','role_map_menu.roleid')
                ->leftjoin('menu','role_map_menu.menuid','=','menu.id')
                ->where([
                    ['admin_map_role.uid', Session::get('userinfo.id')],
                    ['menu.ismenu','<>',3],
                    ['menu.status',1]
                ])
                ->orderBy('menu.weigh','asc')
                ->get()->toArray();
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

    /**
     * 获取所对应的按钮
     * @return array
     */
    private function getButtonByUrl(){
        $path = Request::path();
        if($menuinfo = DB::table('menu')->where('url',$path)->first()){
            $id = $menuinfo->id;
            $adminrole = DB::table('admin_map_role')->where('uid',Session::get('userinfo.id'))->select('roleid')->first();
            return DB::table('role_map_menu')
                ->leftJoin('menu','role_map_menu.menuid','=','menu.id')
                ->where([
                    ['role_map_menu.roleid',$adminrole->roleid],
                    ['menu.pid',$id]
                ])->pluck('buttonmark')->toArray();
        }
        return array();
    }


    private function isAdmin(){
        $roleGroupInfo =  DB::table('admin_map_role')
                ->leftJoin('role','admin_map_role.roleid','=','role.id')
                ->where('admin_map_role.uid',Session::get('userinfo.id'))
                ->select('role.pid')
                ->first();
        return isset($roleGroupInfo->pid) && $roleGroupInfo->pid == 0 ? true : false;
    }






}