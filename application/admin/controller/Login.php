<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;
use think\View;

class Login extends Controller
{
    public function login()
    {
        return view('login');
    }
}
