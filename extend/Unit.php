<?php 

use think\cache\driver\Redis;
use Aes;
/**
 * 自己定义的工具类
 */
class Unit
{

    /**
     * 设置用户token的redis过期时间
     *
     * @param [type] $info  用户身份信息
     * @return $token or false
     */
    public static function setRedisExpire($info)
    {
        $aes = new Aes('zyddj123');
        $redis = new Redis();
        $tokenValue = [
            'id'=>$info['id'],
            'uname'=>$info['uname'],
            'usalt'=>$info['usalt'],
            'loginTime'=>time()
        ];
        $token = $aes->encrypt(implode(" ",$tokenValue));
        $key = 'adminToken_'.$info['id'];
        return $redis->set($key,$token,7200)?$token:false;
    }
}
