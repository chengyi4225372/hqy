<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"C:\phpEnv\www\hqy_\public/../application/home\view\optimal\index.html";i:1575539978;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>招募合伙人</title>
    <link rel="stylesheet" href="/static/spirit/css/base.css">
    <link rel="stylesheet" href="/static/spirit/css/optimal.css">
    <script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
</head>

<body>
    <div class='container'>

        <!-- 导航部分 -->
        <div class='header'>
            <div class=header_content>
                <div class='logo'>
                    <a href="<?php echo url('/home/index/index'); ?>"></a>
                </div>
                <ul class='titile'>
                    <li><a href="<?php echo url('/home/index/index'); ?>">首页</a></li>
                    <li class='nav-active'><a href="<?php echo url('/home/optimal/index'); ?>">招募合伙人</a>
                    </li>
                    <li>
                        <a href="javascript:;">“惠”家族产品</a>
                        <!-- 二级菜单 -->
                        <div class="w secondary-menu" id="secondary-menu">
                            <div>
                                <dl>
                                    <dt><a href="<?php echo config('curl.hys'); ?>">惠优税</a></dt>
                                    <dd>
                                        ·企税降成本 薪税降税负

                                    </dd>
                                    <dd>·分红降扣率 创业降个税</dd>
                                </dl>
                                <dl>
                                    <dt><a href="<?php echo config('curl.hlg'); ?>">惠灵工</a></dt>
                                    <dd>
                                        ·寻求多样化用工模式

                                    </dd>
                                    <dd>·提高内部人员效能</dd>
                                </dl>
                                <dl>
                                    <dt><a href="<?php echo url('/home/many/index'); ?>">惠多薪</a></dt>
                                    <dd>
                                        ·优化员工福利选择模块

                                    </dd>
                                    <dd>·企业成本可控透明化</dd>
                                </dl>
                                <dl>
                                    <dt><a href="<?php echo url('/home/searches/index'); ?>">惠找事</a></dt>
                                    <dd>
                                        ·技能价值化

                                    </dd>
                                    <dd>·成就更好自我</dd>
                                </dl>
                                <dl>
                                    <dt><a href="<?php echo url('/home/business/index'); ?>">惠创业</a></dt>
                                    <dd>
                                        ·一站式解决方案

                                    </dd>
                                    <dd>·激活企业最大效益</dd>
                                </dl>
                                <dl>
                                    <dt><a href="<?php echo url('/home/launch/index'); ?>">惠企动</a></dt>
                                    <dd>·产品内容建设中……</dd>
                                </dl>
                            </div>
                        </div><!-- 二级菜单 -->
                    </li>
                    <li><a href="javascript:;">政府招标信息</a></li>
                    <li><a href="<?php echo url('/home/index/infoList'); ?>">政府招商信息</a></li>
                    <li><a href="<?php echo url('/home/index/industry'); ?>">行业资讯</a></li>
                    <!-- <li><a href="<?php echo url('/home/launch/index'); ?>">惠启动</a></li> -->
                </ul>

                <!--登录，注册暂时先不上线 2019年12月2号-->

                <!--<?php if(empty($userinfo['mobile'])): ?>-->
                <!--<div class='register'>-->
                <!--<a href="javascript:void(0)" login_url="<?php echo $baseurl; ?>" loca_url="<?php echo config('curl.website'); ?>"-->
                <!--onclick="login_btn(this)">登录</a>-->
                <!--<a href="<?php echo url('/home/login/register'); ?>">注册</a>-->
                <!--</div>-->
                <!--<?php else: ?>-->
                <!--<div class="u_info">-->
                <!--<img src="/static/home/images/user_img.png" style="width:30px;height:30px; vertical-align: middle;">-->
                <!--<p style="display:inline-block;color:#fff;"  id="mobile_phone"><?php echo $userinfo['mobile']; ?></p>-->

                <!--<div class="u_info_content" id="u_info_content">-->
                <!--<a class="u_out" href="javascript:void(0)" data-token="<?php echo $userinfo['token']; ?>" onclick="user_logout(this)" location_url="<?php echo url('/home/index/index'); ?>" data-url="<?php echo url('/home/login/logout'); ?>">退出账号</a>-->
                <!--</div>-->
                <!--</div>-->
                <!--<?php endif; ?>-->
            </div>
        </div>
    </div>

    <div>
        <div class="fourzerofour">
            <img src="/static/error_pic.png">
        </div>
        <div class="building">
            正在建设中...
        </div>
        <div class="goHome">
            <span><i class="clock">3</i>秒后返回首页</span>
            <a href="<?php echo url('/home/index/index'); ?>">回到首页</a>
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