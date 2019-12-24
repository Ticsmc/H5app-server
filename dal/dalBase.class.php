<?php
/**
 * 基础类
 */
require_once 'utils/singleton.class.php';
require_once 'utils/redisCache.class.php';
require_once 'pdo/dbInterface.class.php';

class dalBase extends  Singleton{
	protected $m_redisCache; //缓存对象
	protected $m_tableName; //缓存对象

	protected function init(){
		$this->m_redisCache = RedisCache::getInstance()->getRedisI();
		$this->initCache();
	}

	public function save($mInstance)
	{
		$mInstance->save();
		$key = $mInstance->id;
        $mInstance = serialize($mInstance);
		$this->m_redisCache->hSet($this->m_tableName,$key,$mInstance);
	}

	public function delete($key)
	{
		$this->m_redisCache->hDel($this->m_tableName,$key);
        $mInstance = new studentModel();
		$mInstance->delete($key);
	}

	public function update($key,$dataArray)
	{
		$mInstance = $this->get($key);
		$mInstance->update($key,$dataArray);
		$mInstance = serialize($mInstance);
		$this->m_redisCache->hSet($this->m_tableName,$key,$mInstance);
	}

	public function get($key)
	{
        $mInstance =  $this->m_redisCache->hGet($this->m_tableName,$key);
        $mInstance = unserialize($mInstance);
		return $mInstance;
	}

    public function getAll()
    {
        $resp = Array();
		$allData =  $this->m_redisCache->hGetAll($this->m_tableName);
        foreach ($allData as $key=>$mInstance) {
            $mInstance = unserialize($mInstance);
            $resp[$key] = $mInstance;
        }
	    return $resp;
    }


	public function getLogin($name,$password){
		$alldata=$this->getAll();
		foreach($alldata as $user){
			$userdata=unserialize($user);
			if($userdata->name==$name&&$userdata->password==$password)
			{
				return $userdata;
			}
		}


	}

	//初始化数据缓存
    public function initCache()
    {

    }
}
