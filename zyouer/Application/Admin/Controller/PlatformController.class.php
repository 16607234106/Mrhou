<?php
/**
 * Class PlatformController
 * @package Admin\Controller
 * @auth 317149766@qq.com
 */
namespace Admin\Controller;

use Think\Controller;

class PlatformController extends BaseController
{
    public function index()
    {
        $startdate = date("Y-m-d") . " 00:00:00";
        $enddate = date("Y-m-d") . " 23:59:59";
        $where = array(
            'add_time' => array('between', "{$startdate},$enddate"),
        );
        //当天注册的总数量
        $userModer = M("User");
        $Kinder = M("Kinder");
        $todaycount = $userModer->field("count(user_id) as user_count")->where($where)->select();
        //今日注册数量

        $totalcount = $userModer->count("user_id");
        //今日发布信息数量
        $type = array(1, 2, 3, 4);
        $where = array(
            'type' => array('in', $type),
            'status' => 0,
        );
        $aplytodayCount1 = $Kinder->where($where)->count("id");//发布的总数量
        //1为转让 2为求购买 3房产出售 4招标
        $where['status'] = 1;//转让
        $transfer1 = $Kinder->where($where) ->count();//当天转让的数量
        $where['status'] = 2;//求购
        $buyer1 = $Kinder->where($where) ->count();
        $where['status'] = 3;//出售
        $seller1 = $Kinder->where($where) ->count();
        $where['status'] = 4;//招标
        $tender1 = $Kinder->where($where) ->count();
        $where['status'] = 5;//招租
        $renter1 = $Kinder->where($where) ->count();

        $where['add_time'] = array('between', "{$startdate},$enddate");
        $aplytodayCount = $Kinder->where($where)->count("id");//今日发布的数量
        $where['status'] = 1;//转让
        $transfer = $Kinder->where($where) ->count();//当天转让的数量
        $where['status'] = 2;//求购
        $buyer = $Kinder->where($where) ->count();
        $where['status'] = 3;//出售
        $seller = $Kinder->where($where) ->count();
        $where['status'] = 4;//招标
        $tender = $Kinder->where($where) ->count();
        $where['status'] = 5;//招租
        $renter = $Kinder->where($where) ->count();

        $list['renter']=$renter;
        $list['seller']=$aplytodayCount;
        $list['buyer']=$transfer;
        $list['transfer']=$buyer;
        $list['aplytodayCount']=$seller;
        $list['tender']=$tender;


        $list['renter1']=$renter1;
        $list['seller1']=$aplytodayCount1;
        $list['buyer1']=$transfer1;
        $list['transfer1']=$buyer1;
        $list['aplytodayCount1']=$seller1;
        $list['tender1']=$tender1;
        $this->display();
    }


}