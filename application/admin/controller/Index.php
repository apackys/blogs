<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin as UserModel;

class Index extends Controller{
    public function login(){
        return $this->fetch();
    }
    public function check(){
        $data = input('post.');
        $user = new UserModel();
        $res = $user->where('name',$data['name'])->find();

        if($res){
            if($res['password']===md5($data['password'])){
                session('name',$data['name']);
            }else{ $this->error('密码错误');}
        }else{
            $this->error('用户名错误');
        }
        if(captcha_check($data['code'])){
           
            $this->success('登录成功','Home/index');
           }else{
               $this->error('验证码错误');
           }

    }
   public function logout(){
       session(null);
       if(session('?name')){
        $this->error('退出失败！');
       }else{
       $this->success('安全退出','Index/login');}
   }
 
}