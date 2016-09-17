<?php
/**
 * Created by PhpStorm.
 * User: d4smart
 * Date: 2016/9/16
 * Time: 10:51
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

require_once "autoload.php";

$info = app\QueryPhone::query('15896209327');
var_dump($info);
