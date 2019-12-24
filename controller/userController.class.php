<?php
/**
 * 用户模块控制器类
 */
require_once 'model/userModel.class.php';
require_once 'dal/dalUser.class.php';
require_once 'config/configs.class.php';
require_once 'MySQLPDO.class.php';
class userController{
	/**
	 * 新增学生
	 */
	public function userRegisterAction(){
		//实例化模型，取出数据
		$name = $_POST['account'];
		$password = $_POST['password'];

//        if(strlen($name)<20 && strlen($password)<20)
//        {
//            $dbConfig = array('user' => 'root', 'pass' => 'root', 'dbname' => 'test');
//            $m_db = MySQLPDO::getInstance($dbConfig);
//            $sqlstr = "insert into user(name,password) values("."'".$name."'".","."'".$password."'".")";
//            $m_db->exec($sqlstr);
//            $resp = array("errorcode" => Configs::$error_code['success']);
//        }
//		else
//        {
//            $resp = array("errorcode" => Configs::$error_code['register_len_fail']);
//        }
//
//
//        echo json_encode($resp);


        $resp = array("ret" => Configs::$error_code['success']);

		if(strlen($name)<20 && strlen($password)<20)
		{

				$usr = new userModel();
				$usr->name = $name;
				$usr->password = $password;
				$usr->save();

//				$dal = dalUser::getInstance();
//				$pd = $dal->getUserName($name);
//				if ($pd == 0) {
//					$resp = array("ret" => Configs::$error_code['register_fail']);
//				} else {
//					$dal->saveUser($usr);
//					$resp = array("ret" => Configs::$error_code['success'], "data" => array("user_id" => $usr->id));
//				}


		}
		else
		{
			$resp = array("ret" => Configs::$error_code['register_len_fail']);
		}


		echo json_encode($resp);
	}

	//用户登录接口
	public function userLoginAction(){
		//实例化模型，取出数据
		$name = $_POST['account'];
		$password = $_POST['password'];

		//用户登录逻辑
		$dal = dalUser::getInstance();
		$loginer = $dal->getLoginer($name,$password);
		$resp = null;
		if($loginer)
		{
			$resp = array ("ret" => Configs::$error_code['success'],"data" => array("user_id"=>$loginer->id));
		}
		else
		{
			$resp = array ("ret" => Configs::$error_code['login_fail']);
		}

		echo json_encode($resp);
	}

//	public function delStudentAction(){
//		//实例化模型，取出数据
////		$stu = new studentModel();
////		$stu->delete(1);
//
//        $dalStu = dalStudent::getInstance();
//        $dalStu->delStudent(1);
//	}
//
//	public function updateStudentAction(){
//		//实例化模型，取出数据
//		$stu = new studentModel();
//		$updateArray = array('name'=>"testUpdate");
//		$stu->update(4,$updateArray);
//	}
//
//    public function getStudentAction(){
//        //实例化模型，取出数据
//		$dalStu = dalStudent::getInstance();
//        $data = $dalStu->getStudent(3);
//        var_dump($data);
//    }
//
//    public function getAllStudentAction(){
//        //实例化模型，取出数据
//        $stu = new studentModel();
//        $data = $stu->getAll();
//        var_dump($data);
//    }
//
//	/**
//	 * 学生列表
//	 */
//	public function listAction(){
//		//实例化模型，取出数据
//		$stu = new studentModel();
//		$data = $stu->getAll();
//		//载入视图文件
//		require 'student_list.html';
//	}
//	/**
//	 * 查看指定学生信息
//	 */
//	public function infoAction(){
//		//接收请求参数
//		$id = $_GET['id'];
//		//实例化模型，取出数据
//		$stu = new studentModel();
//		$data = $stu->getById($id);
//		//载入视图文件
//		require 'student_info.html';
//	}
}
