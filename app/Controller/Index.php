<?php

namespace app\Controller;

use core\lib\PDOs;

/**
 * Created by PhpStorm.
 * Email: 1194008361@qq.com
 * User:liaosp.top
 * Date: 2018/9/10
 * Time: 21:28
 */
class Index
{
    public function index()
    {
        $info = PDOs::getInstance()->table('work')->get();
        if (empty($info)) {
            return view('index', ['work' => []]);
        }
        $data = [
            'work' => $info,
        ];
        return view('index', $data);
    }

    public function add()
    {

        if ($_POST) {
            unset($_POST['id']);
            foreach ($_POST as $key => $value) {
                if (empty($value)) {
                    $_POST[$key] = '/';
                }
            }
//                print_r($_POST);exit;
            $res = PDOs::getInstance()->table('work')->insert($_POST);
            $res ? alert('成功') : back('失败');
        } else {
            $database_info = PDOs::getInstance();
            $db_name = $database_info->dbName;
            //            COLUMN_NAME as name

            $data = PDOs::getInstance()->query("select
                COLUMN_NAME as name 
            FROM INFORMATION_SCHEMA.COLUMNS
            
where
table_schema = '" . $db_name . "'
 and table_name = 'work'");
            $render = ['data' => $data];
            return view('add', $render);
        }

    }
    public function edit()
    {

        if ($_POST) {
            $id =$_POST['id'];
            unset($_POST['id']);
            foreach ($_POST as $key => $value) {
                if (empty($value)) {
                    $_POST[$key] = '/';
                }
            }
//                print_r($_POST);exit;
            $res = PDOs::getInstance()->table('work')->where('id = '.$id)->update($_POST);
            $res ? back('成功') : back('失败');
        } else {
            $id = $_GET['id'];
            $res = PDOs::getInstance()->table('work')->where('id='.$id)->get();
            $render = ['data' => $res];
            return view('edit', $render);
        }

    }
    public function del(){
        $res =PDOs::getInstance()->where('id='.$_GET['id'])->delete('work');
        $res ? back('成功') : back('失败');
    }
}
