<?php
/**
 * Des:  HTTP请求模块
 * User: d4smart
 * Date: 2016/9/16
 * Time: 13:50
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace libs;

class ImHttpRequest
{
    public static function request($url, $params) {
        $response = null;

        if ($url) {
            if (is_array($params) and count($params)) {
                //生成对应url
                if (strrpos($url, '?')) {
                    $url = $url.'&'.http_build_query($params);
                } else {
                    $url = $url.'?'.http_build_query($params);
                }

                //获取接口返回数据，默认为json字符串
                $response = file_get_contents($url);
            }
        }

        return $response;
    }
}