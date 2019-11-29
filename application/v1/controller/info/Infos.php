<?php

namespace app\v1\controller\info;
use app\common\controller\AuthController;
use think\Config;
use app\common\model\Info;
use app\v1\service\Infosservice;
use app\v1\service\Ificationservice;
class Infos extends  AuthController
{


  public function index(){
    if($this->request->isGet()){
        $title = input('get.title','','trim');
        $list = Infosservice::instance()->getList($title);
        $this->assign('list',$list);
        $this->assign('title','招标信息');
        return $this->fetch();
    }

    return false;
  }


  public function infosAdd(){
    if($this->request->isGet()){
        $catelist = Ificationservice::instance()->getlist('');
        $this->assign('catelist',$catelist);
        return $this->fetch();
    }

    if($this->request->isPost()){
        $array['pid'] = input('post.pid', '', 'int');
        $array['title'] = input('post.title', '', 'trim');
        $array['content'] = input('post.content', '');
        $array['describe'] = input('post.describe', '', 'trim');
        $array['imgs']  = input('post.imgs', '', 'trim');
        $array['keyword']  = implode(',',json_decode(input('post.keyword', '', 'trim')));
        $array['release_time'] = date("Y-m-d");

       $ret = Infosservice::instance()->saves($array);
       if($ret){
           return json(['code'=>200,'msg'=>'操作成功']);
       }else {
           return json(['code'=>400,'msg'=>'操作失败']);
       }
    }

  }


  public function infosEdit(){

      if($this->request->isGet()){
          $id = input('get.id','','int');
          if(empty($id)){
              return false;
          }
          $info    = Infosservice::instance()->getId($id);

          $keywords = explode(',',$info['keyword']);

          //关键字列表
          $catelist = Ificationservice::instance()->getlist('');
          $this->assign('list',$catelist);
          $this->assign('info',$info);
          $this->assign('keywords',$keywords);
          return $this->fetch();
      }

      if($this->request->isPost()){
          $id = input('post.id','','int');
          $array = array(
              'pid'     =>input('post.pid','','int'),
              'title'   =>input('post.title','','trim'),
              'content' =>input('post.content'),
              'describe'=>input('post.describe','','trim'),
              'keyword' =>implode(',',json_decode(input('post.keyword', '', 'trim'))),
              'imgs'    =>input('post.imgs', '', 'trim'),
          );

          $ret = Infosservice::instance()->updateId($array,$id);
          if($ret){
              return json(['code'=>200,'msg'=>'操作成功']);
          }else {
              return json(['code'=>400,'msg'=>'操作失败']);
          }
      }
  }


  //删除
  public function infoDels(){

     if($this->request->isGet()){
        $id = input('get.id','','int');

        if(empty($id)){
            return false;
        }

        $arr = ['status'=>0];
        $ret = Infosservice::instance()->dels($arr,$id);

        if($ret){
          return json(['code'=>200,'msg'=>'操作成功']);
        }else{
            return json(['code'=>400,'msg'=>'操作失败']);
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