<?php echo '<?php'?>

namespace App\Models\base;

use Illuminate\Database\Eloquent\Builder;

Class <?php echo $convert_name.'Query'?> extends QueryBase{
<?php echo $laravel_attr ?>
<?php echo $attribute ?>
<?php echo $functions ?>
<?php echo $query?>
}
