var baseUrl = 'http://172.26.2.215:8089';

window.onload = function () {
    var spans = document.getElementById("change").getElementsByTagName("span")
    // ;
    console.log(spans);
    var divs = document.getElementById("userInfo").getElementsByClassName("phone_user")

    this.console.log(divs)
    for (var i = 0; i < spans.length; i++) {
        spans[i].index = i //创建按钮索引
        spans[i].onclick = function () { //每一个按钮点击事件的方法
            for (var i = 0; i < spans.length; i++) {
                spans[i].classList.remove("active");
                divs[i].style.display = "none";
            }
            //	将对应的索引绑定到一起,点击对应的按钮,对应的内容div就会显示
            spans[this.index].classList.add("active");

            divs[this.index].style.display = "block"
        }
    }

};
//电话号码验证
function check_phone(phone) {
    var tel_reg = /^1([38]\d|5[0-35-9]|7[3678])\d{8}$/;
    if (tel_reg.test(phone)) {
        return true;
    } else {
        return false;
    }
};

var time_one = 0;
var time = 60;

//登录注册模块
var login_module = (function () {
    //手机号登录
    var phone_login_info = function phone_login_info(objthis) {
        //layer.msg('暂时只有账号登录的一种方式',{icon:2,time:2000});return;
        var url = baseUrl + '/api/portal/loginByVercode';
        var phone = $(objthis).parent().find('.phone_input').val();
        var code_input = $(objthis).parent().find('.code_input').val();
        var check_phones = check_phone(phone);
        var web_type = $(objthis).attr('web_type');
        var id = $(objthis).attr('data-id');
        if (check_phones == false) {
            layer.msg('手机号不合法', {icon: 2, time: 2000});
            return;
        }
        if (code_input == '' || code_input == 'undefined' || code_input == undefined) {
            layer.msg('请输入验证码', {icon: 2, time: 2000});
            return;
        }
        var url2 = $('#check_url').attr('data-url');
        $.ajax({
            type: "post",
            url: url,
            data: JSON.stringify({userMobile: phone, verCode: code_input}),
            headers: {
                "Content-Type": "application/json",
            },
            dataType: 'json',
            success: function (ret) {
                var sess = $.session.get('mobile', ret.data.mobile);
                var sess = $.session.get('token', ret.data.token);
                var sess = $.session.get('userName', ret.data.userName);
                var sess = $.session.get('userType', ret.data.userType);

                if (ret.status == 200) {
                    if (ret.status == 200) {
                        $.post(
                            url2,
                            {
                                mobile: ret.data.mobile,
                                token: ret.data.token,
                                userName: ret.data.userName,
                                userType: ret.data.userType
                            },
                            function (res) {
                                if (res.status == true) {
                                    layer.msg(res.message, {icon: 1, time: 1500}, function () {
                                        var href_url = $('#login_url').attr('data-url');//首页的文章详情
                                        var href_url2 = $('#login_url2').attr('data-url');//首页
                                        var href_url3 = $('#login_url3').attr('data-url');//惠灵工的了解更多
                                        var href_url4 = $('#login_url4').attr('data-url');//首页的了解更多
                                        //如果是从点击详情进来的就直接调到详情页，没有就调到首页
                                        if(web_type == 1){
                                            //首页的文章详情
                                            location.href = href_url + '?mid=' + id+'&type='+web_type;
                                        }else if(web_type == 2){
                                            //惠灵工的了解更多
                                            location.href = href_url3 + '?type='+web_type;
                                        }else if((web_type == 3)){
                                            //首页了解更多
                                            location.href = href_url4 + '?type=' + web_type;
                                        }else{
                                            //首页
                                            location.href = href_url2;
                                        }

                                    });
                                } else {
                                    layer.msg(res.message, {icon: 2, time: 2000});
                                }
                            }
                        );
                    } else {
                        layer.msg(ret.message, {icon: 2, time: 2000});
                    }
                }
            },
            error: function (data) {
                console.log(data)
            }
        });
    };
    //账号登录
    var account_login_info = function account_login_info(objthis) {
        var url = baseUrl + '/api/portal/login';
        var phone = $(objthis).parent().find('.accout_input').val();
        var pass_input = $(objthis).parent().find('.pass_input').val();
        var check_phones = check_phone(phone);
        var web_type = $(objthis).attr('web_type');
        var id = $(objthis).attr('data-id');
        if (phone == '' || phone == 'undefined' || phone == undefined) {
            layer.msg('请输入用户名', {icon: 2, time: 2000});
            return;
        }
        if (check_phones == false) {
            //layer.msg('手机号不合法',{icon:2,time:2000});return;
        }
        if (pass_input == '' || pass_input == 'undefined' || pass_input == undefined) {
            layer.msg('请输入密码', {icon: 2, time: 2000});
            return;
        }

        var url2 = $('#check_url').attr('data-url');
        $.ajax({
            type: "post",
            url: url,
            data: JSON.stringify({userMobile: phone, loginPassword: pass_input}),//{userMobile:phone,loginPassword:pass_input},//
            headers: {
                "Content-Type": "application/json",
            },
            dataType: 'json',
            success: function (ret) {
                if (ret.status == 200) {
                    $.post(
                        url2,
                        {
                            mobile: ret.data.mobile,
                            token: ret.data.token,
                            userName: ret.data.userName,
                            userType: ret.data.userType
                        },
                        function (res) {
                            if (res.status == true) {
                                //将用户信息存入session
                                $.session.set('mobile',ret.data.mobile);
                                $.session.set('token',ret.data.token);
                                $.session.set('userName',ret.data.userName);
                                $.session.set('userType',ret.data.userType);
                                layer.msg(res.message, {icon: 1, time: 1500}, function () {
                                    var href_url = $('#login_url').attr('data-url');//首页的文章详情
                                    var href_url2 = $('#login_url2').attr('data-url');//首页
                                    var href_url3 = $('#login_url3').attr('data-url');//惠灵工的了解更多
                                    var href_url4 = $('#login_url4').attr('data-url');//首页的了解更多
                                    //如果是从点击详情进来的就直接调到详情页，没有就调到首页
                                    if(web_type == 1){
                                        //首页的文章详情
                                        location.href = href_url + '?mid=' + id+'&type='+web_type;
                                    }else if(web_type == 2){
                                        //惠灵工的了解更多
                                        location.href = href_url3 + '?type='+web_type;
                                    }else if((web_type == 3)){
                                        //首页了解更多
                                        location.href = href_url4 + '?type=' + web_type;
                                    }else{
                                        //首页
                                        location.href = href_url2;
                                    }
                                });
                            } else {
                                layer.msg(res.message, {icon: 2, time: 2000});
                            }
                        }
                    );
                } else {
                    layer.msg(ret.message, {icon: 2, time: 2000});
                }

            },
            error: function (data) {
                console.log(data)
            }
        });
    };


    //登录验证码
    var get_code = function get_code(objthis) {
        var code = $('#phone_input').val();
        if (code == '' || code == 'undefined' || code == undefined) {
            layer.msg('请填写手机号', {icon: 2, time: 2000});
            return;
        }
        settime(objthis);
        var url = baseUrl + '/api/wechatLogin/sendSMSCode';
        $.ajax({
            type: "post",
            url: url,
            data: JSON.stringify({phoneNumber: code}),
            headers: {
                "Content-Type": "application/json",
            },
            dataType: 'json',
            success: function (res) {

                if (res.status == 200) {
                    layer.msg('验证码已发送，请查收短信', {icon: 1, time: 2000});
                } else {
                    layer.msg(res.message, {icon: 2, time: 2000});
                }
            },
            error: function (data) {
                console.log(data)
            }
        });
    };

    return {
        phone_login_info: phone_login_info,
        account_login_info: account_login_info,
        get_code: get_code,
    };
})();


function settime(obj) { //发送验证码倒计时
    $(obj).css('display', 'none');
    $('#msg_code').css('display', 'block');
    var time2 = 60;
    var validCode = true;

    if (validCode) {
        validCode = false;
        var t = setInterval(function () {
            time2--;
            $('#msg_code').html(time2 + "秒后重新获取");
            if (time2 == 0) {
                clearInterval(t);
                validCode = true;
                $('#msg_code').css('display', 'none');
                $(obj).css('display', 'block');
            }
        }, 1000)
    }
}


