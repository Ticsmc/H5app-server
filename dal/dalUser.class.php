<?php
/**
 * 基础类
 */
require_once 'dal/dalBase.class.php';
require_once 'model/userModel.class.php';
class dalUser extends dalBase {

	protected static $_instance = null;

	protected function init(){
		$this->m_tableName = "user";
		parent::init();
	}

	public function saveUser($mInstance)
	{
	    $this->save($mInstance);
	}

	public function delUser($pk)
	{
        $this->delete($pk);
	}

	public function updateUser($pk,$dataArray)
	{
		$this->update($pk,$dataArray);
	}

	public function getUser($key)
	{
       return   $this->get($key);
	}

	public function initCache()
	{
		$lenCache = $this->m_redisCache->hLen($this->m_tableName);
		if($lenCache > 0)return;
		$sql = "select * from ".$this->m_tableName;
		$dbInst =  DBInterface::getInstance()->getDBInstance();
		$dataArray = $dbInst->fetchAll($sql);
		foreach ($dataArray as $mInstance) {
			$usr = new userModel();
			$usr->id = $mInstance['id'];
			$usr->name =$mInstance['name'];
			$usr->password = $mInstance['password'];
			$this->m_redisCache->hSet($this->m_tableName,$usr->id,serialize($usr));
		}
	}

	//获取登录用户信息
	public function getLoginer($name,$password)
	{
        $users = $this->getAll();
		foreach ($users as $mUser) {
             $user = unserialize($mUser);
			 if($name == $user->name && $password == $user->password)
			 {
				 return $user;
			 }
		}
		return null;
	}
	public function getUserName($username)
	{
		$i=1;
		$userall=$this->getAll();
		foreach($userall as $user)
		{
			$userinfo=unserialize($user);
			if($userinfo->name==$username){
				$i=0;
			}

		}
		return $i;

	}


	//获取登录用户信息
	public function checkUserValid($uid)
	{
		$users = $this->getUser($uid);
		return ($users != null);
	}

}
