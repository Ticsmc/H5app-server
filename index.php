<?php
/**
 * 前端控制器
 */
//header('Content-type:text/html; Charset=utf8');
header( "Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:x-requested-with,content-type');
//得到控制器名
if($_SERVER['REQUEST_METHOD'] == 'OPTIONS')return;

$c = isset($_POST['c']) ? $_POST['c'] : 'student';
//载入控制器文件
require 'controller/'.$c.'Controller.class.php';
//实例化控制器（可变变量）
$controller_name = $c.'Controller';
$controller = new $controller_name;
//得到方法名
$action = isset($_POST['a']) ? $_POST['a'] : 'list';
//调用方法（可变方法）
$action_name = $action.'Action';
$controller->$action_name();
