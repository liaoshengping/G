<?php
/**
 * Created by PhpStorm.
 * User: liaosp
 * Date: 2019/8/11
 * Time: 14:58
 */

namespace app\Service\common;


use app\Service\laravel\model\Generate;
use app\Service\laravel\model\gennerateInterface;

/**
 * Class Factory
 * @package app\Service\common
 * @property gennerateInterface;
 */
class Factory
{

    public function doModel($frame_work=''){
        $obj =new \stdClass();
        switch ($frame_work){
            case 'yii':

                break;
            case 'laravel':
              $obj = new Generate();
                break;
        }
       return $obj;
    }
}