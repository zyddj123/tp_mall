<?php

namespace app\http\middleware;

class AdminLoginCheck
{

    /**
     * handle  重写处理请求对象的操作函数.
     *
     * @param object Request  $request 请求对象
     * @param object \Closure $next    响应对象
     *
     * @return array  错误返回的信息
     *                code 返回码
     *                msg 返回信息
     *                data 返回数据
     * @return object 响应对象
     */
    public function handle($request, \Closure $next)
    {
        
        return $next($request);
    }
}
