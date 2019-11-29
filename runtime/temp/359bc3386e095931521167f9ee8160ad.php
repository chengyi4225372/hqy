<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"/opt/web/hui/public/../application/v1/view/login/changepass.html";i:1573715632;}*/ ?>
<!DOCTYPE >
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/static/assets/components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/static/assets/components/bootstrap-select/css/bootstrap-select.css">
    <link rel="stylesheet" type="text/css" href="/static/assets/plugins/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/static/assets/dist/css/admin.css">
    <script src="/static/assets/components/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="/static/assets/plugins/laydate-v5.0/laydate.js"></script>
    <script src="/static/assets/components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/static/assets/components/bootstrap-select/js/bootstrap-select.js"></script>
    <script src="/static/assets/plugins/layer/layer.js"></script>
    <script src="/static/assets/dist/js/style.js"></script>
    <title>修改用户密码</title>
</head>
<body>
<div class="dialog-content">
    <form class="form-horizontal">
        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <label class="col-sm-3 control-label">用户：</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="oldpassword" value="<?php echo $username; ?>" disabled="disabled">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">新密码：</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="password" name="password" value="">
                    </div>
                </div>
            </div>
        </div>
        <div class="dialog-footer" style="text-align:center;">
            <button class="btn btn-primary" id="pass_btn" type="button" data="" onclick="admin_module.change_password(this);" data-id="<?php echo $userid; ?>" data-url="<?php echo url('v1/login/changepass'); ?>"><i class="glyphicon glyphicon-ok"></i>确认</button>
            <button class="btn btn-danger" id="no_pass_btn" onclick="admin_module.cancel_btn()"  data="" data-url=""> <i class="glyphicon glyphicon-remove"></i>取消</button>
        </div>
    </form>
</div>
<script type="text/javascript">

    $(window).on('load', function () {
        $('#selectpicker').selectpicker('refresh');
        $('#selectpicker').selectpicker('render');
        $('#selectpicker').selectpicker({
            'selectedText': 'cat'
        });

    });

</script>
</body>
</html>