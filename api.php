<?php
/**
 * 查询接口： api.php，可以接受get和post请求
 * User: d4smart
 * Date: 2016/9/16
 * Time: 10:51
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

require_once "autoload.php";

/**
 * 可以接受get和post请求（都有时选post）
 */
if (isset($_POST['phone'])) {
    $phone = $_POST['phone'];
} else if (isset($_GET['phone'])) {
    $phone = $_GET['phone'];
} else {
    $phone = null;
}

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
