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
//            echo '<pre>';print_r($caseInfo);exit;
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
           $this->assign('title','政府招商信息');
           $this->assign('four',$four);
           return $this->fetch();
       }
       return false;
    }

    /**
     * @DESC：招商信息详情
     * @return bool|mixed
     * @author: jason
     * @date: 2019-12-06 03:36:41
     */
    public function detailshang()
    {
        if($this->request->isGet()){
//            if(Cookie('mobile') == '' || Cookie('mobile') == NULL || Cookie('mobile') == 0 ){
//                return $this->redirect('/home/index/index');
//            }

            $id = input('get.mid','','int');
            if(empty($id) || !isset($id)|| $id <=0){
                return false;
            }
            $info = infosservice::instance()->getId($id);
            $top  = Infosservice::instance()->getTop($id,2);
            $next = Infosservice::instance()->getNext($id,2);
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
    public function getshangapi(){
       if($this->request->isPost() || $this->request->isAjax()){
           $title = input('post.title', '', 'trim'); //热门搜索
           $page  = input('post.page','','int');
           $titles = $title? $title: '';
           $page  = $page ?$page :'1';//当前页数
           $size  = 35; //每页显示条数

           $data   = Infosservice::instance()->getshangjson($titles, $page,$size);
           $count  =  Infosservice::instance()->getshangcount($titles);
           $countpage = ceil($count / $size);

           if(!empty($data)){
               return json(['data'=>$data,'page'=>$page,'size'=>$size,'count'=>$countpage,'code'=>200,'msg'=>'success']);
           }

           if(empty($data)){
               return json(['data'=>'','code'=>400,'msg'=>'error']);
           }
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
     * 招标信息 接口
     */
    public function getbiaoapi(){
        if($this->request->isPost() || $this->request->isAjax()){
            $title = input('post.title', '', 'trim'); //热门搜索
            $page  = input('post.page','','int');
            $titles = $title? $title: '';
            $page  = $page ?$page :'1';//当前页数
            $size  = 35; //每页显示条数

            $data   = Infosservice::instance()->getbiaojson($titles, $page,$size);
            $count  =  Infosservice::instance()->getbiaocount($titles);
            $countpage = ceil($count / $size);

            if(!empty($data)){
                return json(['data'=>$data,'page'=>$page,'size'=>$size,'count'=>$countpage,'code'=>200,'msg'=>'success']);
            }

            if(empty($data)){
                return json(['data'=>'','code'=>400,'msg'=>'error']);
            }

        }

        return false;
    }

    /**
     * @DESC：招标信息详情
     * @return bool|mixed
     * @author: jason
     * @date: 2019-12-06 03:33:14
     */
    public function detailbiao()
    {
        if($this->request->isGet()){
//            if(Cookie('mobile') == '' || Cookie('mobile') == NULL || Cookie('mobile') == 0 ){
//                return $this->redirect('/home/index/index');
//            }

            $id = input('get.mid','','int');
            if(empty($id) || !isset($id)|| $id <=0){
                return false;
            }
            $info = infosservice::instance()->getId($id);
            $top  = Infosservice::instance()->getTop($id,1);
            $next = Infosservice::instance()->getNext($id,1);
            $this->assign('info',$info);
            $this->assign('top',$top);
            $this->assign('next',$next);
            $this->assign('title','招标信息详情');
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
     * @DESC：行业资讯
     * @return bool|mixed
     * @author: jason
     * @date: 2019-12-12 05:54:46
     */
    public function industry()
    {
        if($this->request->isGet()){

//           if(Cookie('mobile') == '' || Cookie('mobile') == NULL || Cookie('mobile') == 0 ){
//               return $this->redirect('/home/index/index');
//           }
            // 招商信息
            $keyword   = input('get.keyword','','trim');//正常搜索
            $title     = input('get.title','','trim'); //热门搜索

            $titles    =$keyword?$keyword:$title;

            $biao = Infosservice::instance()->getIndustry($titles,30);

            //关键字排序 最高四条
            $four = Ificationservice::instance()->getfour();
            $this->assign('biao',$biao);
            $this->assign('four',$four);
            $this->assign('title','行业资讯');
            return $this->fetch();
        }
        return false;
    }

    /**
     * 行业资讯关键字接口
     */
    public function industryapi(){
        if($this->request->isPost() || $this->request->isAjax()) {
            //行业资讯
            $title = input('post.title', '', 'trim'); //热门搜索
            $page  = input('post.page','','int');
            $titles = $title? $title: '';
            $page  = $page ?$page :'1';//当前页数
            $size  = 40; //每页显示条数
            $data   = Infosservice::instance()->getindustryjson($titles, $page,$size);
            $count  =  Infosservice::instance()->getindustrycount($titles);
            $countpage = ceil($count / $size);
            if(!empty($data)){
                return json(['data'=>$data,'page'=>$page,'size'=>$size,'count'=>$countpage,'code'=>200,'msg'=>'success']);
            }

            if(empty($data)){
                return json(['data'=>'','code'=>400,'msg'=>'error']);
            }

        }
        return false;
    }

    /**
     * @DESC：资讯
     * @return bool|mixed
     * @author: jason
     * @date: 2019-12-12 06:03:12
     */
    public function industrydetail()
    {
        if($this->request->isGet()){
//            if(Cookie('mobile') == '' || Cookie('mobile') == NULL || Cookie('mobile') == 0 ){
//                return $this->redirect('/home/index/index');
//            }

            $id = input('get.mid','','int');
            if(empty($id) || !isset($id)|| $id <=0){
                return false;
            }

            $info = infosservice::instance()->getId($id,3);

            $top  = Infosservice::instance()->getTop($id,3);
            $next = Infosservice::instance()->getNext($id,3);
            $this->assign('info',$info);
            $this->assign('top',$top);
            $this->assign('next',$next);
            $this->assign('title','招标信息详情');
            return $this->fetch();
        }
        return false;
    }
}