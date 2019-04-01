<?php

namespace app\admin\controller;

use think\Controller;
use think\cache\driver\Redis;
use Aes;

class Index extends Controller
{
    public function _initialize()
    {
        //登录验证
        
    }

    public function index()
    {
        $jsonp = input('get.callback'); //get接收jsonp自动生成的函数名
        $uname = input('get.uname');
        $upwd = input('get.upwd');
        $info = db('admin')->where('uname',$uname)->find();
        $ret = [
            'sta'=>0,
            'mes'=>'',
            'data'=>[]
        ];
        echo $jsonp.'('.json_encode($ret).')'; //jsonp函数名包裹json数据
    }
}
