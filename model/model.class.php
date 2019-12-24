<?php
/**
 * 基础模型类
 */
require_once 'pdo/dbInterface.class.php';
class model {
	#protected $m_db; //保存数据库对象
	protected $m_tableName;
	protected $m_arRelationMap;
	//protected $m_unModifyMap;
	protected $m_primaryKey;//主键名

	public function __construct(){
		$this->init(); // 初始化
	}
	protected  function init(){
		#$this->initDB(); // 初始化数据库
		$this->initTableName();
		$this->initRelationMap();
		$this->initPrimaryKey();
	}

//	private function initDB(){
//		//配置数据库连接信息
//		$dbConfig = array('user'=>'root','pass'=>'root','dbname'=>'test');
//		//实例化数据库操作类
//		$this->m_db = MySQLPDO::getInstance($dbConfig);
//	}
	protected  function initTableName(){

	}
	protected  function initRelationMap(){

	}
	protected  function initPrimaryKey(){

	}

	protected  function getTableName(){
		return $this->m_tableName;
	}
	protected function getRelationMap(){
		return $this->m_arRelationMap;
	}

	public function save()
	{
		$field = "";
		$values = "";
//        $class_vals = get_class_vars(get_class($this));
//        foreach($class_vals as $name => $value) {
//            $value = $this->$name;
//            echo "$name : $value\n<br/>";
//        }


		$sql = "INSERT INTO ".$this->m_tableName." (";
          foreach($this->m_arRelationMap as $key => $value){
              if($value->getMBCanModify() == false)
                  continue;

              $keyDB = $value->getMKey();
              $valueDB = $this->$keyDB;
			  if($value->getMDataType() == 'str')
			  {
				  $valueDB ="'".$valueDB."'";
			  }
              $field  .= $keyDB.",";
              $values .= $valueDB.",";
          }
	    $fields = substr($field,0,strlen($field)-1);
	    $vals   = substr($values,0,strlen($values)-1);
		$sql .= $fields." ) VALUES (".$vals.")";
//        $this->m_db->exec($sql);
//        $key = $this->m_db->lastInsertKey();

        $dbInst =  DBInterface::getInstance()->getDBInstance();
        $dbInst->exec($sql);
        $key = $dbInst->lastInsertKey();

        $this->id = $key;
		#var_dump($key);
		return $key;
	}

	public function delete($pk)
	{
		$sql = "DELETE FROM ".$this->m_tableName." WHERE ".$this->m_primaryKey."=".$pk;
		$dbInst =  DBInterface::getInstance()->getDBInstance();
		$dbInst->exec($sql);
	}

	public function update($pk,$dataArray)
	{
		$kv = "";

		$sql = "UPDATE ".$this->m_tableName." SET ";
		foreach($this->m_arRelationMap as $key => $value) {
			if ($value->getMBCanModify() == false)
				continue;

			$keyDB = $value->getMKey();
			if(array_key_exists($keyDB,$dataArray) == false)
			{
				continue;
			}

			$valueDB = $dataArray[$keyDB];
			$this->$keyDB = $valueDB;
			if($value->getMDataType() == 'str')
			{
				$valueDB ="'".$dataArray[$keyDB]."'";
			}

			$kv = $keyDB."=".$valueDB.",";
		}

		$kv = substr($kv,0,strlen($kv)-1);
		$sql .= $kv." WHERE ".$this->m_primaryKey."=".$pk;
		$dbInst =  DBInterface::getInstance()->getDBInstance();
		$dbInst->exec($sql);
	}

	public function get($key)
	{
        $sql = "select * from ".$this->m_tableName." where id =".$key;
		$dbInst =  DBInterface::getInstance()->getDBInstance();
        $data = $dbInst->fetchRow($sql);
        return $data;
	}

    public function getAll()
    {
		$dbInst =  DBInterface::getInstance()->getDBInstance();
		$data = $dbInst->fetchAll('select * from `student`');
		return $data;
    }

}
