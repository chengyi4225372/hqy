<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:109:"C:\Users\Administrator\Desktop\phpEnv5.6.0-Green\www\hui\public/../application/home\view\index\info_list.html";i:1573181646;s:96:"C:\Users\Administrator\Desktop\phpEnv5.6.0-Green\www\hui\application\home\view\common\login.html";i:1573106971;}*/ ?>
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
  <script src='/static/home/js/common.js'></script>
  <script src='/static/common/js/common.js'></script>
</head>

<body>

  <div class='container'>

    <!-- 导航部分 -->
    <div class="nav-box">
      <div class="w nav-container clearfix">
        <!-- logo图 -->
        <div class="logo">
          <h1>
            <a href="/"><img src="/static/spirit/images/logo2x.png"></a>
          </h1>
        </div>
        <!-- nav部分 -->
        <div class="nav">
          <ul class="clearfix">
            <li class="nav-active"><a href="/">首页</a></li>
            <li><a href="#">惠优税</a></li>
            <li><a href="<?php echo url('/home/spirit/index'); ?>">惠灵工</a></li>
            <li><a href="#">惠多薪</a></li>
            <li><a href="#">惠创业</a></li>
            <li><a href="#">惠找事</a></li>
            <li><a href="#">惠启动</a></li>
          </ul>
        </div>
        <!-- 登陆注册 -->
        <?php if(empty($userinfo['mobile'])): ?>
        <div class='register'>
          <a href="<?php echo url('/home/login/login'); ?>">登录</a>
          <span></span>
          <a href="<?php echo url('/home/login/register'); ?>">注册</a>
        </div>
        <?php else: if(empty($userinfo['mobile'])): ?>
<div class="loging clearfix">
    <div class="register-btn"><a href="<?php echo url('/home/login/login'); ?>">
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
        <a class="u_out" href="javascript:void(0)" onclick="index_module.user_logout(this)" location_url="<?php echo url('/home/index/index'); ?>" data-url="<?php echo url('/home/login/logout'); ?>">退出账号</a>
    </div>
</div>
<?php endif; endif; ?>
      </div>

    </div>

    <!-- 面包屑导航 -->
    <div class="content-box">
      <div class="w content">
        <div class="bread-crumbs">
          <span><a href="/">首页</a></span> > <span><a onclick="go_news(this)" data-url="<?php echo url('/home/index/infoList'); ?>">资讯</a></span> > <span></span>
        </div>
        <div class="information-list">
          <div class="tabs clearfix">
            <ul class="clearfix fl">
              <li class="li-active">招商政策</li>
              <li>招标信息</li>
            </ul>
            <div class="search-box fr">
              <input type="text" id="keyword" value="<?php echo \think\Request::instance()->get('keyword'); ?>" placeholder="请输入关键字">
              <div  id="searched" data-url="<?php echo url('/home/index/infoList'); ?>">搜索</div>
            </div>
          </div>
          <div class="tabs-items show">
            <ul  id="shang">
              <?php if(empty($shang) || (($shang instanceof \think\Collection || $shang instanceof \think\Paginator ) && $shang->isEmpty())): ?>
              <li>
                <div class="tabs-items-content">
                  <div class="tabs-items-content-text figcaption">
                    <p>抱歉，没有找到与<b style="color: #ff2222"><?php echo \think\Request::instance()->get('keyword'); ?></b>的相关结果。</p>
                  </div>
                </div>
              </li>
              <?php else: if(is_array($shang) || $shang instanceof \think\Collection || $shang instanceof \think\Paginator): $i = 0; $__LIST__ = $shang;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sh): $mod = ($i % 2 );++$i;?>
              <li>
                <a href="<?php echo url('/home/index/getInfo',array('mid'=>$sh['id'])); ?>">
<!--                  <div class="tabs-items-img">-->
<!--                    <img src="./images/qitewentiyewu.jpg" alt="">-->
<!--                  </div>-->
                  <div class="tabs-items-content">
                    <div class="tabs-items-content-title figcaption">
                      <p><?php echo $sh['title']; ?></p>
                    </div>
                    <div class="tabs-items-content-text figcaption">
                      <p><?php echo $sh['describe']; ?></p>
                    </div>
                    <div class="tabs-items-content-time"><span><img src="/static/spirit/images/shijian2x.png" alt="">
                    </span><span><?php echo $sh['release_time']; ?></span>
                    </div>
                  </div>
                </a>
              </li>
              <?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </ul>
            <input type="hidden" id="sid" value="<?php echo \think\Request::instance()->get('keyword'); ?>">
            <input type="hidden" id="page" value="1">
            <div class="more-btn" onclick="moreShang($('#sid').val(),$('#page').val(),this)" data-href="<?php echo url('/home/index/getInfo'); ?>" data-url="<?php echo url('/home/index/getshangPage'); ?>">查看更多</div>
          </div>
          <div class="tabs-items">
            <ul id="biao">
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
                <a href="<?php echo url('/home/index/getInfo',array('mid'=>$ww['id'])); ?>">
<!--                  <div class="tabs-items-img">-->
<!--                    <img src="./images/qitewentiyewu.jpg" alt="">-->
<!--                  </div>-->
                  <div class="tabs-items-content">
                    <div class="tabs-items-content-title">
                      <p><?php echo $ww['title']; ?></p>
                    </div>
                    <div class="tabs-items-content-text">
                      <p><?php echo $ww['describe']; ?></p>
                    </div>
                    <div class="tabs-items-content-time">
                      <span><img src="/static/spirit/images/shijian2x.png" alt=""></span>
                      <span><?php echo $ww['release_time']; ?></span>
                    </div>
                  </div>
                </a>
              </li>
              <?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </ul>
            <input type="hidden" id="bid" value="<?php echo \think\Request::instance()->get('keyword'); ?>">
            <input type="hidden" id="pages" value="1">
            <div class="more-btn" onclick="moreBiao($('#bid').val(),$('#pages').val(),this)" data-href="<?php echo url('/home/index/getInfo'); ?>" data-url="<?php echo url('/home/index/getbiaoPage'); ?>">查看更多</div>
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