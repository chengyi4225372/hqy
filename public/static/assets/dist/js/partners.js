

//添加弹窗
$('#addpartner').click(function(){
    var url = $(this).attr('data-url');
    layer.open({
        type: 2,
        title: '添加产品',
        shadeClose: true,
        shade: 0.8,
        area: ['50%', '75%'],
        content: url, //iframe的url
    })
});

$(".cancle").click(function(){
    parent.layer.closeAll();
})

$("#imgs").click(function(){
    $("#files").click();
})

//上传图片
function upload_files() {
    var formData =new FormData();
    formData.append("file",$("#file")[0].files[0]);

    var urls = "uploadImgs";

    $.ajax({
        url: urls,
        type: "post",
        data: formData,
        async:false,
        dataType: 'json',
        cache: false,
        processData : false,
        contentType : false,
        success: function (ret) {
            if (ret.code == 200) {
                $("#imgs").attr('src', ret.path);
                $("#Images").val(ret.path);
                layer.msg(ret.msg,{icon:6});
            } else {
                layer.msg(ret.msg);
            }
        },

    });
    return false;
}


//添加提交
$(".addpartners").click(function(){

    var urls = $(this).attr('data-url');

    var imgs = $('#Images').val();
    var iurl = $('#iurl').val();


    if(imgs == '' || imgs == undefined){
        layer.msg('请上传图片');
        return ;
    }

    if(iurl == '' || iurl == undefined){
        layer.msg('请填写连接地址');
        return;
    }

    $.post(urls,{'imgs':imgs,'iurl':iurl},function(ret){
         if(ret.code == 200){
             layer.msg(ret.msg,{icon:6},function(){
                 parent.location.href="index";
             })
         }

        if(ret.code == 400){
            layer.msg(ret.msg,{icon:5},function(){
                parent.location.href="index";
            })
        }

    },'json')
});


//编辑弹窗
$(".edit-partner").click(function(){
    var url1 = $(this).attr('data-url');

    layer.open({
        type: 2,
        title: '编辑详情',
        shadeClose: true,
        shade: 0.8,
        area: ['50%', '75%'],
        content: url1, //iframe的url
    })
})

//编辑提交
$('.editpartners').click(function(){
    var url2 = $(this).attr('data-url');

    var mid  = $('#mid').val();
    var iurl = $('#iurl').val();
    var imgs = $('#Images').val();

    if(imgs == '' || imgs == undefined){
        layer.msg('请上传图片');
        return ;
    }

    if(iurl == '' || iurl == undefined){
        layer.msg('请填写连接地址');
        return;
    }

    $.post(url2,{'id':mid,'iurl':iurl,'imgs':imgs},function(ret){
         if(ret.code == 200){
             layer.msg(ret.msg,{icon:6},function(){
                 parent.location.href='index';
             })
         }

        if(ret.code == 400){
            layer.msg(ret.msg,{icon:5},function(){
                parent.location.href='index';
            })
        }

    },'json')
})
