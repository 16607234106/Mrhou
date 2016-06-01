<?php
/**
 * Created by PhpStorm.
 * User: houchao
 * Date: 2016-05-31
 * Time: 13:05
 */
 function getCitySel($controller,$province,$city){
     $controller->assign('province_list',get_regions(1, 1));
     if ($province > 0)
     {

         $controller->assign('city_list',get_regions(2, $province));
         if ($city > 0)
         {
             $controller->assign('district_list', get_regions(3, $city));
         }
     }
 }

function get_regions($type=0,$parent = 0){
    $where =array(
        'region_type'=>$type,
        'parent_id'=>$parent
    );
   return D("Region")->field("region_id,region_name")->where($where)->select();
}

/**
 * 获取真实ip
 * @return string
 */
function get_clientip()
{
    static $CLI_IP = NULL;
    if (isset($CLI_IP)) {
        return $CLI_IP;
    }

    //~ get client ip
    if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
        $CLI_IP = getenv('HTTP_PHP_IP');
    } elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
        $CLI_IP = getenv('HTTP_X_FORWARDED_FOR');
    } elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
        $CLI_IP = getenv('REMOTE_ADDR');
    } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
        $CLI_IP = $_SERVER['REMOTE_ADDR'];
    }
    preg_match("/[\d\.]{7,15}/", $CLI_IP, $ipmatches);
    $CLI_IP = $ipmatches[0] ? $ipmatches[0] : 'unknown';

    return $CLI_IP;
}

/**
 * 字符串截取
 */
function sub_str($str){
    $length = mb_strlen($str,"UTF-8");
    if($length>=15){
      return  mb_substr($str,0,15,"UTF-8")."...";
    }else{
        return  mb_substr($str,0,$length,"UTF-8");
    }
    }

/**
 *
 * @param $dir
 * @param string $mode
 * @param bool|TRUE $recursive
 * @return bool
 */
function mkdirs($dir, $mode = '', $recursive = TRUE)
{
    if (is_dir($dir)) {
        return TRUE;
    }

    if (!$mode) {
        $mode = 0777;
    }

    mkdir($dir, $mode, $recursive);
    chmod($dir, $mode);

    return is_dir($dir);
}

function randstr($len = 6, $prefix = '')
{
    static $_charset = array('a', 'b', 'c', 'd', 'e', 'f', 'g',
        'h', 'i', 'j', 'k', 'l', 'm', 'n',
        'o', 'p', 'q', 'r', 's', 't',
        'u', 'v', 'w', 'x', 'y', 'z',
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    $rlen = count($_charset) - 1;
    $str = '';
    for ($i = 0; $i < $len; $i++) {
        //$str .= chr(mt_rand(97, 122)); //48~57
        $str .= $_charset[mt_rand(0, $rlen)];
    }
    return $prefix . $str;
}