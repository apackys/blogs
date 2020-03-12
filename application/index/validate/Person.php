<?php
namespace app\index\validate;
use think\Validate;

class Person extends Validate{
    protected $rule =   [
        'name' => 'require|min:2',
        'password' =>'require|min:6|confirm:repassword',
        
    ];
    
    protected $message  =   [
        'name.require'=>'用户名不能为空',
        'name.min'=>'用户名长度不小于3',
        'password.require'=>'密码不能为空',
        'password.min'=>'密码长度不小于6',
    ];

}