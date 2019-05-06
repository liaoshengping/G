var token = $('#token').val();
// var axios = require('axios');
var app =new Vue({

    el: '#menu',
    data: {
        menu_data: [11]
    },
    created:function(){
        this.get();
        // this.post();
    },
    methods: {
        get:function () {
            $.post('sys-menu/menu',{'_csrf':token},function (res) {
                app.menu_data = res.result;
                load_menu()//加载完数据之后渲染菜单，恶心啊
            },'JSON')
        }

    },

})
