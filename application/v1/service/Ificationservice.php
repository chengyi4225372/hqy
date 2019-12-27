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
    public function getlist($params)
    {
        $where = [];
        if (isset($params['title']) && !empty($params['title'])) {
            //将中文逗号替换成英文逗号
            if (strpos($params['title'], '，')) {
                $params['title'] = str_replace('，', ',', $params['title']);
            }
            //将空格替换成英文逗号
            $params['title'] = preg_replace('/\s{1,}/', ' ', $params['title']);
            $params['title'] = str_replace(' ', ',', $params['title']);
            $params['title'] = explode(',', $params['title']);

            $params['title'] = array_filter($params['title'], function ($params) {
                return !empty($params);
            });
            $caseArr = array_map(function ($par) {
                return '%' . $par . '%';
            }, $params['title']);

            $where['title'] = ['LIKE', $caseArr, 'OR'];
        }

        if (!empty($params['status'])) {
            $where['status'] = $params['status'];
        }

        if (!empty($params['disable'])) {
            $arr = array_map(function ($par) {
                return '%' . $par . '%';
            }, $params['disable']);
            $where['disable'] = ['like', $arr, 'OR'];
        }

        $list = Ification::instance()->where($where)->order('sort desc')->paginate(15);
        return $list;
    }

    /**
     * @id 用户id
     * 标签详情
     */
    public function getIdinfo($id)
    {

        if (empty($id) || $id <= 0 || is_null($id)) {
            return false;
        }

        $info = Ification::instance()->where(['id' => $id])->find();
        if (count($info) > 0) {
            $info['id'] = $info['id'];
            $info['title'] = $info['title'];
            $info['sort'] = $info['sort'];
            $info['create_time'] = $info['create_time'];
            $info['status'] = $info['status'];
            $info['disable'] = explode(',', $info['disable']);
        } else {
            $info = [];
        }
        return empty($info) ? '' : $info;
    }

    /**
     * 伪删除
     * @id 用户id
     */
    public function saveStatus($params)
    {
        $ret = Ification::instance()->where(['id' => $params['id']])->update(['status' => $params['status']]);
        if ($ret === false) {
            return false;
        }
        return true;
    }

    /**
     * 添加
     * @data 数据
     */
    public function insertData($data)
    {

        if (empty($data)) {
            return false;
        }

        $ret = Ification::instance()->insert($data);
        if ($ret) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 编辑
     * @id id
     * @data 数据
     */
    public function editData($id, $data)
    {
        if (empty($id) || $id <= 0 || is_null($id) || !isset($id)) {
            return false;
        }

        if (empty($data)) {
            return false;
        }

        $ret = Ification::instance()->where(['id' => $id])->data($data)->update();

        if ($ret) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * 编辑排序
     * @id id
     * @sort array
     */
    public function saveSort($id, $sort)
    {
        if (is_null($id) || $id <= 0 || !isset($id)) {
            return false;
        }

        if (empty($sort) || $sort == 0) {
            $data = ['sort' => 1];
        }

        $data = ['sort' => $sort];

        $res = Ification::instance()->where(['id' => $id])->data($data)->update();

        if ($res) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * @DESC：获取招标的关键字安排续的最近的四条数据
     * @author: jason
     * @date: 2019-12-24 06:24:49
     */
    public function getBiaofour($params)
    {
        if(empty($params)) return [];
        $where['disable'] = ['like', '%'.$params.'%'];
        $where['status'] = 1;
        $resfour = collection(Ification::instance()->where($where)->order('sort desc')->limit(6)->select())->toArray();
        return $resfour ? $resfour : '';
    }

    /**
     * 获取最高四条数据
     */
    public function getfour()
    {
        $where['disable'] = ['like', 1];
        $resfour = Ification::instance()->where(['status' => 1])->order('sort desc')->limit(4)->select();

        return $resfour ? $resfour : '';
    }
}