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

class CityModel extends Model
{
   public function getCitySel($controller,$province,$city){
        /* 取得省份 */
        $controller->assign('province_list',get_regions(1, 1));//$order->country 这里默认是中国 不动态取
        if ($province > 0)
        {
            /* 取得城市 */
            $controller->assign('city_list',get_regions(2, $province));
//         if ($city > 0)
//         {
//             /* 取得区域 */
//             $controller->assign('district_list', get_regions(3, $city));
//         }
        }
    }

   public function get_regions($type=0,$parent = 0){
        $where =array(
            'region_type'=>$type,
            'parent_id'=>$parent
        );
        return D("Region")->field("region_id,region_name")->where($where)->select();
    }
}
