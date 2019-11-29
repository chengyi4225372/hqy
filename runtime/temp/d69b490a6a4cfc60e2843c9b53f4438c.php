<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:74:"/opt/web/hui-/public/../application/home/view/spirit/information_list.html";i:1573519048;s:53:"/opt/web/hui-/application/home/view/common/login.html";i:1573518983;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="/static/spirit/css/base.css">
  <link rel="stylesheet" href="/static/spirit/css/Informationlist.css">
  <script src="/static/spirit/js/clamp.js"></script>
  <script src='/static/spirit/js/Informationlist.js'></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="/static/assets/plugins/layui/layui.all.js"></script>
  <script src='/static/spirit/js/spirit.js'></script>
  <script src='/static/common/js/public.js'></script>
</head>

<body>

  <div class='container'>

    <!-- 导航部分 -->
    <div class="nav-box">
      <div class="w nav-container clearfix">
        <!-- logo图 -->
        <div class="logo">
          <h1>
            <a href="<?php echo url('/home/spirit/index'); ?>"><img src="/static/spirit/images/logo2x.png"></a>
          </h1>
        </div>
        <!-- nav部分 -->
        <div class="nav">
          <ul class="clearfix">
            <li ><a href="<?php echo url('/home/index/index'); ?>">首页</a></li>
            <li><a href="<?php echo url('/home/optimal/index'); ?>" target="_blank">惠优税</a></li>
            <li class="nav-active"><a href="<?php echo url('/home/spirit/index'); ?>">惠灵工</a></li>
            <li><a href="<?php echo url('/home/many/index'); ?>">惠多薪</a></li>
            <li><a href="<?php echo url('/home/business/index'); ?>">惠创业</a></li>
            <li><a href="<?php echo url('/home/searches/index'); ?>">惠找事</a></li>
            <li><a href="<?php echo url('/home/launch/index'); ?>">惠启动</a></li>
          </ul>
        </div>
        <!-- 登陆注册 -->
        <?php if(empty($userinfo['mobile'])): ?>
<div class="loging clearfix">
    <div class="register-btn"><a href="<?php echo $baseurl; ?>" target="_blank">
        登陆
    </a></div>
    <div class="loging-btn"><a href="<?php echo url('/home/login/register'); ?>">注册</a></div>
</div>
<?php else: ?>
<div class="u_info">
    <img src="/static/home/images/user_img.png"
         style="width:30px;height:30px; vertical-align: middle;">
    <p style="display:inline-block;color:#fff;"><?php echo $userinfo['mobile']; ?></p>
    <div class="u_info_content" id="u_info_content">
        <a class="u_out" href="javascript:void(0)" onclick="user_logout(this)" location_url="<?php echo url('/home/index/index'); ?>" data-url="<?php echo url('/home/login/logout'); ?>">退出账号</a>
    </div>
</div>
<?php endif; ?>
      </div>

    </div>

    <!-- 面包屑导航 -->
    <div class="content-box">
      <div class="w content">
        <div class="bread-crumbs">
          <span><a onclick="go_work(this)" data-url="<?php echo url('/home/spirit/index'); ?>">惠灵工</a></span> > <span><a onclick="go_news(this)" data-url="<?php echo url('/home/spirit/informationList'); ?>">资讯</a></span> ><span></span>
        </div>
        <div class="information-list">
          <div class="tabs clearfix">
            <ul class="clearfix fl">
              <li class="li-active"><a href="<?php echo url('/home/spirit/informationList'); ?>">行业资讯</a></li>
             <!--  <li>招标信息</li>-->
            </ul>
            <div class="search-box fr">
              <input type="text" id="keyword" value="<?php echo \think\Request::instance()->get('keyword'); ?>" placeholder="请输入关键字">
              <div onclick="search(this)" data-url="<?php echo url('/home/spirit/informationList'); ?>">搜索</div>
            </div>
          </div>
          <div class="tabs-items show">
            <ul id="content">
              <?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
              <li>
                  <div class="tabs-items-content">
                    <div class="tabs-items-content-text figcaption">
                      <p>抱歉，没有找到与<b style="color: #ff2222"><?php echo \think\Request::instance()->get('keyword'); ?></b>的相关结果。</p>
                    </div>
                  </div>
              </li>
              <?php else: if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
              <li>
                <a href="<?php echo url('/home/spirit/detail',['mid'=>$vo['id']]); ?>">
                  <div class="tabs-items-img">
                    <img src="<?php echo (isset($vo['imgs']) && ($vo['imgs'] !== '')?$vo['imgs']:''); ?>" alt="">
                  </div>
                  <div class="tabs-items-content">
                    <div class="tabs-items-content-title figcaption">
                      <p><?php echo $vo['title']; ?></p>
                    </div>
                    <div class="tabs-items-content-text figcaption">
                      <p><?php echo $vo['desc']; ?></p>
                    </div>
                    <div class="tabs-items-content-time"><span><img src="/static/spirit/images/shijian2x.png"
                          alt=""></span><span><?php echo $vo['create_time']; ?></span></div>
                  </div>
                </a>
              </li>
              <?php endforeach; endif; else: echo "" ;endif; endif; ?>

            </ul>
            <input type="hidden" value="<?php echo \think\Request::instance()->get('keyword'); ?>" id="sid">
            <input type="hidden" value="1" id="page">
            <div class="more-btn" onclick="getMore($('#sid').val(),$('#page').val(),this)" data-href="<?php echo url('/home/spirit/detail'); ?>" data-url="<?php echo url('/home/spirit/getpageInfo'); ?>">查看更多</div>
          </div>

        </div>
      </div>
    </div>

    <!-- 底部 -->
    <div class="fotter-box">
      <div class="w fotter">
        <div class='partener_titile'>用智“慧”创造优“惠”</div>
        <div class='parterne_info'>
          深耕税筹行业多年，合作企业多达几千家。专业为个人和企业解决税务难题。为您提供一站式金融、税务和人力外包服务，以及专业的税筹划分析，最安全、高效、合理的节税措施。我们有最成熟的专家团队和各行业实操经验！作为国内领先的标准化税筹服务互联网平台，我们得到了上海、安徽、江西、湖北等各地政府的大力支持，为企业节税保驾护航！
        </div>
        <div class='parter_catefories'>
          <dl>
            <dt><a href="#">服务产品</a></dt>
            <dd><a href="#">服务型税筹</a></dd>
            <dd><a href="#">门户型税筹</a></dd>
            <dd><a href="#">人力资源</a></dd>
          </dl>
          <dl>
            <dt><a href="#">招商政策</a></dt>
            <dd><a href="#">招商政策网</a></dd>
          </dl>
          <dl>
            <dt><a href="#">合作</a></dt>
            <dd><a href="#">代理合作</a></dd>
          </dl>
          <dl>
            <dt><a href="#">公司信息</a></dt>
            <dd><a href="#">瑟维斯有限公司</a></dd>
            <dd><a href="#">惠创优产业联盟</a></dd>
            <dd><a href="#">中兴瑞华有限公司</a></dd>
          </dl>
          <dl>
            <dt><a href="#">联系我们</a></dt>
            <dd><a href="#">400-150-9896</a></dd>
            <dd><a href="#">hcylm008@dingtalk.com</a></dd>
            <dd><a href="#">武汉市硚口区南国大武汉H座18楼</a></dd>
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

</html>