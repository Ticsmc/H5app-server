<?php
/**
 * user表的操作类，继承基础模型类
 */
require_once 'item.class.php';
require_once 'model.class.php';
class userModel extends model{
	/* 查询所有学生 */
//	public function getAll()
//    {
//            $data = $this->db->fetchAll('select * from `student`');
//            return $data;
//    }
//	/* 查询指定id的学生 */
//	public function getByID($id){
//        for ($i = 1; $i < 1000; $i++) {
//		  $data = $this->db->fetchRow("select * from `student` where id={$id}");
//		return $data;
//        }
//	}

	public $id;
	public $name;
	public $password;
    public $phone;


	protected  function initTableName(){
        $this->m_tableName = "user";
	}
	protected  function initRelationMap(){
        $this->m_arRelationMap = array();

        $idItem = new item();
        $idItem->setMKey('id');
        $idItem->setMBCanModify(false);
        $idItem->setMDataType('int');
        array_push($this->m_arRelationMap,$idItem);

        $idItem = new item();
        $idItem->setMKey('name');
        $idItem->setMBCanModify(true);
        $idItem->setMDataType('str');
        array_push($this->m_arRelationMap,$idItem);

        $idItem = new item();
        $idItem->setMKey('password');
        $idItem->setMBCanModify(true);
        $idItem->setMDataType('str');
        array_push($this->m_arRelationMap,$idItem);
	}

	protected  function initPrimaryKey(){
		$this->m_primaryKey ='id';
	}


}
