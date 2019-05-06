var token = $('#token').val();
var app = new Vue({

    el: '#app',
    data: {
        list: [],
        id:'',
        info:[],
        page: page,  //显示的是哪一页
        pageSize: 10, //每一页显示的数据条数
        total: 0, //记录总数
        maxPage:9 //最大页数
    },
    created: function () {
        this.pageHandler(1);
        this.tableStructure();
    },
    methods: {
        pageList: function () {
            Request.get('/<?php echo "$mini_name"?>/index',{},this.getListData)
        },
        getListData:function(data){
            this.list = data.result.list;
            // console.log( data.result.pagination.totalCount)
            this.total = parseInt(data.result.pagination.totalCount)
        },
        //获取表结构
        tableStructure:function(){
            $.post('/<?php echo "$mini_name"?>/info', {'_csrf': token}, function (res) {
                app.info = res.result;
            }, 'JSON');
        },
        //pagehandler方法 跳转到page页
        pageHandler: function (pages) {
           this.page = pages;
           page = pages;
           this.pageList();
        },
        open_view: function (id) {
            layer.open({
                title: '查看详情',
                type: 2,
                area: ['80%', '70%'],
                fixed: false, //不固定
                maxmin: true,
                content: '/<?php echo "$mini_name"?>/view?id=' + id //这边确定一个索引
            });
        },
        open_edit: function (id) {
            layer.open({
                title: '查看详情',
                type: 2,
                area: ['50%', '50%'],
                fixed: false, //不固定
                maxmin: true,
                content: '/<?php echo "$mini_name"?>/view?id=' + id //这边确定一个索引
            });
        },
        del:function (id) {
            layer.confirm('确定删除？', {
                btn: ['确定','再想想'] //按钮
            }, function() {
                $.post('/<?php echo "$mini_name"?>/delete', {'_csrf': token,id:id}, function (res) {
                    if(res.code ==200){
                        app.init()
                        layer.msg(res.msg);
                    }
                }, 'JSON').error(function(){
                        layer.alert('服务器开小差~，请稍后再试')
                })
            })

        }
    }

})
function test() {
    alert('我是爸爸')
}

