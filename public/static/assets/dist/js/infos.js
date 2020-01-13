//搜索
$('#btn_search').click(function () {
    var url = $(this).attr('data-url');
    var searchField = $('#searchField').val();//搜索字段
    var searchValue = $('#searchValue').val();//搜索值
    var category = $('#category').val();//所属分类

    window.location.href = url + "?searchField=" + searchField + '&searchValue=' + searchValue + '&category=' + category;
})

//富文本
var ue = UE.getEditor('content', {initialFrameWidth: '90%', initialFrameHeight: 300, charset: "utf-8"});

//添加
$('#infosadd').click(function () {
    var url = $(this).attr('data-url');
    layer.open({
        type: 2,
        title: '添加新闻',
        shadeClose: true,
        shade: 0.8,
        area: ['65%', '80%'],
        content: url, //iframe的url
    })
})

//取消
$('.cancle').click(function () {
    parent.layer.closeAll();
});

//添加数据
$('.infos-add').click(function () {
    var urls = $(this).attr('data-url');

    var imgs = $('#Images').val();
    var pid = $("#pid option:selected").val();
    var title = $('#title').val();
    var describe = $("#describe").val();
    var keyword = $("#keyword").val();
    var seo_key = $("#seo_key").val();

    if (title == '' || title == undefined) {
        layer.msg('请填写新闻标题');
        return;
    }

    if (imgs == '' || imgs == undefined) {
        layer.msg('请上传图片');
        return false;
    }

    if (describe == '' || describe == undefined) {
        layer.msg('请填写新闻描述');
        return false;
    }

    if (keyword == '' || keyword == undefined) {
        layer.msg('请填写新闻关键字');
        return;
    }

    var content = ue.getContent();//取得html文本

    if (content == '' || content == undefined) {
        layer.msg('请填写新闻编辑内容');
        return false;
    }


    $.post(urls, {
        'title': title,
        'pid': pid,
        'describe': describe,
        'content': content,
        'keyword': JSON.stringify(keyword),
        'imgs': imgs
    }, function (ret) {
        if (ret.code == 200) {
            layer.msg(ret.msg, {icon: 6}, function () {
                parent.location.href = "index";
            })
        }

        if (ret.code == 400) {
            layer.msg(ret.msg, {icon: 5}, function () {
                parent.location.href = "index";
            })
        }
    }, 'json')
});

//编辑弹窗
$('.infos_edit').click(function () {
    var url = $(this).attr('data-url');
    layer.open({
        type: 2,
        title: '编辑新闻',
        shadeClose: true,
        shade: 0.8,
        area: ['60%', '85%'],
        content: url, //iframe的url
    })
});

//编辑提交
$('.infosedits').click(function () {
    var urls = $(this).attr('data-url');

    var pid = $("#pid option:selected").val();
    var title = $('#title').val();
    var id = $('#mid').val();
    var describe = $("#describe").val();
    var keyword = $("#keyword").val();
    var imgs = $('#Images').val();
    var seo_key = $("#seo_key").val();
    if (title == '' || title == undefined) {
        layer.msg('请填写新闻标题');
        return;
    }

    if (imgs == '' || imgs == undefined) {
        layer.msg('请上传图片');
        return false;
    }

    if (id == '' || id == undefined) {
        layer.msg('数据不合法');
        return;
    }

    if (describe == '' || describe == undefined) {
        layer.msg('请填写新闻描述');
        return false;
    }

    if (keyword == '' || keyword == undefined) {
        layer.msg('新闻关键字不能为空');
        return false;
    }

    if (seo_key == '' || seo_key == undefined) {
        $('#seo_key').focus();
        layer.msg('请输入新闻SEO关键字');
        return false;
    }

    var content = ue.getContent();//取得html文本

    if (content == '' || content == undefined) {
        layer.msg('请填写新闻编辑内容');
        return false;
    }
    var page = $(this).attr('page');
    var category = $(this).attr('category');
    var searchField = $(this).attr('searchField');
    var searchValue = $(this).attr('searchValue');
    $.post(urls, {
        'title': title,
        'pid': pid,
        'content': content,
        'id': id,
        'describe': describe,
        'seo_key': seo_key,
        'keyword': JSON.stringify(keyword),
        'imgs': imgs
    }, function (ret) {
        if (ret.code == 200) {
            layer.msg(ret.msg, {icon: 6}, function () {
                parent.location.href = "index?page=" + page + '&category=' + category + '&searchField=' + searchField + '&searchValue=' + searchValue;
            })
        }

        if (ret.code == 400) {
            layer.msg(ret.msg, {icon: 5})
        }
    }, 'json')
})

//删除
$('.infos_del').click(function () {

    var url = $(this).attr('data-url');

    layer.confirm('您确定要删除？', {
        btn: ['是的', '点错了'] //按钮
    }, function () {
        $.get(url, function (ret) {

            if (ret.code == 200) {
                layer.msg(ret.msg, {icon: 6}, function () {
                    parent.location.reload();
                })
            }

            if (ret.code == 400) {
                layer.msg(ret.msg, {icon: 5})
            }
        }, 'json')
    }, function () {
        parent.layer.closeAll();
    });

});


//上传图片
function upload_files() {
    var formData = new FormData();
    formData.append("file", $("#file")[0].files[0]);

    var urls = "uploadImgs";

    $.ajax({
        url: urls,
        type: "post",
        data: formData,
        async: false,
        dataType: 'json',
        cache: false,
        processData: false,
        contentType: false,
        success: function (ret) {
            if (ret.code == 200) {
                $("#imgs").attr('src', ret.path);
                $("#Images").val(ret.path);
                layer.msg(ret.msg, {icon: 6});
            } else {
                layer.msg(ret.msg);
            }
        },

    });
    return false;
}