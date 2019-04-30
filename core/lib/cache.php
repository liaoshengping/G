<?php
class MyCache
{
    static $cache_file = 'runtime/cache/';
    static $is_cache = 1;
    public static function cache($name, $data = array(), $extime = 0)
    {
        if (!$name || !is_string($name)){return false;}
        $name =md5($name);
        $filepath = self::$cache_file .substr($name,0,2).'/';
        $filename = $filepath.$name;

        if (empty($extime) && empty($data) && $data!==null) {
            //读缓存文件
            if (file_exists($filename) && self::$is_cache) {
                $content = file_get_contents($filename);//读取缓存文件
                $arr = unserialize($content);
                if (time() - $arr['time'] > filemtime($filename) && $arr['time'] != 0) {
                    //删除文件
                    unlink($filename);
                    return false;
                }
                return $arr['data'];
            } else {
                return false;
            }
        } else {
            if($data ===null){@unlink($filename);return true;};
            if (!is_readable($filepath) || is_file($filepath)) {
                mkdir($filepath, 0766,true);
            }
            $insert = [
                'time' => $extime,
                'data' => $data
            ];
            $insert = serialize($insert);
            file_put_contents($filename, $insert);//写入缓存文件
            return true;
        }
    }


}
function cache($name, $data = array(), $extime = 0){
    return MyCache::cache($name, $data, $extime);
}
//---------------------
//作者：廖圣平
//来源：CSDN
//原文：https://blog.csdn.net/qq_22823581/article/details/82500504
//版权声明：本文为博主原创文章，转载请附上博文链接！
