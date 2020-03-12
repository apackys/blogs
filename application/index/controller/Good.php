<?php
namespace app\index\controller;
use app\index\controller\Base;

class Good extends Base{
    protected $ischeck_login = ['buy'];
    public function add(){
        echo '添加商品';
    }
    public function buy(){
        echo '购买商品';
    }
}