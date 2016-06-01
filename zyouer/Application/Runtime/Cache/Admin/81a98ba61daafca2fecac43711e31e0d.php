<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>后台模板</title>

<script type="text/javascript" src="/<?php echo (ADMIN_JS_PATH); ?>/jquery.js"></script>

<link rel="stylesheet" href="/<?php echo (ADMIN_CSS_PATH); ?>/add.css" type="text/css" media="screen">
<link rel="stylesheet" href="/<?php echo (ADMIN_CSS_PATH); ?>/index.css" type="text/css" media="screen">
<link rel="stylesheet" href="/<?php echo (ADMIN_CSS_PATH); ?>/bootstrap.css" type="text/css" media="screen">

</head>
<body>
<div class="route_bg">
    <a href="#">主页</a><i class="glyph-icon icon-chevron-right"></i>
    <a href="#">菜单管理</a>
</div>
<div class="div_from_aoto" style="width: 500px;">
    <form>
        <div class="control-group">
            <label class="laber_from">用户名</label>
            <div class="controls"><input class="input_from" placeholder=" 请输入用户名" type="text"><p class="help-block"></p></div>
        </div>
        <div class="control-group">
            <label class="laber_from">密码</label>
            <div class="controls"><input class="input_from" placeholder=" 请输入密码" type="text"><p class="help-block"></p></div>
        </div>
        <div class="control-group">
            <label class="laber_from">确认密码</label>
            <div class="controls"><input class="input_from" placeholder=" 请输入确认密码" type="text"><p class="help-block"></p></div>
        </div>
        <div class="control-group">
            <label class="laber_from">角色</label>
            <div class="controls">
                <select class="input_select">
                    <option selected="selected">董事长</option>
                    <option>总经理</option>
                    <option>经理</option>
                    <option>主管</option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="laber_from"></label>
            <div class="controls"><button class="btn btn-success" style="width:120px;">确认</button></div>
        </div>
    </form>
</div>

</body></html>