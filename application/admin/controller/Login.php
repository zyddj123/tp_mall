<?php

namespace app\admin\controller;

use think\Controller;
use think\View;
// use think\Cache;
use think\cache\driver\Redis;
use extend\Unit;

class Login extends Controller
{
    public function _initialize()
    {
        //登录验证
        
    }

    public function login()
    {
        return view('login');
    }

    public function doLogin()
    {
        $jsonp = input('get.callback'); //get接收jsonp自动生成的函数名
        $uname = input('get.uname');
        $upwd = input('get.upwd');
        $data = db('admin')->where('uname',$uname)->find();
        $ret = [
            'sta'=>0,
            'mes'=>''
        ];
        if(empty($data)){
            $ret['sta'] = 2;
            $ret['mes'] = '用户不存在';
        }else{
            if($data['upwd']===md5($upwd)){
                if($data['status']==1){
                    $ret['sta'] = 1;
                    $ret['mes'] = '登录成功';
                    $key = 'admin_'.$uname;
                    $redis = new Redis();
                    $redis->set($key,['id'=>$data['id'],'uname'=>$data['uname'],'uimg'=>$data['uimg']]);
                }else{
                    $ret['sta'] = 4;
                    $ret['mes'] = '您已被冻结，请联系管理员';
                }
            }else{
                $ret['sta'] = 3;
                $ret['mes'] = '密码错误';
            }
        }
        echo $jsonp.'('.json_encode($ret).')'; //jsonp函数名包裹json数据
    }
}
