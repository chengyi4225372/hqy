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
use app\common\model\Cases;
use app\common\model\Ification;
use app\common\model\Statistics;
use think\Config;
class Apiservice
{
    protected static $instance = null;
    protected $pageSize = 8;
    protected $current_page = 1;
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
        $url = Config::get('queue.pc_url');
        $productModel = new Protuct();
        $where = [];
        $where['status'] = 1;
        $info = collection($productModel->instance()->where($where)->select())->toArray();
        foreach($info as $key => $val){
            $info[$key]['imgs'] = $url.'/'.$val['imgs'];
        }
        return !empty($info) ? $info : [];
    }

    /**
     * @DESC：查询四条最新的招商、招标的信息
     * @author: jason
     * @date: 2020-01-03 02:49:33
     */
    public function gettwobiao()
    {
        $url = Config::get('queue.pc_url');
        $status = Config::get('queue.status');
        $where = [];
        $where['status'] = 1;
        $where['auditing'] = 1;
        $where['pid'] = ['IN',[1,2]];
        $order = 'id desc,release_time desc';
        $infos = Info::instance()->where($where)->order($order)->limit(0,4)->select();

        if(count($infos) > 0){
            $info = $infos->toArray();
            foreach ($info as $k => $val) {
                $info[$k]['category'] = $status[$info[$k]['pid']];
                $info[$k]['title'] = mb_substr($info[$k]['title'], 0, 50, 'utf-8');
                $info[$k]['imgs'] = $url.'/'.$val['imgs'];
            }
        }else{
            $info = [];
        }
        return $info;
    }

    /**
     * @DESC：获取惠家族产品列表
     * @author: jason
     * @date: 2020-01-03 05:06:39
     */
    public function getfamily()
    {
        $url = Config::get('queue.pc_url');
        $where = [];
        $where['status'] = 1;
        $order = 'sort desc,id desc';
        $info = collection(Cases::instance()->where($where)->order($order)->select())->toArray();
        foreach($info as $key => $val){
            $info[$key]['mobile_pic'] = $url.'/'.$val['mobile_pic'];
        }
        return count($info) > 0 ? $info : '';
    }

    /**
     * @DESC：招标信息详情
     * @author: jason
     * @date: 2020-01-06 09:28:43
     */
    public function getbaioinfo($params)
    {
        $status = Config::get('queue.status');
        $baseUrl = Config::get('queue.pc_url');
        if(empty($params)) return [];
        $where = [];
        $where['id'] = $params['id'];
        $where['status'] = 1;
        $where['auditing'] = 1;
        $where['pid'] = $params['pid'];
        $info = [];
        $infos = Info::instance()->where($where)->find();

        if(!empty($infos)){
            $info = $infos->toArray();
            $info['categroy'] = $status[$infos['pid']];
            $pregRule = "/<[img|IMG].*?src=[\'|\"](.*?(?:[\.jpg|\.jpeg|\.png|\.gif|\.bmp]))[\'|\"].*?[\/]?>/";
            $info['content'] = preg_replace($pregRule, '<img src="' . $baseUrl . '${1}">', $info['content']);
//            preg_match_all('/(?<=img.src=").*?(?=")/', $content, $out, PREG_PATTERN_ORDER);
//            if (!empty($out)) {
//                foreach ($out as $v) {
//                    foreach ($v as $j) {
//                        $url = $baseUrl.$j;
//                        $info['content'] = str_replace($j, $url, $content);   //替换相对路径为绝对路径
//                    }
//                }
//            }
        }else{
            $info = [];
        }
        $top = $this->getTop($params['id'],$params['pid']);
        $next = $this->getNext($params['id'],$params['pid']);
        return ['data' => $info,'prev' => $next,'next' => $top];
    }

    /**
     * @DESC：查看更多招标信息
     * @author: jason
     * @date: 2020-01-06 06:32:42
     */
    public function getmorebiao($params)
    {
        $url = Config::get('queue.pc_url');
        $where = [];
        //每页显示的数量
        $page_size = !empty($params['ps']) ? $params['ps'] : $this->pageSize;
        //当前页
        $current_page = (!empty($params['page']) && intval($params['page']) > 0) ? $params['page'] : $this->current_page;

        //分页起始值
        $select_start = $page_size * ($current_page - 1);
        $keyword = !empty($params['keyword']) ? $params['keyword'] : [];
        $title = !empty($params['title']) ? $params['title'] : [];
        //如果搜标题又搜关键字
        if(!empty($keyword) && is_array($keyword) && !empty($title)){
            $keyword = array_map(function($par){
                return '%'.$par.'%';
            },$keyword);
            $where['keyword'] = ['LIKE',$keyword,'OR'];
            $where['title'] = ['LIKE','%'.$title.'%'];
        }
        //如果是只搜标题，不搜关键字
        if(empty($keyword) && !empty($title)){
            $where['title'] = ['LIKE','%'.$title.'%'];
        }
        //如果只搜关键字，不搜标题
        if(!empty($keyword) && is_array($keyword) && empty($title)){
            $keyword = array_map(function($par){
                return '%'.$par.'%';
            },$keyword);
            $where['keyword'] = ['LIKE',$keyword,'OR'];
        }
        $where['pid'] = 1;
        $where['status'] = 1;
        $where['auditing'] = 1;
        $count = Info::instance()->where($where)->count();
        $infos = Info::instance()->where($where)->limit($select_start,$page_size)->select();
//        echo Info::instance()->getLastSql();exit;
        if(count($infos) > 0){
            $info = $infos->toArray();
            foreach ($info as $k => $val) {
                $info[$k]['keyword'] = explode(',', $info[$k]['keyword']);
                $info[$k]['title'] = mb_substr($info[$k]['title'], 0, 50, 'utf-8');
                $info[$k]['imgs'] = $url.'/'.$val['imgs'];
            }
        }else{
            $info = [];
        }
        return ['data' => $info,'total' => $count];
    }

    /**
     * @DESC：查看更多招商信息
     * @author: jason
     * @date: 2020-01-06 07:08:16
     */
    public function getmoreshang($params)
    {
        $url = Config::get('queue.pc_url');
        //每页显示的数量
        $page_size = !empty($params['ps']) ? $params['ps'] : $this->pageSize;
        //当前页
        $current_page = (!empty($params['page']) && intval($params['page']) > 0) ? $params['page'] : $this->current_page;
        //分页起始值
        $select_start = $page_size * ($current_page - 1);
        $where = [];
        $keyword = !empty($params['keyword']) ? $params['keyword'] : [];
        $title = !empty($params['title']) ? $params['title'] : [];
        //如果搜标题又搜关键字
        if(!empty($keyword) && is_array($keyword) && !empty($title)){
            $keyword = array_map(function($par){
                return '%'.$par.'%';
            },$keyword);
            $where['keyword'] = ['LIKE',$keyword,'OR'];
            $where['title'] = ['LIKE','%'.$title.'%'];
        }
        //如果是只搜标题，不搜关键字
        if(empty($keyword) && !empty($title)){
            $where['title'] = ['LIKE','%'.$title.'%'];
        }
        //如果只搜关键字，不搜标题
        if(!empty($keyword) && is_array($keyword) && empty($title)){
            $keyword = array_map(function($par){
                return '%'.$par.'%';
            },$keyword);
            $where['keyword'] = ['LIKE',$keyword,'OR'];
        }

        $where['pid'] = 2;
        $where['status'] = 1;
        $where['auditing'] = 1;
        $count = Info::instance()->where($where)->count();
        $infos = Info::instance()->where($where)->limit($select_start,$page_size)->select();
        if(count($infos) > 0){
            $info = $infos->toArray();
            foreach ($info as $k => $val) {
                $info[$k]['keyword'] = explode(',', $info[$k]['keyword']);
                $info[$k]['title'] = mb_substr($info[$k]['title'], 0, 50, 'utf-8');
                $info[$k]['imgs'] = $url.'/'.$val['imgs'];
            }
        }else{
            $info = [];
        }
        return ['data' => $info,'total' => $count];
    }

    /**
     * @DESC：查看更多新闻信息
     * @author: jason
     * @date: 2020-01-06 07:08:16
     */
    public function getmoresinformation ($params)
    {
        $url = Config::get('queue.pc_url');
        //每页显示的数量
        $page_size = !empty($params['ps']) ? $params['ps'] : $this->pageSize;
        //当前页
        $current_page = (!empty($params['page']) && intval($params['page']) > 0) ? $params['page'] : $this->current_page;
        //分页起始值
        $select_start = $page_size * ($current_page - 1);

        $where = [];
        $keyword = !empty($params['keyword']) ? $params['keyword'] : [];

        $title = !empty($params['title']) ? $params['title'] : [];
        //如果搜标题又搜关键字
        if(!empty($keyword) && is_array($keyword) && !empty($title)){
            $keyword = array_map(function($par){
                return '%'.$par.'%';
            },$keyword);
            $where['keyword'] = ['LIKE',$keyword,'OR'];
            $where['title'] = ['LIKE','%'.$title.'%'];
        }
        //如果是只搜标题，不搜关键字
        if(empty($keyword) && !empty($title)){
            $where['title'] = ['LIKE','%'.$title.'%'];
        }
        //如果只搜关键字，不搜标题
        if(!empty($keyword) && is_array($keyword) && empty($title)){
            $keyword = array_map(function($par){
                return '%'.$par.'%';
            },$keyword);
            $where['keyword'] = ['LIKE',$keyword,'OR'];
        }

        $where['pid'] = 3;
        $where['status'] = 1;
        $where['auditing'] = 1;
        $count = Info::instance()->where($where)->count();
        $infos = Info::instance()->where($where)->limit($select_start,$page_size)->select();
        if(count($infos) > 0){
            $info = $infos->toArray();
            foreach ($info as $k => $val) {
                $info[$k]['keyword'] = explode(',', $info[$k]['keyword']);
                $info[$k]['title'] = mb_substr($info[$k]['title'], 0, 50, 'utf-8');
                $info[$k]['imgs'] = $url.'/'.$val['imgs'];
            }
        }else{
            $info = [];
        }
        return ['data' => $info,'total' => $count];
    }


    /**
     * @DESC：查看关键字
     * @param $params
     * @return array|string
     * @author: jason
     * @date: 2020-01-07 08:53:12
     */
    public function getbiaokey($params)
    {
        if(empty($params)) return [];
        $where['disable'] = ['like', '%'.$params.'%'];
        $where['status'] = 1;
        $resfour = collection(Ification::instance()->where($where)->order('sort desc')->limit(6)->select())->toArray();
        return $resfour ? $resfour : '';
    }


    /**
     * @DESC：详情的上一篇
     * @param $id
     * @param string $pid
     * @return bool|string
     * @author: jason
     * @date: 2020-01-07 08:53:48
     */
    public function getTop($id,$pid = '')
    {
        $where = [];
        if (empty($id) || !isset($id)) {
            return false;
        }
        $where = [
            'id' => ['GT', $id],
            'status' => 1,
            'auditing' => 1,
        ];
        if(!empty($pid)) $where['pid'] = $pid;
        $info = Info::instance()->where($where)->order('id asc,release_time asc')->find();
        if (empty($info)) {
            return $info = '';
        } else {
            return $info;
        }

    }

    /**
     * @DESC：详情的下一篇
     * @param $id
     * @param string $pid
     * @return bool|string
     * @author: jason
     * @date: 2020-01-07 08:54:21
     */
    public function getNext($id,$pid = '')
    {
        if (empty($id) || !isset($id)) {
            return false;
        }

        $where = [
            'id' => ['LT', $id],
            'status' => 1,
            'auditing' => 1,
        ];
        if(!empty($pid)) $where['pid'] = $pid;
        $info = Info::instance()->where($where)->order('id desc,release_time desc')->find();

        if (empty($info)) {
            return $info = '';
        } else {
            return $info;
        }
    }

    /**
     * @DESC：统计慧企云报名人数
     * @author: jason
     * @date: 2020-01-14 11:40:44
     */
    public function hqystatistics()
    {
        $totals = Config::get('site.hqy_total');
        $where = [];
        $where['status'] = 1;
        $res = Statistics::instance()->where($where)->setInc('totals',$totals);
        if($res === false){
            return false;
        }
        return true;
    }

    /**
     * @DESC：查询有多少报名人数
     * @author: jason
     * @date: 2020-01-14 01:54:48
     */
    public function getCount()
    {
        $where['status'] = 1;
        $reeturn_data = Statistics::instance()->where($where)->find();
        return $reeturn_data;
    }
}