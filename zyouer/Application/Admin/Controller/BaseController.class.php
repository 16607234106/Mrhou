<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {
    public function _initialize(){
        $_SESSION['uid']=1;
        $uid = $_SESSION['uid'];
        if(empty($uid)){
            $this->error("请先登录!", U('Login/login'));
        }
    }

    public  function ajax($data){
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode($data);
    }
}