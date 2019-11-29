<?php
namespace app\v1\controller\cate;

use app\common\controller\AuthController;
use app\v1\service\Infosservice;
use think\Config;
use app\common\model\Ification;
use app\v1\service\Ificationservice;

class Ifications extends  AuthController
{
    /**
     *列表页
     */
     public function index(){
       if($this->request->isGet()){
           $title = input('get.title','','trim');
           $list  = Ificationservice::instance()->getlist($title);
           $this->assign('list',$list);
           return $this->fetch();
       }
         return false;
     }

    /**
     * 添加
     */
     public function add(){

         if($this->request->isGet()){
            return $this->fetch();
         }

         if($this->request->isPost()){
             $data['title'] = input('post.title','','trim');
             $data['sort']  = input('post.sort','','int');
             $data['create_time']  = time();

             if(empty($data)){
                 return false;
             }

             $res = Ificationservice::instance()->insertData($data);

             if($res !== false){
                 return json(['code'=>200,'msg'=>'操作成功']);
             }else {
                 return json(['code'=>400,'msg'=>'操作失败']);
             }
         }
         return false;
     }

    /**
     * 编辑
     */
     public function edit(){
         if($this->request->isGet()){
             $id  = input('get.mid','','int');

             if(empty($id) || is_null($id) || $id <= 0){
                 return false;
             }

             $info = Ificationservice::instance()->getIdinfo($id);
             $this->assign('info',$info);
             return $this->fetch();
         }

         if($this->request->isPost()){
              $id = input('post.mid','','int');
              $data['title'] = input('post.title','','trim');
              $data['sort']  = input('post.sort','','int');

              if(empty($id)|| $id<=0 || is_null($id)){
                  return false;
              }

              $ret = Ificationservice::instance()->editData($id,$data);

              if($ret !== false){
                  return json(['code'=>200,'msg'=>'编辑成功']);
              }else{
                  return json(['code'=>400,'msg'=>'编辑失败']);
              }
         }

         return false;
     }

    /**
     * 伪删除操作
     */
     public function dels(){
        if($this->request->isGet()){

           $id = input('get.mid','','int');

           if(empty($id) || is_null($id) || $id <= 0){
               return false;
           }

           $ret= Ificationservice::instance()->saveStatus($id);

           if($ret !== false){
               return json(['code'=>200,'msg'=>'删除成功']);
           }else {
               return json(['code'=>400,'msg'=>'删除失败']);
           }
        }
        return false;
     }

    /**
     * 修改状态
     */
    public function change(){
        if($this->request->isGet()){
           $id   = input('get.mid','','int');
           $sort = input('get.sorts','','int');

           if(empty($id)|| is_null($id) || $id <=0 || !isset($id)){
               return false;
           }

           $ret = Ificationservice::instance()->saveSort($id,$sort);

           if($ret !== false){
               return json(['code'=>200,'msg'=>'修改成功']);
           }else {
               return json(['code'=>400,'msg'=>'修改失败']);
           }
        }

        return false;
    }

}
