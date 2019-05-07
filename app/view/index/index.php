<head>
    <title>系统列表</title>
</head>
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="row">
    <div class="col-xs-6 col-md-4"><div class="row">
            <button type="button" class="btn btn-primary">新增系统</button>
        </div></div>
<!--    <div class="col-xs-6 col-md-4">.col-xs-6 .col-md-4</div>-->
<!--    <div class="col-xs-6 col-md-4">.col-xs-6 .col-md-4</div>-->
</div>



<table class="table table-striped">
    <tr>
        <?php
        //    var_dump($work);exit;
        echo ' <th>操作</th>';
            foreach ($work[0] as $key=>$values){

                echo '<th>'.$key.'</th>';
            }
        ?>

    </tr>
        <?php
        //    var_dump($work);exit;
        foreach ($work as $value){
            echo '<tr><td><a href="build/index/?id='.$value["id"].'" type="button" class="btn btn-primary">进入</a></td>';
            foreach ($value as $key=>$values){
                echo '<td>'.$values.'</td>'.' ';
            }

            echo '</tr>';
        }
        ?>

    </table>

