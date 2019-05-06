
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>列表查看</title>
    <meta name="keywords" content="列表查看">
    <meta name="description" content="查看列表">
<?php
echo '<?php $this->beginContent("@'.$application_name_path.'/views/common/header.php") ?>
    <?php $this->endContent() ?>'
?>


</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>信息列表</h5>
                    <div class="ibox-tools">

                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>

                        <!--                        <a class="dropdown-toggle" data-toggle="dropdown" href="table_basic.html#">-->
                        <!--                            <i class="fa fa-wrench"></i>-->
                        <!--                        </a>-->
                        <ul class="dropdown-menu dropdown-user" style="display: none;">
                            <li><a href="table_basic.html#">选项1</a>
                            </li>
                            <li><a href="table_basic.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row" style="display: none">
                        <div class="col-sm-5 m-b-xs">
                            <select class="input-sm form-control input-s-sm inline">
                                <option value="0">请选择</option>
                                <option value="1">选项1</option>
                                <option value="2">选项2</option>
                                <option value="3">选项3</option>
                            </select>
                        </div>
                        <div class="col-sm-4 m-b-xs">
                            <div data-toggle="buttons" class="btn-group">
                                <label class="btn btn-sm btn-white">
                                    <input type="radio" id="option1" name="options">天</label>
                                <label class="btn btn-sm btn-white active">
                                    <input type="radio" id="option2" name="options">周</label>
                                <label class="btn btn-sm btn-white">
                                    <input type="radio" id="option3" name="options">月</label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" placeholder="请输入关键词" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> 搜索</button> </span>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive" id="app">
                        <div class="">
                            <a v-on:click="create_data();" href="javascript:void(0);" class="btn btn-primary ">添加</a>
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>

                                <th></th>

                                <th v-for="(values , keys ) in info ">
                                    {{values}}
                                </th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for ='(value , key) in list'>
                                <td>
                                    <input type="checkbox" checked class="i-checks" name="input[]">
                                </td>
                                <td v-for="(value2 ,key2) in value">{{value2}}</td>
                                <td>
                                    <a href="#" v-on:click="open_view(value.id)"><i class="fa fa-pencil fa-lg"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="#" v-on:click="del(value.id)" ><i class="fa fa-trash-o fa-lg"></i></a>&nbsp;&nbsp;
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <zpagenav v-bind:page="page" v-bind:page-size="pageSize" v-bind:total="total"
                                  v-bind:max-page="maxPage"  v-on:pagehandler="pageHandler">
                        <zpagenav>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>




<?php
echo '<?php $this->beginContent("@'.$application_name_path.'/views/common/foot.php") ?>
<?php $this->endContent() ?>'
?>

<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>

<?php
    echo '<script src="'.$js_dir.'"></script>';
?>

</body>

</html>
