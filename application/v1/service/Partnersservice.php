<?php
namespace app\v1\service;
use app\common\model\Partners;
use plugin\Tree;
use plugin\Crypt;
use think\Config;
/**
 * Class Userservice
 * @package app\v1\service
 */
class Partnersservice
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
    public function getList()
    {
      $list = Partners::instance()->order('id desc')->paginate(15);
      return $list;
    }

    /**
     *  id string
     *  return array()
     * 获取详情
     */
    public function  getInfoId($id){
        $info = Partners::instance()->where(['id'=>$id])->find();
        return $info;
    }


   /**
    *  param array
    *  return bool
    *  添加
    */
    public function add($param){
        $ret = Partners::instance()->save($param);
        return $ret;
    }

    /**
     *  param array
     *  id string
     * return bool
     * 通过id 更新
     */
     public function updateId($param,$id){
         $ret = Partners::instance()->where(['id'=>$id])->update($param);
         return $ret;
     }


}
