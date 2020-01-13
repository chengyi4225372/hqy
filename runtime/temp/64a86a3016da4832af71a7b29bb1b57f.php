<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"C:\phpEnv\www\hqy_\public/../application/home\view\index\industry.html";i:1578641886;s:59:"C:\phpEnv\www\hqy_\application\home\view\common\header.html";i:1578903611;s:59:"C:\phpEnv\www\hqy_\application\home\view\common\footer.html";i:1578557291;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit"/>
    <meta name="force-rendering" content="webkit"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <script>/*@cc_on document.write('\x3Cscript id="_iealwn_js" src="https://support.dmeng.net/ie-alert-warning/latest.js">\x3C/script>'); @*/</script>

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo $title; ?></title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <!-- <script src='/static/spirit/js/xlPaging.js'></script> -->
    <link rel="stylesheet" href="/static/spirit/css/base.css">
    <!-- <link rel="stylesheet" href="/static/spirit/css/layui.css"  media="all"> -->
    <link rel="stylesheet" href="/static/spirit/css/Informationlist.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+SC:100,300,400,500,700,900">
    <link rel="stylesheet" href="/static/home/font/syht.css">
    <script src="/static/spirit/js/clamp.js"></script>

    <script src='/static/spirit/js/industry.js'></script>
    <script src="/static/assets/plugins/layui/layui.all.js"></script>
    <script src='/static/home/js/common.js'></script>
    <script src='/static/common/js/public.js'></script>
</head>

<body>

<div class='container' data-pageId="5">

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


    <div class="bg_banner">
        <div class="w banner">

            <img src="/static/spirit/images/news.png" alt="">
        </div>
    </div>

    <!-- 面包屑导航 -->
    <div class="bg_breadCrumbs">
        <div class="w bread-crumbs">
            <span><a href="<?php echo url('/home/index/index'); ?>">首页</a></span> >
            <span><a class="current" style="color:#3E92FF;" onclick="go_news(this)"
                     data-url="<?php echo url('/home/index/industry'); ?>">新闻资讯</a></span> <span></span>
        </div>
    </div>

    <!-- 信息列表 -->
    <div class="content-box">
        <div class="m content">

            <div class="information-list">
                <div class="tabs clearfix">
                    <!-- <ul class="clearfix fl">
                  <li class="li-active">招商政策</li>
                  <li>招标信息</li>
                </ul> -->
                    <div class="govPolicy fl">新闻资讯</div>

                </div>

                <!-- 热搜 -->
                <div class="hotWord">
                    <div class="bgHot">
                        <span style='white-space: nowrap;'>热门关键词</span>
                        <ul>
                            <?php if(is_array($four) || $four instanceof \think\Collection || $four instanceof \think\Paginator): $k = 0; $__LIST__ = $four;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ff): $mod = ($k % 2 );++$k;?>
                            <li onclick="hotsearch(this);" data-title="<?php echo $ff['title']; ?>"
                                data-href="<?php echo url('/home/index/industrydetail'); ?>"
                                data-url="<?php echo url('/home/index/industryapi'); ?>" data-id="<?php echo $k; ?>">
                                <span style='white-space: nowrap;'><?php echo $ff['title']; ?></span>
                                <span class="close" onclick="nullhot(this)"
                                    data-title="<?php echo $ff['title']; ?>"  data-url="<?php echo url('/home/index/industryapi'); ?>">✕</span>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <div class="search-box">
                        <input type="text" id="keyword" value="<?php echo \think\Request::instance()->get('keyword'); ?>" placeholder="请输入关键字">
                        <div id="searched" style="cursor:pointer;" data-url="<?php echo url('/home/index/industry/index'); ?>">
                            搜索
                        </div>
                    </div>

                </div>

                <div class="bg_divide">

                    <div class="divide"></div>
                </div>


                <div class="tabs-items show">
                    <ul id="shang">
                        <?php if(empty($biao) || (($biao instanceof \think\Collection || $biao instanceof \think\Paginator ) && $biao->isEmpty())): ?>
                        <li>
                            <div class="tabs-items-content">
                                <div class="tabs-items-content-text figcaption">
                                    <p>抱歉，没有找到与<b style="color: #ff2222"><?php echo \think\Request::instance()->get('keyword'); ?></b>的相关结果。</p>
                                </div>
                            </div>
                        </li>
                        <?php else: if(is_array($biao) || $biao instanceof \think\Collection || $biao instanceof \think\Paginator): $i = 0; $__LIST__ = $biao;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ww): $mod = ($i % 2 );++$i;?>
                        <li>
                            <a href="<?php echo config('curl.website'); ?>/home/index/industrydetail?mid=<?php echo $ww['id']; ?>">
                                <div class="infoItem">
                                    <div class="infoLeft">
                                        <img src="<?php echo !empty($ww['imgs'])?$ww['imgs']:'/static/home/images/infoItem.jpg';; ?>" alt="">
                                    </div>

                                    <div class="infoRight">
                                        <div class="rightTop">
                                            <div class="itemTitle"><?php echo mb_substr($ww['title'],0,35,'utf-8'); ?></div>
                                            <span class="itemTime">
                                                    <img src="/static/spirit/images/shijian2x.png"
                                                         alt=""><span><?php echo $ww['release_time']; ?></span>
                                                </span>
                                        </div>
                                        <p class="limitP">
                                            <?php echo $ww['describe']; ?>
                                        </p>
                                    </div>

                                </div>
                            </a>


                            <ul class="tags">
                                <?php if(empty($ww['keyword']) || (($ww['keyword'] instanceof \think\Collection || $ww['keyword'] instanceof \think\Paginator ) && $ww['keyword']->isEmpty())): else: if(is_array($ww['keyword']) || $ww['keyword'] instanceof \think\Collection || $ww['keyword'] instanceof \think\Paginator): if( count($ww['keyword'])==0 ) : echo "" ;else: foreach($ww['keyword'] as $k=>$key): ?>
                                <li data-title="<?php echo $key; ?>"><?php echo $key; ?></li>
                                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                            </ul>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </ul>

                </div>

            </div>
        </div>
    </div>
    <!-- 分页 -->
    <div class="w pageNation">
        <!--        <ul class="page">-->
        <!--            <li class="prev">上一页</li>-->
        <!--            <li class="currentPage">1</li>-->
        <!--            <li>2</li>-->
        <!--            <li class="next">下一页</li>-->
        <!--        </ul>-->
        <?php echo $biao->render(); ?>
    </div>


    <!-- 底部 -->
    <div class="bgBottom">
    <div class="bottomBox">
        <div class="w bottom">
            <div class="aboutUs">
                <span>关于我们</span>
                <p>
                    惠企云网络信息（湖北）有限公司深度研究财税管理及企业管理在新经济时代的创新和运用，将【惠灵工】、【惠优税】、【惠多薪】、【惠创业】、【惠找事】五大产品融汇，打造一站式互联网服务平台，量身定制一体化财税筹划解决方案及企业管理咨询，为企业可持续发展提供有力保障！
                </p>
            </div>
            <div class="w navBottom">
                <div class="navList">
                    <dl>
                        <dt>惠企云旗下产品</dt>
                        <dd><a href="<?php echo config('curl.hlg'); ?>">惠灵工</a></dd>
                        <dd><a href="<?php echo config('curl.hys'); ?>">惠优税</a></dd>
                        <dd><a href="javascript:;">惠多薪</a></dd>
                        <dd><a href="javascript:;">惠创业</a></dd>
                        <dd><a href="javascript:;">惠找事</a></dd>
                    </dl>
                    <dl>
                        <dt>资讯信息</dt>
                        <dd><a href="<?php echo url('/home/index/industry'); ?>">新闻资讯</a></dd>
                        <dd><a href="<?php echo url('/home/index/infoList'); ?>">政府招商政策</a></dd>
                        <dd><a href="<?php echo url('/home/index/infoBiao'); ?>">招标信息</a></dd>
                    </dl>
                    <dl>
                        <dt>招商合作</dt>

                        <dd><a href="javascript:;">招募合伙人</a></dd>

                    </dl>
                    <dl>
                        <dt>联系我们</dt>
                        <dd><a href="javascript:;"></a>全国统一客服热线：400-150-9896</a></dd>
                        <dd><a href="javascript:;"></a>专家服务电话：181-8619-4461</a></dd>
                        <dd><a href="javascript:;"></a>武汉市硚口区南国大武汉H座</a></dd>
                        <dd><a href="javascript:;"></a>深圳市福田区第一世界广场A座</a></dd>
                        <dd><a href="javascript:;"></a>北京市西城区贵都国际中心B座</a></dd>
                    </dl>
                </div>

                <ul class="qrCode">
                    <li>
                        <div class="pic">
                            <img src="/static/spirit/images/weixincode.png" alt="">
                        </div>
                        <span><img src="/static/spirit/images/weixinicon.png" alt="">微信扫码关注</span>
                        <i>及时获知一手财税消息</i>
                    </li>
                    <li>
                        <div class="pic">
                            <img src="/static/spirit/images/weibocode.png" alt="">
                        </div>
                        <span><img src="/static/spirit/images/weiboicon.png" alt="">惠企云微博</span>
                        <!-- <i>及时获一手财税信息</i> -->
                    </li>
                </ul>
            </div>
        </div>
        <div class="w copyRight">©&nbsp;Copyright&nbsp;2019&nbsp;惠企动（湖北）科技有限公司&nbsp;.&nbsp;All Rights
            Reserved&nbsp;ICP证 : 鄂ICP备16008680号-3
        </div>

    </div>
</div>

<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?866318027a350c7c8dddf0359b3a65d3";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>

    <!-- 返回顶部 -->
    <div class='goTop' id="goTop">
        <i></i>
        <div>返回顶部</div>
    </div>


</div>


</body>
<script>
   

    /* 信息列表显示2行加省略号 */
    $('.limitP').each(function () {
        $clamp($(this)[0], {clamp: 2})
    })
</script>


</html>