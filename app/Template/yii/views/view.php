<?php
echo '<?php $this->beginContent("@'.$application_name_path.'/views/common/header.php") ?>
<?php $this->endContent() ?>';
?>
<body class="gray-bg" >
<div class="wrapper wrapper-content animated fadeInRight"id="app">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form method="get" class="form-horizontal" id="form">
                        <div class="form-group" v-for="(value,key) in list">
                            <label class="col-sm-2 control-label">{{key}}</label>
                            <div class="col-sm-10">
                                <input type="text" :name="key" :value="[value]" class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <div class="btn btn-primary" v-on:click="update()"  type="submit">保存内容</div>
                                <div class="btn btn-white" type="submit">取消</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php
echo '<?php $this->beginContent("@'.$application_name_path.'/views/common/foot.php") ?>
<?php $this->endContent() ?>';
echo '<script src="'.$js_dir.'"></script>';
?>
