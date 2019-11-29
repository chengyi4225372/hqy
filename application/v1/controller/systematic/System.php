<?php
/**
 * 系统管理.
 * User: abc
 * Date: 2019/7/25
 * Time: 14:06
 */
namespace app\v1\controller\systematic;
use app\common\controller\AuthController;
use app\v1\service\Systems;
use think\Config;
class System extends AuthController
{
    /**
     * @DESC：菜单管理列表
     * @author: jason
     * @date: 2019-07-25 02:07:22
     */
    public function menu()
    {
        //配置
        $status = Config::get('layout.status');
        $type = Config::get('layout.type');
        $params = request()->param();
        //菜单列表
        $list = Systems::instance()->menu($params);
        $menuListInfo = Systems::instance()->getMenuTree();
        $menuList = array_column($menuListInfo,'title','id');
        $this->assign('menuList',$menuList);
        $this->assign('status',$status);
        $this->assign('type',$type);
        $this->assign('data',$list['list']['data']);
        $this->assign('page',$list['page']);
        return $this->fetch();
    }

    /**
     * @DESC：添加菜单页面
     * @return mixed
     * @author: jason
     * @date: 2019-08-28 02:48:15
     */
    public function addmenu()
    {
        return $this->fetch();
    }

    /**
     * @DESC：添加或更新菜单
     * @author: jason
     * @date: 2019-08-28 02:48:38
     */
    public function savemenu()
    {
        if($this->request->isAjax() && $this->request->isPost()){
            $params = $_POST['data'];
            parse_str($params,$post);
            $return_data = Systems::instance()->savemenu($post);
            return $return_data;
        }
    }


    /**
     * @DESC：系统设置
     * @author: jason
     * @date: 2019-10-16 04:35:35
     */
    public function setting()
    {
        $return_data = Systems::instance()->getSetting();
        $status = Config::get('site.status');
        $this->assign('status',$status);
        $this->assign('data_list',$return_data);
        $this->assign('title','网站设置');
        return $this->fetch();
    }

    /**
     * @DESC：添加网站设置
     * @author: jason
     * @date: 2019-10-17 10:11:31
     */
    public function addsitesetting()
    {
        if($this->request->isAjax() && $this->request->isPost()){
            return Systems::instance()->addSiteSitting($_POST);
        }
        $status = Config::get('site.status');
        $this->assign('status',$status);
        return $this->fetch();
    }

    /**
     * @DESC：修改网站设置
     * @author: jason
     * @date: 2019-10-21 01:46:50
     */
    public function editsetting()
    {
        if($this->request->isAjax() && $this->request->isPost()){
            $return_data = Systems::instance()->editsetting($_POST);
            return $return_data;
        }
        $id = $_GET['id'];
        $status = Config::get('site.status');
        $retutn_data = Systems::instance()->getEditsetting($id);
        $this->assign('data',$retutn_data);
        $this->assign('status',$status);
        return $this->fetch();
    }

    /**
     * @DESC：首页轮播图设置列表
     * @author: jason
     * @date: 2019-10-21 02:33:44
     */
    public function slideshow()
    {
        $status = Config::get('site.lunbo');
        $params = $_GET;
        if(isset($params['status']) === false){
            $params['status'] = '';
        }
        $reutrn_data = Systems::instance()->getslideshow($params);
        $this->assign('data',$reutrn_data);
        $this->assign('params',$params);
        $this->assign('status',$status);
        $this->assign('title','首页轮播图');
        return $this->fetch();
    }

    /**
     * @DESC：添加轮播图的弹窗
     * @return mixed
     * @author: jason
     * @date: 2019-10-21 02:55:41
     */
    public function addslideshow()
    {
        if($this->request->isAjax() && $this->request->isPost()){
            $return_data = Systems::instance()->addslideshow($_POST);
            return $return_data;
        }
        $status = Config::get('site.lunbo');
        $this->assign('status',$status);
        return $this->fetch();
    }

    /**
     * @DESC：编辑轮播图的弹窗
     * @author: jason
     * @date: 2019-10-21 06:15:03
     */
    public function editslideshow()
    {
        if($this->request->isAjax() && $this->request->isPost()){
            $data = Systems::instance()->editslideshow($_POST);
            return $data;
        }
        $id = $_GET['id'];
        $return_data = Systems::instance()->getOneSlideshow($id);
        $status = Config::get('site.lunbo');
        $this->assign('status',$status);
        $this->assign('data',$return_data);
        return $this->fetch();
    }

    /**
     * @DESC：上传图片
     * @author: jason
     * @date: 2019-10-21 04:29:36
     */
    public function uploadimg()
    {
        $return_data = Systems::instance()->uploadimg($_FILES['file']);
        return $return_data;
    }
}