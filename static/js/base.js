/**
 * Created by d4smart on 2016/9/17.
 * JS基础类（依赖jQuery）
 */

var phone = ""; //全局变量，用于存储电话号

$(document).ready(function () {
    $('#subPhone').click(function () {
        //11位数字的简单正则验证
        var pattern = /^[0-9]{11}$/;
        phone = $('#phoneText').val();

        if (phone.match(pattern)) {
            IMOOC.GLOBAL.AJAX('api.php', 'post', {'phone': phone}, 'json', IMOOC.APPS.QUERYPHONE.AJAXCALLBACK);
        } else {
            IMOOC.APPS.QUERYPHONE.HIDEINFO();
            $('.error-message').show();
            $('.error-message').text('手机号码格式不正确！');
        }
    });
});

var IMOOC = IMOOC || {};
IMOOC.GLOBAL = {};
IMOOC.APPS = {};

IMOOC.APPS.QUERYPHONE = {};
IMOOC.APPS.QUERYPHONE.AJAXCALLBACK = function (data) {
    if (data.code == 200) {
        $('.error-message').hide();
        IMOOC.APPS.QUERYPHONE.SHOWINFO();
        $('#phoneNumber').text(phone);
        $('#phoneArea').text(data.result.province + ' ' + data.result.city);
        $('#phoneAreaCode').text(data.result.areacode);
        $('#phonePostalCode').text(data.result.zip);
        $('#phoneCompany').text(data.result.company);
        $('#phoneCard').text(data.result.card);
        $('#phoneMsg').text(data.msg);
    } else {
        IMOOC.APPS.QUERYPHONE.HIDEINFO();
        $('.error-message').show();
        $('.error-message').text(data.msg);
    }
};
IMOOC.APPS.QUERYPHONE.SHOWINFO = function () {
    $('#phoneInfo').show();
};
IMOOC.APPS.QUERYPHONE.HIDEINFO = function () {
    $('#phoneInfo').hide();
};

IMOOC.GLOBAL.AJAX = function (url, method, params, dataType, callback) {
    $.ajax({
        url: url,
        type: method,
        data: params,
        dataType: dataType,
        success: callback,
        error: function () {
            alert('请求异常！');
        }
    });
};