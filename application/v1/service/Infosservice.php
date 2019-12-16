<?php
namespace app\v1\service;

use app\common\model\Info;
use plugin\Tree;
use plugin\Crypt;
use think\Config;
use think\Cookie;

class Infosservice
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
     * @DESC：获取所有产品
     * @param $params
     * @return mixed
     * @author: jason
     * @date: 2019-12-05 04:38:11
     */
    public function getList($params)
    {
        $where = [];
        //按字段类型搜索
        if (!empty($params['searchField']) && !empty($params['searchValue'])) {
            $searchValue = preg_replace("/(\n)|(\s)|(\t)|(\')|(')|(，)/", ',', trim($params['searchValue']));
            $searchValue = explode(',', $searchValue);

            $searchValue = array_filter($searchValue, function ($par) {
                return !empty($par);
            });
            switch ($params['searchField']) {
                case 1:
                    $good = array_map(function ($param) {
                        return '%' . $param . '%';
                    }, $searchValue);
                    $where['title'] = array('like', $good, 'or');
                    break;
                case 2:
                    $good = array_map(function ($param) {
                        return '%' . $param . '%';
                    }, $searchValue);
                    $where['keyword'] = array('like', $good, 'or');
                    break;
                case 3:
                    $good = array_map(function ($param) {
                        return '%' . $param . '%';
                    }, $searchValue);
                    $where['describe'] = array('like', $good, 'or');
                    break;
            }
        }
        if(!empty($params['category'])){
            $where['pid'] = $params['category'];
        }
        $where['status'] = ['GT',0];
        $list = Info::instance()->where($where)->order('sort desc,release_time desc')->paginate(15);
        return $list;
    }

    /**
     * @DESC：招标、招商信息审核
     * @param $params
     * @return bool
     * @author: jason
     * @date: 2019-12-12 05:48:29
     */
    public function auditing($params)
    {
        if(empty($params)){
            return false;
        }
        $save = [];
        $where = [];
        $save['auditing'] = 1;
        $save['audit_user'] = Cookie('username');

        $where['id'] = $params['id'];
        $res = Info::instance()->where($where)->update($save);
        if($res === false){
            return false;
        }
        return true;
    }

    /**
     * @param $array
     * @return mixed
     */
    public function saves($array)
    {
        $ret = Info::instance()->data($array)->save();
        return $ret;
    }

    //更新
    public function updateId($arr, $id)
    {
        if (empty($id)) {
            return false;
        }
        $rest = Info::instance()->where('id', $id)->update($arr);
        return $rest;
    }

    /**
     * @param $id
     * @return mixed
     * 通过id 获取信息
     */
    public function getId($id)
    {
        $where = [];
        $where['auditing'] = 1;
        $where['id'] = $id;
        $info = Info::instance()->where($where)->find();
        return $info;
    }

    /**
     * 招标信息
     *  array('pid'=>1)
     */
    public function biao($array)
    {
        $array = [];
        $array['status'] = 1;
        $array['auditing'] = 1;
        $arr = Info::instance()->where($array)->order('sort desc,release_time desc')->limit(0, 2)->select();
        return $arr;
    }

    /**
     * 招商信息
     *  array('pid'=>2)
     */
    public function shang($array)
    {
        $array = [];
        $array['status'] = 1;
        $array['auditing'] = 1;
        $arr = Info::instance()->where($array)->order('sort desc,release_time desc')->limit(0, 2)->select();
        return $arr;
    }

    /**
     * 招标信息 列表
     * title string
     */
    public function getbiao($title, $page)
    {
        $array = [];
        if (empty($title)) {
            $array['status'] = 1;
            $array['auditing'] = 1;
            $array['pid'] = 1;
        } else {
            $array['status'] = 1;
            $array['auditing'] = 1;
            $array['pid'] = 1;
            $array['title|keyword|describe'] = ['like', '%' . $title . '%'];
        }

        if (empty($page) || is_null($page)) {
            $page = 10;
        }

        $arr = Info::instance()->where($array)->order('sort desc,release_time desc')->paginate($page);

        foreach ($arr as $k => $val) {
            $arr[$k]['keyword'] = explode(',', $arr[$k]['keyword']);
            $arr[$k]['title'] = mb_substr($arr[$k]['title'], 0, 50, 'utf-8');
        }

        return $arr ? $arr : '';
    }

    /**
     * @DESC：行业资讯
     * @param $title
     * @param $page
     * @return string
     * @author: jason
     * @date: 2019-12-03 04:59:11
     */
    public function getIndustry($title, $page)
    {
        if (empty($title)) {
            $array['status'] = 1;
            $array['auditing'] = 1;
        } else {
            $array['status'] = 1;
            $array['auditing'] = 1;
            $array['title|keyword|describe'] = ['like', '%' . $title . '%'];
        }

        if (empty($page) || is_null($page)) {
            $page = 10;
        }

        $arr = Info::instance()->where($array)->order('sort desc,release_time desc')->paginate($page);

        foreach ($arr as $k => $val) {
            $arr[$k]['keyword'] = explode(',', $arr[$k]['keyword']);
            $arr[$k]['title'] = mb_substr($arr[$k]['title'], 0, 50, 'utf-8');
        }

        return $arr ? $arr : '';
    }

    /**
     * 招商信息列表
     * title string
     */
    public function getshang($title, $page)
    {
        $array = [];
        if (empty($title)) {
            $array['status'] = 1;
            $array['auditing'] = 1;
            $array['pid'] = 2;
        } else {
            $array['status'] = 1;
            $array['auditing'] = 1;
            $array['pid'] = 2;
            $array['title|keyword|describe'] = ['like', '%' . $title . '%'];
        }

        if (empty($page) || is_null($page)) {
            $page = 15;
        }

        $arr = Info::instance()->where($array)->order('sort desc,release_time desc')->paginate($page);

        foreach ($arr as $k => $val) {
            $arr[$k]['keyword'] = explode(',', $arr[$k]['keyword']);
            $arr[$k]['title'] = mb_substr($arr[$k]['title'], '0', '50', 'utf-8');
        }

        return $arr ? $arr : '';
    }


    /**
     * id string
     * 删除功能
     */
    public function dels($id)
    {
        $ret = Info::instance()->where(['id' => $id])->update(['status' => 0]);
        if($ret == false){
            return false;
        }
        return true;
    }

    /**
     * 上一篇
     * id string
     * return array|null
     */
    public function getTop($id)
    {
        if (empty($id) || !isset($id)) {
            return false;
        }
        $where = [
            'id' => ['<', $id],
            'status' => 1,
            'auditing' => 1,
        ];
        $info = Info::instance()->where($where)->order('sort desc,release_time desc')->find();

        if (empty($info)) {
            return $info = '';
        } else {
            return $info;
        }

    }

    /**
     * 下一篇
     * id string
     * return array|null
     */
    public function getNext($id)
    {
        if (empty($id) || !isset($id)) {
            return false;
        }

        $where = [
            'id' => ['>', $id],
            'status' => 1,
            'auditing' => 1,
        ];
        $info = Info::instance()->where($where)->order('sort desc,release_time asc')->find();

        if (empty($info)) {
            return $info = '';
        } else {
            return $info;
        }
    }

    /**
     * @DESC：首页统计招标信息的数量
     * @return mixed
     * @author: jason
     * @date: 2019-10-31 09:36:25
     */
    public function getinfocount()
    {
        $info = Info::instance()->where(['status' => 1])->count();
        return $info;
    }


    /**
     * @DESC：招商、招标信息排序
     * @param $params
     * @return bool
     * @author: jason
     * @date: 2019-12-05 02:34:26
     */
    public function changesort($params)
    {
        if(empty($params)){
            return false;
        }
        $save = [];
        $save['sort'] = $params['sort'];
        $where = [];
        $where['id'] = $params['id'];
        $res = Info::instance()->where($where)->update($save);
        if($res === false){
            return false;
        }
        return true;
    }

}