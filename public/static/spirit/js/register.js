var baseUrl = 'http://172.26.2.215:8089';

//电话号码验证
function check_phone(phone) {
    var tel_reg = /^1([38]\d|5[0-35-9]|7[3678])\d{8}$/;
    if (tel_reg.test(phone)) {
        return true;
    } else {
        return false;
    }
};

window.onload = function () {
    var tabArr = document.querySelectorAll(".tabs .tab");
    var tabsitemArr = document.querySelectorAll(".tabs-items .tabs-item");
    let qyonebox = document.querySelector('.tabs-item-qy #one-box')
    let qytwobox = document.querySelector('.tabs-item-qy #two-box')
    let qyonebtn = document.querySelector('#qy-one-btn')
    let qytwobtn = document.querySelector('#qy-two-btn')
    let gronebox = document.querySelector('.tabs-item-gr #one-box')
    let grtwobox = document.querySelector('.tabs-item-gr #two-box')
    let gronebtn = document.querySelector('#gr-one-btn')
    let grtwobtn = document.querySelector('#gr-two-btn')
    let succeedbox = document.querySelector('#succeed-box')
    let formcontent = document.querySelector("#form-content")
    console.log('====================================');
    console.log(qytwobox, qytwobtn);
    console.log('====================================');


    //企业注册  第一步
    qyonebtn.onclick = function (){
        //企业手机号
        var phone = $('#phone').val();
        //短信验证码
        var code = $('#code').val();
        //密码1
        var password1 = $('#password1').val();
        //密码2
        var password2 = $('#password2').val();
        if (phone == '' || phone == 'undefined' || phone == undefined) {
            layer.msg('请输入手机号', {icon: 2, time: 2000});return;
        }
        if (!check_phone(phone)) {
            layer.msg('企业手机号不合法',{icon:2,time:2000});return;
        }
        if (code == '' || code == 'undefined' || code == undefined) {
            layer.msg('请输入短信验证码', {icon: 2, time: 2000});return;
        }
        if (password1 == '' || password1 == 'undefined' || password1 == undefined) {
            layer.msg('请设置密码', {icon: 2, time: 2000});return;
        }
        if (password2 == '' || password2 == 'undefined' || password2 == undefined) {
            layer.msg('再次确认密码', {icon: 2, time: 2000});return;
        }

        if(password1 != password2){
            layer.msg('两次输入的密码不一致', {icon: 2, time: 2000});return;
        }
        qyonebox.style.display = "none";
        qytwobox.style.display = "block";

    };

    //企业注册  完成注册
    qytwobtn.onclick = function () {
        var url = baseUrl + '/api/portal/register';
        //第一步
        //企业手机号
        var phone = $('#phone').val();
        //短信验证码
        var code = $('#code').val();
        //密码1
        var password1 = $('#password1').val();
        //密码2
        var password2 = $('#password2').val();

        //第二步
        //企业名称
        var businessName = $('#businessName').val();
        //公司地址
        var customerAddress = $('#customerAddress').val();
        //法人姓名
        var legalPersonName = $('#legalPersonName').val();
        //法人电话
        var legalPersonMobile = $('#legalPersonMobile').val();
        //纳税识别号
        var industryNo = $('#industryNo').val();

        //两次输入的密码是否一致

        if (businessName == '' || businessName == 'undefined' || businessName == undefined) {
            layer.msg('请输入企业名称', {icon: 2, time: 2000});
            return;
        }
        if (customerAddress == '' || customerAddress == 'undefined' || customerAddress == undefined) {
            layer.msg('请填写公司地址', {icon: 2, time: 2000});
            return;
        }
        if (legalPersonName == '' || legalPersonName == 'undefined' || legalPersonName == undefined) {
            layer.msg('请填写法人姓名', {icon: 2, time: 2000});
            return;
        }
        if (legalPersonMobile == '' || legalPersonMobile == 'undefined' || legalPersonMobile == undefined) {
            layer.msg('请填写法人电话', {icon: 2, time: 2000});return;
        }
        if (!check_phone(legalPersonMobile)) {
            layer.msg('法人手机号不合法',{icon:2,time:2000});return;
        }

        if (industryNo == '' || industryNo == 'undefined' || industryNo == undefined) {
            layer.msg('请填写纳税识别号', {icon: 2, time: 2000});return;
        }
        //用户类型
        var user_type = $('#user_type').val();

        $.ajax({
            type: "post",
            url: url,
            data: JSON.stringify({userType:user_type,taxNo:industryNo,businessAddress:customerAddress,userMobile:phone,verCode:code,loginPassword:password1,businessName:businessName,legalPersonName:legalPersonName,legalPersonMobile:legalPersonMobile}),
            headers: {
                "Content-Type": "application/json",
            },
            dataType: 'json',
            success: function (ret) {
                if (ret.status == 200) {
                    succeedbox.style.display = "block";
                    formcontent.style.display = "none";

                }else{
                    layer.msg(ret.message,{icon:2,time:1500});
                }
            },
            error: function (data) {
                console.log(data)
            }
        });

    };

    //刚进来就要去查询出希望从事的行业
    $(window).ready(function (){
        var url = baseUrl + '/api/portal/getIndustryParent';
        $.ajax({
            type: "get",
            url: url,
            data: '',
            headers: {
                "Content-Type": "application/json",
            },
            dataType: 'json',
            success: function (ret) {
                if (ret.status == 200) {
                    var _html = '';
                    var _html2 = '';
                    if(ret.data.length >0){
                        $.each(ret.data,function (index,item){
                            _html += '<option value="'+item.industryNo+'">'+item.industryName+'</option>';
                            if(index == 0){
                                $.ajax({
                                    type:"get",
                                    url:url,
                                    data:{parentNo:item.industryNo},//JSON.stringify({parentNo:item.industryNo}),
                                    headers: {
                                        "Content-Type": "application/json",
                                    },
                                    dataType: 'json',
                                    success:function(res){
                                        if(res.status == 200){
                                            if(res.data.length > 0){
                                                $.each(res.data,function (index2,item2){
                                                    _html2 += '<option value="'+item2.industryNo+'">'+item2.industryName+'</option>';
                                                });
                                                $('#taxNo2').append('').html(_html2);
                                            }
                                        }
                                    },
                                    error: function (data) {
                                        console.log(data)
                                    }
                                });
                            }
                        });
                        $('#taxNo').append('').html(_html);
                    }
                }
            },
            error: function (data) {
                console.log(data)
            }
        });
    });

    //个人注册  第一步
    gronebtn.onclick = function () {
        //个人手机号
        var user_phone = $('#user_phone').val();
        //验证码
        var user_code =  $('#user_code').val();
        //密码1
        var user_password = $('#user_password').val();
        //密码2
        var user_password2 = $('#user_password2').val();

        if(user_phone == '' || user_phone == 'undefined' || user_phone == undefined){
            layer.msg('请填写手机号', {icon: 2, time: 2000});return;
        }
        if (check_phone(user_phone) == false) {
            layer.msg('手机号不合法', {icon: 2, time: 2000});return;
        }
        if(user_code == '' || user_code == 'undefined' || user_code == undefined){
            layer.msg('请填写验证码', {icon: 2, time: 2000});return;
        }
        if(user_password == '' || user_password == 'undefined' || user_password == undefined){
            layer.msg('请设置密码', {icon: 2, time: 2000});return;
        }
        if(user_password2 == '' || user_password2 == 'undefined' || user_password2 == undefined){
            layer.msg('请确认密码', {icon: 2, time: 2000});return;
        }

        if(user_password != user_password2){
            layer.msg('两次输入的密码不一致', {icon: 2, time: 2000});return;
        }
        gronebox.style.display = "none";
        grtwobox.style.display = "block";
    };


    //个人注册  第二步
    grtwobtn.onclick = function () {
        var url = baseUrl + '/api/portal/register';
        //个人手机号
        var user_phone = $('#user_phone').val();
        //验证码
        var user_code =  $('#user_code').val();
        //密码1
        var user_password = $('#user_password').val();
        //密码2
        var user_password2 = $('#user_password2').val();
        //姓名
        var userName =  $('#userName').val();
        //希望从事行业
        var taxNo =  $('#taxNo').val();
        //希望从事行业2
        var taxNo2 =  $('#taxNo2').val();
        //联系方式
        var contact =  $('#contact').val();
        //用户类型
        var user_type2 = $('#user_type2').val();


        if(userName == '' || userName == 'undefined' || userName == undefined){
            layer.msg('请输入姓名', {icon: 2, time: 2000});return;
        }
        if(taxNo == '' || taxNo == 'undefined' || taxNo == undefined){
            layer.msg('请选择所从事的行业1', {icon: 2, time: 2000});return;
        }

        if(taxNo2 == '' || taxNo2 == 'undefined' || taxNo2 == undefined){
            layer.msg('请选择所从事的行业2', {icon: 2, time: 2000});return;
        }
        if(contact == '' || contact == 'undefined' || contact == undefined){
            layer.msg('请填写联系方式', {icon: 2, time: 2000});return;
        }

        var user_type = $('#user_type2').val();
        $.ajax({
            type: "post",
            url: url,
            data: JSON.stringify({userType:user_type,userMobile:user_phone,verCode:user_code,loginPassword:user_password,industryNo:taxNo2,userName:userName,customerAddress:contact}),
            headers: {
                "Content-Type": "application/json",
            },
            dataType: 'json',
            success: function (ret) {
                if (ret.status == 200) {
                    succeedbox.style.display = "block";
                    formcontent.style.display = "none";
                }
            },
            error: function (data) {
                console.log(data)
            }
        });

    };

    for (var i = 0; i < tabArr.length; i++) {
        //绑定索引值（新增一个自定义属性：index属性）
        tabArr[i].index = i;
        tabArr[i].onclick = function () {

            //1.点亮上面的盒子。   2.利用索引值显示下面的盒子。(排他思想)
            for (var j = 0; j < tabArr.length; j++) {
                tabArr[j].classList.remove("tab-active");
                tabsitemArr[j].classList.remove("tabs-item-active");
            }
            this.classList.add("tab-active");
            tabsitemArr[this.index].classList.add("tabs-item-active");
        }
    }
};

function change_tax(objthis){
    var taxNo = $(objthis).val();
    var url = baseUrl + '/api/portal/getIndustryParent';
    $.ajax({
        type:"get",
        url:url,
        data:{parentNo:taxNo},
        headers: {
            "Content-Type": "application/json",
        },
        dataType: 'json',
        success:function(res){

            if(res.status == 200){
                if(res.data.length > 0){
                    var _html2 = '';
                    $.each(res.data,function (index2,item2){
                        _html2 += '<option value="'+item2.industryNo+'">'+item2.industryName+'</option>';
                    });
                    $('#taxNo2').append('').html(_html2);
                }
            }
        },
        error: function (data) {
            console.log(data)
        }
    });

}
var time_one = 0;


var time_one2 = 0;



//获取gr注册验证码
function get_code(objthis){
    var code = $('#user_phone').val();
    if(code == '' || code == 'undefined' || code == undefined){
        layer.msg('请填写手机号', {icon: 2, time: 2000});return;
    }
    settime(objthis);


    var url = baseUrl + '/api/wechatLogin/sendRegisterSMSCode';
    $.ajax({
        type:"post",
        url:url,
        data:JSON.stringify({phoneNumber:code}),
        headers: {
            "Content-Type": "application/json",
        },
        dataType: 'json',
        success:function(res){

            if(res.status == 200){
                //$('#msg_code').css('display','block');
                layer.msg('验证码已发送，请查收短信',{icon:1,time:2000});
            }else{
                layer.msg(res.message, {icon: 2, time: 2000});
            }
        },
        error: function (data) {
            console.log(data)
        }
    });
}

//获得企业注册验证码
function get_qy_code(objthis){
    var code = $('#phone').val();
    if(code == '' || code == 'undefined' || code == undefined){
        layer.msg('请填写手机号', {icon: 2, time: 2000});return;
    }
    settime2(objthis);

    return;
    var url = baseUrl + '/api/wechatLogin/sendRegisterSMSCode';
    $.ajax({
        type:"post",
        url:url,
        data:JSON.stringify({phoneNumber:code}),
        headers: {
            "Content-Type": "application/json",
        },
        dataType: 'json',
        success:function(res){

            if(res.status == 200){
                //$('#msg_code2').css('display','block');
                layer.msg('验证码已发送，请查收短信',{icon:1,time:2000});
            }else{
                layer.msg(res.message, {icon: 2, time: 2000});
            }
        },
        error: function (data) {
            console.log(data)
        }
    });
}


function settime(obj) { //发送验证码倒计时
    $(obj).css('display','none');
    $('#msg_code').css('display','block');
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
                $('#msg_code').css('display','none');
                $(obj).css('display','block');
            }
        }, 1000)
    }
}


function settime2(obj) { //发送验证码倒计时
    $(obj).css('display','none');
    $('#msg_code2').css('display','block');
    var time2 = 60;
    var validCode = true;

    if (validCode) {
        validCode = false;
        var t = setInterval(function () {
            time2--;
            $('#msg_code2').html(time2 + "秒后重新获取");
            if (time2 == 0) {
                clearInterval(t);
                validCode = true;
                $('#msg_code2').css('display','none');
                $(obj).css('display','block');
            }
        }, 1000)
    }
}