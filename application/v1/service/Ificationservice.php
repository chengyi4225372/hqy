<?php
/**
 * 关键字 标签 分类
 */
namespace app\v1\service;

use app\common\model\Admin;
use app\common\model\Ification;
use plugin\Tree;
use plugin\Crypt;
use think\Config;

class Ificationservice
{
    // 静态对象
    protected static $instance = null;

    /**
     * @DESC：单例
     * @return null|static
     * @author: jason
     * @date: 2019-07-26 10:00:16
     */
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * @title  搜索标题
     * @列表页
     */
     public function getlist($title){
         if(empty($title)){
             $list = Ification::instance()->where(['status'=>1])->order('sort desc')->paginate(15);
         }

         if(!empty($title)){
             $list = Ification::instance()->where(['status'=>1,'title'=>['like','%'.$title.'%']])->order('sort desc')->paginate(15);
         }

         return $list;
     }

     /**
      * @id 用户id
      * 标签详情
      */
     public function getIdinfo($id){

         if(empty($id) || $id <=0 || is_null($id)){
             return false;
         }

         $info = Ification::instance()->where(['status'=>1,'id'=>$id])->find();

         return empty($info)?'':$info;
     }

     /**
      * 伪删除
      * @id 用户id
      */
     public function saveStatus($id){
         if(empty($id) || is_null($id) || $id<=0){
             return false;
         }

         $ret = Ification::instance()->where(['id'=>$id])->update(['status'=>-1]);

         if($ret){
             return true;
         }else {
             return false;
         }
     }

     /**
      * 添加
      * @data 数据
      */
     public function insertData($data){

         if(empty($data)){
             return false;
         }

         $ret = Ification::instance()->save($data);

         if($ret){
             return true;
         }else {
             return false;
         }
     }

     /**
      * 编辑
      * @id id
      * @data 数据
      */
     public function editData($id,$data){
         if(empty($id) || $id <= 0 || is_null($id) || !isset($id)){
             return false;
         }

         if(empty($data)){
             return false;
         }

         $ret = Ification::instance()->where(['id'=>$id])->data($data)->update();

         if($ret){
             return true;
         }else {
             return false;
         }

     }

     /**
      * 编辑排序
      * @id id
      * @sort array
      */
     public function saveSort($id,$sort){
         if(is_null($id) || $id<=0 || !isset($id)){
             return false;
         }

         if(empty($sort) || $sort == 0){
             $data = ['sort'=>1];
         }

         $data  = ['sort'=>$sort];

         $res = Ification::instance()->where(['id'=>$id])->data($data)->update();

         if($res){
             return true;
         }else {
             return false;
         }

     }

     /**
      * 获取最高四条数据
      */
     public function getfour(){
         $resfour = Ification::instance()->where(['status'=>1])->order('sort desc')->limit(4)->select();

         return $resfour?$resfour:'';
     }
}