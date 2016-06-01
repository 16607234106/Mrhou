<?php
/**
 * Created by PhpStorm.
 * User: houchao
 * Date: 2016-05-29
 * Time: 21:16
 */
namespace Admin\Model;

use Think\Model;
use Think\Pager;

class KinderModel extends Model
{
    /**
     * @param Pager $pager
     * @param $list
     * @param $status
     */
    public function getListPage(Pager $pager, $list,$where)
    {
//            return $data;
        $count = count($list);
        $pager->setTotalNum($count);
        $limit = $pager->start . "," . $pager->pagesize;
        $data = $this->where($where)->order("add_time Desc")->limit($limit)->select();
        $pager->result = $data;
    }

    /**
     * @param $id
     */
    public function updateStatus($id){
        $where = array(
            'status'=>array('in',"0,-1"),
            'id'=>$id
        );
//        $User-> where('id=5')->setField('name','ThinkPHP');
       return $this->where($where)->setField("is_delete",1);
    }

    /**
     * @param $ids
     */
    public function updateAllStatus($ids){
        $where = array(
            'id'=>array('in',$ids),
            'status'=>0
        );
        return $this->where($where)->setField("is_delete",1);
    }
}
