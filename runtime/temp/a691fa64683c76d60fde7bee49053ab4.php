<<<<<<< HEAD
<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"C:\phpEnv\www\hqy_\public/../application/home\view\many\index.html";i:1576727827;}*/ ?>
=======
<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"C:\phpEnv\www\hqy_\public/../application/home\view\many\index.html";i:1576577274;}*/ ?>
>>>>>>> ebe57fda5c5dc94df04396e6c11ae2583881eb3f
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
    <title>惠多薪</title>
=======
    <title>招募合伙人</title>
>>>>>>> ebe57fda5c5dc94df04396e6c11ae2583881eb3f
    <link rel="stylesheet" href="/static/spirit/css/base.css">
    <link rel="stylesheet" href="/static/spirit/css/optimal.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</head>

<<<<<<< HEAD
<body style="background: #fff;">
=======
<body>
>>>>>>> ebe57fda5c5dc94df04396e6c11ae2583881eb3f


<div>
    <div class="fourzerofour">
<<<<<<< HEAD
        <img src="/static/hdx_error2.png">
=======
        <img src="/static/hdx_error.png">
>>>>>>> ebe57fda5c5dc94df04396e6c11ae2583881eb3f
    </div>
    <div class="building">
        正在建设中...
    </div>
    <div class="goHome">
<<<<<<< HEAD
        <span><i class="clock">3</i>秒后返回主站</span>
        <a href="<?php echo url('/home/index/index'); ?>">点击跳转</a>
=======
        <span><i class="clock">3</i>秒后返回首页</span>
        <a href="<?php echo url('/home/index/index'); ?>">回到首页</a>
>>>>>>> ebe57fda5c5dc94df04396e6c11ae2583881eb3f
    </div>
</div>
</div>
</body>
<script>
    $(function () {
        var count = 3;
        var timer = setInterval(function () {
            $('.clock').html(count);
            count--;
            if (count < 0) {
                clearInterval(timer)
                location.href="<?php echo url('/home/index/index'); ?>"
            }
        }, 1000)
<<<<<<< HEAD
=======

>>>>>>> ebe57fda5c5dc94df04396e6c11ae2583881eb3f
    })
</script>

</html>