<?php echo '<?php'?>

namespace App\Models\base;
/**
 * 部署时填写
 * 1.填写namespace
 * 2.获取list 具体方案getListByFind
 * 3.获取one 具体方案
 */

use Illuminate\Database\Eloquent\Model;

class QueryBase extends Model
{
    /**
     * 处理查询输出
     * @param $data
     * @return mixed
     */
    public static function handlerListData($data)
    {
        return $data;
    }

    /**
     * 处理查询单条数据的处理
     * @param $data
     * @return mixed
     */
    public static function handlerOneData($data)
    {
        return $data;
    }


    /**
     *
     * @param $find
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    public static function getListByFind($find, $page = 1, $pageSize = 20)
    {
        /*
        * 对应的分页查询相关
        */
        $res = $find->paginate($pageSize, ['*'], 'page', $page);
        if (!empty($res)) {
            $res = $res->toArray();
        }
        $list = static::handlerListData($res);
        return [
            'data' => $list['data'],
            'links' => [
                'first' => $list['first_page_url'],
                'last' => $list['last_page_url'],
                'next' => $list['next_page_url'],
                'prev' => $list['prev_page_url'],
            ],
            'meta' => [
                'current_page' => $list['current_page'],
                'from' => $list['from'],
                'path' => $list['path'],
                'per_page' => $list['per_page'],
                'to' => $list['to'],
                'total' => ['total'],
            ],
        ];
    }


//    public function


    public static function getOneByFind($find)
    {
//        echo 'kk';exit;
        $data = $find
//            ->one();
            ->first();
        if (!empty($data)) {
            $data->toArray();
        }

        return static::handlerListData($data);
    }

}
