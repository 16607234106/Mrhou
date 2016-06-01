<?php if (!defined('THINK_PATH')) exit();?><table cellspacing="0" cellpadding="0" class="search_result_tab">
    <tr>
        <th>选择</th>
        <th>发布人</th>
        <th width="200px">标题</th>
        <th width="260px">发布信息</th>
        <th>发布类型</th>
        <th>联系人</th>
        <th>联系人手机号</th>
        <th><span class="slaes_among">信息照片</span></th>
        <th><span class="slaes_among">所属城市</span></th>
        <th><span class="slaes_among">发布日期</span></th>
        <th><span class="slaes_among">截止日期</span></th>
        <th><span class="slaes_among">状态</span></th>
        <th width="100px">操作</th>
    </tr>
    <?php if(is_array($ret["result"])): foreach($ret["result"] as $key=>$vo): ?><tr data-type="<?php echo ($vo["id"]); ?>">
            <td><input type="checkbox" value="<?php echo ($vo["id"]); ?>"></td>
            <td><?php echo ($vo["user_id"]); ?></td>
            <td><?php echo ($vo["title"]); ?></td>
            <td style="position: relative;">
                <div class="goods_name" title="<?php echo ($vo["title"]); ?>">
                    <?php echo (sub_str($vo["info"])); ?>
                </div>
            </td>
            <td><?php echo ($youer_type[$vo['type']]); ?></td>
            <td><?php echo ($vo["t_person"]); ?></td>
            <td><?php echo ($vo["t_mobile"]); ?></td>
            <td><?php echo ($vo["t_img"]); ?></td>
            <td><?php echo ($vo["city"]); ?></td>
            <td><?php echo ($vo["add_time"]); ?></td>
            <td><?php echo ($vo["date"]); ?></td>
            <td><?php echo ($status[$vo['status']]); ?></td>
            <td class="t_finish">
                <?php if($type != 1): ?><span class="goods_del" data-type="<?php echo ($vo["id"]); ?>">删除</span><?php endif; ?>
                <?php if($type == 0 && !isset($user_type)): ?><span class="goods_look_up check" data-type="<?php echo ($vo["id"]); ?>">审核</span>
                    <?php elseif($type == 1): ?>
                    <span class="goods_look_up" data-type="<?php echo ($vo["id"]); ?>" onclick="finishBuy(this);">完成交易</span>
                    <?php elseif($type == -1): ?>
                    <span class="goods_look_up check" data-type="<?php echo ($vo["id"]); ?>">复审</span><?php endif; ?>

                <?php if(isset($user_type)): ?><span class="goods_edit user_info" data-type="<?php echo ($user_type); ?>" view="edit">编辑</span>
                    <span class="goods_look_up user_info" data-type="<?php echo ($user_type); ?>" view="look">查看</span><?php endif; ?>
            </td>
        </tr><?php endforeach; endif; ?>
</table>
<script>
    var curpage = "<?php echo ($ret["curpage"]); ?>";
    var maxpage = "<?php echo ($ret["maxpage"]); ?>";
    var status = "<?php echo ($type); ?>";
    $(function () {
        var totalnum = "<?php echo ($ret["totalnum"]); ?>";
        generatePage(curpage, maxpage, totalnum);
    });
    function generatePage(pageNo, totalPage, totalRecords) {
        //生成分页
        kkpager.generPageHtml({
            pno: pageNo,
            //总页码
            total: totalPage,
            //总数据条数
            totalRecords: totalRecords,
            isGoPage: false,
            mode: 'click',
            click: function (n) {
                this.selectPage(n);
                gethtml(n, url)
            }
        }, true);
    }
    ;
    $(".goods_del").click(function () {
        var $this = $(this).parent().parent();
        var id = $(this).data("type");
        layer.confirm('确定要删除吗?', function (index) {
            //do something
            var url = "/Admin/Check/del_check";
            var status = "<?php echo ($type); ?>";
            var data = {id: id, status: status};
            $.get(url, data, function (ret) {
                if (ret == 1) {
                    $this.remove();
                    layer.msg("删除成功！");
                    setTimeout(function () {
                        layer.close(index);
                    }, 3000);
                }
            }, "JSON")
        });
    });
    $(".check").click(function () {
        var id = $(this).parent().parent().data("type");
        var url = "<?php echo U('/Admin/Check/checkStatus');?>?id=" + id + "&status=" + status;
        layer.open({
            type: 2,
            title: '审核信息',
            shadeClose: true,
            shade: 0.1,
            area: ['1000px', '700px'],
            content: url//iframe的url
        });
    });
    function finishBuy(vale) {
        var id = $(vale).data("type");
        var url = "<?php echo U('/Admin/Check/buy_finish');?>";
        $.get(url, {id: id}, function (ret) {
            if (ret.status == 1) {
                layer.msg(ret.retmsg);
                setTimeout(function () {
                    location.reload();
                }, 3000)
            }
        });
    }
        $(".user_info").click(function() {
            var id = $(this).parent().parent().data("type");
            var user_do = $(this).attr("view");
            var user_type = $(this).data("type");
            var url = "/Admin/Check/checkStatus?id="+id+"&user_type="+user_type+"&user_do="+user_do;

            if (user_do == "look")var titile = "查看信息";
            else if (user_do == "edit")var titile = "编辑发布信息";
            layer.open({
                type: 2,
                title: '发布信息',
                shadeClose: true,
                shade: 0.01,
                area: ['1000px', '700px'],
                content: url//iframe的url
            });
        });

    //      layer.open({
    //                  type: 2,
    //                  title: '新增分类',
    //                  shadeClose: true,
    //                  shade: 0.8,
    //                  area: ['470px', '495px'],
    //                  content: '/goods/catetory?cat_id=' + cat_id//iframe的url
    //              });

</script>