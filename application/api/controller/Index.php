<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/1/3
 * Time: 9:06
 */
namespace  app\api\controller;

use Think\Controller;
use app\v1\service\Infosservice;
class Index extends Controller{

    /**
     * 招标信息列表
     *
     */
    public function apibiaolist(){
        if($this->request->isPost()){
            $array=[
                'status' => 1,
                'auditing' =>1,
                'pid' =>1,
            ];

            $list = Infosservice::instance()->where($array)->order('id desc,release_time desc')->select();
            if(!empty($list) || isset($list)){
                return json(['code'=>2000,'msg'=>'success','data'=>$list]);
            }else {
                return json(['code'=>4000,'msg'=>'error','data'=>'当前请求数据不存在']);
            }
        }
        return false;
    }

    /**招标详情
     * @id int|string
     */
    public function apibiaogetinfo(){
        if($this->request->isPost()){

            $id =  input('post.id','','trim');

            if(empty($id) || !isset($id)||$id <=0){
                return json(['code'=>4003,'msg'=>'传递数据不合法!']);
            }

            $array=[
                'status' => 1,
                'auditing' =>1,
                'pid' =>1,
                'id'=>$id,
             ];

            $info = Infosservice::instance()->where($array)->order('id desc,release_time desc')->find();

            if(!empty($info) || !isset($info)){
                return json(['code'=>2000,'msg'=>'success','data'=>$info]);
            }else{
                return json(['code'=>4004,'msg'=>'error','data'=>'请求数据不存在']);
            }
        }
        return false;
    }

   /**
    * 招商政策
    */
    public function apishanglist(){
       if($this->request->isPost()){
               $array=[
                   'status' => 1,
                   'auditing' =>1,
                   'pid' =>2,
               ];

               $list = Infosservice::instance()->where($array)->order('id desc,release_time desc')->select();
               if(!empty($list) || isset($list)){
                   return json(['code'=>2000,'msg'=>'success','data'=>$list]);
               }else {
                   return json(['code'=>4000,'msg'=>'error','data'=>'当前请求数据不存在']);
               }
           }
       return false;
   }

   /**
    * 招商信息详情
    * @id int|string
    */
    public function apishanggetinfo(){
       if($this->request->isPost()){
           $id =  input('post.id','','trim');

           if(empty($id) || !isset($id)||$id <=0){
               return json(['code'=>4003,'msg'=>'传递数据不合法!']);
           }

           $array=[
               'status' => 1,
               'auditing' =>1,
               'pid' =>2,
               'id'=>$id,
           ];

           $info = Infosservice::instance()->where($array)->order('id desc,release_time desc')->find();

           if(!empty($info) || !isset($info)){
               return json(['code'=>2000,'msg'=>'success','data'=>$info]);
           }else{
               return json(['code'=>4004,'msg'=>'error','data'=>'请求数据不存在']);
           }
       }
       return false;
   }

   /**
    *行业资讯
   */
    public function apiindustrylist(){
       if($this->request->isPost()){
           $array=[
               'status' => 1,
               'auditing' =>1,
               'pid' =>3,
           ];

           $list = Infosservice::instance()->where($array)->order('id desc,release_time desc')->select();
           if(!empty($list) || isset($list)){
               return json(['code'=>2000,'msg'=>'success','data'=>$list]);
           }else {
               return json(['code'=>4000,'msg'=>'error','data'=>'当前请求数据不存在']);
           }
       }
       return false;
   }

   /**
    * 行业资讯详情
    * @id string|int
    */
    public function apiindustrygetinfo(){
       if($this->request->isPost()){
           $id =  input('post.id','','trim');

           if(empty($id) || !isset($id)||$id <=0){
               return json(['code'=>4003,'msg'=>'传递数据不合法!']);
           }

           $array=[
               'status' => 1,
               'auditing' =>1,
               'pid' =>3,
               'id'=>$id,
           ];

           $info = Infosservice::instance()->where($array)->order('id desc,release_time desc')->find();

           if(!empty($info) || !isset($info)){
               return json(['code'=>2000,'msg'=>'success','data'=>$info]);
           }else{
               return json(['code'=>4004,'msg'=>'error','data'=>'请求数据不存在']);
           }
       }
       return false;
   }
}