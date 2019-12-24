<?php
/**
 * 基础类
 */
require_once 'dal/dalBase.class.php';
require_once 'model/couseModel.class.php';
class dalCouse extends dalBase {

	protected static $_instance = null;

	protected function init(){
		$this->m_tableName = "couse";
		parent::init();
	}

	public function saveCouse($mInstance)
	{
	    $this->save($mInstance);
	}

	public function delCouse($pk)
	{
        $this->delete($pk);
	}

	public function updateCouse($pk,$dataArray)
	{
		$this->update($pk,$dataArray);
	}

	public function getCouse($key)
	{
       return   $this->get($key);
	}

    public function getAllCouse()
    {
        return $this->getAll();
    }

	public function initCache()
	{
		$lenCache = $this->m_redisCache->hLen($this->m_tableName);
		//if($lenCache > 0)return;
		$sql = "select * from ".$this->m_tableName;
		$dbInst =  DBInterface::getInstance()->getDBInstance();
		$dataArray = $dbInst->fetchAll($sql);
		foreach ($dataArray as $mInstance) {
			$couse = new couseModel();
            $couse->c_id = $mInstance['c_id'];
            $couse->c_name =$mInstance['c_name'];
            $couse->t_id =$mInstance['t_id'];
            $couse->q_list =$mInstance['q_list'];
			$this->m_redisCache->hSet($this->m_tableName,$couse->c_id,serialize($couse));
		}
	}
}
