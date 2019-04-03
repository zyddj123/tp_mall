<?php

namespace app\http\middleware;

use Aes;
use think\cache\driver\Redis;

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
        $jsonp = $request->param('callback');
        $token = $request->param('token');
        $aes = new Aes('zyddj123');
        $tokenValue = $aes->decrypt($token);
        $tokenArr = explode(' ', $tokenValue);
        // array(3) {
        //     [0]=>
        //     string(1) "1"
        //     [1]=>
        //     string(10) "superadmin"
        //     [2]=>
        //     string(10) "1554273530"
        // }
        $key = 'adminToken_'.$tokenArr[0];
        $redis = new Redis();
        $redisToken = $redis->get($key);
        $redisTokenValue = $aes->decrypt($redisToken);
        $redisTokenArr = explode(' ', $redisTokenValue);

        if ($redisTokenArr[0] == $tokenArr[0] && $redisTokenArr[1] == $tokenArr[1] && $redisTokenArr[2] == $tokenArr[2] && intval($redisTokenArr[count($redisTokenArr) - 1]) + 7200 > time()) {
            //已经登录  刷新redis中token过期时间
            $redisTokenArr[count($redisTokenArr) - 1] = time();
            $newToken = $aes->encrypt(implode(' ', $redisTokenArr));
            if (!$redis->set($key, $newToken, 7200)) {
                $ret = [
                    'sta' => -2,
                    'mes' => '写入redis中token过期时间失败!',
                ];
                echo $jsonp.'('.json_encode($ret).')';
                die;
            }
        } else {
            //未登录  终止程序
            $ret = [
                'sta' => -1,
                'mes' => '请重新登录!',
            ];
            echo $jsonp.'('.json_encode($ret).')';
            die;
        }

        return $next($request);
    }
}
