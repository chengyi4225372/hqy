<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:64:"/opt/web/hui-/public/../application/home/view/spirit/detail.html";i:1573519037;s:53:"/opt/web/hui-/application/home/view/common/login.html";i:1573518983;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $title; ?></title>
  <meta name="keywords" content="<?php echo (isset($info['keyword']) && ($info['keyword'] !== '')?$info['keyword']:''); ?>" />
  <link rel="stylesheet" href="/static/spirit/css/base.css">
  <link rel="stylesheet" href="/static/spirit/css/detail.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="/static/assets/plugins/layui/layui.all.js"></script>
  <script src='/static/spirit/js/spirit.js'></script>
  <script src='/static/common/js/public.js'></script>
</head>

<body>
  <div class='container'>
    <div class='header'>
      <div class=header_content>
        <div class='logo'>
          <a href="<?php echo url('/home/spirit/index'); ?>"></a>
        </div>
        <ul class='titile'>
          <li ><a href="<?php echo url('/home/index/index'); ?>">首页</a></li>
          <li><a href="<?php echo url('/home/optimal/index'); ?>">惠优税</a></li>
          <li class="nav-active"><a href="<?php echo url('/home/spirit/index'); ?>">惠灵工</a></li>
          <li><a href="<?php echo url('/home/many/index'); ?>">惠多薪</a></li>
          <li><a href="<?php echo url('/home/business/index'); ?>">惠创业</a></li>
          <li><a href="<?php echo url('/home/searches/index'); ?>">惠找事</a></li>
          <li><a href="<?php echo url('/home/launch/index'); ?>">惠启动</a></li>
        </ul>
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
    <div class='main_content'>
      <div class='content_middle'>
        <div class='bread_title'><a onclick="go_work(this)" data-url="<?php echo url('/home/spirit/index'); ?>">惠灵工</a> > <a onclick="go_news(this)" data-url="<?php echo url('/home/spirit/informationList'); ?>">资讯</a> > 新闻详情</div>
        <div class='pic_total'>
          <div class='pic_title'><?php echo $info['title']; ?></div>
          <div class='time'><?php echo $info['create_time']; ?></div>
          <div class='line'></div>
          <div class='tuwen'>
            <div class='wenzi'>
              <?php echo $info['content']; ?>
             </div>

            <div class='page'>
              <?php if(empty($top) || (($top instanceof \think\Collection || $top instanceof \think\Paginator ) && $top->isEmpty())): ?>
              <div><span>上一篇:</span><a href="#">已经是第一篇了</a></div>
              <?php else: ?>
              <div><span>上一篇:</span><a href="<?php echo url('/home/spirit/detail',['mid'=>$top['id']]); ?>"><?php echo $top['title']; ?></a></div>
              <?php endif; if(empty($next) || (($next instanceof \think\Collection || $next instanceof \think\Paginator ) && $next->isEmpty())): ?>
              <div><span>下一篇:</span><a href="#">已经是最后一篇</a></div>
              <?php else: ?>
              <div><span>下一篇:</span><a href="<?php echo url('/home/spirit/detail',['mid'=>$next['id']]); ?>"><?php echo $next['title']; ?></a></div>
              <?php endif; ?>
            </div>
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