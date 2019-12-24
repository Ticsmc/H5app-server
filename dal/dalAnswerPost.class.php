<?php
/**
 * 基础类
 */
require_once 'dal/dalBase.class.php';
require_once 'model/answerPostModel.class.php';
class dalAnswerPost extends dalBase {

	protected static $_instance = null;

	protected function init(){
		$this->m_tableName = "answer_post";
		parent::init();
	}

	public function saveAnswerPost($mInstance)
	{
	    $this->save($mInstance);
	}

	public function delAnswerPost($pk)
	{
        $this->delete($pk);
	}

	public function updateAnswerPost($pk,$dataArray)
	{
		$this->update($pk,$dataArray);
	}

	public function getAnswerPost($key)
	{
       return   $this->get($key);
	}

    public function getAllAnswerPost()
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
			$answer = new answerPostModel();
            $answer->id = $mInstance['id'];
            $answer->question_id =$mInstance['question_id'];
            $answer->user_id =$mInstance['user_id'];
            $answer->answer_content =$mInstance['answer_content'];
            $answer->score =$mInstance['score'];
            $answer->time =$mInstance['time'];
			$this->m_redisCache->hSet($this->m_tableName,$answer->id,serialize($answer));
		}
	}
}
