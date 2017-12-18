<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected $result=array('code'=>0,'msg'=>'','data'=>array());


    protected function getTree($sourceItems, &$targetItems, $pid=0, $str='ㅣ'){
        $str .= 'ㅡㅡ';
        foreach ($sourceItems as $k => $v) {
            if($v->pid == $pid){
                $v->name = $str.$v->name;
                $targetItems[] = $v;
                $this->getTree($sourceItems, $targetItems, $v->id, $str);
            }
        }
        return $targetItems;
    }

    protected function getSalt(){
        return substr(sha1(time()), -10);
    }
}
