<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:105:"C:\Users\Administrator\Desktop\phpEnv5.6.0-Green\www\hui\public/../application/home\view\index\index.html";i:1573611150;}*/ ?>
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>惠企云</title>
    <link rel="stylesheet" href="/static/home/css/base.css">
    <link rel="stylesheet" href="/static/home/css/index.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src='/static/home/js/index.js'></script>
    <script src="/static/assets/plugins/layui/layui.all.js"></script>
    <script src='/static/home/js/common.js'></script>
    <script src='/static/common/js/public.js'></script>
    <style>
        .header {
            background-image: url("<?php echo (isset($slideshow['pic']) && ($slideshow['pic'] !== '')?$slideshow['pic']:'/static/home/images/default.png'); ?>");
        }

        .success_icon>div:nth-of-type(1) {
            position: absolute;
            top: 3.0625rem;
            left: 0.875rem;
            width: 24.125rem;
            height: 10.375rem;
            background-size: contain;
            background-image: url('/static/home/images/huiduoxin.png');
            background-size: 100% 100%;
        }

        .success_icon>div:nth-of-type(2) {
            position: absolute;
            top: 6.625rem;
            right: -0.1875rem;
            width: 24.125rem;
            height: 10.375rem;
            background-size: 100%;
            background-image: url('/static/home/images/huichuangyou.png');
            background-size: 100% 100%;
        }

        .success_icon>div:nth-of-type(3) {
            position: absolute;
            top: 11.875rem;
            left: -1px;
            width: 24.125rem;
            height: 10.375rem;
            background-size: contain;
            background-image: url('/static/home/images/huilinggong.png');
            background-size: 100% 100%;
        }

        .success_icon>div:nth-of-type(4) {
            position: absolute;
            top: 14.3125rem;
            right: 0.375rem;
            width: 24.125rem;
            height: 10.375rem;
            background-size: 100%;
            background-image: url('/static/home/images/huizhaoshi.png');
            background-size: 100% 100%;
        }

        .success_icon>div:nth-of-type(5) {
            position: absolute;
            bottom: 6.6875rem;
            left: 0.75rem;
            width: 24.125rem;
            height: 10.375rem;
            background-size: contain;
            background-image: url('/static/home/images/huiqidong.png');
            background-size: 100% 100%;
        }

        .success_icon>div:nth-of-type(6) {
            position: absolute;
            bottom: 4.5rem;
            right: -0.4375rem;
            width: 24.125rem;
            height: 10.375rem;
            background-size: contain;
            background-image: url('/static/home/images/huichuangye.png');
            background-size: 100% 100%;
        }
    </style>

</head>

<body id="getdata" data="<?php echo $count; ?>">

    <div class='container'>



        <!-- 头部 -->
        <div class='header'>
            <!-- 头部图标 -->
            <div class='header_total' id='headerTotal'>
                <div class='header_line'>
                    <div class='w header_icon'>
                        <div class='title_icon'>
                            <span class='phone'></span>
                            <span><?php echo $site_info['tel']; ?></span>
                            <span class='email'></span>
                            <span><?php echo $site_info['mail']; ?></span>
                            <!--<span class='bo'></span>-->
                            <!--<span class='wx'></span>-->
                            <!--<span class='tie'></span>-->
                        </div>
                        <div class='title_lan'>中文</div>
                    </div>
                </div>

            </div>


            <!-- 头部其他内容 -->
            <div class='header_fixed'>
                <input type="hidden" id="data_token" value="<?php echo $userinfo['token']; ?>"/>
                <div class='header_content' id='headerContent'>
                    <div class='w content'>
                        <div class='content_logo' id='logo'></div>
                        <ul>
                            <li class="nav-active"><a href="<?php echo url('/home/index/index'); ?>">首页</a></li>
                            <li><a href="<?php echo url('/home/optimal/index'); ?>">惠优税</a></li>
                            <li><a href="<?php echo url('/home/spirit/index'); ?>">惠灵工</a></li>
                            <li><a href="<?php echo url('/home/many/index'); ?>">惠多薪</a></li>
                            <li><a href="<?php echo url('/home/business/index'); ?>">惠创业</a></li>
                            <li><a href="<?php echo url('/home/searches/index'); ?>">惠找事</a></li>
                            <li><a href="<?php echo url('/home/launch/index'); ?>">惠企动</a></li>
                        </ul>

                        <?php if(empty($userinfo['mobile'])): ?>
                        <div class='register'>
                            <!--<a href="<?php echo url('/home/login/login'); ?>">登录</a>-->
                            <a href="<?php echo $baseurl; ?>" target="_blank">登录</a>
                            <span></span>
                            <a href="<?php echo url('/home/login/register'); ?>">注册</a>
                        </div>
                        <?php else: ?>
                        <div class="u_info">
                            <img src="/static/home/images/user_img.png"
                                 style="width:30px;height:30px; vertical-align: middle;">
                            <p style="display:inline-block;color:#fff;"><?php echo $userinfo['mobile']; ?></p>
                            <div class="u_info_content" id="u_info_content">
                                <a class="u_out" href="javascript:void(0)" data-token="<?php echo $userinfo['token']; ?>" onclick="user_logout(this)" location_url="<?php echo url('/home/index/index'); ?>" data-url="<?php echo url('/home/login/logout'); ?>">退出账号</a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>


            <!-- 文字部分-->
            <div class='content_text'>
                <div class='w'><?php echo $slideshow['title']; ?></div>
            </div>

            <div class='rentong'>
                <div class='w'><?php echo $slideshow['desc']; ?></div>
            </div>

            <div class='btn'>
                <div class='w'>
                    <button onclick="showSearch()">定制您的方案</button>
                </div>
            </div>

        </div>


        <!-- 选择我们 -->
        <div class='chooseUs'>
            <div class="w choose">
                <div class='choose-title'>选择我们</div>
                <div class='choose-intro'>惠企云平台是一款基于国家政策、以合规化为基础、由金牌顾问团队打造的产品，为企业及个人提供税筹问题的全方位解决方案。</div>
                <ul class='img_total'>
                    <li>
                        <img src="/static/home/images/more.png" alt="">
                        <a href="#">集专家智“惠”定制</a>
                    </li>
                    <li>
                        <img src="/static/home/images/rainning.png" alt="">
                        <a href="#">集专家智“惠”定制</a>
                    </li>
                    <li>
                        <img src="/static/home/images/pig.png" alt="">
                        <a href="#">给您最优“惠”</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- 惠想产品 -->
        <div class='hui_product'>
            <div class='w'>
                <div class='product_logo'></div>
                <ul class='all_product'>
                    <?php if(is_array($protuct) || $protuct instanceof \think\Collection || $protuct instanceof \think\Paginator): $i = 0; $__LIST__ = $protuct;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                    <li>
                        <img src="<?php echo (isset($v1['imgs']) && ($v1['imgs'] !== '')?$v1['imgs']:''); ?>" alt="">
                        <a href="#"><?php echo (isset($v1['names']) && ($v1['names'] !== '')?$v1['names']:''); ?></a>
                        <a href="#"><?php echo (isset($v1['desc']) && ($v1['desc'] !== '')?$v1['desc']:''); ?></a>
                        <ul class='one_pic'>
                            <li><a onclick="showSearch()">获取方案</a></li>
                            <li><a href="<?php echo (isset($v1['purl']) && ($v1['purl'] !== '')?$v1['purl']:'#'); ?>">前往网站</a></li>
                        </ul>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>

        <div class="prop_box"></div>


        <!-- 近期成功案例 -->
        <input type="hidden" id="add_url" value="<?php echo url('/home/index/ajaximage'); ?>">
        <div class='success'>
            <div class='w success_content'>
                <div class='success_title'></div>
                <div class='success_icon'>
                    <?php if(is_array($case_list) || $case_list instanceof \think\Collection || $case_list instanceof \think\Paginator): $i = 0; $__LIST__ = $case_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data_list): $mod = ($i % 2 );++$i;?>
                    <div onclick="click_show(this)" keys="<?php echo $key; ?>" class="<?php echo $data_list['is_show'].$key; ?>" data="<?php echo $count; ?>"
                        data-attr="<?php echo $data_list['is_show']; ?>">
                        <div class='<?php if($key == 1): ?>hui_icon<?php else: ?>p_icon<?php endif; ?>'>
                            <div><?php echo $data_list['title2']; ?></div>
                            <div><?php echo $data_list['title3']; ?></div>
                            <?php if($key != 1): ?>
                            <!--<a href="javascript:void(0)">-->
                            <!--<img src="/static/home/images/jiantou.png" alt="">-->
                            <!--</a>-->
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                </div>
                <div class='to_detailInfo'>
                    <?php if(is_array($case_list) || $case_list instanceof \think\Collection || $case_list instanceof \think\Paginator): $i = 0; $__LIST__ = $case_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info_list): $mod = ($i % 2 );++$i;?>
                    <div class="<?php echo $info_list['is_show']; ?>">
                        <div class='huichuangyou_title'><?php echo $info_list['title']; ?></div>
                        <div class="con">
                            <div class="desc"><?php echo $info_list['desc']; ?></div>
                            <div class="desc"><?php echo $info_list['desc2']; ?></div>
                            <div class="desc"><?php echo $info_list['desc3']; ?></div>
                            <div class="desc"><?php echo $info_list['desc4']; ?></div>
                            <div class="desc"><?php echo $info_list['desc5']; ?></div>
                            <div class="desc"><?php echo $info_list['desc6']; ?></div>
                            <div class="desc"><?php echo $info_list['desc7']; ?></div>
                            <div class='total_input'>
                                <div>
                                    <input type="text" id='contactName' placeholder="请输入您的姓名..">
                                </div>
                                <div>
                                    <input type="text" id="companyName" placeholder="请输入您的公司名称..">
                                </div>
                                <div>
                                    <input type="text" id='contactMobile' placeholder="请输入您的手机号..">
                                </div>
                                <div>
                                    <input type='hidden' id='source' value='门户首页'>
                                    <input type='hidden' id='identification' value='企业一站式服务'>
                                    <input type="button" onclick='getErp()' value='定制您的方案'>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                </div>
            </div>
        </div>




        <!-- 招标信息政策 -->
        <div class='zhaoBox'>
            <div class='zhaoInfo'>
                <div class='diandianone'></div>
                <div class='diandiantwo'></div>
                <div class='w'>
                    <div class='search_info'>
                        <div class='zhao_title'>
                        </div>

                        <!-- 搜索 -->
                        <div class='zhaoSearch'>
                            <div class='searchLogo'>
                                <i onclick="search(this)" data-url="<?php echo url('/home/index/infoList'); ?>"></i>
                                <input type="text" id="keyword" placeholder="搜索招标政策和招标信息...">
                            </div>
                            <!-- <button>查询</button> -->
                        </div>
                    </div>

                    <div class='zhaomethods'>
                        <div class='totalInfo_title'>招商政策</div>
                        <?php if(is_array($shang) || $shang instanceof \think\Collection || $shang instanceof \think\Paginator): $i = 0; $__LIST__ = $shang;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ss): $mod = ($i % 2 );++$i;?>
                        <div class='totalInfo_content'>
                            <a href="javascript:void(0)"
                               data-url="<?php echo url('/home/index/getInfo',['mid' => $ss['id']]); ?>"
                               login_url="<?php echo url('/home/login/login',['type' => 1,'id' => $ss['id']]); ?>"
                               mobile-phone="<?php echo $userinfo['mobile']; ?>"
                               data-id="<?php echo $ss['id']; ?>" onclick="home_module.show_detail(this)">
                                <div class='zhao_contentInfo'>
                                    <div><?php echo $ss['title']; ?></div>
                                    <div>
                                        <?php echo $ss['release_time']; ?>
                                    </div>
                                </div>
                                <div> <?php echo $ss['describe']; ?></div>
                            </a>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <button class='know_more' mobile-phone="<?php echo $userinfo['mobile']; ?>" onclick="showUrl(this)"
                            data-url="<?php echo url('/home/index/infoList'); ?>"
                            login_url="<?php echo $baseurl; ?>">了解更多</button>
                    </div>

                    <div class='zhaoTotalInfo'>
                        <div class='totalInfo_title'>招标信息</div>
                        <?php if(is_array($biao) || $biao instanceof \think\Collection || $biao instanceof \think\Paginator): $i = 0; $__LIST__ = $biao;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$biaos): $mod = ($i % 2 );++$i;?>
                        <div class='totalInfo_content'>
                            <a href="javascript:void(0)"
                               data-url="<?php echo url('/home/index/getInfo',['mid' => $ss['id']]); ?>"
                               login_url="<?php echo $baseurl; ?>"
                               mobile-phone="<?php echo $userinfo['mobile']; ?>" data-id="<?php echo $ss['id']; ?>" onclick="home_module.show_detail(this)">
                                <div class='zhao_contentInfo'>
                                    <div><?php echo (isset($biaos['title']) && ($biaos['title'] !== '')?$biaos['title']:''); ?></div>
                                    <div>
                                        <?php echo $biaos['release_time']; ?>
                                    </div>
                                </div>
                                <div>
                                    <?php echo $biaos['describe']; ?>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>

                        <button class='know_more' mobile-phone="<?php echo $userinfo['mobile']; ?>" onclick="showUrl(this)"
                            data-url="<?php echo url('/home/index/infoList'); ?>"
                            login_url="<?php echo $baseurl; ?>">了解更多</button>

                    </div>

                </div>
            </div>
        </div>


        <!-- 合作伙伴 -->
        <div class='partener'>
            <div class='w partener_total'>
                <div class='parter_icon'></div>

                <!-- <div class='search' id='search'>
                    <input type="text" placeholder="请输入姓名">
                    <input type="text" placeholder="请输入公司名称">
                    <input type="text" placeholder="请输入手机号码">
                    <input type="button" value='定义方案'>
                </div> -->
            </div>

        </div>


        <div class='partner_bottom'>
            <div class='w content'>
                <div class='partener_titile'>用智“慧”创造优“惠”</div>
                <div class='parterne_info'>
                    深耕税筹行业多年，合作企业多达几千家。专业为个人和企业解决税务难题。为您提供一站式金融、税务和人力外包服务，以及专业的税筹划分析，最安全、高效、合理的节税措施。我们有最成熟的专家团队和各行业实操经验！作为国内领先的标准化税筹服务互联网平台，我们得到了上海、安徽、江西、湖北等各地政府的大力支持，为企业节税保驾护航！
                </div>
                <div class='parter_catefories'>
                    <dl>
                        <dt>服务产品</dt>
                        <dd>服务型税筹</dd>
                        <dd>门户型税筹</dd>
                        <dd>人力资源</dd>
                    </dl>
                    <dl>
                        <dt>招商政策</dt>
                        <dd>招商政策网</dd>
                    </dl>
                    <dl>
                        <dt>合作</dt>
                        <dd>代理合作</dd>
                    </dl>
                    <dl>
                        <dt>公司信息</dt>
                        <dd>瑟维斯有限公司</dd>
                        <dd>惠创优产业联盟</dd>
                        <dd>中兴瑞华有限公司</dd>
                    </dl>
                    <dl>
                        <dt>联系我们</dt>
                        <dd><?php echo $site_info['tel']; ?></dd>
                        <dd><?php echo $site_info['mail']; ?></dd>
                        <dd><?php echo $site_info['count_code']; ?></dd>
                    </dl>

                </div>
                <!--<div class='concat_icon'>-->
                <!--<div><img src="/static/home/images/bo.png" alt=""></div>-->
                <!--<div><img src="/static/home/images/wx.png" alt=""></div>-->
                <!--<div><img src="/static/home/images/tie.png" alt=""></div>-->
                <!--</div>-->
            </div>
        </div>



        <div class='goTop' id="goTop">
            <i></i>
            <div>返回顶部</div>
        </div>

    </div>
    <script>



/*        function user_logout(objthis){
            var baseUrl = 'http://172.26.2.215:8089';
            //var url = $(objthis).attr('data-url');
            var url = baseUrl + '/api/huser/goOut';;
            var url2 = $(objthis).attr('location_url');
            var tokens = $(objthis).attr('data-token');
            $.ajax({
                type: "post",
                url: url,
                data: '',
                headers: {
                    "Content-Type": "application/json",
                    "Authorization":tokens
                },
                dataType: 'json',
                success: function (ret) {

                },
                error: function (data) {
                    console.log(data)
                }
            });
        }*/
    </script>
</body>

</html>