//表单相关
var page = 1;
var pageSize = 10;
var Form = {
    //获取表单数据
    getFromData: function () {
        var t = $('#form').serializeArray();
        var d = {};
        $.each(t, function () {
            d[this.name] = this.value;
        });
        return d;
    }
}
//基本方法
var APP = {
    getUrlByName: function (name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return decodeURIComponent(r[2]);
        return null;
    },
    GetUrlPara: function () {
        var url = location.search; //获取url中"?"符后的字串
        var theRequest = new Object();
        if (url.indexOf("?") != -1) {
            var str = url.substr(1);
            strs = str.split("&");
            for (var i = 0; i < strs.length; i++) {
                var kv = strs[i].split("=");
                theRequest[kv[0]] = unescape(kv[1]);
            }
        }
        return theRequest;
    },
    //获取绝对路径
    GetUrlRelativePath: function () {
        var url = document.location.toString();
        var arrUrl = url.split("//");

        var start = arrUrl[1].indexOf("/");
        var relUrl = arrUrl[1].substring(start);//stop省略，截取从start开始到结尾的所有字符

        if (relUrl.indexOf("?") != -1) {
            relUrl = relUrl.split("?")[0];
        }
        return relUrl;
    },

}
var Request  = {

    /**
     * 获取数据ajax-get请求
     * @author https://blog.csdn.net/qq_22823581
     */
    get: function (url, data, callback) {
        data.page =page;
        data.pageSize= pageSize;
        data._csrf=token;
        $.ajax({
            url: url,
            type: "get",
            contentType: "application/json",
            dataType: "json",
            timeout: 10000,
            data: data,
            success: function (data) {
                callback(data);
            }
        });
    },

    /**
     * 提交json数据的post请求
     * @author https://blog.csdn.net/qq_22823581
     */
    post: function (url, data, callback) {
        $.ajax({
            url: url,
            type: "post",
            contentType: "application/json",
            dataType: "json",
            data: data,
            timeout: 60000,
            success: function (msg) {
                callback(msg);
            },
            error: function (xhr, textstatus, thrown) {

            }
        });
    },

    /**
     * 修改数据的ajax-put请求
     * @author https://blog.csdn.net/qq_22823581
     */
    put: function (url, data, callback) {
        $.ajax({
            url: url,
            type: "put",
            contentType: "application/json",
            dataType: "json",
            data: data,
            timeout: 20000,
            success: function (msg) {
                callback(msg);
            },
            error: function (xhr, textstatus, thrown) {

            }
        });
    },
    /**
     * 删除数据的ajax-delete请求
     * @author https://blog.csdn.net/qq_22823581
     */
    delete: function (url, data, callback) {
        $.ajax({
            url: url,
            type: "delete",
            contentType: "application/json",
            dataType: "json",
            data: data,
            success: function (msg) {
                callback(msg);
            },
            error: function (xhr, textstatus, thrown) {

            }
        });
    }
}



