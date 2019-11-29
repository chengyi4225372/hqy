<?php
namespace app\home\controller;

use app\common\controller\BaseController;
use app\v1\service\Workservice;
use think\Controller;
use app\v1\service\Protuctservice;
use app\v1\service\Infosservice;
use app\v1\service\Systems;
use app\v1\service\Caseservice;
use app\v1\service\Ificationservice;
use think\Cookie;
use think\Cache;
class Index extends BaseController
{

    public function index()
    {
        if ($this->request->isGet()) {

            //慧享产品
            $array = array('status' => '1');
            $protuct = Protuctservice::instance()->normal($array);
            $this->assign('protuct', $protuct);

            //招标 招商信息
            $biao = Infosservice::instance()->biao(['pid' => 1]);
            $shang = Infosservice::instance()->shang(['pid' => 2]);

            //轮播
            $slideshow = Systems::instance()->getOneshow();

            //有关电话号码、邮箱、地址
            $siteInfo = Systems::instance()->getOneSite();

            //近期成功案例

            $caseInfo = Caseservice::instance()->getallparent();
            $pic = array_column($caseInfo,'pic');
            $pic2 = array_column($caseInfo,'pic2');
            $this->assign('pic1',json_encode($pic));
            $this->assign('pic2',json_encode($pic2));
            $this->assign('count',count($caseInfo));
            $this->assign('case_list', $caseInfo);


            $this->assign('site_info',$siteInfo);

            $this->assign('slideshow', $slideshow);
            $this->assign('biao', $biao);
            $this->assign('shang', $shang);
            //用户信息
            $this->assign('userinfo',$this->userinfo);
            return $this->fetch();
        }
        return false;
    }

    /**
     * @DESC：ajax获取案例图片
     * @author: jason
     * @date: 2019-10-28 10:27:42
     */
    public function ajaximage(){
        if($this->request->isAjax() && $this->request->isPost() && $_POST['data'] == 'getdata'){
            $caseInfo = Caseservice::instance()->getallparent();
            $pic_arr = [];
            $pic2_arr = [];
            foreach($caseInfo as $key => $value){
                $pic_arr[$key]['pic1'] = $value['pic'];
                $pic_arr[$key]['is_show'] = $value['is_show'];
                $pic2_arr[$key]['pic2'] = $value['pic2'];
                $pic2_arr[$key]['is_show'] = $value['is_show'];
                $pic2_arr[$key]['is_pic1'] = $value['pic'];
            }
            return json(['pic1' => $pic_arr,'pic2' => $pic2_arr]);
        }
    }


    /**
     * 招商列表页面
     */
    public function infoList(){
       if($this->request->isGet()){

//           if(Cookie('mobile') == '' || Cookie('mobile') == NULL || Cookie('mobile') == 0 ){
//               return $this->redirect('/home/index/index');
//           }
           // 招商信息
           $keyword   = input('get.keyword','','trim');
           $title     = input('get.title','','trim');

           $titles    =$keyword?$keyword:$title;

           $shang = Infosservice::instance()->getshang($titles,20);

           //关键字排序 最高四条
           $four = Ificationservice::instance()->getfour();

           $this->assign('shang',$shang);
           $this->assign('title','招商招标信息列表');
           $this->assign('four',$four);
           return $this->fetch();
       }
       return false;
    }


    /**
     * 招标列表页
     */
     public function infoBiao(){
         if($this->request->isGet()){

//           if(Cookie('mobile') == '' || Cookie('mobile') == NULL || Cookie('mobile') == 0 ){
//               return $this->redirect('/home/index/index');
//           }
             // 招商信息
             $keyword   = input('get.keyword','','trim');//正常搜索
             $title     = input('get.title','','trim'); //热门搜索

             $titles    =$keyword?$keyword:$title;

             $biao = Infosservice::instance()->getbiao($titles,30);

             //关键字排序 最高四条
             $four = Ificationservice::instance()->getfour();
             $this->assign('biao',$biao);
             $this->assign('four',$four);
             $this->assign('title','招标信息列表');
             return $this->fetch();
         }
         return false;
     }


    /**
     * 新闻详情页
     * min  string | int
     */
    public function getInfo(){
        if($this->request->isGet()){
//            if(Cookie('mobile') == '' || Cookie('mobile') == NULL || Cookie('mobile') == 0 ){
//                return $this->redirect('/home/index/index');
//            }

           $id = input('get.mid','','int');
           if(empty($id) || !isset($id)|| $id <=0){
               return false;
           }
           $info = infosservice::instance()->getId($id);
           $top  = Infosservice::instance()->getTop($id);
           $next = Infosservice::instance()->getNext($id);
           $this->assign('info',$info);
           $this->assign('top',$top);
           $this->assign('next',$next);
           $this->assign('title','新闻详情');
           return $this->fetch();
        }
        return false;
    }


    /**
     * 招商信息 接口
     * keyword string
     * page string |id
     */
    public function getshangPage(){
        $keyword = input('get.keyword','','trim');
        $page    = input('get.page','','int');

        $list  =  Infosservice::instance()->getshang($keyword,$page);

        if(empty($list)){
            return json(['code'=>404,'msg'=>'没有更多了']);
        }

        if(isset($list) && !empty($list)){
            return json(['code'=>200,'msg'=>'请求成功','data'=>$list]);
        }

    }


    /**
     * 招标信息 接口
     */
    public function getbiaoPage(){
        $keyword = input('get.keyword','','trim');
        $page    = input('get.page','','int');

        $list  =  Infosservice::instance()->getbiao($keyword,$page);

        if(empty($list)){
            return json(['code'=>404,'msg'=>'没有更多了！']);
        }

        if(isset($list) && !empty($list)){
            return json(['code'=>200,'msg'=>'请求成功','data'=>$list]);
        }

    }
}