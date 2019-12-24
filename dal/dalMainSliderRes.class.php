<?php
/**
 * 基础类
 */
require_once 'dal/dalBase.class.php';
require_once 'model/mainSliderResModel.class.php';
class dalMainSliderRes extends dalBase {

	protected static $_instance = null;

	protected function init(){
		$this->m_tableName = "main_slider_res";
		parent::init();
	}

	public function saveSliderRes($mInstance)
	{
	    $this->save($mInstance);
	}

	public function delSliderRes($pk)
	{
        $this->delete($pk);
	}

	public function updateSliderRes($pk,$dataArray)
	{
		$this->update($pk,$dataArray);
	}

	public function getSliderRes($key)
	{
       return   $this->get($key);
	}

    public function getAllSliderRes()
    {
        return $this->getAll();
    }

	public function initCache()
	{
		$lenCache = $this->m_redisCache->hLen($this->m_tableName);
		if($lenCache > 0)return;
		$sql = "select * from ".$this->m_tableName;
		$dbInst =  DBInterface::getInstance()->getDBInstance();
		$dataArray = $dbInst->fetchAll($sql);
		foreach ($dataArray as $mInstance) {
			$sliderRes = new mainSliderResModel();
            $sliderRes->id = $mInstance['id'];
            $sliderRes->img =$mInstance['img'];
			$this->m_redisCache->hSet($this->m_tableName,$sliderRes->id,serialize($sliderRes));
		}
	}
}
