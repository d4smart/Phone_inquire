<?php
/**
 * Created by PhpStorm.
 * User: d4smart
 * Date: 2016/9/16
 * Time: 13:00
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */
class autoload
{
    public static function load($classname) {
        $fileName = sprintf('%s.php', str_replace('\\', '/', $classname));

        if (is_file($fileName)) {
            require_once $fileName;
        }
    }
}

spl_autoload_register(['autoload', 'load']);