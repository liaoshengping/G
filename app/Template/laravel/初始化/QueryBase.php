<?php

namespace sdf\sdfsd;
/**
 * 部署时填写
 * 1.namespace
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
            'paginationObj' => $pagination,
            'pagination' => [
                'currentPage' => $page,
                'pageSize' => $pageSize,
                'pageCount' => $pagination->getPageCount(),
                'totalCount' => $pagination->totalCount,
            ],
            'list' => $list,
        ];
    }
//    public function



    public static function getOneByFind($find)
    {
        $data = $find
            ->asArray()
            ->one();

        return static::handlerListData($data);
    }

}
