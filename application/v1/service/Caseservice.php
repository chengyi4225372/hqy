<?php
/**
 * 成功案例service
 * User: abc
 * Date: 2019/10/21
 * Time: 19:00
 */
namespace app\v1\service;

use app\common\model\Admin;
use app\common\model\Cases;
use plugin\Tree;
use plugin\Crypt;
use think\Config;

class Caseservice
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
     * @DESC：获取成功案例父类列表
     * @author: jason
     * @date: 2019-10-21 07:43:14
     */
    public function getparentlist($params)
    {
        $where = [];
        //每页显示的数量
        $page_size = !empty($params['ps']) ? $params['ps'] : 20;
        //当前页
        $current_page = (!empty($params['page']) && intval($params['page']) > 0) ? $params['page'] : 1;
        //分页起始值
        $start = $page_size * ($current_page - 1);

        if(isset($params['title']) && !empty($params['title'])){
            //将中文逗号替换成英文逗号
            if(strpos($params['title'],'，')){
                $params['title'] = str_replace('，',',',$params['title']);
            }
            //将空格替换成英文逗号
            $params['title'] = preg_replace('/\s{1,}/',' ',$params['title']);
            $params['title'] = str_replace(' ',',',$params['title']);
            $params['title'] = explode(',',$params['title']);

            $params['title'] = array_filter($params['title'],function ($params){
                return !empty($params);
            });
            $caseArr = array_map(function($par){
                return '%'.$par.'%';
            },$params['title']);

            $where['title'] = ['LIKE',$caseArr,'OR'];
        }

        //分页url参数
        $config = [
            'query' => request()->param(),
        ];
        $caseInfo = Cases::where($where)
            ->limit($start,$page_size)
            ->order('id', 'desc')
            ->paginate($page_size, false, $config);
        $page = $caseInfo->render();

        $return_data = [
            'list' => $caseInfo->toArray(),
            'page' => $page,
        ];

        return $return_data;
    }

    /**
     * @DESC：确认添加主案例
     * @author: jason
     * @date: 2019-10-21 08:55:36
     */
    public function addcase($params)
    {
        $add['title'] = $params['title'];
        $add['title2'] = $params['title2'];
        $add['title3'] = $params['title3'];
        $add['pic'] = $params['pic'];
        $add['pic2'] = $params['pic2'];
        $add['url'] = $params['url'];
        $add['desc'] = $params['desc'];
        $add['desc2'] = $params['desc2'];
        $add['desc3'] = $params['desc3'];
        $add['desc4'] = $params['desc4'];
        $add['desc5'] = $params['desc5'];
        $add['desc6'] = $params['desc6'];
        $add['desc7'] = $params['desc7'];
        $add['status'] = $params['status'];
        $add['is_show'] = $params['is_show'];
        $res = Cases::insert($add);
        if($res === false){
            return json(['status' => false,'msg' => '添加失败']);
        }
        return json(['status' => true,'msg' => '添加成功']);
    }

    /**
     * @DESC：根据id获得当前的主案例的信息
     * @author: jason
     * @date: 2019-10-21 09:22:42
     */
    public function getcaselist($id)
    {
        if(empty($id)){
            die('<div style="color:red;">没有要修改的数据</div>');
        }
        $info = Cases::where(['id' => $id])->find()->toArray();
        if(empty($info)){
            die('<div style="color:red;">没有要修改的数据</div>');
        }
        return $info;
    }

    /**
     * @DESC：编辑案例
     * @author: jason
     * @date: 2019-10-21 09:33:46
     */
    public function editcase($params)
    {

        if(empty($params['case_id'])){
            return json(['status' => false,'msg' => '没有要修改的数据']);
        }

        $info = Cases::where(['id' => $params['case_id']])->find()->toArray();

        if(empty($info)){
            return json(['status' => false,'msg' => '没有要修改的数据']);
        }
        $add['title'] = $params['title'];
        $add['title2'] = $params['title2'];
        $add['title3'] = $params['title3'];
        $add['pic'] = $params['pic'];
        $add['pic2'] = $params['pic2'];
        $add['url'] = $params['url'];
        $add['desc'] = $params['desc'];
        $add['desc2'] = $params['desc2'];
        $add['desc3'] = $params['desc3'];
        $add['desc4'] = $params['desc4'];
        $add['desc5'] = $params['desc5'];
        $add['desc6'] = $params['desc6'];
        $add['desc7'] = $params['desc7'];
        $add['status'] = $params['status'];
        $add['is_show'] = $params['is_show'];
        $res = Cases::update($add,['id' => $params['case_id']]);
        if($res === false){
            return json(['status' => false,'msg' => '修改失败']);
        }
        return json(['status' => true,'msg' => '修改成功']);
    }

    /**
     * @DESC：查询所有的主案例
     * @author: jason
     * @date: 2019-10-21 09:54:02
     */
    public function getallparent()
    {
        $return_data = collection(Cases::where(['status' => 1])->select())->toArray();
        return $return_data;
    }


}
