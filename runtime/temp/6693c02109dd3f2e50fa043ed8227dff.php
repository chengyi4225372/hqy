<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"C:\phpEnv\www\hqy_\public/../application/home\view\searches\index.html";i:1576745275;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>惠找事</title>
    <link rel="stylesheet" href="/static/spirit/css/base.css">
    <link rel="stylesheet" href="/static/spirit/css/optimal.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</head>

<body style="background: #fff;">

<div>
    <div class="fourzerofour">
        <img src="/static/hzs_error.png">
    </div>
    <div class="building">
        正在建设中...
    </div>
    <div class="goHome">

        <span><i class="clock">3</i>秒后返回主站</span>
        <a href="<?php echo url('/home/index/index'); ?>">点击跳转</a>

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

    })
</script>

</html>