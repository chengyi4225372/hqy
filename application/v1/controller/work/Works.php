<?php
namespace app\v1\controller\work;
use app\common\controller\AuthController;
use think\Config;
use app\common\model\Work;
use app\v1\service\Workservice;

class Works extends  AuthController
{

    public function index()
    {
     if($this->request->isGet()){
         $title = input('get.title','','trim');
         $list = Workservice::instance()->getNewList($title);
         $this->assign('list',$list);
         $this->assign('title','行业资讯');
         return $this->fetch();
       }
       return false;
    }

    /**
     * 添加
     */
    public function add()
    {
        if($this->request->isGet()){
            return $this->fetch();
        }

        if($this->request->isPost()){
         $data = $this->request->param();

         if(empty($data)){
             return false;
         }

         $array = array(
             'title'=>$data['title'],
             'desc' =>$data['desc'],
             'content'=>$data['content'],
             'keyword'=>$data['keyword'],
             'sort'=>$data['sort'],
             'imgs'=>$data['imgs'],
             'create_time'=>time(),
         );

         $ret = Workservice::instance()->setAddArray($array);

         if($ret){
             return json(['code'=>200,'msg'=>'操作成功']);
         }else{
             return json(['code'=>400,'msg'=>'操作失败']);
         }

        }
    }

    /**
     * 编辑
     */
    public function edit(){

        if($this->request->isGet()){
            $id = input('get.id','','int');

            if(empty($id) || !isset($id)|| $id < 0){
                return false;
            }
            $info = Workservice::instance()->getIdInfo($id);

            $this->assign('info',$info);
            return $this->fetch();
        }

        if($this->request->isPost()){
           $data = $this->request->param();
           if(empty($data['id']) || !isset($data['id'])){
               return false;
           }

           $arr= array(
               'title'=>$data['title'],
               'keyword'=>$data['keyword'],
               'desc'=>$data['desc'],
               'content'=>$data['content'],
               'imgs'=>$data['imgs'],
               'sort'=>$data['sort'],
           );
           $ret = Workservice::instance()->updateByArray($arr,$data['id']);

           if($ret){
               return json(['code'=>200,'msg'=>'操作成功']);
           }else {
               return json(['code'=>400,'msg'=>'操作失败']);
           }
        }

    }

    /**
     * @return bool
     * 删除
     */
    public function del(){

        if($this->request->isPost()){
          $id = input('post.id','','int');

          if(empty($id)){
              return false;
          }

          $ret = Workservice::instance()->setDel($id);

          if($ret){
               return json(['code'=>200,'msg'=>'操作成功']);
          }else {
              return json(['code'=>400,'msg'=>'操作失败']);
          }
        }
        return false;
    }

    /**
     * @return cheng
     * 设置 排序
     */
    public function setsort(){
        if($this->request->isPost()){
            $id  = input('post.id','','int');
            $sort= input('post.sort','','int');

            if(!is_int($id) && !is_string($id)){
                return false;
            }

            $ret = Workservice::instance()->toSetsort($id,$sort);

            if($ret === true){
                return json(['code'=>200,'msg'=>'排序成功']);
            }else {
                return json(['code'=>400,'msg'=>'排序失败']);
            }

        }
        return false;
    }


   //上传图片
    public function uploadImgs(){
        // 获取上传文件
        $file =$this->request->file('file');
        // 验证图片,并移动图片到框架目录下。
        $path = ROOT_PATH.'public/uploads/imgs/works/';

        if(!is_dir($path)){
            mkdir($path,0755);
        }

        $info = $file->move($path,false,true);
        if($info){
            $mes = $info->getSaveName();
            $mes = str_replace("\\",'/',$mes);
            return json(['code'=>'200','msg'=>'上传成功','path'=>'/uploads/imgs/works/'.$mes]);
        }else{
            // 文件上传失败后的错误信息
            $mes = $file->getError();
            return json(['code'=>'400','msg'=>$mes]);
        }
    }

}