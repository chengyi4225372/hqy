//手机验证
function checkPhone(phone) {
    var tel_reg = /^1(3|4|5|6|7|8|9)\d{9}$/;
    if (!tel_reg.test(phone)) {
        return false;
    } else {
        return true;
    }
}

var gurl = "http://47.105.48.137:8089";

function getErp() {
    var urkl = gurl + "/api/wechatForeign/public/addGatewayPotentialCustomer";

    var data = {};

    data.contactName = $.trim($("#contactName").val());//联系姓名
    data.companyName = $.trim($("#companyName").val()); //公司
    data.contactMobile = $.trim($("#contactMobile").val());//手机
    data.source = $("#source").val(); //渠道
    data.identification = $("#identification").val();//标识

    if (data.contactMobile == '' || data.contactMobile == undefined) {
        layer.msg('请填写联系电话');
        return false;
    }

    if (checkPhone(data.contactMobile) === false) {
        layer.msg("联系电话不合法");
        return false;
    }

    if (data.companyName == '' || data.companyName == undefined) {
        layer.msg('请填写公司名称');
        return false;
    }

    if (data.contactName == '' || data.contactName == undefined) {
        layer.msg('请填写您的姓名');
        return false;
    }

    $.ajax({
        url: urkl,
        type: "post",
        headers: {
            "Content-Type": "application/json",
        },
        dataType: 'json',
        data: JSON.stringify(data),
        success: function (ret) {

            //201 号码已经存在
            if (ret.status == 200 && ret.rel == true) {
                layer.msg('提交成功', function () {
                    parent.location.reload();
                })
            }

            if (ret.status == 201) {
                layer.msg(ret.message, function () {
                    parent.location.reload();
                })
            }

            if (ret.status == 500) {
                layer.msg('网络错误，请稍后再提交。', function () {
                    parent.location.reload();
                });
            }
        },
        error: function (ret) {
            console.log(ret);
        }

    })

}

//点击弹窗
function showSearch() {
    var content = '';

    content += "<div class='propbox' >";
    content += "<div class='title' onclick='closedTab()'>方案咨询<i class='close'></i></div>";
    content += "<div class='total-input'> <div>";
    content += "<span>您的姓名</span>";
    content += "<input type='text' id='contactName'  placeholder='请输入您的姓名'></div>";
    content += "<div><span>您的公司</span>";
    content += "<input type='text' id='companyName' placeholder='请输入您的公司名称'></div><div>";
    content += "<span>联系方式</span>";
    content += "<input type='text' id='contactMobile'  placeholder='请输入您的联系方式'></div>";
    content += "<input type='hidden' id='source' value='门户首页'>";
    content += "<input type='hidden' id='identification' value='企业一站式服务'>";
    content += "<button  class='button' onclick='getErp()'>获取方案</button>";
    content += "</div><div class='mask-box1'>";
    content += "<span></span>";
    content += "<p class='mask-box-title'>提交成功</p>";
    content += "<p class='mask-box-content'>我们会在一个工作日内联系您</p>";
    content += "</div></div>";

    console.log(content);
    $(".prop_box").append(content).show();
}

//关闭弹窗
function closedTab() {
    $(".prop_box").hide();
}


//首页搜索
function search(obj) {
    var keyword = $('#keyword').val();
    var url = $(obj).attr('data-url');
    if (keyword == '' || keyword == undefined) {
        layer.msg('请输入搜索条件');
        return false;
    }

    window.location.href = url + "?keyword=" + keyword;
}

//了解更多
function showUrl(objthis) {
    var data_url = $(objthis).attr('data-url');
    var is_login = $(objthis).attr('mobile-phone');
    var login_url2 = $(objthis).attr('login_url');
    var loca_url2 = $(objthis).attr('loca_url');
    var loca_url = encodeURIComponent(loca_url2);
    var login_url = login_url2 + '?artId=' + loca_url;
    //if(is_login == '' || is_login == undefined){
    //    //window.location.href=login_url;
    //    window.open(login_url);
    //}else{
    //    window.location.href=data_url;
    //}
    window.location.href = data_url;

}

//列表页搜索
$(function () {
    $('#searched').click(function () {
        var keyword = $('#keyword').val();
        var url = $(this).attr('data-url');
        //if (keyword == '' || keyword == undefined) {
        //    layer.msg('请输入搜索条件');
        //    return false;
        //}
        //var urlw = "/home/index/infoList";

        window.location.href = url + "?keyword=" + keyword;

    });
});

//回到列表页
function go_news(obj) {
    var url = $(obj).attr('data-url');
    window.location.href = url;
}

 /* 选择热词 */
 $(function () {
    $('.hotWord ul li').click(function () {
        $(this).addClass('chosen')
        $(this).children().css({ 'display': 'block' });
    })
    $('.close').click(function(e){
        e.stopPropagation()
        $(this).css({'display': 'none'})
        $(this).parent().removeClass('chosen')
    })
    $('.hotWord ul li').mouseenter(function(){
        if($(this).hasClass('chosen')){
            return false
        }
        $(this).css({
            'background':'#E7F1FF',
            'color':'#7EB4FD'
        })
    }).mouseleave(function(){
        $(this).css({
            'background':'#F6F6F6',
            'color':'#333'
        })
    })

    /* 惠企云首页二级菜单动效 */
$('.secStatus').mouseenter(function(){
    $(this).css({'color':'#7eb4fd'})
  }).mouseleave(function(){
    $(this).css({'color':'#fff'})
  })
  
  $('.secStatus').mousedown(function(){
    $(this).css({'color':'#4091ff'})
  })
  // .mouseup(function(){
  //   $(this).css({'color':'#fff'})
  // })
})

var keyword = [];
var titles  = '';
/** 列表页热门搜索 **/
function hotsearch(obj) {
     var urls = $(obj).attr('data-url');

     var searchs = $(obj).attr('data-title');

     var index = $.inArray(searchs,keyword);

     if(index >= 0){
         keyword.pop(search);
     }

     keyword.push(searchs);

     if (keyword == '' || keyword == undefined || keyword == 'undefined') {
        return false;
      }

      if(keyword.length == 0 || keyword.length =='' || keyword.length == undefined){
          layer.msg('请选择关键字进行查询');
          return false;
      }

     titles = keyword.join(',')
     console.log(titles);
     $.post(urls,{'title':titles},function(ret){

     })
}

/** 清除关键字 **/
function nullhot(obj){
     var title = $(obj).parents('li').attr('data-title');
     keyword.pop(title);
     titles = keyword.join(',')
     console.log(titles);
    $.post(urls,{'title':titles},function(ret){

    })
}