<?php
/**
 * 单例类
 */
$redis = new redis();
$redis->connect("127.0.0.1","6379");
$redis->set("type",12);
echo $redis->get("type");


//存储多个值
$array = array('first_key'=>'first_val',
    'second_key'=>'second_val',
    'third_key'=>'third_val');
$array_get = array('first_key','second_key','third_key');
$redis->mset($array);
var_dump($redis->mget($array_get));

