<?php
/**
 * 用户模块控制器类
 */
require_once 'model/userModel.class.php';
require_once 'dal/dalUser.class.php';
require_once 'dal/dalCouse.class.php';
require_once 'dal/dalCouseQuestions.class.php';
require_once 'dal/dalCouseQuestionsDetail.class.php';
require_once 'config/configs.class.php';
require_once 'MySQLPDO.class.php';
class questionController{
	/**
	 * 课程列表
	 */
	public function couseResAction(){
		//实例化模型，取出数据
		$uid = $_POST['uid'];
        $page = $_POST['page'];

        $resp = array("errorcode" => Configs::$error_code['success']);

		$bValid = dalUser::getInstance()->checkUserValid($uid);
        if(!$bValid)
            $resp = array("errorcode" => Configs::$error_code['user_invalid']);
        else{
            $respData = dalCouse::getInstance()->getAllCouse();
            $pagesize = 6;
            $count = count($respData);//总条数
            $start=($page-1)*$pagesize;//偏移量，当前页-1乘以每页显示条数
            $article = array_slice($respData,$start,$pagesize);
            $resp = array("errorcode" => Configs::$error_code['success'],"data"=>$respData);
        }


		echo json_encode($resp);
	}

    /**
     * 课程习题集列表
     */
    public function cqListResAction(){
        //实例化模型，取出数据
        $uid = $_POST['uid'];
        $cid = $_POST['cid'];
        $page = $_POST['page'];

        $resp = array("errorcode" => Configs::$error_code['success']);

        $bValid = dalUser::getInstance()->checkUserValid($uid);
        if(!$bValid)
            $resp = array("errorcode" => Configs::$error_code['user_invalid']);
        else{
            $couse = dalCouse::getInstance()->getCouse($cid);
            $qlist = explode(';',$couse->q_list);

            $allCQData = Array();
            foreach ($qlist as $qid)
            {
                $cq = dalCouseQuestions::getInstance()->getCouseQuestions($qid);
                array_push($allCQData,$cq);
            }

            $pagesize = 6;
            $count = count($allCQData);//总条数
            $start=($page-1)*$pagesize;//偏移量，当前页-1乘以每页显示条数
            $respData = array_slice($allCQData,$start,$pagesize);
            $resp = array("errorcode" => Configs::$error_code['success'],"data"=>$respData);
        }


        echo json_encode($resp);
    }


    /**
     * 习题详情列表,第一题数据以及总数
     */
    public function cqDetailsResAction(){
        //实例化模型，取出数据
        $uid = $_POST['uid'];
        $cqid = $_POST['cqid'];

        $resp = array("errorcode" => Configs::$error_code['success']);

        $bValid = dalUser::getInstance()->checkUserValid($uid);
        if(!$bValid)
            $resp = array("errorcode" => Configs::$error_code['user_invalid']);
        else{
            $cq = dalCouseQuestions::getInstance()->getCouseQuestions($cqid);
            $qlist = explode(';',$cq->questions);
            $count = count($qlist);//总条数
            $arrDetails = Array();
            foreach ( $qlist as $cq_detail_id)
            {
                $cqDetail =  dalCouseQuestionsDetail::getInstance()->getCouseQuestionsDetail($cq_detail_id);
                array_push($arrDetails,$cqDetail);
            }

            $resp = array("errorcode" => Configs::$error_code['success'],
                "data"=>$arrDetails,"cq_details_len"=>$count,"cq_title"=>$cq->q_name);
        }

        echo json_encode($resp);
    }


    /**
     * 提交答案
     */
    public function onPostAnswerAction(){
        //实例化模型，取出数据
        $uid = $_POST['uid'];
        $cqid = $_POST['qid'];
        $answers = $_POST['answers'];

        $resp = array("errorcode" => Configs::$error_code['success']);
        $resp['answer'] = array();
        $bValid = dalUser::getInstance()->checkUserValid($uid);
        if(!$bValid)
            $resp = array("errorcode" => Configs::$error_code['user_invalid']);
        else{
             foreach($answers as $qid=>$qanswer)
             {
                 $cqDetail =  dalCouseQuestionsDetail::getInstance()->getCouseQuestionsDetail($qid);
                 if($cqDetail->type == 1)//单选
                 {
                     $userAnswer = strtoupper($answers[$qid]);
                     $resp['answer'][$qid] = ($userAnswer == $cqDetail->answer);
                 }
                 else
                 {
                     $helpArray = array();
                     foreach($answers[$qid] as $uanswer)
                     {
                         array_push($helpArray,$uanswer);
                     }
                     $alist = explode(',',$cqDetail->answer);
                     $compRet = $this->diffArray($alist,$helpArray);
                     $resp['answer'][$qid] =(count($compRet) <= 0 );
                 }

             }
        }

        echo json_encode($resp);
    }


    /**
     * 以第一个参数为主进行进行比较
     * **/
    public  function diffArray($arr1 , $arr2 ){
        $arrRet = array();
        #针对关联数组
        if($this->is_assoc($arr1) && $this->is_assoc($arr2) ){
            if (empty($arr1)) {
                $arr1 = array();
            }
            if (empty($arr2)) {
                $arr2 = array();
            }

            foreach ($arr1 as $key => $value){
                if(!in_array($key, array_keys($arr2))){
                    if(!array_key_exists($key, $arrRet)){
                        array_push($arrRet, $key);
                    }
                    continue;
                }
                if($arr1[$key] !== $arr2[$key]){
                    if(!array_key_exists($key, $arrRet)){
                        array_push($arrRet, $key);
                    }
                }
                #针对元素为数组的情况
                if(is_array($value)){
                    array_merge($arrRet,$this->diffArray($value,$arr2[$key]));
                }
            }
        }elseif($this->is_assoc($arr1)===false && $this->is_assoc($arr2)===false) {#针对索引数组
            $arrRet = array_merge(array_diff($arr1, $arr2),array_diff($arr2, $arr1));
        }else {
            new Exception("数组类型不一致!");
        }
        return $arrRet;
    }

    /**
     * 判断是否为关联数组
     * **/
    private  function is_assoc($arr) {
        if(!is_array($arr)) return -1;
        return !(array_values($arr) === $arr);
    }

}
