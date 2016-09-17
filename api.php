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

$params = $_POST;
$phone = isset($_POST['tel'])? $_POST['tel']: null;

$info = app\QueryPhone::query($phone);

$data = [];
if ($info) {
    $data = $info;
    $data['code'] = 200;
} else {
    $data['msg'] = '手机号码不存在！';
    $data['code'] = 400;
}

echo json_encode($data);
