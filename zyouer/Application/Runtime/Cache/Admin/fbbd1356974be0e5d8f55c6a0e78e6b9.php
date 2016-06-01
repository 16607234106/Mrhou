<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="/<?php echo (ADMIN_CSS_PATH); ?>/style.css" type="text/css" media="screen">
    <script type="text/javascript" src="/<?php echo (ADMIN_JS_PATH); ?>/jquery.js"></script>

    <script type="text/javascript" src="/<?php echo (ADMIN_JS_PATH); ?>/layer.js"></script>
    <script type="text/javascript" src="/<?php echo (ADMIN_JS_PATH); ?>/mytool.js"></script>
    <script type="text/javascript" src="/<?php echo (ADMIN_JS_PATH); ?>/jquery.ajaxfileupload.js"></script>
    <style>
        .upload_button{
            width: 100px;
            height: 25px;

            border: 1px solid red;
            text-align: center;
            line-height: 25px;
            background-color: #FF00A8;
            color: white;
            border-radius: 5px;

        }
        .file_upload{
            opacity: 0;
            top: 524px;
            position: absolute;
            /*border: 1px solid red;*/
            width: 100px;
            height: 25px;
            left: 182px;
        }
        #center{
            position: relative;
        }
    </style>
</head>
<body>
<div align="center" id="center">
    <table border="0" width="97%">
        <tbody><tr>
            <td height="0"><b><font color="#FF0000">&nbsp;&nbsp;&nbsp;&nbsp;<font color="#000000">1、注意：</font>此平台为个人信息发布平台，中介请绕行。所有信息均采取审核制，一般24小时之内完成审核，节假日可能会稍晚，未通过审核者说明信息有问题！</font></b><font color="#FF0000"><b>&nbsp;</b></font><font color="#999999"><b><br>
                &nbsp;&nbsp;&nbsp;&nbsp;<font color="#000000">2、对转让者：</font><font color="#FF3300">如果您转让的幼儿园面积超过800平米，为避免骚扰，您可以直接把详细信息发到bjchildserve@163.com，由我们来帮您联系买家！&nbsp;</font><br>
                &nbsp;&nbsp;&nbsp;&nbsp;<font color="#000000">3、对所有信息发布者：</font><font color="#FF0000">请务必填写真实信息，否则您将承担由此造成的一切后果！请勿重复多次发帖，否则封无赦！</font></b></font></td>
        </tr>
        <tr>
            <td><b><font color="#FF0000">&nbsp;&nbsp;&nbsp;&nbsp;</font></b></td>
        </tr>
        </tbody></table>
    <form action="" method="post" name="postart" id="checkForm" enctype="multipart/form-data">
        <div class="container">
            <div class="list center">
                <div class="list_left">
                    信息标题：
                </div>
                <div class="list_right">
                    <input name="title" id="dtitle"  type="text" value="<?php echo ($list["title"]); ?>" <?php if($check): ?>readonly<?php endif; ?>></div>
                <!--<div class="list_left">密码：</div>-->
                <!--<div class="list_right"><input name="pwd" id="pwd" maxlength="10" type="password">-->
                    <!--<font color="#FF0000">* 请牢记以用于编辑删除信息</font></div>-->

                <div class="list_left">选择城市：</div>
                <div class="list_right">

                    <select onchange="regionChange(this,2,'selCity', '/Admin/Check/region');"
                                        name="province" id="city_one" size="1" <?php if($check): ?>disabled<?php endif; ?>>
                        <option value="" >请选择省份</option>
                        <?php if(is_array($province_list)): $i = 0; $__LIST__ = $province_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["region_id"]); ?>"  <?php if($list["province"] == $vo["region_id"] ): ?>selected<?php endif; ?>  ><?php echo ($vo["region_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>

                    <select id="selCity" name="city" <?php if($check): ?>disabled<?php endif; ?>  onchange="regionChange(this,3,'selDistrict', '/Admin/Check/region');"
                            data-child="selDistrict" name="city" >
                            <option value="">选择城市</option>
                        <?php if(is_array($city_list)): $i = 0; $__LIST__ = $city_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["region_id"]); ?>" <?php if($list["city"] == $vo["region_id"] ): ?>selected<?php endif; ?>><?php echo ($vo["region_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <select id="selDistrict" name="district" <?php if($check): ?>disabled<?php endif; ?>  >
                        <option value="" >选择区域</option>
                        <?php if(is_array($district_list)): $i = 0; $__LIST__ = $district_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["region_id"]); ?>" <?php if($list["district"] == $vo["region_id"] ): ?>selected<?php endif; ?>   ><?php echo ($vo["region_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>

                </div>

                <div class="list_left">信息类别：</div>
                <div class="list_right">
                    <select name="type" size="1" id="type_one" <?php if($check): ?>disabled<?php endif; ?>>
                        <option value="">选择类别</option>
                        <?php if(is_array($youer_type)): foreach($youer_type as $k=>$vo): ?><option value="<?php echo ($k); ?>" <?php if($k == $list['type']): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                    </select>
                    <span id="typemoneystr"></span>
                </div>
                <div class="list_left">信息内容：</div>
                <div class="list_right">
                    <textarea rows="10" name="info" cols="50" onkeydown="checkMaxInput(this.form)"   onkeyup="checkMaxInput(this.form)" <?php if($check): ?>disabled<?php endif; ?>><?php echo ($list["info"]); ?></textarea>
                    <br>
                    &nbsp;800字以内&nbsp;目前还可以写
                    <input readonly="readonly" name="remLen" size="4" maxlength="2" value="800" style="border: 1 solid #888888" type="text">
                    个字
                </div>
                <div class="list_left">联系方式：</div>
                <div class="list_right" >
                    <div style="margin-bottom: 10px;" <?php if($check): ?>disabled<?php endif; ?>>
                        <div class="pp">联&nbsp;&nbsp;系&nbsp;人：<input name="t_person" id="dusername2" size="13" maxlength="13" type="text" <?php if($check): ?>readonly<?php endif; ?> value="<?php echo ($list["t_person"]); ?>"></div>
                        <div class="pp">联系电话：<input name="t_mobile" id="dtel2" size="13" maxlength="13" type="text" <?php if($check): ?>readonly<?php endif; ?> value="<?php echo ($list["t_mobile"]); ?>">
                        </div>
                    </div>
                </div>
                <div class="list_left">有效期限：</div>
                <div class="list_right">
                    <select size="1" name="limit_days" <?php if($check): ?>disabled<?php endif; ?> id="limit_days">
                        <option value="选择有效期" selected="selected">选择有效期</option>

                        <?php if(is_array($limit_days)): foreach($limit_days as $k=>$vo): ?><option value="<?php echo ($k); ?>" <?php if($k==$list['limit_days']): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                    </select>
                </div>
            <div class="list_left">联系人公司(选填)：</div>
            <div class="list_right">
                <input name="t_complane"   type="text" value="<?php echo ($list["t_complane"]); ?>" <?php if($check): ?>readonly<?php endif; ?>>
            </div>
            <div class="list_left">公司地址(选填)：</div>
            <div class="list_right">
                <input name="t_addr"   type="text" value="<?php echo ($list["t_addr"]); ?>" <?php if($check): ?>readonly<?php endif; ?>>
            </div>

            <div class="list_left">信息图片:</div>
            <div class="list_right">
                <div class="upload_button" >上传</div>
            </div>
                <div  class="file_upload" >
                    <input name="file"   type="file" id="file_upload" onchange='fileupload(event,this)'/>
                </div>
            <div class="list_left"></div>
            <div id="uploads" class="list_right">
                未上传任何图片
            </div>
            <input type="hidden" value="" id="img_path" name="con_img"/>
                <!--<div class="list_left">验&nbsp;&nbsp;证&nbsp;码：</div>-->
                <!--<div class="list_right">-->
                    <!--<input name="proof" id="proof" size="4" maxlength="4" tabindex="6" onfocus="get_Code();this.onfocus=null;" type="text">-->
                    <!--<span id="imgid" style="color:red">点击获取验证码</span>-->
                <!--</div>-->
                <div class="list_left"></div>
                <div class="list_right">
                    <?php if($check && !isset($user_do)): ?><input value="审核通过" name="submit" class="sb" type="button" data-type="1">
                        &nbsp; &nbsp;&nbsp;
                        <?php if($list["status"] != -1): ?><input value="审核不通过" name="submit" class="sb" type="button" data-type="-1"><?php endif; ?>
                        <?php elseif(isset($user_do) && $user_do == 'look'): ?>
                        <input value="确认" name="submit" id="sb" type="button">
                        <?php elseif(isset($user_do) && $user_do == 'edit'): ?>
                        <input value="确认修改" name="submit" id="sb" type="button">
                        <?php else: ?>
                        <input value="确认发布" name="submit" id="sb" type="button"><?php endif; ?>
                </div>
                <div class="clear"></div>
            </div>
        </div>
                <input type="hidden" value="<?php echo ($list["id"]); ?>" name="id"/>
    </form>
</div>
<script>
    function fileupload(e, obj) {
        $obj = $(obj)
        var url = '/Admin/Check/img_upload';
//        var galleryCount = $(".goods_gallery").length;
//        var selectedCls = "";
//        if(galleryCount < 1){
//            selectedCls = "add_img_selected";
//        }
        image_upload(url, e, obj, function (ret) {

            var thumb = ret.thumb;
            var html =   '	<div class="img_input">'
                    +'		<img src="'+thumb+'"  data-ori="'+ret.result+'" data-std="'+ret.stdpath+'">	'
                        +'	</div>';
            $("#uploads").html(html);
            $("#img_path").val(thumb);
        });
    }
    $(".sb").click(function(){
        var status_type =$(this).data("type");

        var url ="/Admin/Check/doCheck";
        var id = "<?php echo ($list["id"]); ?>";
        $.post(url,{status:status_type,id:id},function(ret){
                    if(ret.status==1){
                        layer.msg("操作成功!");
                        setTimeout(function(){
                            window.parent.document.location.reload();
                            parent.layer.closeAll(); //再执行关闭
                        },1500);
                    }
        },"JSON");
        return false;
    });

    function getData(){
//        var status_type =$(this).data("type");
//        var type = $(this).data("type");
        var url ="/Admin/Check/doCheck";
        var data = $("#checkForm").serializeJson();//过滤掉了select
//        console.log(data); return false;
//        var province = $("#city_one").val();
//        var city = $("#selCity").val();
//        var district = $("#selDistrict").val();
//
//        var limit_days =$("#limit_days").val();
//        data.province=province;
//        data.city=city;
//        data.district=district;
//        data.limit_days=limit_days;
        return data;
    }
    $("#sb").click(function(){
        var data = getData();
        var url ="/Admin/Check/doAddMsg";
        console.log(data);
        $.post(url,{data:data},function(ret){
                if(ret.status==1){
                    layer.msg(ret.retmsg);
                    setTimeout(function(){
                        window.parent.document.location.reload();
                        parent.layer.closeAll(); //再执行关闭
                    },1500);
                }
        });
                    return false;
    });
</script>
</body>
</html>