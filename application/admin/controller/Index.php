<?php

namespace app\admin\controller;

use think\Controller;
use think\cache\driver\Redis;
use Aes;

class Index extends Controller
{

    //登录验证
    protected $middleware = ['AdminLoginCheck'];
    
    public function _initialize()
    {

    }

    public function index()
    {
        $jsonp = input('get.callback'); //get接收jsonp自动生成的函数名
        $ret = $_GET;
        echo $jsonp.'('.json_encode($ret).')'; //jsonp函数名包裹json数据
    }
}
