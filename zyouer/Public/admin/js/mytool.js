/**
 * 表单JSON序列化
 */
(function ($) {
    $.fn.serializeJson = function () {
        var serializeObj = {};
        var array = this.serializeArray();
        var str = this.serialize();
        $(array).each(function () {
            if (serializeObj[this.name]) {
                if ($.isArray(serializeObj[this.name])) {
                    serializeObj[this.name].push(this.value);
                } else {
                    serializeObj[this.name] = [serializeObj[this.name], this.value];
                }
            } else {
                serializeObj[this.name] = this.value;
            }
        });
        return serializeObj;
    };
})(jQuery);

function image_upload(url, e, obj, callback) {
    var files = e.target.files;
    var file = files[0];
    var valid = false;
    if (file && file.type && file.type) {
        var reg = /^image/i;
        valid = reg.test(file.type);
    }
    if (!valid) {
        layer.msg('请选择正确的图片格式上传，如：JPG/JPEG/PNG/GIF ');
        return;
    }
    var fr = new FileReader();
    fr.onload = function (ev) {
        var img = ev.target.result;
        $.post(url, {img: img}, function (ret) {
            if (ret.flag == "SUC") {
                callback(ret, obj);
            } else {
                layer.msg(ret.errMsg);
            }
        });
    };
    fr.readAsDataURL(file);
}

/**
 * get client ip
 */
/**
 * 省市区关联公共函数
 * @param obj
 * @param type
 * @param selDom
 */
function regionChange(obj, type, selDom, url) {
    if(!url){
        url = '/Admin/Check/region';
    }
    var selectVal = $(obj).val();
    $.get(url, {type: type, region: selectVal}, function (ret) {
        var selectObj = $("#" + selDom); console.log(selectObj.length);
        var html = "<option value=\"\">请选择...</option>";
        var selectedVal = "";
        if (ret && ret.length) {
            for (var i = 0, len = ret.length; i < len; i++) {
                var op = ret[i];
                if (i == 0) {
                    selectedVal = op.region_id;
                }
                html += "<option value=\"" + op.region_id + "\">" + op.region_name + "</option>";
            }
        }
        selectObj.html($(html));
        if (selectedVal) {
            selectObj.val(selectedVal);
            selectObj.trigger('change');
        } else {
            var childId = $(obj).data("child");
            $("#" + childId).html($("<option value=\"\">请选择...</option>"));
        }
    },"JSON");
}

