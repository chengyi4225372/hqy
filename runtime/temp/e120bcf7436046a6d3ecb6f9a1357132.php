<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:109:"C:\Users\Administrator\Desktop\phpEnv5.6.0-Green\www\hqy_\public/../application/home\view\index\industry.html";i:1577086735;s:98:"C:\Users\Administrator\Desktop\phpEnv5.6.0-Green\www\hqy_\application\home\view\common\footer.html";i:1577086735;}*/ ?>
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

<div class='container'>

    <!-- 导航部分 -->
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
                                <dt><a class="secStatus" href="<?php echo config('curl.hys'); ?>" target="_blank">惠优税</a></dt>
                                <dd>
                                    · 企业财税筹划定制

                                </dd>
                                <dd>· 一体化解决方案</dd>
                            </dl>
                            <dl>
                                <dt><a class="secStatus" href="<?php echo config('curl.hlg'); ?>" target="_blank">惠灵工</a></dt>
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
                                    · 武汉创业公司

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
                <li class='nav-active'><a href="<?php echo url('/home/index/industry'); ?>">新闻资讯</a></li>
                <!-- <li><a href="<?php echo url('/home/launch/index'); ?>">惠启动</a></li> -->
            </ul>

            <!--登录，注册暂时先不上线 2019年12月2号-->

            <!-- <?php if(empty($userinfo['mobile'])): ?>
            <div class='register'>
                <a href="javascript:void(0)" login_url="<?php echo $baseurl; ?>" loca_url="<?php echo config('curl.website'); ?>"
                    onclick="login_btn(this)">登录</a>
                <a href="<?php echo url('/home/login/register'); ?>">注册</a>
            </div>
            <?php else: ?>
            <div class="u_info">
                <img src="/static/home/images/user_img.png" style="width:30px;height:30px; vertical-align: middle;">
                <p style="display:inline-block;color:#fff;" id="mobile_phone"><?php echo $userinfo['mobile']; ?></p>

                <div class="u_info_content" id="u_info_content">
                    <a class="u_out" href="javascript:void(0)" data-token="<?php echo $userinfo['token']; ?>"
                        onclick="user_logout(this)" location_url="<?php echo url('/home/index/index'); ?>"
                        data-url="<?php echo url('/home/login/logout'); ?>">退出账号</a>
                </div>
            </div>
            <?php endif; ?> -->


        </div>
    </div>


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
                        <span>热门关键词</span>
                        <ul>
                            <?php if(is_array($four) || $four instanceof \think\Collection || $four instanceof \think\Paginator): $k = 0; $__LIST__ = $four;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ff): $mod = ($k % 2 );++$k;?>
                            <li onclick="hotsearch(this);" data-title="<?php echo $ff['title']; ?>"
                                data-href="<?php echo url('/home/index/industrydetail'); ?>"
                                data-url="<?php echo url('/home/index/industryapi'); ?>" data-id="<?php echo $k; ?>">
                                <span><?php echo $ff['title']; ?></span>
                                <span class="close" onclick="nullhot(this)"
                                      data-url="<?php echo url('/home/index/industryapi'); ?>">✕</span>
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

    <!-- 返回顶部 -->
    <div class='goTop' id="goTop">
        <i></i>
        <div>返回顶部</div>
    </div>


</div>


</body>
<script>
    var menuList = document.querySelectorAll('#headerContent ul li')
    var menuUl = document.querySelector('#headerContent ul')

    for (var i = 0; i < menuList.length; i++) {
        menuList[i].onmouseenter = function () {
            var li = document.querySelectorAll('.nav-active')[0]
            li.classList.remove('nav-active')
            this.classList.add('nav-active')
        }
    }

    menuUl.onmouseleave = function () {
        var li = document.querySelectorAll('.nav-active')[0]
        li.classList.remove('nav-active')
        menuList[4].classList.add('nav-active')
    }

    /* 信息列表显示2行加省略号 */
    $('.limitP').each(function () {
        $clamp($(this)[0], {clamp: 2})
    })
</script>


</html>