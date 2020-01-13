<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"C:\phpEnv\www\hqy_\public/../application/home\view\optimal\index.html";i:1578644125;s:59:"C:\phpEnv\www\hqy_\application\home\view\common\header.html";i:1578903611;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <title>招募合伙人</title>
    <link rel="stylesheet" href="/static/spirit/css/base.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+SC:100,300,400,500,700,900">
    <link rel="stylesheet" href="/static/spirit/css/optimal.css">
    <link rel="stylesheet" href="/static/home/font/syht.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</head>

<body>
    <div class='container' data-pageId="1">

        <!-- 导航部分 -->
        <style>
    .container{
        padding-top: 3.75rem;

    }
    .header {
  width: 100%;
  height: 3.75rem;
  background: #031c36;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 3;
}

.header_content {
  position: relative;
  width: 75rem;
  margin: 0 auto;
  height: 3.75rem;
  /* display: flex;
    justify-content: space-between; */
  /* padding: 1rem 0 .6875rem 0; */
  line-height: 3.75rem;
}

.logo {
  float: left;
  margin-left: 0.75rem;
  margin-top: 1rem;
  width: 8.5rem;
  height: 2.06rem;
  background-image: url("/static/spirit/images/logoo.png");
  -webkit-background-size: 100% 100%;
  background-size: 100% 100%;
}

.logo a {
  display: block;
  width: 100%;
  /*height: 100%;*/
}

.titile {
  float: left;
  list-style: none;
  /* padding: .625rem 4.125rem 0 4.125rem; */
  display: -webkit-flex;
  /* 新版本语法: Chrome 21+ */
  display: -webkit-box;
  /* 老版本语法: Safari, iOS, Android browser, older WebKit browsers. */
  display: -moz-box;
  /* 老版本语法: Firefox (buggy) */
  display: -ms-flexbox;
  /* 混合版本语法: IE 10 */
  /* margin: 0px 0px 0 129px; */
  /* height: 2.75rem; */
  height: 100%;
  margin-left: 6.4375rem;
}

.titile li {
  height: 100%;
}

.titile li:hover>a {
  position: relative;
  color: #4091ff;
}

.titile li:hover>a::after {
  content: "";
  position: absolute;
  bottom: -0.55rem;
  left: 50%;
  -webkit-transform: translateX(-50%);
  -ms-transform: translateX(-50%);
  -o-transform: translateX(-50%);
  transform: translateX(-50%);
  width: 110%;
  height: 2px;
  background: #4091ff;
  -webkit-border-radius: 1px;
  border-radius: 1px;
}

.titile li:nth-of-type(1) a {
  font-size: 1rem;
  font-family: "Noto Sans SC","syht";
  font-weight: bold;
  color: #fff;
}

.titile li:nth-of-type(2) {
  margin: 0 3.375rem 0;
}

.titile li:nth-of-type(4) {
  margin: 0 3.375rem 0;
}

.titile li:nth-of-type(6) {
  margin: 0 3.375rem 0 3.375rem;
}

.titile a {
  /* padding:0 28px; */
  font-size: 1rem;
  font-family: "Noto Sans SC","syht";
  font-weight: bold;
  color: #fff;
  text-decoration: none;
}

.titile li {
  /* position: relative; */
  /* padding-top: .5rem; */
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  -o-box-sizing: border-box;
  -ms-box-sizing: border-box;
  box-sizing: border-box;
}

.titile li:nth-of-type(1) {
  /* padding-top: 0.5625rem; */
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  -o-box-sizing: border-box;
  -ms-box-sizing: border-box;
  box-sizing: border-box;
}

.titile :last-child {
  margin-right: 0;
}

.header_content .titile .nav-active>a {
  position: relative;
  font-size: 1rem;
  font-weight: bold;
  color: #006ebc;
}

.header_content .titile .nav-active>a::after {
  content: "";
  position: absolute;
  bottom: -0.5625rem;
  left: 50%;
  -webkit-transform: translateX(-50%);
  -ms-transform: translateX(-50%);
  -o-transform: translateX(-50%);
  transform: translateX(-50%);
  width: 110%;
  height: 2px;
  background: #006ebc;
  -webkit-border-radius: 1px;
  border-radius: 1px;
}

.register {
  float: right;
  line-height: 3.75rem;
}

.header_content .register>a {
  text-decoration: none;
  display: inline-block;
  width: 3.5rem;
  height: 1.5rem;
  text-align: center;
  line-height: 1.5rem;
  border: 1px solid #ccc;
  -webkit-border-radius: 4px;
  border-radius: 4px;
  font-size: 14px;
  font-family: "Noto Sans SC","syht";
  font-weight: 500;
  color: #0069b3;
  color: #fff;
}

.header_content .register>a:nth-of-type(2) {
  margin-left: 1.125rem;
}

/* 次级菜单 */
.secondary-menu {
  position: absolute;
  left: 0;
  top: 3.7125rem;
  /* -webkit-transform: translateX(-50%);
  -ms-transform: translateX(-50%);
  -o-transform: translateX(-50%);
  transform: translateX(-50%); */
  /* height: 9.375rem; */
  background: rgba(64, 145, 255, 0.5);
  z-index: 1;
  /* display: none; */
  -webkit-transition: all 0.3s;
  -o-transition: all 0.3s;
  transition: all 0.3s;
  min-width: 65.625rem;
  height: 0;
  overflow: hidden;
}
.secStatus{
  font-family: "Noto Sans SC","syht";
}
.two .secondary-menu {
  position: absolute;
  left: 50%;
  top: 3.7125rem;
  -webkit-transform: translateX(-50%);
  -ms-transform: translateX(-50%);
  -o-transform: translateX(-50%);
  transform: translateX(-50%);
  /* height: 9.375rem; */
  background: rgba(64, 145, 255, 0.5);
  z-index: 1;
  /* display: none; */
  /* display: block; */
  -webkit-transition: all 0.3s;
  -o-transition: all 0.3s;
  transition: all 0.3s;
  height: 0;
  overflow: hidden;
  /* width: 1199px; */
}

.header_content ul>li:hover .secondary-menu {
  /* top: 6rem; */
  /* display: block; */
  height: 9.375rem;
}

.secondary-menu>div:nth-child(1) {
  /* padding: .625rem 4.125rem 0 4.125rem; */
  display: -webkit-flex;
  /* 新版本语法: Chrome 21+ */
  display: -webkit-box;
  /* 老版本语法: Safari, iOS, Android browser, older WebKit browsers. */
  display: -moz-box;
  /* 老版本语法: Firefox (buggy) */
  display: -ms-flexbox;
  /* 混合版本语法: IE 10 */
  display: flex;
  -moz-justify-content: space-around;
  -webkit-justify-content: space-around;
  -ms-justify-content: space-around;
  -o-justify-content: space-around;
  -ms-flex-pack: distribute;
  justify-content: space-around;
}

.secondary-menu>div:nth-child(1) dl {
  /* float: left;
    margin-right: 3.8rem */
}

.secondary-menu>div:nth-child(1) dl:last-child {
  margin-right: 0;
}

.secondary-menu>div:nth-child(1) dl dt a {
  font-family: "Noto Sans SC","syht"!important;
  font-size: 1.375rem;


  font-weight: 500;
  color: white;
  line-height: 3.8125rem;
}

.secondary-menu>div:nth-child(1) dl dd {
  font-size: 0.875rem;


  font-weight: 300;
  color: #feffff;
  line-height: 1.75rem;
}

/* 用户信息 */
.u_info {
  position: relative;
  float: right;
  /*margin-top: .4625rem;*/
  cursor: pointer;
}

.u_info_content {
  display: none;
  width: 5.625rem;
  height: 2.6875rem;
  position: absolute;
  bottom: -2.8125rem;
  left: -1.8125rem;
  background-color: pink;
  text-align: center;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  -o-box-sizing: border-box;
  -ms-box-sizing: border-box;
  box-sizing: border-box;
  font-size: 0.875rem;
  font-family: "Noto Sans SC","syht";
  font-weight: 500;
  color: #333333;
  background: white;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(11, 32, 64, 0.1);
  box-shadow: 0px 0px 10px 0px rgba(11, 32, 64, 0.1);
  -webkit-border-radius: 2px;
  border-radius: 2px;
}

.u_info_content .u_out {
  font-size: 0.875rem;
  font-family: "Noto Sans SC","syht";
  color: #333;
  display: block;
  width: 100%;
  height: 100%;
  padding: 1.0625rem 0.875rem;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  -o-box-sizing: border-box;
  -ms-box-sizing: border-box;
  box-sizing: border-box;
  line-height: 0.75rem;
}

.u_info_content .u_out:hover {
  background: #f0f7fe;
  cursor: pointer;
}

.u_info_content::after {
  content: "";
  display: block;
  position: absolute;
  top: -1.25rem;
  left: 50%;
  -webkit-transform: translateX(-50%);
  -o-transform: translateX(-50%);
  -ms-transform: translateX(-50%);
  transform: translateX(-50%);
  border-top: 0.625rem solid transparent;
  border-right: 0.625rem solid transparent;
  border-bottom: 0.625rem solid #ffff;
  border-left: 0.625rem solid transparent;
}

.u_info:hover .u_info_content {
  display: block;
}

</style>

<div class='header'>
    <div class=header_content id='headerContent'>
        <div class='logo'>
            <a href="<?php echo url('/home/index/index'); ?>"></a>
        </div>
        <ul class='titile'>
            <li><a href="<?php echo url('/home/index/index'); ?>">首页</a></li>
            <li><a href="<?php echo url('/home/optimal/index'); ?>">招募合伙人</a>
            </li>
            <li>
                <a href="javascript:;">“惠”家族产品</a>
                <!-- 二级菜单 -->
                <div class="w secondary-menu" id="secondary-menu">

                    <div>
                        <dl>
                            <dt><a class="secStatus" href="<?php echo config('curl.hys'); ?>">惠优税</a></dt>
                            <dd>
                                · 企业财税筹划定制

                            </dd>
                            <dd>· 一体化解决方案</dd>
                        </dl>
                        <dl>
                            <dt><a class="secStatus" href="<?php echo config('curl.hlg'); ?>">惠灵工</a></dt>
                            <dd>
                                · 企业灵活用工平台

                            </dd>
                            <dd>· 财税优化综合服务</dd>
                        </dl>
                        <dl>
                            <dt><a class="secStatus" href="<?php echo url('/home/many/index'); ?>">惠多薪</a></dt>
                            <dd>
                                · 优化薪酬结构

                            </dd>
                            <dd>· 为企业降本增效</dd>
                        </dl>
                        <dl>
                            <dt><a class="secStatus" href="<?php echo url('/home/searches/index'); ?>">惠找事</a></dt>
                            <dd>
                                · 精选各地好工作

                            </dd>
                            <dd>· 高效缔结，轻松入职</dd>
                        </dl>
                        <dl>
                            <dt><a class="secStatus" href="<?php echo url('/home/business/index'); ?>">惠创业</a></dt>
                            <dd>
                                · 创业公司

                            </dd>
                            <dd>· 一站式商务服务</dd>
                        </dl>
                        <dl>
                            <dt><a class="secStatus" href="<?php echo url('/home/launch/index'); ?>">惠企动</a></dt>
                            <dd>· 企业互联网生态管理</dd>
                            <dd>· 全行业全渠道数字化转型</dd>
                        </dl>
                    </div>

                </div><!-- 二级菜单 -->
            </li>
            <li><a href="<?php echo url('/home/index/infoBiao'); ?>">招标信息</a></li>
            <li><a href="<?php echo url('/home/index/infoList'); ?>">政府招商政策</a></li>
            <li><a href="<?php echo url('/home/index/industry'); ?>">行业资讯</a></li>
            <!-- <li><a href="<?php echo url('/home/launch/index'); ?>">惠启动</a></li> -->
        </ul>


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

  <script>
    $(document).ready(function () {
      var pageId = Number($('.container').attr('data-pageId'))
    //   if (pageId == 0) {
    //     $('.header_content').height('3.75rem');
    //     $('.header').height('3.75rem');
    //     // $(".logo img").attr('src',"/static/home/images/mainLogo.png");
    //   }
      $('.titile > li').eq(pageId).addClass('nav-active')
      $('.titile li').on('click', function () { $(this).addClass('nav-active chosenPage').siblings().removeClass('nav-active chosenPage') })
      $('.titile li').on('mouseenter', function () { $(this).addClass('nav-active').siblings().removeClass('nav-active') })
      $('.titile').on('mouseleave', function () {
        $('.titile li').removeClass('nav-active')
        if ($('.chosenPage').length < 1) $('.titile li').eq(pageId).addClass('chosenPage')
        $('.chosenPage').addClass('nav-active')
      })
    })
  </script>
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