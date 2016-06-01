<?php
namespace Admin\Controller;

use Think\Controller;

class CheckController extends BaseController
{
    public function index()
    {
        $type = I('status', 0, "intval");
        $this->assign('status', $type);
        $this->display();
    }


    public function ajax_check()
    {
        if(isset($_GET['user_type'])){
            $user_type =I("user_type",0,"intval");
            $this ->assign("user_type",$user_type);
        }
        $current_page = I('current_page', 1, 'intval');
        $type = I('status', 0, "intval");
        $this->assign('type', $type);
        $whewe = array(
            'status' => $type,
            'is_delete' => 0
        );
        if(isset($_GET['user_type'])){
            $type =1;
            $whewe = array(
                'type' =>I("user_type",0,"intval"),
                'is_delete' =>0,
                'status' =>$type
            );
        }
        if (isset($_POST['check'])) {
            $t_person = I("t_person", "", "htmlspecialchars");
            $time_left = I("time_left", "", "htmlspecialchars");
            $time_right = I("time_right", "", "htmlspecialchars");
            $whewe = array(
                'status' => $type,
                'is_delete' => 0,
                't_person' => array('like', "%{$t_person}%")
            );
            if (!empty($time_left) && !empty($time_right)) {
                $whewe['add_time'] = array('between', "{$time_left},{$time_right}");
            }
        }
        $list = M("Kinder")->where($whewe)->order("add_time Desc ,type ASC")->select();
        $you_type = C("youer_type");
        $status = C("youer");

        $pager = new  \Think\Pager($current_page, 3);
        $kinder = D("Kinder");

        $kinder->getListPage($pager, $list, $whewe);
        $ret = $pager->outputPageJson();
        $this->assign("status", $status);
        $this->assign("youer_type", $you_type);
        $this->assign('ret', $ret);
        $this->display("ajaxCheck");
    }

    public function del_check()
    {
        $id = I("id", 0, "intval");
        $status = I("status", 0, "intval");
        $result = D("Kinder")->updateStatus($id);
        if ($result !== false && $status != 1) {
            echo "1";
        }
    }

    public function delAll_check()
    {
        $ids = I("ids");
        $status = I("status", 0, "intval");
        $result = D("Kinder")->updateAllStatus($ids);
        if ($result !== false && $status == 0) {
            echo "1";
        }
    }


    public function checkStatus()
    {

        $id = I("id", 0, "intval");
        $result = M("Kinder")->getById($id);
        $city = $result['city'];
        $province = $result['province'];
        getCitySel($this->view, $province, $city);
        $limit_days = C("limit_day");

        $this->assign('limit_days', $limit_days);
        $youer_type = C("youer_type");
        $this->assign("check", true);
        if(isset($_GET['user_do'])){
           $user_do = I("user_do","","htmlspecialchars");

            if($user_do == 'edit'){
                $this->assign("check", false);
            }elseif($user_do == 'look'){
                $this->assign("check", true);
            }
            $this->assign("user_do",$user_do);
        }
        $this->assign("youer_type", $youer_type);
        $this->assign("list", $result);
        $this->display("inCheck");
    }

    public function addMsg()
    {
        $limit_days = C("limit_day");
        $youer_type = C("youer_type");


        $this->assign('province_list',get_regions(1, 1));
        $this->assign("youer_type", $youer_type);
        $this->assign("check", false);
        $this->assign('limit_days', $limit_days);
        $this->display("inCheck");
    }

    /**
     * 省市区联动
     */
    public function region()
    {
//        $region = $request->get('region');
        $region = I("region", "", "htmlspecialchars");
        $type = I("type", "", "htmlspecialchars");
        if ($type && $region) {
            $region_list = get_regions($type, $region);
            $this->ajaxReturn($region_list);
        }
    }

    /**
     * 审核信息
     */
    public function doCheck()
    {
        $status = I("status", "", "intval");
        $id = I("id", "", "intval");
        $data = array(
            'status' => $status
        );
        $where = array(
            'id' => $id
        );
        M("Kinder")->where($where)->save($data);
        $ret['retmsg'] = "操作成功！";
        $ret['status'] = 1;
        $this->ajaxReturn($ret);
    }

    /**
     * 完成交易
     */
    public function buy_finish(){
        $id = I("id", "", "intval");
        $data = array(
            'status' => 3
        );
        $where = array(
            'id' => $id
        );
        M("Kinder")->where($where)->save($data);
        $ret['retmsg'] = "恭喜您已完成交易！";
        $ret['status'] = 1;
        $this->ajaxReturn($ret);
    }

    /**
     *
     */
    public function doAddMsg(){
            $data = I("data","","htmlspecialchars");

            $data['popularity']=0;
            $data['ip']=get_clientip();
            $data['is_delete']=0;
            $data['status']=0;
            $data['add_time']=date("Y-m-d");
            $data['user_id']=session("uid");
            unset($data['remLen'],$data['id']);
            M("Kinder")->add($data);
            $ret['retmsg'] = "发布信息成功";
            $ret['status'] = 1;
            $this->ajaxReturn($ret);
    }

    /**
     * 图片上传
     */
    public function img_upload(){
       $data = I("img","","htmlspecialchars");
        $uploadr = new  \Think\Uploader($data,"/Upload/img/");
        $data = $uploadr->saveImgData();

        $data = $uploadr->buildUploadResult($data);
        $this->ajaxReturn($data);
    }
}