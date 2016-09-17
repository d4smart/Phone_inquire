/**
 * Created by d4smart on 2016/9/17.
 * JS基础类（依赖jQuery）
 */

$(document).ready(function () {
    $('#subPhone').click(function () {
        var pattern = /^[0-9]{11}$/;
        var phone = $('#phoneText').val();

        if (phone.match(pattern)) {
            IMOOC.GLOBAL.AJAX('api.php', 'post', {'tel': phone}, 'json', IMOOC.APPS.QUERYPHONE.AJAXCALLBACK);
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
        $('#phoneNumber').text(data.telString);
        $('#phoneProvince').text(data.province);
        $('#phoneCatName').text(data.catName);
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