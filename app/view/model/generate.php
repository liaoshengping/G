<head>
    <title>系统列表</title>
</head>
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="row">
    <div class="col-xs-6 col-md-4">
        <div class="row">
            <a href="/index/add">
            </a>
        </div>
    </div>
    <!--    <div class="col-xs-6 col-md-4">.col-xs-6 .col-md-4</div>-->
    <!--    <div class="col-xs-6 col-md-4">.col-xs-6 .col-md-4</div>-->
</div>
<body >
<div class="container">
    <form class="form-control" method="post" action="/model/generate/id/<?php echo $work['id']?>">
        <h2>生成模型</h2>
        <label class="label">表名</label>
        <select  class="form-control" name="table_name" id="select">
            <?php
                foreach ($data as $key=>$value){
                    echo '      <option>'.$value['table_name'].'</option>';
                }
            ?>

        </select>

            <label class="label">模型路径/（根目录之后的）</label>
            <input class="form-control" name="model_path" value="<?php echo $work['models_path']?>">
            <input class="form-control" type="hidden" name="framework" value="<?php echo $work['framework']?>">
            <div class="form-control ">
                <input class="btn btn-primary " type="submit" value="提交" >
            </div>

    </form>
</div>

</body>


