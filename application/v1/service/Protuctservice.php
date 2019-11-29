<?php
namespace app\v1\service;
use app\common\model\Protuct;
use plugin\Tree;
use plugin\Crypt;
use think\Config;
/**
 * Class Userservice
 * @package app\v1\service
 */
class Protuctservice
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
     * 获取所有产品
     */
    public function getList($names){
      if(empty($names) || !isset($names)){
          $list = Protuct::instance()->where(['del_time'=>0])->order(['id'=>'desc'])->paginate(15);
      }

      if(!empty($names) && isset($names)){
      $list = Protuct::instance()->where(['del_time'=>0,'names'=>['like','%'.$names.'%']])->order(['id'=>'desc'])->paginate(15);
      }
       return $list;
    }


    /**
     * 添加数据
     */
     public function protuctAdd($param){
         $ret = Protuct::instance()->data($param)->save();
          return  $ret;
     }


    /**
     * 编辑
     * arr  array
     * id  string
     * return bool
     */
     public function updateByid($arr,$id){
         $ret = Protuct::instance()->where(['id'=>$id])->update($arr);
         return $ret;
     }

    /**
     * $array array
     * 正常数据
     */
    public function normal($array){
        $nlist = Protuct::instance()->where($array)->order('id desc')->select();
        return $nlist;
    }


    /**
     * @DESC：首页统计惠享产品的数量
     * @return mixed
     * @author: jason
     * @date: 2019-10-31 09:36:25
     */
    public function getproductcount()
    {
        $info = Protuct::instance()->where(['status' => 1])->count();
        return $info;
    }
}