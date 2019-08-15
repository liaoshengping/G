<?php echo '<?php'?>

namespace App\Models\<?php echo $prifix ?>;

use App\Models\base\<?php echo $convert_name?>Query;
/**
<?php
    foreach ($cloumn_list as $key=>$value){
        echo '* @property  $'.$value['name'].PHP_EOL;
    }
?>
*/
Class <?php echo $convert_name?> extends <?php echo $convert_name?>Query{

}

