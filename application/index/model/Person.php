<?php
namespace app\index\model;
use think\Model;

class Person extends Model{
    protected $datetime_format = 'Y-m-d H:i:s';
    protected $autoWriteTimestamp = 'datetime';
    protected function setPasswordAttr($value){
        return md5($value);
    }
}