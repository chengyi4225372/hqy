<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"/opt/web/hui/public/../application/home/view/index/info_biao.html";i:1574908491;}*/ ?>
<!DOCTYPE>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title; ?></title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <!-- <script src='/static/spirit/js/xlPaging.js'></script> -->
    <link rel="stylesheet" href="/static/spirit/css/base.css">
    <!-- <link rel="stylesheet" href="/static/spirit/css/layui.css"  media="all"> -->
    <link rel="stylesheet" href="/static/spirit/css/Informationlist.css">
    <script src="/static/spirit/js/clamp.js"></script>

    <script src='/static/spirit/js/Informationlist.js'></script>
    <script src="/static/assets/plugins/layui/layui.all.js"></script>
    <script src='/static/home/js/common.js'></script>
    <script src='/static/common/js/public.js'></script>
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
                <li><a href="<?php echo url('/home/optimal/index'); ?>">招募合伙人</a>
                </li>
                <li>
                    <a href="javascript:;">“惠”家族产品</a>
                    <!-- 二级菜单 -->
                    <div class="w secondary-menu" id="secondary-menu">
                        <div>
                            <dl>
                                <dt><a href="<?php echo url('/home/optimal/index'); ?>">惠优税</a></dt>
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
                                <dt><a href="<?php echo config('curl.hzs'); ?>">惠找事</a></dt>
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
                <li class='nav-active'><a href="javascript:;">政府招标信息</a></li>
                <li><a href="<?php echo url('/home/index/infoList'); ?>">政府招商信息</a></li>
                <li><a href="javascript:;">行业资讯</a></li>
                <!-- <li><a href="<?php echo url('/home/launch/index'); ?>">惠启动</a></li> -->
            </ul>
            <?php if(empty($userinfo['mobile'])): ?>
            <div class='register'>
                <a href="javascript:void(0)" login_url="<?php echo $baseurl; ?>" loca_url="<?php echo config('curl.website'); ?>"
                   onclick="login_btn(this)">登录</a>
                <a href="<?php echo url('/home/login/register'); ?>">注册</a>
            </div>
            <?php else: ?>
            <div class="u_info">
                <img src="/static/home/images/user_img.png" style="width:30px;height:30px; vertical-align: middle;">
                <p style="display:inline-block;color:#fff;"  id="mobile_phone"><?php echo $userinfo['mobile']; ?></p>

                <div class="u_info_content" id="u_info_content">
                    <a class="u_out" href="javascript:void(0)" data-token="<?php echo $userinfo['token']; ?>" onclick="user_logout(this)" location_url="<?php echo url('/home/index/index'); ?>" data-url="<?php echo url('/home/login/logout'); ?>">退出账号</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>


    <div class="bg_banner">
        <div class="w banner">

            <img src="/static/spirit/images/banner.jpg" alt="">
        </div>
    </div>

    <!-- 面包屑导航 -->
    <div class="w bg_breadCrumbs">
        <div class="bread-crumbs">
            <span><a href="<?php echo url('/home/index/index'); ?>">首页</a></span> >
            <span><a class="current" style="color:#3E92FF;" onclick="go_news(this)"
                     data-url="<?php echo url('/home/index/infoList'); ?>">政府招标信息</a></span> <span></span>
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
                    <div class="govPolicy fl">政府招标信息</div>
                    <div class="search-box fr">
                        <input type="text" id="keyword" value="<?php echo \think\Request::instance()->get('keyword'); ?>" placeholder="请输入关键字">
                        <div id="searched" style="cursor:pointer;" data-url="<?php echo url('/home/index/infoBiao'); ?>">搜索</div>
                    </div>
                </div>

                <!-- 热搜 -->
                <div class="m hotWord">
                    <ul>
                        <li style="cursor:pointer;" data-url="<?php echo url('/home/index/infoBiao'); ?>"
                            onclick="location.href=$(this).attr('data-url')">
                            <span>热门关键词</span>
                        </li>
                        <?php if(is_array($four) || $four instanceof \think\Collection || $four instanceof \think\Paginator): $i = 0; $__LIST__ = $four;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ff): $mod = ($i % 2 );++$i;?>
                        <li onclick="hotsearch(this);" data-title="<?php echo $ff['title']; ?>" data-url="<?php echo url('/home/index/infoBiao'); ?>">
                            <span><?php echo $ff['title']; ?></span>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>

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
                            <a href="javascript:;"
                               data-url="<?php echo url('/home/index/getInfo',['mid' => $ww['id']]); ?>"
                               login_url="<?php echo $baseurl; ?>"
                               loca_url="<?php echo config('curl.website'); ?>/home/index/getInfo?mid=<?php echo $ww['id']; ?>"
                               mobile-phone="<?php echo $userinfo['mobile']; ?>" data-id="<?php echo $ww['id']; ?>"
                               onclick="home_module.show_detail(this)">
                                <div class="infoItem">
                                    <div class="infoLeft">
                                        <img src="<?php echo !empty($ww['imgs'])?$ww['imgs']:'/static/home/images/infoItem.jpg';; ?>" alt="">
                                    </div>

                                    <div class="infoRight">
                                        <div class="rightTop">
                                            <div class="itemTitle"><?php echo mb_substr($ww['title'],0,35,'utf-8'); ?></div>
                                            <span class="itemTime">
                                                <img src="/static/spirit/images/shijian2x.png" alt=""><span><?php echo $ww['release_time']; ?></span>
                                            </span>
                                        </div>
                                        <p>
                                            <?php echo $ww['describe']; ?>
                                        </p>
                                    </div>

                                </div>
                            </a>
                            <ul class="tags">
                                <?php if(empty($ww['keyword']) || (($ww['keyword'] instanceof \think\Collection || $ww['keyword'] instanceof \think\Paginator ) && $ww['keyword']->isEmpty())): else: if(is_array($ww['keyword']) || $ww['keyword'] instanceof \think\Collection || $ww['keyword'] instanceof \think\Paginator): if( count($ww['keyword'])==0 ) : echo "" ;else: foreach($ww['keyword'] as $k=>$key): ?>
                                <li onclick="hotsearch(this);" data-title="<?php echo $key; ?>" data-url="<?php echo url('/home/index/infoBiao'); ?>" ><?php echo $key; ?></li>
                                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                            </ul>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </ul>
                    <input type="hidden" id="sid" value="<?php echo \think\Request::instance()->get('keyword'); ?>">
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
    <div class="fotter-box">
        <div class="w fotter">
            <!-- <div class='partener_titile'>用智“慧”创造优“惠”</div>
            <div class='parterne_info'>
              深耕税筹行业多年，合作企业多达几千家。专业为个人和企业解决税务难题。为您提供一站式金融、税务和人力外包服务，以及专业的税筹划分析，最安全、高效、合理的节税措施。我们有最成熟的专家团队和各行业实操经验！作为国内领先的标准化税筹服务互联网平台，我们得到了上海、安徽、江西、湖北等各地政府的大力支持，为企业节税保驾护航！
            </div> -->
            <div class='parter_catefories'>
                <dl>
                    <dt><a href="javascript:;">服务产品</a></dt>
                    <dd><a href="javascript:;">服务型税筹</a></dd>
                    <dd><a href="javascript:;">门户型税筹</a></dd>
                    <dd><a href="javascript:;">人力资源</a></dd>
                </dl>
                <dl>
                    <dt><a href="javascript:;">招商政策</a></dt>
                    <dd><a href="javascript:;">招商政策网</a></dd>
                </dl>
                <dl>
                    <dt><a href="javascript:;">合作</a></dt>
                    <dd><a href="javascript:;">代理合作</a></dd>
                </dl>
                <dl>
                    <dt><a href="javascript:;">公司信息</a></dt>
                    <dd><a href="javascript:;">瑟维斯有限公司</a></dd>
                    <dd><a href="javascript:;">惠创优产业联盟</a></dd>
                    <dd><a href="javascript:;">中兴瑞华有限公司</a></dd>
                </dl>
                <dl>
                    <dt><a href="javascript:;">联系我们</a></dt>
                    <dd><a href="javascript:;">400-150-9896</a></dd>
                    <dd><a href="javascript:;">hcylm008@dingtalk.com</a></dd>
                    <dd><a href="javascript:;">武汉市硚口区南国大武汉H座18楼</a></dd>
                </dl>

            </div>
            <div class='concat_icon clearfix'>
                <div><img src="/static/spirit/images/tie.png" alt=""></div>
                <div><img src="/static/spirit/images/wx.png" alt=""></div>
                <div><img src="/static/spirit/images/bo.png" alt=""></div>
            </div>
            <div class="partener_fotter">© Copyright 2019 惠企动（湖北）科技有限公司 . All Rights Reserved</div>
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

    /* 选择热词 */
    $('.hotWord ul li').click(function (e) {
        if ($(this).hasClass('chosen')) {
            $(this).removeClass('chosen')
        } else {
            $(this).addClass('chosen')
            $(this).siblings().removeClass('chosen')
        }

    })


</script>

</html>