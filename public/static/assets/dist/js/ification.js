/**
 * 搜索
 */
$('#btnsearch').click(function () {
    var key = $.trim($('#keywords').val());
    var status = $('#status').val();
    var disable = $('#disable').val();
    var urlss = $(this).attr('data-url');

    window.location.href = urlss + '?title=' + key + '&status=' + status + '&disable=' + disable;

});

/**
 * 添加 弹窗
 */
$('#addcates').click(function () {
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
$('.add_biao').click(function () {
    var title = $.trim($('#title').val());
    var sort = $.trim($('#sort').val());
    var disable = $.trim($('#disable').val());

    var urls = $(this).attr('data-url');

    if (title == '' || title == undefined) {
        layer.msg('请输入标签名称');
        return false;
    }

    if (disable == '' || title == undefined) {
        layer.msg('请确定关键字是在哪个页面显示');
        return false;
    }

    $.post(urls, {title: title, sort: sort, disable: disable}, function (ret) {
        if (ret.code == 200) {
            layer.msg(ret.msg, {icon: 6}, function () {
                parent.location.reload();
            })
        }

        if (ret.code == 400) {
            layer.msg(ret.msg, {icon: 5})
        }

    }, 'json');


});

/**
 * 取消关闭弹窗
 */
$('.cancle').click(function () {
    parent.layer.closeAll();
});

/**
 * 编辑弹窗
 */
function edits(obj) {
    var urls = $(obj).attr('data-url');
    var mid = $(obj).attr('data-id');

    if (urls == '' || urls == undefined || urls == 'undefined') {
        return false;
    }

    layer.open({
        type: 2,
        title: '添加标签',
        shadeClose: true,
        shade: 0.8,
        area: ['35%', '40%'],
        content: urls, //iframe的url
    });
}


/**
 * 编辑逻辑
 */
$('.edit_biao').click(function () {
    var urls = $(this).attr('data-url');
    var title = $.trim($('#title').val());
    var sort = $.trim($('#sort').val());
    var disable = $('#disablekey').val();
    disable = disable.join(',');
    var mid = $('#mid').val();

    if (urls == '' || urls == undefined || urls == 'undefined') {
        return false;
    }

    if (title == '' || title == undefined) {
        layer.msg('标签名不能为空');
        return false;
    }

    if(disable == '' || disable == undefined){
        layer.msg('请确定关键字是在哪个页面显示');
        return false;
    }

    $.post(urls, {'title': title, 'mid': mid, 'sort': sort,'disable':disable}, function (ret) {
        if (ret.code == 200) {
            layer.msg(ret.msg, {icon: 6}, function () {
                parent.location.reload();
            })
        }

        if (ret.code == 400) {
            layer.msg(ret.msg, {icon: 5})
        }


    }, 'json');

});

/**
 * 删除
 */
function dels(objthis) {
    var status = $(objthis).attr('data');
    var url = $(objthis).attr('data-url');
    var id = $(objthis).attr('data-id');
    $.post(
        url,
        {status: status, id: id},
        function (ret) {
            if (ret.code == 200) {
                if (status == -1) {
                    $(objthis).removeClass('btn-success');
                    $(objthis).addClass('btn-danger');
                    $(objthis).attr('data', 1);
                    $(objthis).html('已禁用');
                }
                if (status == 1) {
                    $(objthis).removeClass('btn-danger');
                    $(objthis).addClass('btn-success');
                    $(objthis).attr('data', -1);
                    $(objthis).html('已启用');
                }
                layer.msg(ret.msg, {icon: 6, time: 1500});
            }
            if (ret.code == 400) {
                layer.msg(ret.msg, {icon: 5, time: 1500});
            }
        }, 'json'
    );
}


/**
 * 修改排序
 */
function savesort(val, id, url) {
    var mid = id;
    var sort = val;
    ;

    if (mid == '' || mid == undefined || mid == 'undefined') {
        return false;
    }

    var urls = $(url).attr('data-url');

    if (urls == '' || urls == undefined) {
        return false;
    }

    $.get(urls, {'mid': mid, 'sorts': sort}, function (ret) {

        if (ret.code == 200) {
            layer.msg(ret.msg, {icon: 6}, function () {
                parent.location.reload();
            })
        }
        ;

        if (ret.code == 400) {
            layer.msg(ret.msg, {icon: 5}, function () {
                parent.location.reload();
            })
        }
        ;
    }, 'json');

}





