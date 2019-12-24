<?php
/**
 * 用户模块控制器类
 */
require_once 'model/userModel.class.php';
require_once 'dal/dalUser.class.php';
require_once 'dal/dalMainSliderRes.class.php';
require_once 'config/configs.class.php';
require_once 'MySQLPDO.class.php';
class mainController{
	/**
	 * 新增学生
	 */
	public function mainSliderResAction(){
		//实例化模型，取出数据
		$uid = $_POST['uid'];

        $resp = array("errorcode" => Configs::$error_code['success']);

		$bValid = dalUser::getInstance()->checkUserValid($uid);
        if(!$bValid)
            $resp = array("errorcode" => Configs::$error_code['user_invalid']);
        else{
            $respData = dalMainSliderRes::getInstance()->getAllSliderRes();
            $resp = array("errorcode" => Configs::$error_code['success'],"data"=>$respData);
        }


		echo json_encode($resp);
	}


}
