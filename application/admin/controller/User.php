<?php
namespace app\admin\controller;
use app\admin\Controller\Base;
use app\admin\model\User as UserModel;
use app\admin\validate\User as UserValidate;

class User extends Base{
    public function index(){
        return $this->fetch();
    }
    public function userlist(){
        
        $data = UserModel::paginate(10);
        // 获取分页显示
        $page = $data->render();
        $this->assign('data',$data);
        $this->assign('page',$page);
        return $this->fetch();
    }
    public function add(){
        return $this->fetch();
    }
    //增加管理员方法
    public function insert(){
        $data =input('post.');
        $val = new UserValidate();
        if(!$val->check($data)){
            //返回validate中messagec错误信息
            return $this->error($val->getError());
            exit();
        }
        $user = new UserModel($data);
        $res = $user->allowField(true)->save();
        if($res){
            return $this->success('添加管理员成功','user/userlist');
        }else{
            return  $this->error('添加管理员失败');
        }


    }
    public function edit(){
        $id=input('get.id');
        $data= UserModel::get($id);
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function update(){
        $data = input('post.');
        $id = input('post.id');
        $val = new UserValidate();
        if(!$val->check($data)){
            $this->error($val->getError());
            exit();
        }
        $user = new UserModel();
        $res=$user->allowField(true)->save($data,['id'=>$id]);
        if($res){
            $this->success('修改用户信息成功', 'User/userlist');
        }else{ $this->error('修改用户信息失败');}
    }
    public function delete(){
        $id= input('get.id');
        $user =UserModel::destroy($id);
        if($user){
            $this->success('删除成功','User/userlist');
              }else{
                  $this->error('删除失败');
              }
    }


}