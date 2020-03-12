<?php
namespace app\index\controller;
use think\Controller;
use think\Request;

class Base extends Controller{
    protected $ischeck_login = [''];
     public function _initialize(){
    if(!$this->islogin() && (in_array(Request::instance()->action(), $this->ischeck_login) || $this->ischeck_login[0]=='*'))
   {
      $this->error('请先登录系统', 'index/index/login');
    }
}
    public function islogin(){
        return  session('?name');
    }

}