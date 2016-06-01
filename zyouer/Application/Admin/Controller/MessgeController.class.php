<?php
namespace Admin\Controller;
use Think\Controller;
class MessgeController extends BaseController {
   public function common(){
       $a = 11111;
       $this->assign("a",$a);
       $this->display();
   }
    public function law(){
        $a = 11111;
        $this->assign("a",$a);
        $this->display();
    }
}