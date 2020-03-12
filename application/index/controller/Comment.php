<?php
namespace app\index\controller;
use app\index\controller\Base;

class Comment extends Base{
    protected $ischeck_login=['*'];
    public function post(){
        echo '发表评论';
    }
    public function edit(){
        echo '编辑评论';
    }
}