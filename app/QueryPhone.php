<?php
/**
 * Created by PhpStorm.
 * User: d4smart
 * Date: 2016/9/16
 * Time: 10:53
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace app;
use libs\ImHttpRequest;
use libs\ImRedis;

class QueryPhone
{
    //const TAOBAO_API = "https://tcc.taobao.com/cc/json/mobile_tel_segment.htm";
    const HaoService_API = "http://apis.haoservice.com/mobile";
    const key = "a04a738d979243e5aecbaedfea6c21f4";
    const CACHE_KEY = "PhoneInfo";

    public static function query($phone)
    {
        $ret = [];

        if (self::verifyPhone($phone)) {
            $redisKey = $phone;
            $phoneInfo = ImRedis::getRedis()->hGet(self::CACHE_KEY, $redisKey);

            if ($phoneInfo) {
                $ret = json_decode($phoneInfo, true);
                $ret['msg'] = '数据由d4smart提供';

            } else {
                $response = ImHttpRequest::request(self::HaoService_API, ['phone' => $phone, 'key' => self::key]);
                //$data = self::formatData($response);
                $data = json_decode($response, true);

                if ($data['error_code'] == 0) {
                    ImRedis::getRedis()->hSet(self::CACHE_KEY, $redisKey, $response);
                    $data['msg'] = '数据由HaoService提供';
                    $ret = $data;
                }
            }
        }
        return $ret;
    }

    /**
     * 校验手机号码合法性
     * @param 手机号码，默认为空
     * @return bool，合法为true，非法为false
     */
    public static function verifyPhone($phone=null) {
        if ($phone) {
            if (preg_match('/^1[34578]{1}\d{9}$/', $phone)) {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * 格式化API请求回来的数据
     * @param string数据
     * @return array形式的数据
     */
    /*public static function formatData($data=null) {
        $ret = false;

        if ($data) {
            preg_match_all("/(\w+):'([^']+)/", $data, $res);
            //var_dump($res);
            $ret = array_combine($res[1], $res[2]);
        }
        return $ret;
    }*/
}