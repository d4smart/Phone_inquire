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

class QueryPhone
{
    const TAOBAO_API = "https://tcc.taobao.com/cc/json/mobile_tel_segment.htm";

    public static function query($phone) {
        if (self::verifyPhone($phone)) {
            $response = ImHttpRequest::request(self::TAOBAO_API, ['tel' => $phone]);
            var_dump($response);
        }
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
}