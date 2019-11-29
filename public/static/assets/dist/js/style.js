var admin_module = (function (){
    var changepas = function changepas(){
        $(document).on('click','#changepass',function (){
            var url = $(this).attr('href');
            layer.open({
                type: 2,
                title: "修改用户密码",
                maxmin: false,
                shadeClose: true, //点击遮罩关闭层
                scrollbar: false,
                area: ['600px', '450px'],
                content: url,
            });
        });
    };
    var change_password = function change_password(objthis){
        var uid = $(objthis).attr('data-id');
        var password = $('input[name=password]').val();
        var url = $(objthis).attr('data-url');
        $.post(
            url,
            {password:password,uid:uid},
            function (ret){
                if(ret.code != 0){
                    layer.msg(ret.msg,{icon:1,time:1500},function (){
                        parent.location.reload();
                    });
                }else{
                    layer.msg(ret.msg,{icon:2,time:1500});
                }
            },'json'
        );
    };
    //退出登录
    var logout_btn = function logout_btn(objthis){
        layer.confirm('确定要退出登录?', function(index){
            var url = $(objthis).attr('data-url');
            $.post(
                url,
                "",
                function (ret){
                    if(ret.code != 0){
                        layer.msg(ret.msg,{icon:1,time:1500},function (){
                            layer.close(index);
                            parent.location.reload();
                        });
                    }else{
                        layer.msg(ret.msg,{icon:2,time:1500});
                    }
                },'json'
            );
        });
    };
    //添加菜单
    var add_menu = function add_menu(objthis){
        var url = $(objthis).attr('data-url');
        layer.open({
            type: 2,
            title: "添加菜单",
            maxmin: false,
            shadeClose: true, //点击遮罩关闭层
            scrollbar: false,
            area: ['70%', '60%'],
            content: url,
        });
    };
    //去图标库查看图标
    var show_icon = function show_icon(){
        window.open("http://adminlte.la998.com/pages/UI/icons.html");
    };
    //保存菜单
    var save_menu = function save_menu(objthis){
        var url = $(objthis).attr('data-url');
        var form_value = $('#form').serialize();
        $.post(
            url,
            {data:form_value},
            function (ret){
                if(ret.status == true){
                    layer.msg(ret.msg,{icon:1,time:1500},function (){
                        parent.layer.close();
                        parent.location.reload();
                    });
                }else{

                }
            },'json'
        );
    };
    //组织架构新增成员
    var add_org = function add_org(thisobj){
        var url = $(thisobj).attr('data-url');
        layer.open({
            type: 2,
            title: "添加部门",
            maxmin: false,
            shadeClose: true, //点击遮罩关闭层
            scrollbar: false,
            area: ['70%', '60%'],
            content: url,
        });
    };
    //修改组织架构的提交按钮
    var save_btn = function save_btn(objthis){
        var url = $(objthis).attr('data-url');
        var is_add = $(objthis).attr('is-add');
        var pid = $('#pid').val();
        if(pid == '' || pid == undefined || pid == 'undefined'){
            layer.msg('父级部门必填');return;
        }
        if(title == '' || title == undefined || title == 'undefined'){
            layer.msg('部门名称必填');return;
        }
        if(manage_uid == '' || manage_uid == undefined || manage_uid == 'undefined'){
            layer.msg('负责人必填');return;
        }
        $.post(
            url,
            {data:$('#form').serialize()},
            function (ret){
                if(ret.status == true){
                    layer.msg(ret.msg,{icon:1,time:1500},function (){
                        parent.layer.close();
                        parent.location.reload();
                    });
                }else{
                    layer.msg(ret.msg);
                }

            },'json'
        );
    };

    //编辑成员
    var edit_org = function edit_org(objthis){
        var url = $(objthis).attr('data-url');
        var id = $(objthis).attr('data-id');
        url = url+'?id='+id;
        layer.open({
            type: 2,
            title: "修改部门",
            maxmin: false,
            shadeClose: true, //点击遮罩关闭层
            scrollbar: false,
            area: ['70%', '60%'],
            content: url,
        });
    }

    //添加用户
    $(document).on('click','#addusers',function (){
        var url = $(this).attr('data-url');
        layer.open({
            type: 2,
            title: "添加用户",
            maxmin: false,
            shadeClose: true, //点击遮罩关闭层
            scrollbar: false,
            area: ['700px', '450px'],
            content: url,
        });
    });
    //添加用户确认提交
    var user_add = function user_add(objthis)
    {
        var url = $(objthis).attr('data-url');
        var username = $('#username').val();
        var password = $('#password').val();
        var tel = $('#tel').val();
        var mail = $('#mail').val();
        if(username == undefined || username == 'undefined' || username == ''){
            $('#username').focus();
            layer.tips('用户名不能为空!','#username',{tips:[1,'#c00']});
            return;
        }
        if(password == undefined || password == 'undefined' || password == ''){
            $('#password').focus();
            layer.tips('密码不能为空!','#password',{tips:[1,'#c00']});
            return;
        }
        if(tel == undefined || tel == 'undefined' || tel == ''){
            $('#tel').focus();
            layer.tips('电话不能为空!','#tel',{tips:[1,'#c00']});
            return;
        }
        if(mail == undefined || mail == 'undefined' || mail == ''){
            $('#mail').focus();
            layer.tips('邮箱不能为空!','#mail',{tips:[1,'#c00']});
            return;
        }
        var obj = new Object();
        obj.username = username;
        obj.password = password;
        obj.tel = tel;
        obj.mail = mail;
        $.post(
            url,
            obj,
            function (ret){
                if(ret.status == true){
                    layer.msg(ret.msg,{icon:1,time:1500},function (){
                        parent.layer.close();
                        parent.location.reload();
                    });
                }else{
                    layer.msg(ret.msg);
                }
            },'json'
        );
    };

    //编辑用户
    var user_edit = function user_edit(objthis){
        var url = $(objthis).attr('data-url');
        layer.open({
            type: 2,
            title: "编辑用户",
            maxmin: false,
            shadeClose: true, //点击遮罩关闭层
            scrollbar: false,
            area: ['700px', '450px'],
            content: url,
        });
    };
    //确认用户编辑
    var edit_users = function edit_users(objthis){
        var url = $(objthis).attr('data-url');
        var username = $('#username').val();
        var password = $('#password').val();
        var tel = $('#tel').val();
        var mail = $('#mail').val();
        var id = $('#userid').val();
        if(username == undefined || username == 'undefined' || username == ''){
            $('#username').focus();
            layer.tips('用户名不能为空!','#username',{tips:[1,'#c00']});
            return;
        }

        if(tel == undefined || tel == 'undefined' || tel == ''){
            $('#tel').focus();
            layer.tips('电话不能为空!','#tel',{tips:[1,'#c00']});
            return;
        }
        if(mail == undefined || mail == 'undefined' || mail == ''){
            $('#mail').focus();
            layer.tips('邮箱不能为空!','#mail',{tips:[1,'#c00']});
            return;
        }
        var obj = new Object();
        obj.username = username;
        obj.tel = tel;
        obj.mail = mail;
        obj.id = id;
        $.post(
            url,
            obj,
            function (ret){
                if(ret.status == true){
                    layer.msg(ret.msg,{icon:1,time:1500},function (){
                        parent.layer.close();
                        parent.location.reload();
                    });
                }else{
                    layer.msg(ret.msg);
                }
            },'json'
        );
    };

    //添加网站设置

    $(document).on('click','#addsitesetting',function(){
        var url = $(this).attr('data-url');
        layer.open({
            type: 2,
            title: "网站设置",
            maxmin: false,
            shadeClose: true, //点击遮罩关闭层
            scrollbar: false,
            area: ['700px', '450px'],
            content: url,
        });
    });

    //网站设置提交
    var setting_add = function setting_add(objthis){
        var url = $(objthis).attr('data-url');
        var title = $('#title').val();
        var icp = $('#icp').val();
        var count_code = $('#count_code').val();
        var tel = $('#tel').val();
        var status = $('#status').val();
        var mail = $('#mail').val();
        //网站名称不能为空
        if(title == undefined || title == 'undefined' || title == ''){
            $('#title').focus();
            layer.tips('网站名称不能为空!','#title',{tips:[1,'#c00']});return;
        }
        //icp不能为空
        if(icp == undefined || icp == 'undefined' || icp == ''){
            $('#icp').focus();
            layer.tips('ICP备案号!','#icp',{tips:[1,'#c00']});return;
        }
        //统计代码不能为空
        if(count_code == undefined || count_code == 'undefined' || count_code == ''){
            $('#count_code').focus();
            layer.tips('统计代码不能为空!','#count_code',{tips:[1,'#c00']});return;
        }

        //固定电话不能为空
        if(tel == undefined || tel == 'undefined' || tel == ''){
            $('#tel').focus();
            layer.tips('固定电话不能为空!','#tel',{tips:[1,'#c00']});return;
        }
        if(mail == undefined || mail == 'undefined' || mail == ''){
            $('#mail').focus();
            layer.tips('邮箱不能为空!','#mail',{tips:[1,'#c00']});return;
        }

        var obj = new Object();
        obj.title = title;
        obj.icp = icp;
        obj.count_code = count_code;
        obj.tel = tel;
        obj.status = status;
        obj.mail = mail;
        $.post(
            url,
            obj,
            function (ret){
                if(ret.status == true){
                    layer.msg(ret.msg,{icon:1,time:1500},function (){
                        parent.layer.close();
                        parent.location.reload();
                    });
                }else{
                    layer.msg(ret.msg);
                }
            },'json'
        );

    }


    //编辑网站设置
    var edit_setting = function edit_setting(objthis){
        var url = $(objthis).attr('data-url');
        layer.open({
            type: 2,
            title: "修改网站设置",
            maxmin: false,
            shadeClose: true, //点击遮罩关闭层
            scrollbar: false,
            area: ['70%', '60%'],
            content: url,
        });
    };
    //编辑网站设置提交
    var  setting_edit = function setting_edit(objthis){
        var url = $(objthis).attr('data-url');
        var title = $('#title').val();
        var icp = $('#icp').val();
        var count_code = $('#count_code').val();
        var tel = $('#tel').val();
        var status = $('#status').val();
        var mail = $('#mail').val();
        //网站名称不能为空
        if(title == undefined || title == 'undefined' || title == ''){
            $('#title').focus();
            layer.tips('网站名称不能为空!','#title',{tips:[1,'#c00']});return;
        }
        //icp不能为空
        if(icp == undefined || icp == 'undefined' || icp == ''){
            $('#icp').focus();
            layer.tips('ICP备案号!','#icp',{tips:[1,'#c00']});return;
        }
        //统计代码不能为空
        if(count_code == undefined || count_code == 'undefined' || count_code == ''){
            $('#count_code').focus();
            layer.tips('统计代码不能为空!','#count_code',{tips:[1,'#c00']});return;
        }

        //固定电话不能为空
        if(tel == undefined || tel == 'undefined' || tel == ''){
            $('#tel').focus();
            layer.tips('固定电话不能为空!','#tel',{tips:[1,'#c00']});return;
        }

        if(mail == undefined || mail == 'undefined' || mail == ''){
            $('#mail').focus();
            layer.tips('邮箱不能为空!','#mail',{tips:[1,'#c00']});return;
        }
        var id = $('#site_id').val();
        var obj = new Object();
        obj.title = title;
        obj.icp = icp;
        obj.count_code = count_code;
        obj.tel = tel;
        obj.status = status;
        obj.id = id;
        obj.mail = mail;
        $.post(
            url,
            obj,
            function (ret){
                if(ret.status == true){
                    layer.msg(ret.msg,{icon:1,time:1500},function (){
                        parent.layer.close();
                        parent.location.reload();
                    });
                }else{
                    layer.msg(ret.msg);
                }
            },'json'
        );
    };

    //取消
    var cancel_btn = function  cancel_btn(){
        parent.layer.closeAll();
    };
    var check_out = function check_out(objthis){
        $('.data-check_box').prop("checked",objthis.checked);
    };

    var init_submit_form = function init_submit_form(){
        $('#form').submit(function (e){
            var data = $(this).serializeArray();
            var arr = [];
            var tmp = [];
            for (d in data) {
                var _data = data[d];
                if ($.trim(_data['value'])) {

                    if (_data['name'].endsWith('[]')) {
                        var tmp_str = _data['name'].substr(0, _data['name'].length - 2);
                        if (!tmp[tmp_str]) tmp[tmp_str] = [];
                        tmp[tmp_str].push(_data['value']);
                    }
                    else {
                        arr.push(_data['name'] + '=' + _data['value']);
                    }
                }
            }
            var search_str = '';
            if (tmp) {
                for (d in tmp) {
                    arr.push(d + '=' + tmp[d].join(','));
                }
            }
            if (arr) search_str += arr.join('&')

            var url = new URL(location.href);
            var new_url = url.origin + url.pathname + '?' + arr.join('&');
            window.location = new_url;
            e.preventDefault();
        });
    }
    var btn_search = function btn_search(){
        $(document).keypress(function (e){
            if(e.keyCode == 13){
                $('#btn_search').click();
            }
        });
    };

    //添加轮播图
    $(document).on('click','#addslideshow',function (){
        var url = $(this).attr('data-url');
        layer.open({
            type: 2,
            title: "添加轮播图",
            maxmin: false,
            shadeClose: true, //点击遮罩关闭层
            scrollbar: false,
            area: ['70%', '60%'],
            content: url,
        });
    });

    //确认添加轮播图
    var add_slideshow = function add_slideshow(objthis){
        var url = $(objthis).attr('data-url');
        var pic = $('#pic_curr').val();
        var title = $('#title').val();
        var desc = $('#desc').val();
        var urls = $('#url').val();
        var status = $('#status').val();
        if(pic == undefined || pic == 'undefined' || pic == ''){
            layer.msg('请选择要上传的图片');return;
            //layer.tips('请选择要上传的图片!','#pic',{tips:[1,'#c00']});
        }
        var obj = new Object();
        obj.pic = pic;
        obj.title = title;
        obj.desc = desc;
        obj.url = urls;
        obj.status = status;
        $.post(
            url,
            obj,
            function (ret){
                if(ret.status == true){
                    layer.msg(ret.msg,{icon:1,time:1500},function (){
                        parent.layer.close();
                        parent.location.reload();
                    });
                }else{
                    layer.msg(ret.msg);
                }
            },'json'
        );
    };

    //编辑轮播图的弹窗
    var edit_slideshow = function edit_slideshow(objthis){
        var url = $(objthis).attr('data-url');
        layer.open({
            type: 2,
            title: "编辑轮播图",
            maxmin: false,
            shadeClose: true, //点击遮罩关闭层
            scrollbar: false,
            area: ['70%', '60%'],
            content: url,
        });
    };
    //确认编辑轮播图
    var slideshow_edit = function slideshow_edit(objthis){
        var url = $(objthis).attr('data-url');
        var pic = $('#pic_curr').val();
        var title = $('#title').val();
        var desc = $('#desc').val();
        var urls = $('#url').val();
        var status = $('#status').val();
        var id = $('#site_id').val();
        if(pic == undefined || pic == 'undefined' || pic == ''){
            layer.msg('请选择要上传的图片');return;
            //layer.tips('请选择要上传的图片!','#pic',{tips:[1,'#c00']});
        }
        var obj = new Object();
        obj.pic = pic;
        obj.title = title;
        obj.desc = desc;
        obj.url = urls;
        obj.status = status;
        obj.id = id;
        $.post(
            url,
            obj,
            function (ret){
                if(ret.status == true){
                    layer.msg(ret.msg,{icon:1,time:1500},function (){
                        parent.layer.close();
                        parent.location.reload();
                    });
                }else{
                    layer.msg(ret.msg);
                }
            },'json'
        );
    };

    //图片上传
    $(function (){
        layui.use('upload', function(){
            var upload = layui.upload;
            var is_nginx = $('#pic').attr('is_nginx');
            //var img_url = '';
            //if(is_nginx != '' || is_nginx != 'undefined' || is_nginx != undefined){
            //    img_url = is_nginx;
            //}
            //执行实例
            var img_url = $('#pic').attr('data-url');
            var uploadInst = upload.render({
                elem: '#pic' //绑定元素
                ,url: img_url //上传接口
                ,done: function(ret){
                    if(ret.status){
                        $('#cur_pic').attr('src',ret['data']['src']);
                        $('#pic_curr').val(ret['data']['src']);
                    }else{
                        layer.msg(ret.msg, {
                            icon: 2,
                            time: 1000 //2秒关闭（如果不配置，默认是3秒）
                        })
                    }

                }
                ,accept: 'images'
            });
        });
    });

    //图片上传
    $(function (){
        layui.use('upload', function(){
            var upload = layui.upload;
            var is_nginx = $('#pic').attr('is_nginx');
            var img_url = '';
            if(is_nginx != '' || is_nginx != 'undefined' || is_nginx != undefined){
                img_url = is_nginx;
            }
            //执行实例
            var uploadInst = upload.render({
                elem: '#pic2' //绑定元素
                ,url: img_url + '/v1/systematic/system/uploadimg' //上传接口
                ,done: function(ret){
                    if(ret.status){
                        $('#cur_pic2').attr('src',ret['data']['src']);
                        $('#pic_curr2').val(ret['data']['src']);
                    }else{
                        layer.msg(ret.msg, {
                            icon: 2,
                            time: 1000 //2秒关闭（如果不配置，默认是3秒）
                        })
                    }

                }
                ,accept: 'images'
            });
        });
    });

    //添加主案例的弹窗
    $(document).on('click','#addcase',function (){
        var url = $(this).attr('data-url');
        layer.open({
            type: 2,
            title: "添加案例",
            maxmin: false,
            shadeClose: true, //点击遮罩关闭层
            scrollbar: false,
            area: ['70%', '60%'],
            content: url,
        });
    });
    var add_case = function add_case(objthis){
        var urls = $(objthis).attr('data-url');
        var title = $('#title').val();
        var title2 = $('#title2').val();
        var title3 = $('#title3').val();
        var pic = $('#pic_curr').val();
        var pic2 = $('#pic_curr2').val();
        var url = $('#url').val();
        var desc = $('#desc').val();
        var desc2 = $('#desc2').val();
        var desc3 = $('#desc3').val();
        var desc4 = $('#desc4').val();
        var desc5 = $('#desc5').val();
        var desc6     = $('#desc6 ').val();
        var desc7 = $('#desc7').val();
        var status = $('#status').val();
        var is_show = $('#is_show').val();
        //数据校验
        if(title == '' || title == undefined || title == 'undefined'){
            $('#title').focus();
            layer.tips('标题不能为空!','#title',{tips:[1,'#c00']});return;
        }
        if(is_show == '' || is_show == undefined || is_show == 'undefined'){
            $('#is_show').focus();
            layer.tips('请填写样式名称!','#is_show',{tips:[1,'#c00']});return;
        }
        if(title2 == '' || title2 == undefined || title2 == 'undefined'){
            $('#title2').focus();
            layer.tips('标题2不能为空!','#title2',{tips:[1,'#c00']});return;
        }
        if(title3 == '' || title3 == undefined || title3 == 'undefined'){
            $('#title3').focus();
            layer.tips('标题不能为空!','#title3',{tips:[1,'#c00']});return;
        }
        if(pic == '' || pic == undefined || pic == 'undefined'){
            layer.msg('请选择要上传的图片1');return;
        }
        if(pic2 == '' || pic2 == undefined || pic2 == 'undefined'){
            layer.msg('请选择要上传的图片2');return;
        }
        if(url == '' || url == undefined || url == 'undefined'){
            $('#url').focus();
            layer.tips('请填写URL!','#url',{tips:[1,'#c00']});return;
        }
        if(desc == '' || desc == undefined || desc == 'undefined'){
            $('#desc').focus();
            layer.tips('描述不能为空!','#desc',{tips:[1,'#c00']});return;
        }
        if(desc2 == '' || desc2 == undefined || desc2 == 'undefined'){
            $('#desc2').focus();
            layer.tips('描述2不能为空!','#desc2',{tips:[1,'#c00']});return;
        }
        if(desc3 == '' || desc3 == undefined || desc3 == 'undefined'){
            $('#desc3').focus();
            layer.tips('描述3不能为空弄!','#desc3',{tips:[1,'#c00']});return;
        }
        if(desc4 == '' || desc4 == undefined || desc4 == 'undefined'){
            $('#desc4').focus();
            layer.tips('描述4不能为空!','#desc4',{tips:[1,'#c00']});return;
        }
        if(desc5 == '' || desc5 == undefined || desc5 == 'undefined'){
            $('#desc5').focus();
            layer.tips('描述5不能为空!','#desc5',{tips:[1,'#c00']});return;
        }
        if(desc6 == '' || desc6 == undefined || desc6 == 'undefined'){
            $('#desc6').focus();
            layer.tips('描述6不能为空!','#desc6',{tips:[1,'#c00']});return;
        }
        if(desc7 == '' || desc7 == undefined || desc7 == 'undefined'){
            $('#desc7').focus();
            layer.tips('描述7不能为空!','#desc7',{tips:[1,'#c00']});return;
        }
        if(status == '' || status == undefined || status == 'undefined'){
            layer.msg('请选择状态');return;
        }
        var obj = new Object();
        obj.title = title;
        obj.title2 = title2;
        obj.title3 = title3;
        obj.pic = pic;
        obj.pic2 = pic2;
        obj.url = url;
        obj.desc = desc;
        obj.desc2 = desc2;
        obj.desc3 = desc3;
        obj.desc4 = desc4;
        obj.desc5 = desc5;
        obj.desc6 = desc6;
        obj.desc7 = desc7;
        obj.status = status;
        obj.is_show = is_show;

        $.post(
            urls,
            obj,
            function (ret){
                if(ret.status == true){
                    layer.msg(ret.msg,{icon:1,time:1500},function (){
                        parent.layer.close();
                        parent.location.reload();
                    });
                }else{
                    layer.msg(ret.msg);
                }
            },'json'
        );
    };
    //编辑主案例弹窗
    var edit_case = function edit_case(objthis){
        var url = $(objthis).attr('data-url');
        layer.open({
            type: 2,
            title: "编辑案例",
            maxmin: false,
            shadeClose: true, //点击遮罩关闭层
            scrollbar: false,
            area: ['70%', '60%'],
            content: url,
        });
    };

    //主案例确认提交
    var case_edit = function case_edit(objthis){
        var urls = $(objthis).attr('data-url');
        var title = $('#title').val();
        var title2 = $('#title2').val();
        var title3 = $('#title3').val();
        var pic = $('#pic_curr').val();
        var pic2 = $('#pic_curr2').val();
        var url = $('#url').val();
        var desc = $('#desc').val();
        var desc2 = $('#desc2').val();
        var desc3 = $('#desc3').val();
        var desc4 = $('#desc4').val();
        var desc5 = $('#desc5').val();
        var desc6     = $('#desc6 ').val();
        var desc7 = $('#desc7').val();
        var status = $('#status').val();
        var is_show = $('#is_show').val();
        var case_id = $('#case_id').val();
        //数据校验
        if(title == '' || title == undefined || title == 'undefined'){
            $('#title').focus();
            layer.tips('标题不能为空!','#title',{tips:[1,'#c00']});return;
        }
        if(is_show == '' || is_show == undefined || is_show == 'undefined'){
            $('#is_show').focus();
            layer.tips('请填写样式名称!','#is_show',{tips:[1,'#c00']});return;
        }
        if(title2 == '' || title2 == undefined || title2 == 'undefined'){
            $('#title2').focus();
            layer.tips('标题2不能为空!','#title2',{tips:[1,'#c00']});return;
        }
        if(title3 == '' || title3 == undefined || title3 == 'undefined'){
            $('#title3').focus();
            layer.tips('标题不能为空!','#title3',{tips:[1,'#c00']});return;
        }
        if(pic == '' || pic == undefined || pic == 'undefined'){
            layer.msg('请选择要上传的图片');return;
        }

        if(pic2 == '' || pic2 == undefined || pic2 == 'undefined'){
            layer.msg('请选择要上传的图片');return;
        }

        if(url == '' || url == undefined || url == 'undefined'){
            $('#url').focus();
            layer.tips('请填写URL!','#url',{tips:[1,'#c00']});return;
        }
        if(desc == '' || desc == undefined || desc == 'undefined'){
            $('#desc').focus();
            layer.tips('描述不能为空!','#desc',{tips:[1,'#c00']});return;
        }
        if(desc2 == '' || desc2 == undefined || desc2 == 'undefined'){
            $('#desc2').focus();
            layer.tips('描述2不能为空!','#desc2',{tips:[1,'#c00']});return;
        }
        if(desc3 == '' || desc3 == undefined || desc3 == 'undefined'){
            $('#desc3').focus();
            layer.tips('描述3不能为空弄!','#desc3',{tips:[1,'#c00']});return;
        }
        if(desc4 == '' || desc4 == undefined || desc4 == 'undefined'){
            $('#desc4').focus();
            layer.tips('描述4不能为空!','#desc4',{tips:[1,'#c00']});return;
        }
        if(desc5 == '' || desc5 == undefined || desc5 == 'undefined'){
            $('#desc5').focus();
            layer.tips('描述5不能为空!','#desc5',{tips:[1,'#c00']});return;
        }
        if(desc6 == '' || desc6 == undefined || desc6 == 'undefined'){
            $('#desc6').focus();
            layer.tips('描述6不能为空!','#desc6',{tips:[1,'#c00']});return;
        }
        if(desc7 == '' || desc7 == undefined || desc7 == 'undefined'){
            $('#desc7').focus();
            layer.tips('描述7不能为空!','#desc7',{tips:[1,'#c00']});return;
        }
        if(status == '' || status == undefined || status == 'undefined'){
            layer.msg('请选择状态');return;
        }

        var obj = new Object();
        obj.title = title;
        obj.title2 = title2;
        obj.title3 = title3;
        obj.pic = pic;
        obj.pic2 = pic2;
        obj.url = url;
        obj.desc = desc;
        obj.desc2 = desc2;
        obj.desc3 = desc3;
        obj.desc4 = desc4;
        obj.desc5 = desc5;
        obj.desc6 = desc6;
        obj.desc7 = desc7;
        obj.status = status;
        obj.is_show = is_show;
        obj.case_id = case_id;

        $.post(
            urls,
            obj,
            function (ret){
                if(ret.status == true){
                    layer.msg(ret.msg,{icon:1,time:1500},function (){
                        parent.layer.close();
                        parent.location.reload();
                    });
                }else{
                    layer.msg(ret.msg);
                }
            },'json'
        );
    };

    return {
        changepas: changepas,
        change_password: change_password,
        cancel_btn: cancel_btn,
        logout_btn: logout_btn,
        add_menu: add_menu,
        show_icon: show_icon,
        save_menu: save_menu,
        add_org: add_org,
        save_btn: save_btn,
        edit_setting: edit_setting,
        check_out: check_out,
        //submit_search:submit_search,
        init_submit_form: init_submit_form,
        btn_search: btn_search,
        setting_add: setting_add,
        user_add: user_add,
        user_edit: user_edit,
        edit_users: edit_users,
        setting_edit: setting_edit,
        add_slideshow: add_slideshow,
        edit_slideshow:edit_slideshow,
        slideshow_edit:slideshow_edit,
        add_case:add_case,
        edit_case:edit_case,
        case_edit:case_edit,
    }

})();


