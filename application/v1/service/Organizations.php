<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/8/28
 * Time: 16:51
 */
namespace app\v1\service;

use plugin\Tree;
use plugin\Crypt;
use think\Config;
use app\common\model\User;
use app\common\model\organ;

class Organizations
{
    // 静态对象
    protected static $instance = null;
    protected $_reids = null;

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
     * @DESC：获取所有组织架构信息
     * @author: jason
     * @date: 2019-09-02 08:55:01
     */
    public function getOrgList($params)
    {
        $organization = new organ();
        $where = [];
        //如果状态没选的情况
        if(isset($params['status']) && !empty($params['status'])){
            $where['status'] = $params['status'];
        }
        if(isset($params['user_name']) && !empty($params['user_name'])){
            //将中文逗号替换成英文逗号
            if(strpos($params['user_name'],'，')){
                $params['user_name'] = str_replace('，',',',$params['user_name']);
            }
            //将空格替换成英文逗号
            $params['user_name'] = preg_replace('/\s{1,}/',' ',$params['user_name']);
            $params['user_name'] = str_replace(' ',',',$params['user_name']);
            $params['user_name'] = explode(',',$params['user_name']);

            $params['user_name'] = array_filter($params['user_name'],function ($params){
                return !empty($params);
            });
            $userArr = array_map(function($par){
                return '%'.$par.'%';
            },$params['user_name']);

            $where['manage'] = ['LIKE',$userArr,'OR'];
        }

        // 必须将结果集转换为数组
        $list = collection($organization->order('weigh', 'desc')->where($where)->select())->toArray();
//        echo $organization->getLastSql();exit;
//        echo '<pre>';print_r($list);exit;
        Tree::instance()->init($list);

        $list = Tree::instance()->getTreeList(Tree::instance()->getTreeArray(0), 'title');
        return $list;
    }

    /**
     * @DESC：新增组织架构
     * @author: jason
     * @date: 2019-08-29 02:39:22
     */
    public function add_org($params)
    {
        $organModel = new organ();
        $time = time();
        $addData = [
            'pid' => (int)($params['pid'] ?? 0),
            'manage_uid' => (int)($params['manage_uid'] ?? 0),
            'title' => trim($params['title']),
            'weigh' => (int)$params['weigh'],
            'createtime' => $time,
            'updatetime' => $time,
            'status' => 1, //0禁用，1启用
        ];
        //检测同级部门名称是否重复
        $res = $this->checkdep($addData['title'], $addData['pid']);
        if ($res) {
            return json(['status' => false, 'msg' => '父级部门下存在相同部门名称']);
        }
        $treeClass = \plugin\TreeClass::instance($organModel);
        //负责人
        $manage_uid = array_column($this->getUser(), 'username', 'id');
        $manage = $manage_uid[$addData['manage_uid']];
        $addData['manage'] = $manage;
        $addData['rank'] = $this->rank($addData['pid']);
        if ($addData['pid'] > 0) {
            $parent = $organModel->where(['id' => $addData['pid']])->find();
            $addData['tid'] = $parent->tid;
        }
        // 启动事务
        $organModel->startTrans();
        try {
            // 开始更新左右值
            $return = $treeClass->add($addData['pid']);
            // 插入
            $id = $organModel->insert(array_merge($addData, $return), false, true);
            if ($addData['pid'] <= 0) {
                $organModel->where(['id' => $id])->update(['tid' => $id]);
            }
            // 提交事务
            $organModel->commit();
            return json(['status' => true, 'msg' => __('新增部门成功')]);
        } catch (\Exception $e) {
//            $this->setErrors(0, Config::get('app_debug') ? $e->getMessage() : __('新增部门失败'));
            // 回滚事务
            $organModel->rollback();
            return json(['status' => false, 'msg' => __('新增部门失败')]);
        }


////        $organModel->startTrans();
//        $result = $this->save_lid_rid($addData['pid']);
//        if (empty($result) || $result == false) {
////            $organModel->rollback();
//            return json(['status' => false, 'msg' => '保存失败']);
//        }
//        $merge_arr = array_merge($addData, $result);
//        $id = $organModel->insert($merge_arr);
//        $parent_id = $organModel->getLastInsID();
//        if ($id === false) {
////            $organModel->rollback();
//            return json(['status' => false, 'msg' => '保存失败']);
//        }
//        if ($addData['pid'] <= 0) {
//            $organModel->where(['id' => $parent_id])->update(['tid' => $parent_id]);
//
//        }
////        $organModel->commit();
//        return json(['status' => true, 'msg' => '保存成功']);
    }


    /**
     * @DESC：编辑成员
     * @param $id
     * @author: jason
     * @date: 2019-09-19 09:40:57
     */
    public function edit_org($params)
    {
        $id = $params['id'] ?? '';
        if (empty($id)) {
            return json(['status' => false, 'msg' => '没有要编辑的信息']);
        }
        $organModel = new organ();
        $orgInfo = $organModel->where(['id' => $id])->find()->toArray();
        if (empty($orgInfo)) return json(['status' => false, 'msg' => '保存失败!']);
        $save['title'] = $params['title'];
        $save['manage_uid'] = $params['manage_uid'];
        $res = $organModel->where(['id' => $id])->update($save);
        if ($res === false) {
            return json(['status' => false, 'msg' => '保存失败']);
        }
        return json(['status' => true, 'msg' => '保存成功']);
    }

    /**
     * @DESC：获得当前成员的信息
     * @param $id
     * @return array
     * @throws \think\Exception
     * @author: jason
     * @date: 2019-09-23 09:21:45
     */
    public function get_edit_org($id)
    {
        $organModel = new organ();
        $orgInfo = $organModel->where(['id' => $id])->find()->toArray();
        return $orgInfo;
    }

    /**
     * @DESC：更新左值右值
     * @param $pid
     * @author: jason
     * @date: 2019-08-30 08:48:31
     */
    public function save_lid_rid($pid)
    {
        $organModel = new organ();
        if ($pid == 0) {
            $default = [
                'pid' => $pid,
                'lid' => 1,
                'rid' => 2,
            ];
            return $default;
        }
        $org_info = $organModel->where(['id' => $pid])->find()->toArray();
        if (empty($org_info)) return false;
        $rid = $org_info['rid'] + 2;
        $lid = $org_info['lid'] + 1;
        $tid = $org_info['tid'];
//        $organModel->where(['lid' => ['GT',$org_info['lid']],'tid' => $org_info['tid']])->setInc('lid',2);
//        // 更新右值
//        $organModel->where([
//            'lid' => ['EGT', $org_info['lid']],
//            'tid' => $org_info['tid']
//        ])->setInc('rid', 2);
//        // 更新右值
//        $organModel->where([
//            'lid' => ['LT', $org_info['lid']],
//            'rid' => ['GT', $org_info['rid']],
//            'tid' => $org_info['tid'],
//        ])->setInc('rid', 2);

        return [
            'pid' => $pid,
            'tid' => $tid,
            'lid' => $lid,
            'rid' => $rid,
        ];
    }

    /**
     * @DESC：检测同级部门的名称是否重复
     * @param $tile
     * @param $pid
     * @param int $id
     * @return bool
     * @author: jason
     * @date: 2019-08-29 03:26:18
     */
    public function checkdep($tile, $pid, $id = 0)
    {
        if (!$tile || !is_numeric($pid)) return false;
        $orgModel = new organ();
        $map = [
            'title' => $tile,
            'pid' => $pid
        ];
        if ($id > 0) $map['id'] = ['neq', $id];
        $id = $orgModel->where($map)->value('id');
        return $id ? true : false;
    }

    /**
     * @desc 获取层级
     * @author 杨能文
     * @date 2019/4/4 9:20
     * @param $pid
     * @access public
     * @return string
     */
    public function rank($pid)
    {
        if (empty($pid)) return 1;
        $organization = new organ();
        $rank = $organization->where(['id' => $pid])->value('rank');
        $rank = $rank > 0 ? $rank + 1 : 1;
        return $rank;
    }

    /**
     * @DESC：获取所有的组织架构
     * @param int $type
     * @return array|string
     * @author: jason
     * @date: 2019-08-30 11:20:50
     */
    public function getAllOrg($type = 2)
    {
        $organization = new organ();
        // 必须将结果集转换为数组
        $list = collection($organization->order('weigh', 'desc')->select())->toArray();

        Tree::instance()->init($list);
        if ($type == 3) {
            $list = Tree::instance()->getTreeArray(0);
        } else {
            $list = Tree::instance()->getTreeList(Tree::instance()->getTreeArray(0), 'title');
        }
        return $list;
    }

    /**
     * @DESC：获取用户信息
     * @author: jason
     * @date: 2019-08-29 09:27:05
     */
    public function getUser()
    {
        return collection(User::instance()->where(['status' => 1])->select())->toArray();
    }

}