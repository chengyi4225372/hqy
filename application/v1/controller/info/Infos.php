<?php

namespace app\v1\controller\info;

use app\common\controller\AuthController;
use think\Config;
use app\common\model\Info;
use app\v1\service\Infosservice;
use app\v1\service\Ificationservice;

class Infos extends AuthController
{

    /**
     * @DESC：招商、招标信息
     * @return bool|mixed
     * @author: jason
     * @date: 2019-12-05 04:26:28
     */
    public function index()
    {
        if ($this->request->isGet()) {
            $searchField = input('get.searchField', '', 'trim');
            $searchValue = input('get.searchValue', '', 'trim');
            $category = input('get.category', '', 'trim');
            $page = input('get.page', '', 'trim');
            $list = Infosservice::instance()->getList(['searchField' => $searchField, 'searchValue' => $searchValue, 'category' => $category]);
            $params = [];
            $params['searchField'] = !empty($searchField) ? $searchField : '';
            $params['searchValue'] = !empty($searchValue) ? $searchValue : '';
            $params['category'] = !empty($category) ? $category : '';
            $params['page'] = !empty($page) ? $page : 1;
            $audit = Config::get('site.audit');
            $this->assign('audit', $audit);
            $this->assign('params', $params);
            $this->assign('list', $list);
            $this->assign('title', '招标信息');
            return $this->fetch();
        }

        return false;
    }


    public function infosAdd()
    {
        if ($this->request->isGet()) {
            $searchField = input('get.searchField', '', 'trim');
            $searchValue = input('get.searchValue', '', 'trim');
            $category = input('get.category', '', 'trim');
            $page = input('get.pages', '', 'trim');
            $params = [];
            $params['searchField'] = !empty($searchField) ? $searchField : '';
            $params['searchValue'] = !empty($searchValue) ? $searchValue : '';
            $params['category'] = !empty($category) ? $category : '';
            $params['pages'] = !empty($page) ? $page : 1;
            $catelist = Ificationservice::instance()->getlist('');

            $this->assign('params', $params);
            $this->assign('catelist', $catelist);
            return $this->fetch();
        }

        if ($this->request->isPost()) {
            $array['pid'] = input('post.pid', '', 'int');
            $array['title'] = input('post.title', '', 'trim');
            $array['auditing'] = 1;
            $array['content'] = input('post.content', '');
            $array['describe'] = input('post.describe', '', 'trim');
            $array['imgs'] = input('post.imgs', '', 'trim');
            $array['keyword'] = implode(',', json_decode(input('post.keyword', '', 'trim')));
            $array['seo_key'] = input('post.seo_key','','trim');
            $array['release_time'] = date("Y-m-d,h:i:s");

            $ret = Infosservice::instance()->saves($array);
            if ($ret) {
                return json(['code' => 200, 'msg' => '操作成功']);
            } else {
                return json(['code' => 400, 'msg' => '操作失败']);
            }
        }

    }


    public function infosEdit()
    {
        $pc_url = Config::get('queue.pc_url');
        if ($this->request->isGet()) {
            $id = input('get.id', '', 'int');
            if (empty($id)) {
                return false;
            }
            $info = Infosservice::instance()->getId($id);


            //关键字列表
            $catelist = Ificationservice::instance()->getlist('');

            $searchField = input('get.searchField', '', 'trim');
            $searchValue = input('get.searchValue', '', 'trim');
            $category = input('get.category', '', 'trim');
            $page = input('get.pages', '', 'trim');
            $params = [];
            $params['searchField'] = !empty($searchField) ? $searchField : '';
            $params['searchValue'] = !empty($searchValue) ? $searchValue : '';
            $params['category'] = !empty($category) ? $category : '';
            $params['pages'] = !empty($page) ? $page : 1;


            $this->assign('params', $params);
            $this->assign('list', $catelist);
            $this->assign('info', $info);
            $this->assign('keywords', $info['keyword']);
            return $this->fetch();
        }

        if ($this->request->isPost()) {
            $id = input('post.id', '', 'int');
            $array = array(
                'pid' => input('post.pid', '', 'int'),
                'title' => input('post.title', '', 'trim'),
                'content' => input('post.content'),
                'describe' => input('post.describe', '', 'trim'),
                'seo_key' => input('post.seo_key', '', 'trim'),
                'keyword' => implode(',', json_decode(input('post.keyword', '', 'trim'))),
                'imgs' => input('post.imgs', '', 'trim'),
            );

            $ret = Infosservice::instance()->updateId($array, $id);
            if ($ret) {
                return json(['code' => 200, 'msg' => '操作成功']);
            } else {
                return json(['code' => 400, 'msg' => '操作失败']);
            }
        }
    }


    //删除
    public function infoDels()
    {

        if ($this->request->isGet()) {
            $id = input('get.id', '', 'int');

            if (empty($id)) {
                return json(['code' => 400, 'msg' => '操作失败']);
            }

            $ret = Infosservice::instance()->dels($id);
            if($ret === false){
                return json(['code' => 400, 'msg' => '操作失败']);
            }
            return json(['code' => 200, 'msg' => '操作成功']);
        }
        return false;
    }

    /**
     * @DESC：招标、招商信息审核
     * @return \think\response\Json
     * @author: jason
     * @date: 2019-12-12 05:48:13
     */
    public function auditing()
    {
        if($this->request->isAjax() && $this->request->isPost()){
            $id = input('post.id','','int');
            $audit = input('post.audit','','int');
            if(empty($id)) return json(['status' => 400,'msg' => '操作失败']);
            if(empty($audit)) return json(['status' => 400,'msg' => '操作失败']);
            $res = Infosservice::instance()->auditing(['id' => $id,'audit' => $audit]);
            if($res == false) return json(['status' => 400,'msg' => '操作失败']);
            return json(['status' => 200,'msg' => '操作成功']);
        }
    }

    /**
     * @DESC：招商、招标信息排序
     * @return \think\response\Json
     * @author: jason
     * @date: 2019-12-05 02:25:19
     */
    public function changesort()
    {
        if($this->request->isAjax() && $this->request->isPost()){
            $return_data = Infosservice::instance()->changesort($_POST);
            if($return_data == false){
                return json(['status' => 400,'msg' => '请确认操作是否正确']);
            }
            return json(['status' => 200,'msg' => '排序成功']);
        }
    }

    //上传图片
    public function uploadImgs()
    {
        // 获取上传文件
        $file = $this->request->file('file');
        // 验证图片,并移动图片到框架目录下。
        $path = ROOT_PATH . 'public/uploads/imgs/works/';

        if (!is_dir($path)) {
            mkdir($path, 0755);
        }

        $info = $file->move($path, false, true);
        if ($info) {
            $mes = $info->getSaveName();
            $mes = str_replace("\\", '/', $mes);
            return json(['code' => '200', 'msg' => '上传成功', 'path' => '/uploads/imgs/works/' . $mes]);
        } else {
            // 文件上传失败后的错误信息
            $mes = $file->getError();
            return json(['code' => '400', 'msg' => $mes]);
        }
    }


}