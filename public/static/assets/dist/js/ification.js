/**
 * 搜索
 */
$('#btnsearch').click(function(){
   var key = $.trim($('#keywords').val());
   var urlss = $(this).attr('data-url');
   if(key == '' || key == undefined){
       layer.msg('请输入标签名进行搜索...',{icon:6});
       return false;
   }

   window.location.href= urlss+'?title='+key;

});

/**
 * 添加 弹窗
 */
$('#addcates').click(function(){
   var url = $(this).attr('data-url');

    layer.open({
        type: 2,
        title: '添加标签',
        shadeClose: true,
        shade: 0.8,
        area: ['35%', '40%'],
        content: url, //iframe的url
   });
});

/**
 * 添加数据
 */
$('.add_biao').click(function(){
     var title  = $.trim($('#title').val());
     var sort   = $.trim($('#sort').val());

     var urls  = $(this).attr('data-url');

     if(title  == '' || title  == undefined){
         layer.msg('请输入标签名称');
         return false;
     }

     $.post(urls,{'title':title,'sort':sort},function(ret){
             if(ret.code == 200){
               layer.msg(ret.msg,{icon:6},function(){
                   parent.location.reload();
               })
             }

             if(ret.code == 400){
                 layer.msg(ret.msg,{icon:5},function(){
                     parent.location.reload();
                 })
             }

     },'json');



});

/**
 * 取消关闭弹窗
 */
$('.cancle').click(function(){
     parent.layer.closeAll();
});

/**
 * 编辑弹窗
 */
function edits(obj){
  var urls = $(obj).attr('data-url');
  var mid  = $(obj).attr('data-id');

  if(urls == '' || urls == undefined || urls == 'undefined'){
      return false;
  }

  layer.open({
      type: 2,
      title: '添加标签',
      shadeClose: true,
      shade: 0.8,
      area: ['35%', '40%'],
      content: urls+'?mid='+mid, //iframe的url
       });
}


/**
 * 编辑逻辑
 */
$('.edit_biao').click(function(){
    var urls = $(this).attr('data-url');
    var title= $.trim($('#title').val());
    var sort = $.trim($('#sort').val());
    var mid  = $('#mid').val();

    if(urls == '' || urls == undefined || urls == 'undefined'){
        return false;
    }

    if(title == '' || title==undefined){
        layer.msg('标签名不能为空');
        return false;
    }

    $.post(urls,{'title':title,'mid':mid,'sort':sort},function(ret){

         if(ret.code == 200){
             layer.msg(ret.msg,{icon:6},function(){
                 parent.location.reload();
             })
         }

        if(ret.code == 400){
            layer.msg(ret.msg,{icon:5},function(){
                parent.location.reload();
            })
        }


    },'json');

});

/**
 * 删除
 */
function dels(obj){
   var del_url = $(obj).attr('data-url');
   var mid      = $(obj).attr('data-id');

   if(mid == ''|| mid == undefined || mid=='undefined'){
       return false;
   }

   if(del_url =='' || del_url == undefined){
       layer.msg('路由不合法');
       return false;
   }

    layer.confirm('您确定要删除？', {
        btn: ['确定','点错了'] //按钮
    }, function(){
       $.get(del_url,{'mid':mid},function(ret){
           if(ret.code == 200){
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


/**
 * 修改排序
 */
function savesort(val,id,url){
        var  mid = id;
        var  sort= val;;

        if(mid == '' || mid == undefined || mid=='undefined'){
         return false;
        }

        var urls = $(url).attr('data-url');

        if(urls == '' || urls == undefined){
            return false;
        }

        $.get(urls,{'mid':mid,'sorts':sort},function(ret){

            if(ret.code == 200){
                layer.msg(ret.msg,{icon:6},function(){
                  parent.location.reload();
                })
            };

            if(ret.code == 400){
                layer.msg(ret.msg,{icon:5},function(){
                    parent.location.reload();
                })
            };
        },'json');

    }





