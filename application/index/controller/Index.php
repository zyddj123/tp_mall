<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
        return '456';
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
