<?php
namespace app\v1\controller\partners;

use app\common\controller\AuthController;
use app\v1\service\Protuctservice;
use think\Config;
use app\common\model\Partners;
use app\v1\service\Partnersservice;

class Partner extends  AuthController
{

  public function index()
  {
   if($this->request->isGet()){
       $list = Partnersservice::instance()->getList();
       $this->assign('list',$list);
       $this->assign('title','合作伙伴');
       return $this->fetch();
   }
   return false;
  }

  public function add(){
      if($this->request->isGet()){
          return $this->fetch();
      }
      if($this->request->isPost()){
        $param['imgs'] = input('post.imgs','','trim');
        $param['iurl'] = input('post.iurl','','trim');

        $ret = Partnersservice::instance()->add($param);

        if($ret){
            return json(['code'=>200,'msg'=>'操作成功']);
        }else{
            return json(['code'=>400,'msg'=>'操作失败']);
        }

      }

  }


  public function edit(){
      if($this->request->isGet()){
          $id = input('get.id','','int');

          if(empty($id)){
              return false;
          }

         $info = Partnersservice::instance()->getInfoId($id);
         $this->assign('info',$info);
         return $this->fetch();
      }

     if($this->request->isPost()){
         $id   = input('post.id','','int');
         $param['imgs'] = input('post.imgs','','trim');
         $param['iurl'] = input('post.iurl','','trim');

         if(empty($id) || $id <=0){
             return false;
         }

         $ret = Partnersservice::instance()->updateId($param,$id);

         if($ret){
             return json(['code'=>200,'msg'=>'操作成功']);
         }else {
             return json(['code'=>400,'msg'=>'操作失败']);
         }
     }

  }



 public function uploadImgs(){
        // 获取上传文件
        $file =$this->request->file('file');
        // 验证图片,并移动图片到框架目录下。
        $path = ROOT_PATH.'public/uploads/imgs/partner/';

       if(!is_dir($path)){
         mkdir($path,0755);
       }

        $info = $file-> move($path,false,true);
        if($info){
            $mes = $info->getSaveName();
            $mes = str_replace("\\",'/',$mes);
            return json(['code'=>'200','msg'=>'上传成功','path'=>'/uploads/imgs/partner/'.$mes]);
        }else{
            // 文件上传失败后的错误信息
            $mes = $file->getError();
            return json(['code'=>'400','msg'=>$mes]);
        }
    }




  //TODO 未完成
  public function del(){

  }




}