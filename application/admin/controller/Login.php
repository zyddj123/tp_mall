<?php

namespace app\admin\controller;

use think\Controller;
use think\cache\driver\Redis;
use Aes;
use Unit;

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
        // var_dump($_GET);die;
        $jsonp = input('get.callback'); //get接收jsonp自动生成的函数名
        $uname = input('get.uname');
        $upwd = input('get.upwd');
        $info = db('admin')->where('uname',$uname)->find();
        $ret = [
            'sta'=>0,
            'mes'=>'',
            'data'=>[]
        ];
        if(empty($info)){
            $ret['sta'] = 2;
            $ret['mes'] = '用户不存在';
            $ret['data'] = [];
        }else{
            if($info['upwd']===md5($upwd)){
                if($info['status']==1){
                    //设置redis过期时间
                    $flag = Unit::setRedisExpire($info);
            
                    if($flag){
                        $ret['sta'] = 1;
                        $ret['mes'] = '登录成功';
                        $ret['data'] = [
                            'token' => $flag,
                            'info' => [
                                'uname' => $info['uname'],
                                'uimg' => $info['uimg']
                            ]
                        ];
                    }else{
                        $ret['sta'] = 5;
                        $ret['mes'] = '登录异常';
                        $ret['data'] = [];
                    }
                }else{
                    $ret['sta'] = 4;
                    $ret['mes'] = '您已被冻结，请联系管理员';
                    $ret['data'] = [];
                }
            }else{
                $ret['sta'] = 3;
                $ret['mes'] = '密码错误';
                $ret['data'] = [];
            }
        }
        echo $jsonp.'('.json_encode($ret).')'; //jsonp函数名包裹json数据
    }
}
