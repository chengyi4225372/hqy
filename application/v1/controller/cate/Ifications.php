<?php
namespace app\v1\controller\cate;

use app\common\controller\AuthController;
use app\v1\service\Infosservice;
use think\Config;
use app\common\model\Ification;
use app\v1\service\Ificationservice;

class Ifications extends AuthController
{
    /**
     *列表页
     */
    public function index()
    {
        if ($this->request->isGet()) {
            $params = $_GET;
            if (empty($params['title'])) $params['title'] = '';
            if (empty($params['status'])) $params['status'] = '';
            if (empty($params['disable'])) $params['disable'] = [];
            if (!empty($params['disable'])) {
                $params['disable'] = explode(',', $params['disable']);
            }
            $list = Ificationservice::instance()->getlist($params);
            $disable = Config('site.disable');
            $this->assign('disable', $disable);
            $this->assign('params', $params);
            $this->assign('list', $list);
            $this->assign('title','关键字列表');
            return $this->fetch();
        }
        return false;
    }

    /**
     * 添加
     */
    public function add()
    {
        if ($this->request->isAjax() && $this->request->isPost()) {
            $data = [];
            $data['title'] = $_POST['title'];
            $data['sort'] = $_POST['sort'];
            $data['disable'] = $_POST['disable'];
            $data['create_time'] = time();
//            echo '<pre>';print_r($data);exit;
            if (empty($data)) {
                return false;
            }

            $res = Ificationservice::instance()->insertData($data);

            if ($res !== false) {
                return json(['code' => 200, 'msg' => '操作成功']);
            } else {
                return json(['code' => 400, 'msg' => '操作失败']);
            }
        }
        $disable = Config('site.disable');
        $this->assign('disable',$disable);
        return $this->fetch();
    }

    /**
     * 编辑
     */
    public function edit()
    {
        if ($this->request->isGet()) {
            $id = input('get.mid', '', 'int');

            if (empty($id) || is_null($id) || $id <= 0) {
                return false;
            }

            $info = Ificationservice::instance()->getIdinfo($id);
//            echo '<pre>';print_r($info);exit;
            $disable = Config('site.disable');
            $this->assign('disable',$disable);
            $this->assign('info', $info);
            return $this->fetch();
        }

        if ($this->request->isPost()) {
            $data = [];
            $id = input('post.mid', '', 'int');
            $data['title'] = input('post.title', '', 'trim');
            $data['sort'] = input('post.sort', '', 'int');
            $data['disable'] = input('post.disable');
            if (empty($id) || $id <= 0 || is_null($id)) {
                return false;
            }

            $ret = Ificationservice::instance()->editData($id, $data);

            if ($ret !== false) {
                return json(['code' => 200, 'msg' => '编辑成功']);
            } else {
                return json(['code' => 400, 'msg' => '编辑失败']);
            }
        }

        return false;
    }

    /**
     * 伪删除操作
     */
    public function dels()
    {
        if ($this->request->isAjax() && $this->request->isPost()) {
            $id = input('post.id', '', 'int');
            $status = input('post.status', '', 'int');
            if (empty($id) || is_null($id) || $id <= 0) {
                return false;
            }

            $ret = Ificationservice::instance()->saveStatus(['id' => $id, 'status' => $status]);

            if ($ret !== false) {
                return json(['code' => 200, 'msg' => '操作成功']);
            } else {
                return json(['code' => 400, 'msg' => '操作失败']);
            }
        }
    }

    /**
     * 修改状态
     */
    public function change()
    {
        if ($this->request->isGet()) {
            $id = input('get.mid', '', 'int');
            $sort = input('get.sorts', '', 'int');

            if (empty($id) || is_null($id) || $id <= 0 || !isset($id)) {
                return false;
            }

            $ret = Ificationservice::instance()->saveSort($id, $sort);

            if ($ret !== false) {
                return json(['code' => 200, 'msg' => '修改成功']);
            } else {
                return json(['code' => 400, 'msg' => '修改失败']);
            }
        }

        return false;
    }

}
