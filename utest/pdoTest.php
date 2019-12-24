<?php
/**
 * 单例类
 */
require_once '../MySQLPDO.class.php';
$dbConfig = array('user' => 'root', 'pass' => 'root', 'dbname' => 'test');
//实例化数据库操作类
$m_db = MySQLPDO::getInstance($dbConfig);
$sqlstr = "insert into user(name,password) values('user1','123456')";
$m_db->exec($sqlstr);

