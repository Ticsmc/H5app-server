<?php
/**
 * user表的操作类，继承基础模型类
 */
require_once 'item.class.php';
require_once 'model.class.php';
class couseModel extends model{
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

	public $c_id;
	public $c_name;
    public $t_id;
    public $q_list;



	protected  function initTableName(){
        $this->m_tableName = "couse";
	}
	protected  function initRelationMap(){
        $this->m_arRelationMap = array();

        $idItem = new item();
        $idItem->setMKey('c_id');
        $idItem->setMBCanModify(false);
        $idItem->setMDataType('int');
        array_push($this->m_arRelationMap,$idItem);

        $idItem = new item();
        $idItem->setMKey('c_name');
        $idItem->setMBCanModify(true);
        $idItem->setMDataType('str');
        array_push($this->m_arRelationMap,$idItem);

        $idItem = new item();
        $idItem->setMKey('t_id');
        $idItem->setMBCanModify(true);
        $idItem->setMDataType('int');
        array_push($this->m_arRelationMap,$idItem);

        $idItem = new item();
        $idItem->setMKey('q_list');
        $idItem->setMBCanModify(true);
        $idItem->setMDataType('str');
        array_push($this->m_arRelationMap,$idItem);
	}

	protected  function initPrimaryKey(){
		$this->m_primaryKey ='c_id';
	}


}
