<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
        $this->display();
    }
    public function main()
    {
        $this->display();
    }
    public function add(){
        $a=111111111111111111111111;
        $this->assign("a",$a);
        $this->display();
    }

}