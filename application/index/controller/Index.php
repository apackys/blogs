<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Person as PModel;
use app\index\validate\Person as PValid;


class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    public function login()
    {
        return $this->fetch();
    }
    public function register()
    {
        return $this->fetch();
    }
    public function add(){
        $data=input('post.');
        $val = new PValid();
        if(!$val->check($data)){
            $this->error($val->getError());
            exit();
        }
        $user = new PModel();
        $res=$user->allowField(true)->save($data);
        if($res){
            session('name',$data['name']);
        }else{
            $this->error('注册失败');
        }
        if(captcha_check($data['code'])){
            $this->success('注册成功','index/index');
           }else{
               $this->error('验证码错误');
           }

    }
    public function check(){
        $data = input('post.');
        $val = new PModel();
        $res = $val->where('name',$data['name'])->find();
       // dump($res);
       // die();
        if($res){
            if($res['password'] === md5($data['password'])){
                session('name',$data['name']);
            }else{
                $this->error('密码错误');
            }

        }else{
            $this->error('用户名不正确');
        }
        if(captcha_check($data['code'])){
            $this->success('登录成功','index/index');
        }else {
            $this->error('验证码不正确');
        }

    }

    public function logout(){
        session(null);
        $this->success('安全退出','Index/login');
    }
    
}
