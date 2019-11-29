<?php
namespace app\v1\controller\protuct;
use app\common\controller\AuthController;
use think\Config;
use app\common\model\Protuct;
use app\v1\service\Protuctservice;
class Protucts extends AuthController
{

   public function index(){

      if($this->request->isGet()){
          $names = input('get.names','','trim');
          $list = Protuctservice::instance()->getList($names);
          $this->assign('list',$list);
          $this->assign('title','产品列表');
          return $this->fetch();
      }

   }

   public function add(){

     if($this->request->isGet()){
         return $this->fetch();
     }

     if($this->request->isPost()){
        $param = $this->request->param();
        $array = [
            'purl'=>$param['purl'],
            'imgs'=>$param['imgs'],
            'names'=>$param['names'],
            'status'=>$param['status'],
            'desc'  =>$param['desc'],
        ];
        $ret = Protuctservice::instance()->protuctAdd($array);
        if($ret){
            return json(['code'=>200,'msg'=>'操作成功']);
        }else {
            return json(['code'=>400,'msg'=>'操作失败']);
        }

     }

   }

   public function edit(){
       if($this->request->isGet()){

         $id   = input('get.id','','int');
         if(empty($id)){
             return false;
         }

         $info = Protuct::instance()->where(['id'=>$id])->find();

         $this->assign('info',$info);
         return $this->fetch();
       }

       if($this->request->isPost()){
          $param = $this->request->param();
          $array = array(
              'purl'=>$param['purl'],
              'imgs'=>$param['imgs'],
              'names'=>$param['names'],
              'status'=>$param['status'],
              'desc'  =>$param['desc'],
          );

           $ret = Protuctservice::instance()->updateByid($array,$param['id']);
           if($ret){
               return json(['code'=>200,'msg'=>'操作成功']);
           }else {
               return json(['code'=>400,'msg'=>'操作失败']);
           }
       }
   }

   public function uploadImg(){
       // 获取上传文件
       $file =$this->request->file('file');
       // 验证图片,并移动图片到框架目录下。
       $path = ROOT_PATH.'public/uploads/imgs/protucts/';

       if(!is_dir($path)){
           mkdir($path,0755);
       }

       $info = $file->move($path,false,true);
       if($info){
           $mes = $info->getSaveName();
           $mes = str_replace("\\",'/',$mes);
           return json(['code'=>'200','msg'=>'上传成功','path'=>'/uploads/imgs/protucts/'.$mes]);
       }else{
           // 文件上传失败后的错误信息
           $mes = $file->getError();
           return json(['code'=>'400','msg'=>$mes]);
       }
   }

    //todo 待完成删除
    public function del()
    {

    }
}