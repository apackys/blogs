<?php
namespace app\admin\model;
use think\Model;
use traits\model\SoftDelete;

class Admin extends Model{
    use Softdelete;
    protected static $deleteTime='delete_time';
    protected $autoWriteTimestamp = 'datetime';
    protected $datetime_format = 'Y-m-d H:i:s';
    protected $auto=['ip','password'];
    protected function setIpAttr(){
        return request()->ip();
    }
    protected function setPasswordAttr($value){
        return md5($value);
    }

    protected function setNameAttr($value)
    {
        return strtolower($value);
    }
    
}