/**
 * Created by d4smart on 2016/9/17.
 * JS基础类（依赖jQuery）
 */

$(document).ready(function () {
    $('#subPhone').click(function () {
        var phone = $('#phoneText').val();
        if (phone.length == 11) {
            IMOOC.GLOBAL.AJAX('api.php', 'post', {'tel': phone}, 'json', IMOOC.APPS.QUERYPHONE.AJAXCALLBACK);
        }
    });
});

var IMOOC = IMOOC || {};
IMOOC.GLOBAL = {};
IMOOC.APPS = {};

IMOOC.APPS.QUERYPHONE = {};
IMOOC.APPS.QUERYPHONE.AJAXCALLBACK = function (data) {
    if (data.code == 200) {
        IMOOC.APPS.QUERYPHONE.SHOWINFO();
        $('#phoneNumber').text(data.telString);
        $('#phoneProvince').text(data.province);
        $('#phoneCatName').text(data.catName);
        $('#phoneMsg').text(data.msg);
    } else {
        IMOOC.APPS.QUERYPHONE.HIDEINFO();
        alert(data.msg);
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