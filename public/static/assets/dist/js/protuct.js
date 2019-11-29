//搜索
$('#btn_search_protuct').click(function(){
    var url   = $(this).attr('data-url');
    var names = $('#names').val();

    if(names == '' || names == undefined){
        layer.msg('搜索条件不能为空')
        return;
    }
    window.location.href = url+"?names="+names;
})



$("#addprotuct").click(function(){
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

//关闭弹窗
function go_return(){
    parent.layer.closeAll();
}

//点击图片触动上传
$('#imgs').click(function(){
    $('#file').click();
})

//上传图片
function upload_file() {
    var formData =new FormData();
    formData.append("file",$("#file")[0].files[0]);

    var urls = "uploadImg";

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

//添加
$('.adds').click(function(){
    var purl   =  $("#purl").val();
    var names  = $("#names").val();
    var desc   = $("#desc").val();
    var imgs    = $('#Images').val();
    var status = $('#status option:selected').val();

    var url =  $(this).attr('data-url');

    if(purl == '' || purl==undefined){
        layer.msg('请输入连接地址');
        return ;
    }

    if(names =='' || names == undefined){
       layer.msg('请输入产品名称');
         return false;
    }

    if(desc == '' || desc==undefined){
        layer.msg('描述不能为空');
        return;
    }

    if(imgs == '' || imgs == undefined){
        layer.msg('请上传图片');
        return ;
    }

    $.post(url,{'purl':purl,'names':names,'desc':desc,'imgs':imgs,'status':status},function(ret){
          if(ret.code == 200){
              layer.msg(ret.msg,function(){
                  parent.location.href = "index";
              });
          }

        if(ret.code == 400){
            layer.msg(ret.msg,function(){
                parent.location.reload();
            });
        }

    },'json');
})


//编辑
$('.edit-protuct').click(function(){
    var url = $(this).attr('data-url');
    layer.open({
        type: 2,
        title: '编辑产品',
        shadeClose: true,
        shade: 0.8,
        area: ['50%', '75%'],
        content: url, //iframe的url
    })

});

//编辑提交

$('.edits').click(function(){
    var purl   = $("#purl").val();
    var names  = $("#names").val();
    var desc   = $("#desc").val();
    var imgs   = $('#Images').val();
    var status = $('#status option:selected').val();
    var pid    = $('#pid').val();

    if(purl == '' || purl==undefined){
        layer.msg('请输入连接地址');
        return ;
    }

    if(names =='' || names == undefined){
        layer.msg('请输入产品名称');
        return false;
    }

    if(desc == '' || desc==undefined){
        layer.msg('描述不能为空');
        return;
    }

    if(imgs == '' || imgs == undefined){
        layer.msg('请上传图片');
        return ;
    }

    var url =  $(this).attr('data-url');

    if(purl == '' || purl==undefined){
        layer.msg('请输入连接地址');
        return ;
    }

    $.post(url,{'purl':purl,'names':names,'desc':desc,'imgs':imgs,'status':status,'id':pid},function(ret){
        if(ret.code == 200){
            layer.msg(ret.msg,function(){
                parent.location.href = "index";
            });
        }

        if(ret.code == 400){
            layer.msg(ret.msg,function(){
                parent.location.reload();
            });
        }

    },'json');
})


