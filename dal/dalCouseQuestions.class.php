<?php
/**
 * 基础类
 */
require_once 'dal/dalBase.class.php';
require_once 'model/couseQuestionsModel.class.php';
class dalCouseQuestions extends dalBase {

	protected static $_instance = null;

	protected function init(){
		$this->m_tableName = "couse_questions";
		parent::init();
	}

	public function saveCouseQuestions($mInstance)
	{
	    $this->save($mInstance);
	}

	public function delCouseQuestions($pk)
	{
        $this->delete($pk);
	}

	public function updateCouseQuestions($pk,$dataArray)
	{
		$this->update($pk,$dataArray);
	}

	public function getCouseQuestions($key)
	{
       return   $this->get($key);
	}

    public function getAllCouseQuestions()
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
			$couseQuestions = new couseQuestionsModel();
            $couseQuestions->id = $mInstance['id'];
            $couseQuestions->c_id = $mInstance['c_id'];
            $couseQuestions->q_name =$mInstance['q_name'];
            $couseQuestions->questions =$mInstance['questions'];
			$this->m_redisCache->hSet($this->m_tableName,$couseQuestions->id,serialize($couseQuestions));
		}
	}
}
