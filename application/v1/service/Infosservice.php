<?php
namespace app\v1\service;
use app\common\model\Info;
use plugin\Tree;
use plugin\Crypt;
use think\Config;

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
     * 获取所有产品
     */
    public function getList($param){
       if(empty($param)){
           $list = Info::instance()->where(['status'=>1])->order(['release_time'=>'desc'])->paginate(15);
       }

        if(!empty($param) && isset($param)){
            $where = [
                'title'=>['like','%'.$param.'%'],
                'status'=>1
            ];
            $list = Info::instance()->where($where)->order(['release_time'=>'desc'])->paginate(15);
        }

       return $list;
    }

    /**
     * @param $array
     * @return mixed
     */
    public function saves($array){
        $ret = Info::instance()->data($array)->save();
        return $ret;
    }

   //更新
    public function updateId($arr,$id){
        if(empty($id)){
            return false;
        }
        $rest = Info::instance()->where('id',$id)->update($arr);
        return $rest;
    }

    /**
     * @param $id
     * @return mixed
     * 通过id 获取信息
     */
    public function getId($id){
        $info = Info::instance()->where(['id'=>$id])->find();
        return $info;
    }

    /**
     * 招标信息
     *  array('pid'=>1)
     */
    public function biao($array){
        $array['status'] =1;
        $arr = Info::instance()->where($array)->order('release_time desc')->limit(0,2)->select();
        return $arr;
    }

    /**
     * 招商信息
     *  array('pid'=>2)
     */
    public function shang($array){
        $array['status'] =1;
        $arr = Info::instance()->where($array)->order('release_time desc')->limit(0,2)->select();
        return $arr;
    }

    /**
     * 招标信息 列表
     * title string
     */
    public function getbiao($title,$page){
        if(empty($title)){
            $array['status'] =1;
            $array['pid'] =1;
        }else{
            $array['status'] =1;
            $array['pid'] =1;
            $array['title|keyword|describe'] = ['like','%'.$title.'%'];
        }

        if(empty($page) || is_null($page)){
            $page = 10;
        }

        $arr = Info::instance()->where($array)->order('release_time desc')->paginate($page);

        foreach ($arr as $k =>$val){
            $arr[$k]['keyword'] = explode(',',$arr[$k]['keyword']);
            $arr[$k]['title']   = mb_substr($arr[$k]['title'],0,50,'utf-8');
        }

        return $arr?$arr:'';
    }

    /**
     * 招商信息列表
     * title string
     */
    public function getshang($title,$page){
        if(empty($title)){
            $array['status'] =1;
            $array['pid'] =2;
        }else{
            $array['status'] =1;
            $array['pid'] =2;
            $array['title|keyword|describe'] = ['like','%'.$title.'%'];
        }

        if(empty($page) || is_null($page)){
            $page = 15;
        }

        $arr  = Info::instance()->where($array)->order('release_time desc')->paginate($page);

        foreach ($arr as $k =>$val){
            $arr[$k]['keyword'] = explode(',',$arr[$k]['keyword']);
            $arr[$k]['title']   = mb_substr($arr[$k]['title'],'0','50','utf-8');
        }

        return $arr?$arr:'';
    }



    /**
     * id string
     * 删除功能
     */
    public function dels($arr,$id){
        $ret = Info::instance()->where(['id'=>$id])->update($arr);
        return $ret;
    }

    /**
     * 上一篇
     * id string
     * return array|null
     */
    public function getTop($id){
        if(empty($id) || !isset($id)){
            return false;
        }
        $where = [
            'id'=>['<',$id],
            'status'=>1
        ];

        $info = Info::instance()->where($where)->order(['release_time'=>'desc'])->find();

        if(empty($info)){
            return  $info ='';
        }else{
            return  $info;
        }

    }

    /**
     * 下一篇
     * id string
     * return array|null
     */
    public function getNext($id){
        if(empty($id) || !isset($id)){
            return false;
        }

        $where = [
            'id'=>['>',$id],
            'status'=>1
        ];
        $info = Info::instance()->where($where)->order(['release_time'=>'asc'])->find();

        if(empty($info)){
            return  $info ='';
        }else{
            return  $info;
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
}