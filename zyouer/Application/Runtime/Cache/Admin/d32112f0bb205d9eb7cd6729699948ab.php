<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>幼儿园信息管理系统</title>
    <link rel="stylesheet" href="/<?php echo (ADMIN_CSS_PATH); ?>/index.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/<?php echo (ADMIN_CSS_PATH); ?>/table.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/<?php echo (ADMIN_CSS_PATH); ?>/kkpager_orange.css" type="text/css" media="screen">

    <link href="/<?php echo (ADMIN_CSS_PATH); ?>/lyz.calendar.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="/<?php echo (ADMIN_JS_PATH); ?>/jquery.js"></script>
    <script src="/<?php echo (ADMIN_JS_PATH); ?>/lyz.calendar.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="/<?php echo (ADMIN_JS_PATH); ?>/tendina.js"></script>
    <script type="text/javascript" src="/<?php echo (ADMIN_JS_PATH); ?>/common.js"></script>

    <script type="text/javascript" src="/<?php echo (ADMIN_JS_PATH); ?>/kkpager.min.js"></script>
    <script type="text/javascript" src="/<?php echo (ADMIN_JS_PATH); ?>/layer.js"></script>
</head>
<style>
.batch_del{
    cursor: pointer;
}
</style>
<body>
<div class="route_bg">
    <a href="#">主页</a><i class="glyph-icon icon-chevron-right"></i>
    <a href="#">菜单管理</a>
</div>
<div id="body" class="ifr-body">
    <div id="new_common">
        <!--<div id="order_type">-->
            <!--<ul>-->
                <!--<li style="background-color: red;border-radius: 5px;" id="addMsg">发布信息</li>-->
            <!--</ul>-->
        <!--</div>-->
        <div id="choose_condition">
            <input class="check_time_left" contenteditable id="buyer"  placeholder="发布人">
            <input class="check_time_left" id="time_left" placeholder ="<?php echo date('Y-m-d'); php?>"/>
            <span style="padding-left:15px;">至</span>
            <input class="check_time_left" id="time_right" placeholder ="<?php echo date('Y-m-d'); php?>" />
            <button id="search_type_infos">搜索</button>
        </div>

        <div class="common_go" id="list1">
            <div class="search_result" id="youer">
            </div>
        </div>

        <div class="batch_week">
            <div class="batch_l">
                <label for="male"> </label>
                    <span style="margin-left:10px; " id="male"><input type="checkbox" id="check_all"/> 全选</span>
                <button class="btn_common batch_del" id="batch_del">批量删除</button>
            </div>
            <div id="kkpager" class="kkpager"  style="float:right;clear:none;padding:0px 10px;"></div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<script>
    var status = "<?php echo ($type); ?>";
    var url ="/Admin/Check/ajax_check";
    $(function () {
        gethtml(1,url);
//        document.write("<script src='http://libs.baidu.com/jquery/1.5.2/jquery.min.js'><\/script>");
        $('#time_left').datetimepicker({
            onChangeDateTime:"logic",
            onShow:"logic"
        });
        $('#time_right').datetimepicker({
            onChangeDateTime:"logic",
            onShow:"logic"
        });
    });
    $(document).on('click','#check_all',function(){
        var all_obj = $("#list1 input[type='checkbox']");
        var $obj =$(this)
        if($obj.is(":checked")){
            $(all_obj).each(function(){
               $(this).attr("checked","checked");
            });
            $obj.attr("checked","checked");
        }else{
            $obj.removeAttr("checked");
            $(all_obj).each(function(){
                $(this).removeAttr("checked");
            });
        }
    })

    function getSelectId(){
        var all_obj = $("#list1 input[type='checkbox']");
        var data = new Array();
        $(all_obj).each(function(){
            var value = $(this).val();
            if($(this).is(":checked")){
                data.push(value);
            }
        });
            return data;
    }
    function gethtml(curpage,url) {
        var container = $("#resultList");
        container.find("tr:gt(0)").remove();
        curpage = curpage ? curpage : 1;
        var status = "<?php echo ($status); ?>";
        var data ={current_page:curpage,status:status};
        $.get(url, data, function (ret) {
            $("#youer").html(ret);
        },"HTML");
    }
    $(document).on('click',"#batch_del",function() {
        var ids = getSelectId();
        if(ids==""){
            layer.msg("请选择要删除的数据！");
            return;
        }
        layer.confirm('确定要删除吗?', function (index) {
            //do something
            var url = "/Admin/Check/delAll_check";
            var data = {status: status, ids: ids}
            $.post(url, data, function (ret) {
                if (ret == 1) {
                    $(".search_result_tab input[type='checkbox']").each(
                            function () {
                                if ($(this).is(":checked")) {
                                    $(this).parent().parent().remove();
                                }
                            }
                    );
                    layer.msg("删除成功！");
                    setTimeout(function () {
                        layer.close(index);
                    }, 3000);
                }
            }, "JSON");
        });
    });
   $("#search_type_infos").click( function(){
       var t_person = $("#buyer").val();
       var time_left = $("#time_left").val();
       var time_right = $("#time_right").val();
       var data ={t_person:t_person,time_left:time_left,time_right:time_right,check:1,status:status};
       var url ="/Admin/Check/ajax_check";
       $.post(url,data,function(ret){
           $("#youer").html(ret)
       },"HTML")
   })
    $(document).on('click',"#addMsg",function(){
        var url = "<?php echo U('/Admin/Check/addMsg');?>";
        layer.open({
            type: 2,
            title: '发布信息',
            shadeClose: true,
            shade: 0.01,
            area: ['1000px', '700px'],
            content:url//iframe的url
        });
    })
</script>
</body>
</html>