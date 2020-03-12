<?php
namespace  app\admin\validate;
use think\Validate;

class  Admin extends Validate{
    protected $rule= [
        'name' => 'require|min:2',
        'password' =>'require|min:6|confirm:repassword',
        'email' =>'require|min:6',
        
    ];
    protected $message =[
        'name.require'=>'用户名不能为空',
        'name.min'=>'用户名长度不小于3',
        'password.require'=>'密码不能为空',
        'password.min'=>'密码长度不小于6',
        'password.confirm'=>'密码不一致',
        'email.require'=>'邮箱不能为空',
        'email.min'=>'邮箱长度不小于6',
    ];

}