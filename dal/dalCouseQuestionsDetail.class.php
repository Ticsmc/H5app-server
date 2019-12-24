<?php
/**
 * 基础类
 */
require_once 'dal/dalBase.class.php';
require_once 'model/couseQuestionsDetailModel.class.php';
class dalCouseQuestionsDetail extends dalBase {

	protected static $_instance = null;

	protected function init(){
		$this->m_tableName = "couse_questions_detail";
		parent::init();
	}

	public function saveCouseQuestionsDetail($mInstance)
	{
	    $this->save($mInstance);
	}

	public function delCouseQuestionsDetail($pk)
	{
        $this->delete($pk);
	}

	public function updateCouseQuestionsDetail($pk,$dataArray)
	{
		$this->update($pk,$dataArray);
	}

	public function getCouseQuestionsDetail($key)
	{
       return   $this->get($key);
	}

    public function getAllCouseQuestionsDetail()
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
			$couseQuestionsDetail = new couseQuestionsDetailModel();
            $couseQuestionsDetail->id = $mInstance['id'];
            $couseQuestionsDetail->cq_id = $mInstance['cq_id'];
            $couseQuestionsDetail->title =$mInstance['title'];
            $couseQuestionsDetail->type =$mInstance['type'];
            $couseQuestionsDetail->itemA =$mInstance['itemA'];
            $couseQuestionsDetail->itemB =$mInstance['itemB'];
            $couseQuestionsDetail->itemC =$mInstance['itemC'];
            $couseQuestionsDetail->itemD =$mInstance['itemD'];
            $couseQuestionsDetail->answer =$mInstance['answer'];
            $couseQuestionsDetail->score =$mInstance['score'];
			$this->m_redisCache->hSet($this->m_tableName,$couseQuestionsDetail->id,serialize($couseQuestionsDetail));
		}
	}
}
