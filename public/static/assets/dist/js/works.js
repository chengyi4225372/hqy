
//富文本
var ue = UE.getEditor('content',{initialFrameWidth:'90%',initialFrameHeight:300,charset:"utf-8"});

//取消
$('.cancle').click(function(){
    parent.layer.closeAll();
});

//搜索
$(".btn_search").click(function(){
    var url   =  $(this).attr('data-url');
    var title =  $("#keyword").val();
    if(title=='' || title == undefined){
        layer.msg("请输入搜索的文章标题");
        return ;
    }
   window.location.href= url +"?title="+title;
})

//弹窗
$("#addwork").click(function(){
    var url = $(this).attr('data-url');
    layer.open({
        type: 2,
        title: '添加新闻',
        shadeClose: true,
        shade: 0.8,
        area: ['50%', '75%'],
        content: url, //iframe的url
    })
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

$('.addworks').click(function(){
    var urlk  = $(this).attr('data-url');
    var data = {};

    data.title = $('#title').val();
    data.desc  = $('#desc').val();
    data.sort  = $('#sort').val();
    data.keyword = $('#keyword').val();
    data.content = ue.getContent();//取得html文本
    data.imgs    =$('#Images').val();

    if(data.title== '' || data.title == undefined){
        layer.msg('请输入新闻标题');
        return false;
    }

    if(data.imgs== '' || data.imgs == undefined){
        layer.msg('请上传新闻图片');
        return false;
    }


    if(data.desc== '' || data.desc == undefined){
        layer.msg('请输入新闻描述');
        return false;
    }

    if(data.content== '' || data.content == undefined){
        layer.msg('请填写新闻详情');
        return false;
    }

   $.post(urlk,data,function(ret){
        if(ret.code == 200){
            layer.msg(ret.msg,function(){
                parent.location.href='index';
            })
        }

       if(ret.code == 400){
           layer.msg(ret.msg,function(){
               parent.location.href='index';
           })
       }
   },'json')

})

//编辑
$(".editWork").click(function(){
    var urls = $(this).attr("data-url");

    layer.open({
        type: 2,
        title: '编辑新闻',
        shadeClose: true,
        shade: 0.8,
        area: ['50%', '75%'],
        content: urls, //iframe的url
    })
})

$('#editWorks').click(function(){
    var urle = $(this).attr('data-url');

    var datas  = {};
    datas.title = $('#title').val();
    datas.desc  = $('#desc').val();
    datas.sort  = $('#sort').val();
    datas.keyword = $('#keyword').val();
    datas.content = ue.getContent();//取得html文本
    datas.imgs    =$('#Images').val();
    datas.id     = $('#mid').val();


    if(datas.id == '' || datas.id == undefined){
        return false;
    }

    if(datas.title== '' || datas.title == undefined){
        layer.msg('请填写新闻标题');
        return false;
    }

    if(datas.imgs== '' || datas.imgs == undefined){
        layer.msg('请上传新闻图片');
        return false;
    }


    if(datas.desc== '' || datas.desc == undefined){
        layer.msg('请填写新闻描述');
        return false;
    }

    if(datas.content== '' || datas.content == undefined){
        layer.msg('请填写新闻详情');
        return false;
    }

    $.post(urle,datas,function(ret){

        if(ret.code == 200){
            layer.msg(ret.msg,function(){
                parent.location.href='index';
            })
        }

        if(ret.code == 400){
            layer.msg(ret.msg,function(){
                parent.location.href='index';
            })
        }
    },'json')
});

//删除
function delWork(id){

    var url  = "del";

    var id = id;

    layer.confirm('您确定要删除？', {
        btn: ['确定','点错了'] //按钮
    }, function(){
        $.post(url,{'id':id},function(ret){
            if(ret.code ==  200){
                layer.msg(ret.msg,{icon:6},function(){
                    parent.location.reload();
                })
            }

            if(ret.code == 400){
                layer.msg(ret.msg,{icon:5},function(){
                    parent.location.reload();
                })
            }
        },'json')
    }, function(){
       parent.layer.closeAll();
    });


}

//排序
function setSort(value,id){
    var  newVal  = value;
    var   id     = id;
    var  setUrl = "setsort";

    $.post(setUrl,{'sort':newVal,'id':id},function(ret){
        if(ret.code == 200){
            layer.msg(ret.msg,{icon:6},function(){
                parent.location.reload();
            })
        }

        if(ret.code == 400){
            layer.msg(ret.msg,{icon:6},function(){
                parent.location.reload();
            })
        }
    },'json')

}

