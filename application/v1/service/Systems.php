<?php
/**
 * Class System   系统配置类
 * @package app\v1\service
 */
namespace app\v1\service;

use app\common\model\Menu;
use app\common\model\Admin;
use app\common\model\Site;
use app\common\model\Slideshow;
use plugin\Tree;
use plugin\Crypt;
use think\Config;
class Systems
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
     * @DESC：检查是否有登录
     * @param $username
     * @param $password
     * @author: jason
     * @date: 2019-07-26 04:34:49
     */
    public function checklogin($username,$password)
    {
        $password = md5(md5($password));

        $user_info = Admin::where(['username' => $username,'is_del' => 0])->find()->toArray();

        if($username != $user_info['username'] || $password != $user_info['password']){
            return false;
        }
//        $arr = [
//            'id' => $user_info['id'],
//            'username' => $user_info['username'],
//        ];
//        $token = $user_info['token'];
//        $cache_token = $this->setToken($arr);
//        if($token != $cache_token){
//            return false;
//        }
        //存入session
        cookie('userid',$user_info['id'],864000);
        cookie('username',$user_info['username'],864000);
        cookie('truename',$user_info['truename'],864000);
        cookie('tel',$user_info['tel'],864000);
        cookie('power',$user_info['power'],864000);
        cookie('admin',$user_info['admin'],864000);

        return true;
    }

    /**
     * @DESC：菜单
     * @author: jason
     * @date: 2019-07-26 09:58:40
     */
    public function menu($params)
    {
        //每页显示的数量
        $page_size = !empty($params['ps']) ? $params['ps'] : 20;
        //当前页
        $current_page = (!empty($params['page']) && intval($params['page']) > 0) ? $params['page'] : 1;
        //分页起始值
        $start = $page_size * ($current_page - 1);
        $fields = 'id,type,pid,title,url,icon,url,weigh,status,createtime,remark';
        $where['status'] = 1;
        //分页url参数
        $config = [
            'query' => request()->param(),
        ];
        $menuInfo = Menu::instance()->where($where)
            ->limit($start,$page_size)
            ->order('weigh', 'desc')
            ->field($fields)
            ->paginate($page_size, false, $config);
        $page = $menuInfo->render();
        $return_data = [
            'list' => $menuInfo->toArray(),
            'page' => $page,
        ];
        return $return_data;
    }



    /**
     * @DESC：修改密码
     * @author: jason
     * @date: 2019-07-29 02:38:01
     */
    public function changepass($params)
    {
        $uid = $params['uid'];
        $password = $params['password'];
        $password = md5(md5($password));
        $where['id'] = $uid;
        $res = Admin::where($where)->update(['password' => $password]);
        if($res === false){
            return false;
        }
        return true;
    }

    /**
     * @DESC：树形结构
     * @author: jason
     * @date: 2019-08-02 04:10:03
     */
    public function getMenuTree()
    {
        //查询出所有的菜单
        $menuInfo = collection(Menu::order('weigh', 'desc')->select())->toArray();
        Tree::instance()->init($menuInfo);
        $treeList = Tree::instance()->getTreeList(Tree::instance()->getTreeArray(0),'title');
        return $treeList;
    }

    /**
     * @DESC：更新菜单
     * @author: jason
     * @date: 2019-08-28 02:47:03
     */
    public function savemenu($params)
    {
        $add['title'] = $params['title'];
        $add['type'] = $params['type'];
        $add['status'] = $params['status'];
        $add['url'] = $params['url'];
        $add['icon'] = $params['icon'];
        $add['remark'] = $params['remark'];
        $add['createtime'] = time();
        $res = Menu::instance()->insert($add);
        if($res === false){
            return json(['status' => false,'msg' => '操作失败']);
        }
        return json(['status' => true,'msg' => '操作成功']);
    }

    /**
     * @DESC：添加网站设置
     * @author: jason
     * @date: 2019-10-17 03:16:43
     */
    public function addSiteSitting($params)
    {
        //先要验证前端过来的值是不是真实存在的
        if(empty($params['title']) || !isset($params['title'])){
            return json(['status' => false,'msg' => '网站标题不能为空!']);
        }
        if(empty($params['icp']) || !isset($params['icp'])){
            return json(['status' => false,'msg' => 'ICP备案号!']);
        }
        if(empty($params['count_code']) || !isset($params['count_code'])){
            return json(['status' => false,'msg' => '统计代码不能为空!']);
        }
        if(empty($params['tel']) || !isset($params['tel'])){
            return json(['status' => false,'msg' => '固定电话不能为空!']);
        }
        if(empty($params['mail']) || !isset($params['mail'])){
            return json(['status' => false,'msg' => '邮箱不能为空!']);
        }
        $add = [
            'title' => $params['title'],
            'icp' => $params['icp'],
            'count_code' => $params['count_code'],
            'tel' => $params['tel'],
            'status' => $params['status'],
            'mail' => $params['mail'],
        ];
        $res = Site::instance()->insert($add);
        if($res === false){
            return json(['status' => false,'msg' => '添加失败！']);
        }
        return json(['status' => true,'msg' => '添加成功！']);
    }

    /**
     * @DESC：获取编辑网站设置的信息---单个
     * @param $id
     * @return mixed
     * @author: jason
     * @date: 2019-10-21 02:09:30
     */
    public function getEditsetting($id)
    {
        if(empty($id)){
            die('<div style="color:red;">没有找到要编辑的信息</div>');
        }
        $siteInfo = Site::instance()->where(['id' => $id])->find();
        if(empty($siteInfo)){
            die('<div style="color:red;">没有找到要编辑的信息</div>');
        }
        $info = $siteInfo->toArray();
        return $info;
    }

    /**
     * @DESC：编辑网站设置
     * @param $params
     * @return \think\response\Json
     * @author: jason
     * @date: 2019-10-21 03:31:01
     */
    public function editsetting($params)
    {
        $id = $params['id'];
        //数据校验
        if(empty($id)){
            return json(['status' => false,'msg' => '没有找到要编辑的信息']);
        }
        if(empty($params['title'])){
            return json(['status' => false,'msg' => '请填写网站名称']);
        }
        if(empty($params['icp'])){
            return json(['status' => false,'msg' => '请填写ICP备案号']);
        }
        if(empty($params['count_code'])){
            return json(['status' => false,'msg' => '请填写地址']);
        }
        if(empty($params['tel'])){
            return json(['status' => false,'msg' => '请填写电话']);
        }

        if(empty($params['mail'])){
            return json(['status' => false,'msg' => '请填写邮箱']);
        }
        $save['title'] = $params['title'];
        $save['icp'] = $params['icp'];
        $save['count_code'] = $params['count_code'];
        $save['tel'] = $params['tel'];
        $save['status'] = $params['status'];
        $save['mail'] = $params['mail'];
        Site::instance()->update($save,['id' => $id]);
        return json(['status' => true,'msg' => '修改成功']);
    }

    /**
     * @DESC：添加轮播图
     * @author: jason
     * @date: 2019-10-21 05:17:53
     */
    public function addslideshow($params)
    {
        if(!isset($params['pic']) || empty($params['pic'])){
            return json(['status' => false,'msg' => '添加失败']);
        }
        $add['pic'] = $params['pic'];
        $add['title'] = $params['title'] ?? '';
        $add['desc'] = $params['desc'] ?? '';
        $add['url'] = $params['url'] ?? '';
        $add['status'] = $params['status'] ?? 1;
        $res = Slideshow::insert($add);
        if($res === false){
            return json(['status' => false,'msg' => '添加失败']);
        }
        return json(['status' => true,'msg' => '添加成功']);
    }

    //轮播图列表
    public function getslideshow($params)
    {
        $where = [];
        if(!empty($params['status'])){
            $where['status'] = $params['status'];
        }
        $return = collection(Slideshow::order('id desc')->where($where)->select())->toArray();
        return $return;
    }

    /**
     * @DESC：获取单个轮播图
     * @author: jason
     * @date: 2019-10-21 06:16:56
     */
    public function getOneSlideshow($id)
    {
        if(empty($id)){
            die('<div style="color:red;">没有找到要修改的数据</div>');
        }
        $info = Slideshow::where(['id' => $id])->find();
        if(empty($info)){
            die('<div style="color:red;">没有找到要修改的数据</div>');
        }
        return $info->toArray();
    }

    /**
     * @DESC：确认编辑轮播图
     * @author: jason
     * @date: 2019-10-21 06:37:04
     */
    public function editslideshow($params)
    {
        if(empty($params['id'])){
            return json(['status' => false,'msg' => '没有找到要修改的数据']);
        }
        if(empty($params['pic'])){
            return json(['status' => false,'msg' => '请选择要上传的图片']);
        }
        $save['title'] = $params['title'];
        $save['pic'] = $params['pic'];
        $save['desc'] = $params['desc'];
        $save['url'] = $params['url'];
        $save['status'] = $params['status'];
        $res = Slideshow::update($save,['id' => $params['id']]);
        if($res ===  false){
            return json(['status' => false,'msg' => '修改失败']);
        }
        return json(['status' => true,'msg' => '修改成功']);
    }

    /**
     * @DESC：上传轮播图
     * @author: jason
     * @date: 2019-10-21 03:31:26
     */
    public function uploadimg($file)
    {
        //要有上传的数据
        if(empty($file)){
            return json(['status' => false,'msg' => '上传失败']);
        }
        $res = $this->upload($file);
        return json($res);
    }

    /**
     * @DESC：图片上传
     * @author: jason
     * @date: 2019-10-21 04:14:21
     */
    public function upload($file)
    {
        $imgDir = dirname(THINK_PATH).'/public';
        $lastDir = '/uploads/images/'.date('YmdH').'/';
        $imgSmallDir = $imgDir . $lastDir;
        if (!is_dir($lastDir)) {
            @mkdir($imgDir,0777,true);
        }
        if (!is_dir($imgSmallDir)) {
            @mkdir($imgSmallDir,0777,true);
        }
        $name = $file['name'];

        $filename = $file['name'];
        $error = $file['error'];

        $fileimg = strtolower(substr(strrchr($filename, "."), 1));
        //文件类型
        $typeArr = array('jpg', 'gif', 'png', 'jpeg');
        if(!in_array($fileimg,$typeArr)){
            $arr = array(
                'status' => 0,
                'msg' => "图片类型必须是【'jpg', 'gif', 'png', 'jpeg'】!",
                'data' => []
            );
            return $arr;
        }
        $tem_name = $file['tmp_name'];
        move_uploaded_file($tem_name,$imgSmallDir.$name);

        switch($error){
            case 0 :
                $arr = array(
                    'status' => 1,
                    'msg' => '文件上传成功!',
                    'data' => ['src' => $lastDir.$name]
                );
                break;
            case 1:
                $arr = array(
                    'status' => 0,
                    'msg' => '超过了上传文件大小',
                    'data' => []
                );
                break;
            case 2:
                $arr = array(
                    'status' => 0,
                    'msg' => '超过了文件的大小MAX_FILE_SIZE选项指定的值',
                    'data' => []
                );
                break;
            case 3:
                $arr = array(
                    'status' => 0,
                    'msg' => '文件只有部分被上传',
                    'data' => []
                );
                break;
            case 4:
                $arr = array(
                    'status' => 0,
                    'msg' => '没有文件被上传',
                    'data' => []
                );
                break;
            default:
                $arr = array(
                    'status' => 0,
                    'msg' => '上传文件大小为0',
                    'data' => []
                );
        }
        return $arr;
    }
    /**
     * @DESC：获取网站设置列表
     * @author: jason
     * @date: 2019-10-18 04:50:51
     */
    public function getSetting()
    {
        return collection(Site::instance()->order('id desc')->select())->toArray();
    }

    /**
     * @DESC：获取一条轮播图用来显示在前端
     * @author: jason
     * @date: 2019-10-22 02:36:24
     */
    public function getOneshow()
    {
        $where['status'] = 1;
        $return_data = Slideshow::where($where)->find()->toArray();
        return $return_data;
    }

    /**
     * @DESC：查询一条数据显示在前台页面
     * @author: jason
     * @date: 2019-10-23 09:30:42
     */
    public function getOneSite()
    {
        $return_data = Site::instance()->where(['status' => 1])->find()->toArray();
        return $return_data;
    }

}