<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:69:"/opt/web/hui/public/../application/v1/view/info/infos/infos_edit.html";i:1574902032;s:51:"/opt/web/hui/application/v1/view/layout/dialog.html";i:1574902032;s:49:"/opt/web/hui/application/v1/view/common/meta.html";i:1574902032;s:51:"/opt/web/hui/application/v1/view/common/script.html";i:1574902032;}*/ ?>
<!DOCTYPE>
<html lang="<?php echo $config['language']; ?>">
<head>
    <!-- 加载样式及META信息 -->
    <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="/static/favicon.ico" />
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="/static/assets/components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="/static/assets/components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="/static/assets/components/Ionicons/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="/static/assets/dist/css/AdminLTE.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="/static/assets/dist/css/skins/_all-skins.min.css">
<!-- Date Picker -->
<link rel="stylesheet" href="/static/assets/components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="/static/assets/components/bootstrap-daterangepicker/daterangepicker.css">
<!--bootstrap-select-->
<link rel="stylesheet" href="/static/assets/components/bootstrap-select/css/bootstrap-select.css">
<!--jstree-->
<link rel="stylesheet" href="/static/assets/components/jstree/themes/default/style.min.css"/>
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="/static/assets/plugins/iCheck/all.css">
<!--layui-->
<link rel="stylesheet" href="/static/assets/plugins/layui/css/layui.css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- Font -->
<link rel="stylesheet" href="/static/assets/dist/css/fontcss.css">
<link rel="stylesheet" href="/static/assets/dist/css/style.css">
<link rel="stylesheet" href="/static/assets/plugins/datatables/dataTables.bootstrap.css">
<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/static/assets/dist/js/html5shiv.js"></script>
  <script src="/static/assets/dist/js/respond.min.js"></script>
<![endif]-->
    
    <!-- 用来添加自定义的 样式 -->
    
</head>
<body class="hold-transition skin-purple-light sidebar-mini">
<div class="container-fluid">
    
<style>
    .dialog-content{margin:20px;}
    .dialog-footer{right:39%;top:82%;margin-left:30%; }
    .red-color{color:red;}
    /* 修改原有下拉框*/
    .bootstrap-select .btn {max-width: 550px;}
    .bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {width: 550px;}
</style>
<div class="dialog-content">
    <form class="form-horizontal dialog-form" id="form">
        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <label for="status" class="col-sm-3 control-label">分类列表：</label>
                    <div class="col-sm-9">
                        <select id="pid"  class="form-control form-control-sm">
                            <option value="1" <?php if($info['pid'] == '1'): ?> selected=""<?php endif; ?>>招标信息</option>
                            <option value="2" <?php if($info['pid'] == '2'): ?> selected=""<?php endif; ?>>招商信息</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="images" class="col-sm-3 control-label"><span class="red-color">*</span>新闻展示图：</label>
                    <div class="col-sm-9">
                        <input type="file"  onchange="upload_files()" style="display:none;" class="form-control form-control-sm" id="file">
                        <img id="imgs" src="<?php echo (isset($info['imgs']) && ($info['imgs'] !== '')?$info['imgs']:'/static/default.png'); ?>" style="width:90px;height:80px;">
                        <input type="hidden" id="Images" value="<?php echo $info['imgs']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">
                        <span class="red-color">*</span>新闻标题：</label>
                    <div class="col-sm-9">
                        <input type="text" value="<?php echo $info['title']; ?>"  class="form-control form-control-sm" id="title">
                    </div>
                </div>

                <div class="form-group">
                    <label for="keyword" class="col-sm-3 control-label">新闻关键字列表：</label>
                    <div class="col-sm-9" >
                        <select id="keyword" class="selectpicker" multiple  title="<?php echo $info['keyword']; ?>">
                            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$co): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $co['title']; ?>" data-width="100%" <?php if(in_array($co['title'],$keywords)): ?> selected="selected" <?php endif; ?>><?php echo $co['title']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">
                        <span class="red-color">*</span>新闻重点描述：</label>
                    <div class="col-sm-9">
                        <textarea  id="describe" class="form-control form-control-sm"  rows="5" ><?php echo $info['describe']; ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="content" class="col-sm-3 control-label">新闻详情：</label>
                    <div class="col-sm-9">
                        <script id="content" name="content" type="text/plain"><?php echo $info['content']; ?></script>
                    </div>
                </div>
                <input type="hidden" id="mid" value="<?php echo $info['id']; ?>">
            </div>

        </div>
        <div class="td-align dialog-footer">
            <button class="btn btn-warning cancle"> <i class="fa fa-close"></i> 取消</button>
            <button class="btn btn-primary infosedits" type="button"  data-url="<?php echo url('/v1/info/infos/infosEdit'); ?>"><i class="fa fa-save"></i> 确定提交</button>

        </div>
    </form>
</div>

</div>

<!-- 加载JS脚本 -->
<!-- jQuery 3 -->
<script src="/static/assets/components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap 3.3.7 -->
<script src="/static/assets/components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- daterangepicker -->
<script src="/static/assets/components/moment/min/moment.min.js"></script>
<script src="/static/assets/components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/static/assets/components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!--bootstrap-select-->
<script src="/static/assets/components/bootstrap-select/js/bootstrap-select.js"></script>
<!--jstree-->
<script src="/static/assets/components/jstree/jstree.min.js"></script>
<!-- ValidateForm -->
<script src="/static/assets/components/nice-validator/dist/jquery.validator.min.js?local=zh-CN"></script>
<!-- Slimscroll -->
<script src="/static/assets/components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- Scrolltofixed -->
<script src="/static/assets/components/scrolltofixed/jquery-scrolltofixed-min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="/static/assets/plugins/iCheck/icheck.min.js"></script>
<!-- AdminLTE App -->
<script src="/static/assets/dist/js/adminlte.min.js"></script>
<script src="/static/assets/plugins/layui/layui.all.js"></script>
<script src="/static/assets/plugins/laydate-v5.0/laydate.js"></script>
<script src="/static/assets/plugins/lazyload.js"></script>
<!-- datatables -->
<script src="/static/assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="/static/assets/plugins/datatables/dataTables.bootstrap.js"></script>
<!-- 富文本 -->
<script src="/static/assets/plugins/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/static/assets/plugins/ueditor/ueditor.all.js"> </script>
<script type="text/javascript" charset="utf-8" src="/static/assets/plugins/ueditor/lang/zh-cn/zh-cn.js"></script>
<!-- 富文本-->

<script src="/static/assets/dist/js/default.js"></script>
<script src="/static/assets/dist/js/app.js"></script>
<script src="/static/assets/dist/js/style.js"></script>

<script src="/static/assets/dist/js/protuct.js"></script>
<script src="/static/assets/dist/js/infos.js"></script>
<script src="/static/assets/dist/js/partners.js"></script>
<script src="/static/assets/dist/js/works.js"></script>
<!-- 标签 -->
<script src="/static/assets/dist/js/ification.js"></script>



<script>
    admin_module.changepas();
</script>
<!--<script src="/static/assets/dist/js/common.js"></script>-->




</body>
</html>