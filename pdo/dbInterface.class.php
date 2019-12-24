<?php
/**
 * 基础模型类
 */
require_once 'utils/singleton.class.php';
require_once 'MySQLPDO.class.php';
class DBInterface extends Singleton
{
    protected static $_instance = null;
    protected $m_db; //保存数据库对象

    protected function init()
    {
        $this->initDB(); // 初始化数据库
    }

    private function initDB()
    {
        //配置数据库连接信息
        $dbConfig = array('user' => 'root', 'pass' => 'root', 'dbname' => 'study_app');
        //实例化数据库操作类
        $this->m_db = MySQLPDO::getInstance($dbConfig);
    }

    public function getDBInstance()
    {
        return $this->m_db;
    }
}