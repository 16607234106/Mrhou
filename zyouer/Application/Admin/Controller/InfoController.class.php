<?php
namespace Admin\Controller;
use Think\Controller;
class InfoController extends BaseController {
   public function transfer(){
       $user_type =I("status",0,"intval");
       $this->assign('status',C("youer"));
       $this->assign('user_type',$user_type);
       $this->display();
   }
}