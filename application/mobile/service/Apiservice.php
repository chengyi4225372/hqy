<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2020/1/3
 * Time: 9:12
 */
namespace app\mobile\service;
use app\common\model\Protuct;
use app\common\model\Info;
class Apiservice
{
    protected static $instance = null;

    /**
     * @DESC：单例
     * @return null|static
     * @author: jason
     * @date: 2019-08-05 03:48:37
     */
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * @DESC：获取惠享产品
     * @return array
     * @author: jason
     * @date: 2020-01-03 10:23:15
     */
    public function getProduct()
    {
        $productModel = new Protuct();
        $where = [];
        $where['status'] = 1;
        $info = collection($productModel->instance()->where($where)->select())->toArray();
        return !empty($info) ? $info : [];
    }

    /**
     * @DESC：查询两条最新的招标的信息
     * @author: jason
     * @date: 2020-01-03 02:49:33
     */
    public function gettwobiao($pid = 0)
    {
        $where = [];
        $where['pid'] = $pid;
        $where['status'] = 1;
        $where['auditing'] = 1;
        $order = 'id desc,release_time desc';
        $info = collection(Info::instance()->where($where)->order($order)->select())->toArray();
    }

}