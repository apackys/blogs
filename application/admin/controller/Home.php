<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\validate\Admin as AdminValid;
use app\admin\model\Admin as AdminModel;

class Home extends Base{
    public function index(){
        return $this->fetch();
    }
    public function addadmin(){
        if (request()->isAjax()) {
            $data = [
                'name'=>input('username'),
                'password'=>input('password'),
                'repassword' => input('repassword'),
                'status' => input('status'),                
                'nickname'=>input('nickname'),
                'email' => input('email')
            ];
            $val = new AdminValid();
            if(!$val->check($data)){
                return $this->error($val->getError());
                exit();
            }
            $user = new AdminModel();
            $res=$user->allowField(true)->save($data);
            if($res){
                return $this->success('添加管理员成功','home/adminlist');
            }else{
                return  $this->error('添加管理员失败');
            }
        }
        return view();
    }
    public function adminlist(){
        $data = AdminModel::paginate(5);
        $page = $data->render();
        $this->assign('page',$page);
        $this->assign('list',$data);
        return view();
    }
    public function admindisabled(){
        $data=['id' => input('id'),
            'status' => input('status') ? 0 : 1
        ];
        $user = new AdminModel();
        $res = $user->isUpdate(true)->save($data);
        if($res){
            $this->success('操作成功！', 'admin/home/adminlist');
        }else{
            $this->error('操作失败');
        }
    }
    public function admindelete(){
        $user = new AdminModel();
        $res =$user->find(input('id'))->delete();
        if($res){
            $this->success('删除账号成功！', 'admin/home/adminlist');
        }else{
            $this->error('删除账号失败');
        }
    }
}