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

class QueryPhone
{
    public static function query($phone) {
        var_dump(self::verifyPhone($phone));
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