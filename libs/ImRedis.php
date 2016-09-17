<?php
/**
 * Des:  获取redis数据库句柄
 * User: d4smart
 * Date: 2016/9/16
 * Time: 21:05
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace libs;


class ImRedis
{
    private static $redis;

    public static function getRedis() {
        if (!(self::$redis instanceof \Redis)) {
            self::$redis = new \Redis();
            self::$redis->connect('127.0.0.1', 6379);
        }
        return self::$redis;
    }
}