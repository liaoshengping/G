<?php

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
    public static function handlerListData($data){
        return $data;
    }

    /**
     * 处理查询单条数据的处理
     * @param $data
     * @return mixed
     */
    public static function handlerOneData($data){
        return $data;
    }




    /**
     *
     * @param $find
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    public function getListByFind($find, $page=1, $pageSize=20)
    {
        /*
         * 对应的分页查询相关
         */
        $data ='你查询出来的数据';
        $list = static::handlerListData($data);
        return [
//            'paginationObj' => $pagination,
//            'pagination' => [
//                'currentPage' => $page,
//                'pageSize' => $pageSize,
//                'pageCount' => $pagination->getPageCount(),
//                'totalCount' => $pagination->totalCount,
//            ],
//            'list' => $list,
        ];
    }
//    public function



    public static function getOneByFind($find)
    {
//        echo 'kk';exit;
        $data = $find
//            ->one();
            ->first();
        if(!empty($data)){
            $data->toArray();
        }

        return static::handlerListData($data);
    }

}
