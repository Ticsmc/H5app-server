<?php
/**
 * 单例类
 */

class Utils extends Singleton
{
    protected static $_instance = null;

    public function array_remove($arr, $key){
        if(!array_key_exists($key, $arr)){
            return $arr;
        }
        $keys = array_keys($arr);
        $index = array_search($key, $keys);
        if($index !== FALSE){
            array_splice($arr, $index, 1);
        }
        return $arr;
    }

    public function put_json($arr, $file){
        $json_string = json_encode($arr);
// 写入文件
        file_put_contents($file, $json_string);
    }


    public function get_json( $file){
        $json_string = file_get_contents($file);
// 把JSON字符串转成PHP数组
        $data = json_decode($json_string, true);
        return $data;
    }

}
