var token = $('#token').val();
var app = new Vue({
    el: '#app',
    data: {
        list: [],
        id: '222',
    },
    created: function () {
        this.getId('id');
        this.init();
    },
    methods: {
        test: function () {
            alert(2323);
        },
        init: function () {
            $.post('/<?php echo "$mini_name"?>/view', {'_csrf': token, id: this.id}, function (res) {
                app.list = res.result;
            }, 'JSON')
        },
        getId: function (name) {
            this.id = APP.getUrlByName(name)
        },
        update: function () {
            //获取当前的url，post 当前的路径
            var selfurl = '<?php echo $site_prefix;echo "/".$mini_name ?>/create';
            //更新数据
            var form_data = Form.getFromData();
            form_data['_csrf'] = token;
            $.post(selfurl, form_data, function (res) {
                layer.msg(res.msg)
                if (res.code == 200) {
                    parent.app.pageList();
                    setTimeout(function () {
                        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                        parent.layer.close(index); //再执行关闭
                    }, 1000)

                }


            }, 'JSON')
        }
    }

})

