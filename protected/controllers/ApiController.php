<?php

error_reporting(E_ALL);
require_once('aws.phar');
require 'aws/vendor/autoload.php';
require_once('sns.class.php');
require_once("protected/extensions/phpmailer/autoload.php");


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Headers:x-requested-with, Content-Type, origin, authorization, accept, client-security-token");
//date_default_timezone_set("Asia/Riyadh");

use Aws\Sns\SnsClient;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

set_error_handler('exceptions_error_handler');

function exceptions_error_handler($severity, $message, $filename, $lineno) {
    if (error_reporting() == 0) {
        return;
    }
    if (error_reporting() & $severity) {
        throw new ErrorException($message, 0, $severity, $filename, $lineno);
    }
}

class ApiController extends Controller {

    public $msg;
    public $errorCode;
    public $starttime;
    public $apiLogID;

    /**
     * Declares class-based actions.
     */
    public function actions() {

        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    function beforeAction($action = NULL) {

        $this->layout='column3';

        $mtime = microtime();
        $mtime = explode(" ", $mtime);
        $mtime = $mtime[1] + $mtime[0];
        $this->starttime = $mtime;

        $apiData = array();
        $apiData['api_name'] = Yii::app()->controller->action->id;
        $apiData['status'] = 1;

        $TblApiCallsObj = new TblApiCalls();
        $TblApiCallsObj->setData($apiData);
        $this->apiLogID = $TblApiCallsObj->insertData();

        $this->msg = Yii::app()->params->msg;
        $this->errorCode = Yii::app()->params->errorCode;

        if (Yii::app()->controller->action->id != "showLogs" && Yii::app()->controller->action->id != "clearLogs") {
            $dt = date('Y-m-d H:i:s');
            $fp = fopen(_SITENAME_ . '.txt', 'a+');
            fwrite($fp, "\r\r\n<div style='background-color:#F2F2F2; color:#222279; font-weight: bold; padding:10px;box-shadow: 0 5px 2px rgba(0, 0, 0, 0.25);'>");
            fwrite($fp, "<b>API Call Time</b> : <font size='6' style='color:orange;'><b><i>" . $dt . "</i></b></font> <br>");
            fwrite($fp, "<b>Function Name</b> : <font size='6' style='color:orange;'><b><i>" . Yii::app()->controller->action->id . "</i></b></font>");
            fwrite($fp, "\r\r\n\n");
            fwrite($fp, "<b>PARAMS</b> : " . print_r($_REQUEST, true));
            fwrite($fp, "\r\r\n");
            $link = "http://" . $_SERVER['HTTP_HOST'] . '' . print_r($_SERVER['REQUEST_URI'], true) . "";
            fwrite($fp, "<b>URL</b> :<a style='text-decoration:none;color:#4285F4' target='_blank' href='" . $link . "'> http://" . $_SERVER['HTTP_HOST'] . '' . print_r($_SERVER['REQUEST_URI'], true) . "</a>");
            fwrite($fp, "</div>\r\r\n");
            fclose($fp);
        }
        return true;
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->renderPartial('apilist');
        //$this->redirect(array("admin/index"));
    }

    public function actionpossibleErrors() {
        $this->render('possibleErrorsList');
    }
/* =========================================== Start  Customer API ==============================================    */


    function actionshowLogs() {
        $handle = @fopen(_SITENAME_ . '.txt', "r");
        if ($handle) {
            while (($buffer = fgets($handle, 4096)) !== false) {
                echo $buffer;
                echo "<br>";
            }
            if (!feof($handle)) {
                echo "Error: unexpected fgets() fail\n";
            }
        }
        fclose($handle);
    }

    function actionclearLogs() {
        $handle = fopen(_SITENAME_ . '.txt', "w");
        fwrite($handle, '');
        fclose($handle);
    }

	function actionmessage()
    {
        $session	=	new CHttpSession;
        $session->open();
        $prefferd_language = $session['prefferd_language'];
        //echo $session['prefferd_language'];die;
        if($session['prefferd_language'] = 'ar')
        {
            $this->setLanguage('2');
            $message_ar  = $this->msg['_PROVIDER_BUSY_'];
            $this->setLanguage('1');
            $message  = $this->msg['_PROVIDER_BUSY_'];
            $this->setLanguage('2');
        }
        else
        {
            $message  = $this->msg['_PROVIDER_BUSY_'];
            $this->setLanguage('2');
            $message_ar  = $this->msg['_PROVIDER_BUSY_'];
            $this->setLanguage('1');
        }
          /*  echo $message_ar;
            echo "<br/>";echo $message;*/
    }

    function response($response = NULL) {
        header("content-type: application/json");
        $this->endTimeCalculate($response);
        echo json_encode($response);
        die;
    }

    function endTimeCalculate($response) {
        $mtime = microtime();
        $mtime = explode(" ", $mtime);
        $mtime = $mtime[1] + $mtime[0];
        $endtime = $mtime;
        $totaltime = ($endtime - $this->starttime) * 1000;

        $apiData = array();
        $apiData['time'] = $totaltime;
        $apiData['api_name'] = Yii::app()->controller->action->id;
        $apiData['created'] = date("Y-m-d H:i:s");
        $apiData['status'] = 2;
        $apiData['request'] = json_encode($_REQUEST);
        $apiData['response'] = json_encode($response);


        $TblApiCallsObj = new TblApiCalls();
        $TblApiCallsObj->setData($apiData);
        $TblApiCallsObj->insertData($this->apiLogID);
    }

    function setLanguage($lang="1")
    {
        if(isset($lang) && $lang == '2')
        {
            $this->PrefferedLanguage('ar');
        }
        else
        {
            $this->PrefferedLanguage('eng');
        }
    }

    function PrefferedLanguage($lang='eng')
    {

        Yii::app()->session['prefferd_language']=$lang;
        if($lang == 'eng')
        {
            Yii::app()->session['prefferd_language_id']	= '1' ;
        }

        if($lang == 'ar')
        {
            Yii::app()->session['prefferd_language_id']	= '2' ;
        }

        $session	=	new CHttpSession;
        $session->open();
        $prefferd_language = $session['prefferd_language'];

        if(!isset($prefferd_language))
        {
            $prefferd_language = 'eng';
        }

        $adminLanguagePath=FILE_PATH."protected/vendors/Smarty/languages/".$prefferd_language."/admin_global.php";
        //$prefferd_language = 'ar';
        if(isset($adminLanguagePath))
        {
            $adminmsg = include($adminLanguagePath);
        }
        if(isset($prefferd_language))
        {
            $languagePath=FILE_PATH."protected/vendors/Smarty/languages/".$prefferd_language."/global.php";
        }
        else
        {
            $languagePath=FILE_PATH."protected/vendors/Smarty/languages/".DEFAULT_LANGUAGE."/global.php";
        }
        if (file_exists($languagePath))
        {
            global $msg;
            $msg = include($languagePath);
        } else {
            //error_log("FATAL ERROR: do not know the language! Using English");
            global $msg;
            $prefferd_language=DEFAULT_LANGUAGE;
            $languagePath=FILE_PATH."protected/vendors/Smarty/languages/".$prefferd_language."/global.php";
            $msg = include($languagePath);

        }
        $errorCodePath=FILE_PATH."protected/vendors/Smarty/languages/errorcode.php";
        if (file_exists($errorCodePath))
        {
            global $errorCode;
            $errorCode = include($errorCodePath);
        }
        $this->msg = $msg;
        $this->errorCode = $errorCode;
        return true;

    }

    function actionTest()
    {
        $str = "a'ќўѓ";
        $strD =  htmlentities($str);
        $TblCustomerObj = new TblCustomer();
        $bool = $TblCustomerObj->checkEmailExists("vishal.panchal@bpt.in");
        print "<pre>";
        print_r($bool);
        echo $strD;
        error_log($strD);
    }


    /*=============================  User  Defined Function ===============================*/

    /*
      Function : createSession
      Description : Create driver and passenger session.
      Developed By : Priyank Patel
      Date:- 22-Aug-2017
     */
    function createSession($userId, $userType, $deviceToken,$endpoint_arn=NULL) {
        /* Code for generate session at registation time */
        $sessionData = array();
        $sessionData['user_id'] = $userId;
        $sessionData['user_type'] = $userType;

        $abc = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
            "0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        $sessionId = $abc[rand(0, 61)] . $abc[rand(0, 61)] . $abc[rand(0, 61)] . $abc[rand(0, 61)] . $abc[rand(0, 61)];
        $sessionId .= $sessionId . $abc[rand(0, 61)] . $abc[rand(0, 61)] . $abc[rand(0, 61)] . $abc[rand(0, 61)] . $abc[rand(0, 61)];
        $sessionId .= $sessionId . $abc[rand(0, 61)] . $abc[rand(0, 61)] . $abc[rand(0, 61)] . $abc[rand(0, 61)] . $abc[rand(0, 61)];
        $sessionData['device_token'] = $deviceToken;
        $sessionData['endpointArn'] = $endpoint_arn;
        $sessionData['session_code'] = $sessionId;
        $sessionData['status'] = 1;
        $sessionData['created_at'] = date('Y-m-d H:i:s');
        $sessionData['modified_at'] = date('Y-m-d H:i:s');

        //check this token of this user is already exist
        $TblUsersessionObj = new TblUsersession();
        $get_session = $TblUsersessionObj->check_session_withToken($sessionData['user_id'], $sessionData['device_token'],$userType);

        if (!empty($get_session)) { // if record found then update session
            $sees_data = array();
            $sees_data['session_code'] = $sessionData['session_code'];
            $sees_data['status'] = 1;
            $sees_data['modified_at'] = date('Y-m-d H:i:s');
            $TblUsersessionObj = new TblUsersession();
            $TblUsersessionObj->setData($sees_data);
            $TblUsersessionObj->insertData($get_session['user_session_id']);

            $TblUsersessionObj = new TblUsersession();
            $session_Data = $TblUsersessionObj->getSessionDataByUserSessionID($get_session['user_session_id']);

        } else {
            // delete all previous session
            $this->deleteSession($sessionData['user_id'], $sessionData['user_type']);
            // Insert New Record
            $TblUsersessionObj = new TblUsersession();
            $TblUsersessionObj->setData($sessionData);
            $session_id = $TblUsersessionObj->insertData();

            $TblUsersessionObj = new TblUsersession();
            $session_Data = $TblUsersessionObj->getSessionDataByUserSessionID($session_id);
        }
        return $session_Data;

    }

    public function deleteSession($userId, $userType) {
        $UsersessionObj = new TblUsersession();
        $checkSession = $UsersessionObj->checksessionExists($userId, $userType);
        if (!empty($checkSession)) {
            $UsersessionObj = new TblUsersession();
            $UsersessionObj->deleteAllSessoion($userId, $userType);
            return 1;
        } else {
            return 0;
        }
    }

    function emailSend($message=NULL,$email=NULL,$subject=NULL)
    {   //echo "hi"; die;
        $mail = new PHPMailer;
        $mail->Host = MANDRILL_HOST;      // Specify main and backup server
        $mail->Port = MANDRILL_PORT;      // Set the SMTP port
        $mail->SMTPAuth = true;
        $mail->isSMTP();          // Enable SMTP authentication
        $mail->Username = MANDRILL_USERNAME; // SMTP username
        $mail->Password = MANDRILL_PASSWORD; // SMTP password
        //$mail->SMTPDebug  = 4;
        $mail->SMTPSecure = MANDRILL_SMTPSECURE;
        $mail->SetFrom('no-reply@mymudra.com', 'mymudra');
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        //$address = RIDE_APPROVAL_ADMIN;
        $mail->AddAddress($email);
        $result = $mail->Send();
        return $result;
    }

    /*function actiontestone()
    {
       $data = $this->emailSend("sdfsdsdsfs","bhoomi.patel@bypeopletechnologies.com","test");
       echo "<pre>"; print_r($data); die;
    }*/
    /*=============================  User  Defined Function End===============================*/

    /*api for listing of bank loan type*/ /*not in use*/
    public function actionbankLoanList()
    {
        if (!empty($_REQUEST) && isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != '' && isset($_REQUEST['session_code']) && $_REQUEST['session_code'] != '' && isset($_REQUEST['loan_type_id']) && $_REQUEST['loan_type_id']!='')
        {
            $TblUserSessionObj = new TblUsersession();
            $user = $TblUserSessionObj->checksession($_REQUEST['user_id'], $_REQUEST['session_code'], 1);
            //print_r($user);die;
            if (!empty($user)){
                $transaction = Yii::app()->db->beginTransaction();
                try{
                    $user_id = $_REQUEST['user_id'];
                    $loan_type_id = $_REQUEST['loan_type_id'];
                    $tblLoanTypeObj = new TblLoanTypeMaster();
                    $LoanList = $tblLoanTypeObj->getLoanTypeList();

                    if(!empty($LoanList))
                    {
                        $transaction->commit();
                        $data = array();
                        $data['status'] =  $this->errorCode['_SUCCESS_'];
                        $data['message'] =  $this->msg['_SUCCESS_'];
                        $data['data'] = $LoanList;
                        $this->response($data);
                    }
                    else
                    {
                        $this->response(array("status" => $this->errorCode['_DATA_NOT_FOUND_'], "message" =>  $this->msg['_DATA_NOT_FOUND_'], 'data' => array()));
                    }
                }
                catch(Exception $e)
                {
                    $transaction->rollback();
                    $data = array();
                    $data['status'] = -111;
                    $data['message'] = $e->getMessage();
                    $data['data'] = array();
                    $this->response($data);
                }
            }
            else
            {
                $this->response(array("status" => $this->errorCode['_INVALID_SESSION_'], "message" => $this->msg['_INVALID_SESSION_'], 'data' => array()));
            }
        }else{
            $this->response(array("status" => $this->errorCode['_PERMISSION_DENIED_'], "message" => $this->msg['_PERMISSION_DENIED_'], 'data' => array()));
        }
    }

    /*api for listing of investment advisory type*/ /*not in use*/
    public function actioninvestmentAdvisoryList()
    {
        if (!empty($_REQUEST) && isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != '' && isset($_REQUEST['session_code']) && $_REQUEST['session_code'] != '' && isset($_REQUEST['loan_type_id']) && $_REQUEST['loan_type_id']!='')
        {
            $TblUserSessionObj = new TblUsersession();
            $user = $TblUserSessionObj->checksession($_REQUEST['user_id'], $_REQUEST['session_code'], 1);
            //print_r($user);die;
            if (!empty($user)){
                $transaction = Yii::app()->db->beginTransaction();
                try{
                    $user_id = $_REQUEST['user_id'];
                    $loan_type_id = $_REQUEST['loan_type_id'];
                    $tblInvestmentTypeObj = new TblInvTypeMaster();
                    $InvAdvisoryList = $tblInvestmentTypeObj->getInvAdvisoryTypeList($loan_type_id);

                    if(!empty($InvAdvisoryList))
                    {
                        $transaction->commit();
                        $data = array();
                        $data['status'] =  $this->errorCode['_SUCCESS_'];
                        $data['message'] =  $this->msg['_SUCCESS_'];
                        $data['data'] = $InvAdvisoryList;
                        $this->response($data);
                    }
                    else
                    {
                        $this->response(array("status" => $this->errorCode['_DATA_NOT_FOUND_'], "message" =>  $this->msg['_DATA_NOT_FOUND_'], 'data' => array()));
                    }
                }
                catch(Exception $e)
                {
                    $transaction->rollback();
                    $data = array();
                    $data['status'] = -111;
                    $data['message'] = $e->getMessage();
                    $data['data'] = array();
                    $this->response($data);
                }
            }
            else
            {
                $this->response(array("status" => $this->errorCode['_INVALID_SESSION_'], "message" => $this->msg['_INVALID_SESSION_'], 'data' => array()));
            }
        }else{
            $this->response(array("status" => $this->errorCode['_PERMISSION_DENIED_'], "message" => $this->msg['_PERMISSION_DENIED_'], 'data' => array()));
        }
    }

    /*api for listing of real estate type*/ /*not in use*/
    public function actionrealEstateList()
    {
        if (!empty($_REQUEST) && isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != '' && isset($_REQUEST['session_code']) && $_REQUEST['session_code'] != '' && isset($_REQUEST['loan_type_id']) && $_REQUEST['loan_type_id']!='')
        {
            $TblUserSessionObj = new TblUsersession();
            $user = $TblUserSessionObj->checksession($_REQUEST['user_id'], $_REQUEST['session_code'], 1);
            //print_r($user);die;
            if (!empty($user)){
                $transaction = Yii::app()->db->beginTransaction();
                try{
                    $user_id = $_REQUEST['user_id'];
                    $loan_type_id = $_REQUEST['loan_type_id'];
                    $tblPropertyTypeObj = new TblPropertyTypeMaster();
                    $realEstateList = $tblPropertyTypeObj->getRealEstateTypeList($loan_type_id);

                    if(!empty($realEstateList))
                    {
                        $transaction->commit();
                        $data = array();
                        $data['status'] =  $this->errorCode['_SUCCESS_'];
                        $data['message'] =  $this->msg['_SUCCESS_'];
                        $data['data'] = $realEstateList;
                        $this->response($data);
                    }
                    else
                    {
                        $this->response(array("status" => $this->errorCode['_DATA_NOT_FOUND_'], "message" =>  $this->msg['_DATA_NOT_FOUND_'], 'data' => array()));
                    }
                }
                catch(Exception $e)
                {
                    $transaction->rollback();
                    $data = array();
                    $data['status'] = -111;
                    $data['message'] = $e->getMessage();
                    $data['data'] = array();
                    $this->response($data);
                }
            }
            else
            {
                $this->response(array("status" => $this->errorCode['_INVALID_SESSION_'], "message" => $this->msg['_INVALID_SESSION_'], 'data' => array()));
            }
        }else{
            $this->response(array("status" => $this->errorCode['_PERMISSION_DENIED_'], "message" => $this->msg['_PERMISSION_DENIED_'], 'data' => array()));
        }
    }

    /*api for list of loan sub type based on three type*/
    public function actionloanTypeList()
    {
        if (!empty($_REQUEST) && isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != '' && isset($_REQUEST['session_code']) && $_REQUEST['session_code'] != '' && isset($_REQUEST['loan_type']) && $_REQUEST['loan_type']!='')
        {
            $TblUserSessionObj = new TblUsersession();
            $user = $TblUserSessionObj->checksession($_REQUEST['user_id'], $_REQUEST['session_code'], 1);
            //print_r($user);die;
            if (!empty($user)){
                $transaction = Yii::app()->db->beginTransaction();
                try{
                    if(isset($_REQUEST['loan_type']) && $_REQUEST['loan_type']==1)
                    {
                        $tblLoanTypeObj = new TblLoanTypeMaster();
                        $LoanList = $tblLoanTypeObj->getLoanTypeList();
                    }
                    else if(isset($_REQUEST['loan_type']) && $_REQUEST['loan_type']==2)
                    {
                        $tblInvestoryTypeObj = new TblInvTypeMaster();
                        $LoanList = $tblInvestoryTypeObj->getInvTypeList();
                    }
                    else if(isset($_REQUEST['loan_type']) && $_REQUEST['loan_type']==3)
                    {
                        $tblRealEstateObj = new TblPropertyTypeMaster();
                        $LoanList = $tblRealEstateObj->getPropertyTypeList();
                    }


                    if(!empty($LoanList))
                    {
                        $transaction->commit();
                        $data = array();
                        $data['status'] =  $this->errorCode['_SUCCESS_'];
                        $data['message'] =  $this->msg['_SUCCESS_'];
                        $data['data'] = $LoanList;
                        $this->response($data);
                    }
                    else
                    {
                        $this->response(array("status" => $this->errorCode['_DATA_NOT_FOUND_'], "message" =>  $this->msg['_DATA_NOT_FOUND_'], 'data' => array()));
                    }
                }
                catch(Exception $e)
                {
                    $transaction->rollback();
                    $data = array();
                    $data['status'] = -111;
                    $data['message'] = $e->getMessage();
                    $data['data'] = array();
                    $this->response($data);
                }
            }
            else
            {
                $this->response(array("status" => $this->errorCode['_INVALID_SESSION_'], "message" => $this->msg['_INVALID_SESSION_'], 'data' => array()));
            }
        }else{
            $this->response(array("status" => $this->errorCode['_PERMISSION_DENIED_'], "message" => $this->msg['_PERMISSION_DENIED_'], 'data' => array()));
        }
    }

    /*api for dashboard icons*/
    public function actiondashboard()
    {
        if (!empty($_REQUEST) && isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != '' && isset($_REQUEST['session_code']) && $_REQUEST['session_code'] != '')
        {
            $TblUserSessionObj = new TblUsersession();
            $user = $TblUserSessionObj->checksession($_REQUEST['user_id'], $_REQUEST['session_code'], 1);
            //print_r($user);die;
            if (!empty($user)){
                $transaction = Yii::app()->db->beginTransaction();
                try{
                    $user_id = $_REQUEST['user_id'];
                    $tblLoanTypeObj = new TblLoanTypeMaster();
                    $loanList = $tblLoanTypeObj->getLoanTypeList();

                    if(!empty($loanList))
                    {
                        $transaction->commit();
                        $data = array();
                        $data['status'] =  $this->errorCode['_SUCCESS_'];
                        $data['message'] =  $this->msg['_SUCCESS_'];
                        $data['data'] = $loanList;
                        $this->response($data);
                    }
                    else
                    {
                        $this->response(array("status" => $this->errorCode['_DATA_NOT_FOUND_'], "message" =>  $this->msg['_DATA_NOT_FOUND_'], 'data' => array()));
                    }
                }
                catch(Exception $e)
                {
                    $transaction->rollback();
                    $data = array();
                    $data['status'] = -111;
                    $data['message'] = $e->getMessage();
                    $data['data'] = array();
                    $this->response($data);
                }
            }
            else
            {
                $this->response(array("status" => $this->errorCode['_INVALID_SESSION_'], "message" => $this->msg['_INVALID_SESSION_'], 'data' => array()));
            }
        }else{
            $this->response(array("status" => $this->errorCode['_PERMISSION_DENIED_'], "message" => $this->msg['_PERMISSION_DENIED_'], 'data' => array()));
        }
    }

    /*====================Bhoomi code start here for mymudra project=====================================*/

    public function actionuserSignUp() {

        if (!empty($_REQUEST) ) {
            $postData = array();
            $transaction = Yii::app()->db->beginTransaction();
            try {

                /*   Optional paramaeters  */
                if (isset($_REQUEST['device_type']) && $_REQUEST['device_type'] != '') {
                    $postData['device_type'] = $_REQUEST['device_type'];
                }

                if (isset($_REQUEST['os_version']) && $_REQUEST['os_version'] != '') {
                    $postData['device_os'] = $_REQUEST['os_version'];
                }

                if (isset($_REQUEST['device_model']) && $_REQUEST['device_model'] != '') {
                    $postData['device_model'] = $_REQUEST['device_model'];

                }
                if (isset($_REQUEST['app_version']) && $_REQUEST['app_version'] != '') {
                    $postData['app_version'] = $_REQUEST['app_version'];

                }
                /* End optional parameters */

                $validationObj = new Validation();
                $res = $validationObj->userSignUp($_REQUEST);

                if ($res['status'] == 0)
                {
                    $TblUserObj = new TblUser();
                    $bool = $TblUserObj->checkMobilenumberExists($_REQUEST['mobile_number']);

                    if (!empty($bool)) {
                        $this->response(array("status" => $this->errorCode['_MOBILE_NUMBER_ALREADY_EXIST_'], "message" => $this->msg['_MOBILE_NUMBER_ALREADY_EXIST_'], 'data' => array()));
                    }
                    $postData['full_name'] = $_REQUEST['name'];
                    if (isset($_REQUEST['email']) && $_REQUEST['email'] != '') {
                        $postData['email'] = $_REQUEST['email'];

                        $bool = $TblUserObj->checkEmailExists($_REQUEST['email']);
                        if (!empty($bool)) {
                            $this->response(array("status" => $this->errorCode['_EMAIL_ALREADY_REGISTER_'], "message" => $this->msg['_EMAIL_ALREADY_REGISTER_'], 'data' => array()));
                        }
                    }
                    $postData['password'] = $_REQUEST['password'];
                    $postData['street'] = $_REQUEST['street'];
                    $postData['city'] = $_REQUEST['city'];
                    $postData['state'] = $_REQUEST['state'];
                    $postData['pincode'] = $_REQUEST['pincode'];
                    $postData['phone_number'] = $_REQUEST['mobile_number'];
                    $postData['employment_type'] = $_REQUEST['employment_type'];
                    $postData['annual_income'] = $_REQUEST['annual_income'];

                    $generalObj = new General();
                    $algoObj = new Algoencryption();
                    $everify_code = $generalObj->encrypt_password(rand(0, 99) . rand(0, 99) . rand(0, 99) . rand(0, 99));
                    if (isset($postData['password']) && $postData['password'] != '') {
                        $Password = $generalObj->encrypt_password($postData['password']);
                        $TblUserObj = new TblUser();
                        $new_password = $TblUserObj->genPassword();
                        $postData['password'] = $Password;
                    }
                    $postData['is_verified'] = $everify_code;
                    $postData['status'] = 1;
                    $postData['created_at'] = date("Y-m-d H:i:s");
                    $postData['modified_at'] = date("Y-m-d H:i:s");
                    $TblUserObj = new TblUser();
                    $TblUserObj->setData($postData);
                    $user_id = $TblUserObj->insertData();

                    if ($user_id != '') {
                        $user_Data = $TblUserObj->getUserdetailsbyId($user_id);
                        if (!empty($user_Data)) {
                            $transaction->commit();

                            $result['status'] = $this->errorCode['_SUCCESS_'];
                            $result['message'] = $this->msg['_SUCCESS_'];
                            $result['data'] = $user_Data;
                            $this->response($result);
                        } else {
                            $result['status'] = $this->errorCode['_DATA_NOT_FOUND_'];
                            $result['message'] = $this->msg['_DATA_NOT_FOUND_'];
                            $result['data'] = array();
                            $this->response($result);
                        }
                    }
                    else {
                        $result['status'] = $this->errorCode['_GETTING_ERROR_REGISTRATION_'];
                        $result['message'] = $this->msg['_GETTING_ERROR_REGISTRATION_'];
                        $result['data'] = array();
                        $this->response($result);
                    }

                }
                else
                {
                    $this->response(array("status" => $res['status'], "message" => $res['message'], 'data' => array()));

                }
            }
            catch (Exception $ex) {
                $transaction->rollback();
                //echo $ex->getMessage();
                if (strpos($ex->getMessage(), '1062') !== false) {
                    $result['status'] = -8;
                    $result['message'] = $this->msg['_EMAIL_ALREADY_REGISTER_'];
                    $result['data'] = (object) array();
                    $this->response($result);
                } else {
                    $result['status'] = $this->errorCode['_GETTING_ERROR_REGISTRATION_'];
                    $result['message'] = $this->msg['_GETTING_ERROR_REGISTRATION_'] . $ex->getMessage();
                    $this->response(array("status" =>  $result['status'] , "message" =>  $result['message'], 'data' => array()));
                }
            }
        } else {
            $this->response(array("status" => $this->errorCode['_PERMISSION_DENIED_'], "message" =>  $this->msg['_PERMISSION_DENIED_'], 'data' => array()));
        }
    }

    public function actionlogin()
    {   //echo "<pre>"; print_r($_REQUEST); die;
        if (!empty($_REQUEST)) {

            $validationObj = new Validation();
            $res = $validationObj->login($_REQUEST);

            $transaction = Yii::app()->db->beginTransaction();
            try{
                if ($res['status'] == 0) {
                    //$device_token = $_REQUEST['device_token'];
                    //$endpointArn['endpointArn'] = $_REQUEST['endpointArn'];

                    $TblUserObj = new TblUser();
                    $res = $TblUserObj->checkEmailExists($_REQUEST['email']);
                    if (!empty($res)) {

                        $generalObj = new General();
                        $isValid  = $generalObj->validate_password($_REQUEST['password'], $res['password']);

                        if($isValid == true){

                            if ($res['status'] != 1) {

                                $this->response(array("status" => $this->errorCode['_ACCOUNT_NOT_VERIFIED_'], "message" =>  $this->msg['_ACCOUNT_NOT_VERIFIED_']));

                            }else if ($res['status'] == 0)
                            {
                                $this->response(array("status" => $this->errorCode['_ACCOUNT_DEACTIVATE_'], "message" =>  $this->msg['_ACCOUNT_DEACTIVATE_'], 'data' => array()));
                            }

                            if(isset($_REQUEST['device_token']) && $_REQUEST['device_token']!=''){
                                $device_token = $_REQUEST['device_token'];
                            }
                            else{
                                $device_token = "";
                            }
                            if(isset($_REQUEST['endpointArn']) && $_REQUEST['endpointArn']!=''){
                                $endpointArn = $_REQUEST['endpointArn'];
                            }
                            else{
                                $endpointArn = "";
                            }

                            $TblUserObj = new TblUser();
                            $user_Data = $TblUserObj->getAdmindetailsbyId($res['user_id']);
                            $user_Data['sessionData'] = $this->createSession($res['user_id'],1,$device_token,$endpointArn);

                            $post_data = array();
                            if(isset($_REQUEST['app_version']) && $_REQUEST['app_version']!=''){
                                $post_data['app_version'] = $_REQUEST['app_version'];
                                $user_Data['app_version'] = $_REQUEST['app_version'];
                            }
                            if(isset($_REQUEST['device_type']) && $_REQUEST['device_type']!=''){
                                $post_data['device_type'] = $_REQUEST['device_type'];
                                $user_Data['device_type'] = $_REQUEST['device_type'];
                            }
                            if(isset($_REQUEST['device_model']) && $_REQUEST['device_model']!=''){
                                $post_data['device_model'] = $_REQUEST['device_model'];
                                $user_Data['device_model'] = $_REQUEST['device_model'];
                            }
                            if(isset($_REQUEST['device_os']) && $_REQUEST['device_os']!=''){
                                $post_data['device_os'] = $_REQUEST['device_os'];
                                $user_Data['device_os'] = $_REQUEST['device_os'];
                            }
                            $post_data['modified_at'] = date("Y-m-d H:i:s");

                            $TblUserObj = new TblUser();
                            $TblUserObj->setData($post_data);
                            $TblUserObj->insertData($res['user_id']);

                            $transaction->commit();

                            if (!empty($user_Data)) {
                                $this->response(array("status" => $this->errorCode['_SUCCESS_'], "message" =>  $this->msg['_SUCCESS_'], 'data' => $user_Data));
                            } else {
                                $this->response(array("status" => $this->errorCode['_DATA_NOT_FOUND_'], "message" =>  $this->msg['_DATA_NOT_FOUND_'], 'data' => array()));
                            }
                        }else{
                            $this->response(array("status" => $this->errorCode['_INVALID_PASSWORD_'], "message" =>  $this->msg['_INVALID_PASSWORD_'], 'data' => array()));
                        }
                    }else{
                        $this->response(array("status" => $this->errorCode['_INVALID_USERNAME_'], "message" =>  $this->msg['_INVALID_USERNAME_'], 'data' => array()));
                    }
                } else {
                    $this->response(array('status' => $res['status'], 'message' => $res['message'], 'data' => array()));
                }
            }catch (Exception $e)
            {
                $transaction->rollback();
                $data = array();
                $data['status'] = -111;
                $data['message'] = $e->getMessage();
                $data['data'] = array();
                $this->response($data);
            }
        } else {
            $this->response(array("status" => $this->errorCode['_PERMISSION_DENIED_'], "message" =>  $this->msg['_PERMISSION_DENIED_'], 'data' => array()));
        }
    }

    function actionforgotPassword()
    {   //print_r($_REQUEST); die;
        if (!empty($_REQUEST))
        {
            $validationObj = new Validation();
            $res = $validationObj->forgotpassword($_REQUEST);

            if ($res['status'] == 0) {
                $TblUserObj = new TblUser();
                $data = $TblUserObj->checkEmailExists($_REQUEST['email']);
                //print_r($data); die;
                if (!empty($data)) {

                    if ($data['status'] == 1) {
                        $abc = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
                            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
                            "0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
                        $fPassword = $abc[rand(0, 61)] . $abc[rand(0, 61)] . $abc[rand(0, 61)] . $abc[rand(0, 61)] . $abc[rand(0, 61)];

                        $user['fConfirmPasscode'] = $fPassword;
                        //print_r($user); die;
                        $TblUserObj = new TblUser();
                        $TblUserObj->setData($user);
                        $TblUserObj->insertData($data['user_id']);

                        $data = $TblUserObj->checkEmailExists($_REQUEST['email']);
                        $Yii = Yii::app();
                        $emailLink = $Yii->params->base_path . "api/resetPassword/fConfirmPasscode/" . $fPassword ."/user_id/".$data['user_id'];
                        //print_r($emailLink); die;
                        //echo Yii::app()->session['prefferd_language']; die;
                        /* -------------------------------------------------send email---------------------------- */
                        try {
                            $email = $_REQUEST['email'];
                            $user_name = $data['full_name'];
                            $subject = "My mudra forgot password link";
                            $message = file_get_contents(Yii::app()->params->base_path.'templatemaster/SetTemplate/lng/'.Yii::app()->session['prefferd_language'].'/file/forgot-password-api');

                            $message = str_replace("_TMP_USER_HELLO_",$user_name,$message);
                            $message = str_replace("_TMP_USER_CONFIRM_LINK_",$emailLink,$message);
                            $message = str_replace("_LOGOBASEPATH_",BASE_PATH,$message);
                            $message = str_replace("_PASSWORD_CODE_", $fPassword, $message);
                            $message = str_replace("_CONTROLLER_", 'api', $message);
                            //print_r($message);die;
                            //echo $message;die;
                            $send_email = $this->emailSend($message,$email,$subject);
                            //print_r($send_email);die;

                            /* ---------------------------------------------email finish------------------------------------------------ */
                            if (!empty($send_email)) {
                                //echo "if"; die;
                                $this->response(array("status" => $this->errorCode['_SUCCESS_'], "message" => $this->msg['_SUCCESS_'], 'data' => $data));

                            } else { //echo "else"; die;
                                $this->response(array("status" => $this->errorCode['_MAIL_SEND_FAIL_'], "message" =>  $this->msg['_MAIL_SEND_FAIL_'], 'data' => $data));
                            }
                        } catch (Exception $e) {
                            //echo "exception"; die;
                            $this->response(array("status" => $this->errorCode['_MAIL_SEND_FAIL_'], "message" =>  $this->msg['_MAIL_SEND_FAIL_'], 'data' => (object) array()));
                        }
                    } else {
                        $this->response(array("status" => $this->errorCode['_ACCOUNT_DEACTIVATE_'], "message" =>  $this->msg['_ACCOUNT_DEACTIVATE_'], 'data' => (object) array()));
                    }
                } else {
                    $this->response(array("status" => $this->errorCode['_USER_NOT_EXIST_'], "message" =>  $this->msg['_USER_NOT_EXIST_'], 'data' => (object) array()));
                }
            } else {
                $this->response(array('status' => $res['status'], 'message' => $res['message']));
            }
        } else {
            $this->response(array("status" => $this->errorCode['_PERMISSION_DENIED_'], "message" =>  $this->msg['_PERMISSION_DENIED_'], 'data' => (object) array()));
        }
    }

    /*reset password api*/
    public function actionresetPassword()
    {
        try {
            if (isset($_REQUEST['fConfirmPasscode'])) {
                if(isset($_REQUEST['user_id'])) {
                    $TblUserObj = new TblUser();
                    $User_Data = $result = $TblUserObj->getUserDetailsById($_REQUEST['user_id']);

                    if(!empty($User_Data))
                    {
                        if($User_Data['fConfirmPasscode'] == $_REQUEST['fConfirmPasscode'])
                        {
                            $data['token'] = trim($_REQUEST['fConfirmPasscode']);
                            $this->render('set_new_password', $data);
                            exit;
                        }
                        else
                        {
                            Yii::app()->user->setFlash('error',"This link is expired.");
                            $this->render("error");
                            exit;
                        }
                    }
                }
                else
                {
                    $message = 'User details not found';
                    Yii::app()->user->setFlash("success", $message);
                }

                $this->render('set_new_password');
            }
        }catch (Exception $e)
        {
            $data = array();
            $data['status'] = -111;
            $data['message'] = $e->getMessage();
            $data['data'] = array();
            $this->response($data);
        }
    }

    public function actionsaveResetPassword()
    {
        if (isset($_POST['submit_reset_password_btn']) && trim($_POST['token']) != "")
        {
            $TblUserObj = new TblUser();
            $result = $TblUserObj->resetpassword($_POST);
            $message = $result[0];

            if ($result[1] == 'Success') {
                Yii::app()->user->setFlash("success", $message);
                $this->redirect(array("api/resetPasswordSuccess"));
                exit;
            } else {
                Yii::app()->user->setFlash("error", $message);
                $this->redirect(array("api/resetPassword"));
                //header("Location: " . Yii::app()->params->base_path . 'api/resetpassword/');
                exit;
            }
        } else {
            $this->redirect(array("api/resetPassword"));
            exit;
        }
    }

    function actionresetPasswordSuccess()
    {
        $this->render('success');
    }
    /*logout api*/
    public function actionlogout()
    {
        if (!empty($_REQUEST) && isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != '' && isset($_REQUEST['session_code']) && $_REQUEST['session_code'] != '')
        {
            $TblUserSessionObj = new TblUsersession();
            $user = $TblUserSessionObj->checksession($_REQUEST['user_id'], $_REQUEST['session_code'], 1);
            //print_r($user);die;
            if (!empty($user)){
                $transaction = Yii::app()->db->beginTransaction();
                try{
                    $this->deletesession($_REQUEST['user_id'],1);

                    $transaction->commit();
                    $data = array();
                    $data['status'] = $this->errorCode['_SUCCESS_'];
                    $data['message'] = $this->msg['_SUCCESS_'];
                    $data['data'] = array();
                    $this->response($data);

                }catch(Exception $e)
                {
                    $transaction->rollback();
                    $data = array();
                    $data['status'] = -111;
                    $data['message'] = $e->getMessage();
                    $data['data'] = array();
                    $this->response($data);
                }
            }else{
                $this->response(array("status" => $this->errorCode['_USER_NOT_EXIST_'], "message" => $this->msg['_USER_NOT_EXIST_'], 'data' => array()));
            }
        }else{
            $this->response(array("status" => $this->errorCode['_PERMISSION_DENIED_'], "message" => $this->msg['_PERMISSION_DENIED_'], 'data' => array()));
        }
    }



    /*save user for particular bank loan type user reference*/
    public function actionbankLoanUserReference()
    {   //echo "<pre>"; print_r($_REQUEST); die;
        if (isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='' && isset($_REQUEST['session_code']) && $_REQUEST['session_code']!='' && isset($_REQUEST['loan_type_id']) && $_REQUEST['loan_type_id']!='') {

            $postData = array();
            $transaction = Yii::app()->db->beginTransaction();
            try {

                $validationObj = new Validation();
                $res = $validationObj->userReferenceSignUp($_REQUEST);

                if ($res['status'] == 0)
                {
                    $postData['full_name'] = $_REQUEST['name'];
                    if (isset($_REQUEST['email']) && $_REQUEST['email'] != '') {
                        $postData['email'] = $_REQUEST['email'];

                    }
                    //$postData['password'] = $_REQUEST['password'];
                    $postData['street'] = $_REQUEST['street'];
                    $postData['city'] = $_REQUEST['city'];
                    $postData['state'] = $_REQUEST['state'];
                    $postData['pincode'] = $_REQUEST['pincode'];
                    $postData['phone_number'] = $_REQUEST['mobile_number'];
                    $postData['employment_type'] = $_REQUEST['employment_type'];
                    $postData['annual_income'] = $_REQUEST['annual_income'];
                    $postData['user_id'] = $_REQUEST['user_id'];

                    $postData['status'] = 1;
                    $postData['created_at'] = date("Y-m-d H:i:s");
                    //$postData['modified_at'] = date("Y-m-d H:i:s");
                    //echo "<pre>"; print_r($postData); die;
                    $TblUserRefObj = new TblUserRefrence();
                    $TblUserRefObj->setData($postData);
                    $user_ref_id = $TblUserRefObj->insertData();

                    //echo "<pre>"; print_r($user_ref_id); die;
                    $loanData = array();
                    if(isset($_REQUEST['bank_id']) && $_REQUEST['bank_id']!='')
                    {
                        $loanData['bank_id'] = $_REQUEST['bank_id'];
                    }
                    $loanData['loan_type'] = $_REQUEST['loan_type_id'];
                    if(isset($_REQUEST['loan_amount']) && $_REQUEST['loan_amount']!='')
                    {
                        $loanData['loan_amount'] = $_REQUEST['loan_amount'];
                    }
                    if(isset($_REQUEST['description']) && $_REQUEST['description'])
                    {
                        $loanData['description'] = $_REQUEST['description'];
                    }
                    $loanData['user_ref_id'] = $user_ref_id;
                    $loanData['load_transaction_date'] = date("Y-m-d H:i:s");
                    $loanData['status'] = 1;
                    $loanData['created_at'] = date("Y-m-d H:i:s");

                    $TblLoanTransactionObj = new TblLoanTransaction();
                    $TblLoanTransactionObj->setData($loanData);
                    $loan_id = $TblLoanTransactionObj->insertData();
                    //echo "<pre>"; print_r($loan_id); die;

                    $transaction->commit();
                    if ($user_ref_id != '') {
                        $user_Data = $TblUserRefObj->getUserdetailsbyId($user_ref_id);
                        if (!empty($user_Data)) {


                            $result['status'] = $this->errorCode['_SUCCESS_'];
                            $result['message'] = $this->msg['_SUCCESS_'];
                            $result['data'] = $user_Data;
                            $this->response($result);
                        } else {
                            $result['status'] = $this->errorCode['_DATA_NOT_FOUND_'];
                            $result['message'] = $this->msg['_DATA_NOT_FOUND_'];
                            $result['data'] = array();
                            $this->response($result);
                        }
                    }
                    else {
                        $result['status'] = $this->errorCode['_GETTING_ERROR_REGISTRATION_'];
                        $result['message'] = $this->msg['_GETTING_ERROR_REGISTRATION_'];
                        $result['data'] = array();
                        $this->response($result);
                    }

                }
                else
                {
                    $this->response(array("status" => $res['status'], "message" => $res['message'], 'data' => array()));

                }
            }
            catch (Exception $ex) {
                $transaction->rollback();
                //echo $ex->getMessage();
                if (strpos($ex->getMessage(), '1062') !== false) {
                    $result['status'] = -8;
                    $result['message'] = $this->msg['_EMAIL_ALREADY_REGISTER_'];
                    $result['data'] = (object) array();
                    $this->response($result);
                } else {
                    $result['status'] = $this->errorCode['_GETTING_ERROR_REGISTRATION_'];
                    $result['message'] = $this->msg['_GETTING_ERROR_REGISTRATION_'] . $ex->getMessage();
                    $this->response(array("status" =>  $result['status'] , "message" =>  $result['message'], 'data' => array()));
                }
            }
        } else {
            $this->response(array("status" => $this->errorCode['_PERMISSION_DENIED_'], "message" =>  $this->msg['_PERMISSION_DENIED_'], 'data' => array()));
        }
    }

    /*save user for particular investment loan type user reference*/

    public function actioninvAdvisoryUserReference()
    {
        if (isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='' && isset($_REQUEST['session_code']) && $_REQUEST['session_code']!='' && isset($_REQUEST['inv_type_id']) && $_REQUEST['inv_type_id']!='') {

            $postData = array();
            $transaction = Yii::app()->db->beginTransaction();
            try {

                $validationObj = new Validation();
                $res = $validationObj->invUserReferenceSignUp($_REQUEST);

                if ($res['status'] == 0)
                {
                    $postData['full_name'] = $_REQUEST['name'];
                    if (isset($_REQUEST['email']) && $_REQUEST['email'] != '') {
                        $postData['email'] = $_REQUEST['email'];
                    }
                    //$postData['password'] = $_REQUEST['password'];
                    $postData['street'] = $_REQUEST['street'];
                    $postData['city'] = $_REQUEST['city'];
                    $postData['state'] = $_REQUEST['state'];
                    $postData['pincode'] = $_REQUEST['pincode'];
                    $postData['phone_number'] = $_REQUEST['mobile_number'];
                    $postData['employment_type'] = $_REQUEST['employment_type'];
                    $postData['annual_income'] = $_REQUEST['annual_income'];
                    $postData['user_id'] = $_REQUEST['user_id'];

                    $postData['status'] = 1;
                    $postData['created_at'] = date("Y-m-d H:i:s");
                    $postData['modified_at'] = date("Y-m-d H:i:s");

                    $TblUserRefObj = new TblUserRefrence();
                    $TblUserRefObj->setData($postData);
                    $user_ref_id = $TblUserRefObj->insertData();
                    //echo "<pre>"; print_r($user_ref_id); die;

                    $loanData = array();
                    if(isset($_REQUEST['inv_type_id']) && $_REQUEST['inv_type_id']!='')
                    {
                        $loanData['inv_type'] = $_REQUEST['inv_type_id'];
                    }

                    if(isset($_REQUEST['inv_amount']) && $_REQUEST['inv_amount']!='')
                    {
                        $loanData['inv_amount'] = $_REQUEST['inv_amount'];
                    }

                    if(isset($_REQUEST['description']) && $_REQUEST['description']!='')
                    {
                        $loanData['description'] = $_REQUEST['description'];
                    }
                    $loanData['user_ref_id'] = $user_ref_id;
                    $loanData['inv_transaction_date'] = date("Y-m-d H:i:s");
                    $loanData['status'] = 1;
                    $loanData['created_at'] = date("Y-m-d H:i:s");
                    //echo "<pre>"; print_r($loanData); die;
                    $TblInvTransactionObj = new TblInvestmentTransaction();
                    $TblInvTransactionObj->setData($loanData);
                    $loan_id = $TblInvTransactionObj->insertData();

                    $transaction->commit();

                    if ($user_ref_id != '') {
                        $user_Data = $TblUserRefObj->getUserdetailsbyId($user_ref_id);
                        if (!empty($user_Data)) {
                            $result['status'] = $this->errorCode['_SUCCESS_'];
                            $result['message'] = $this->msg['_SUCCESS_'];
                            $result['data'] = $user_Data;
                            $this->response($result);
                        } else {
                            $result['status'] = $this->errorCode['_DATA_NOT_FOUND_'];
                            $result['message'] = $this->msg['_DATA_NOT_FOUND_'];
                            $result['data'] = array();
                            $this->response($result);
                        }
                    }
                    else {
                        $result['status'] = $this->errorCode['_GETTING_ERROR_REGISTRATION_'];
                        $result['message'] = $this->msg['_GETTING_ERROR_REGISTRATION_'];
                        $result['data'] = array();
                        $this->response($result);
                    }

                }
                else
                {
                    $this->response(array("status" => $res['status'], "message" => $res['message'], 'data' => array()));

                }
            }
            catch (Exception $ex) {
                $transaction->rollback();
                //echo $ex->getMessage();
                if (strpos($ex->getMessage(), '1062') !== false) {
                    $result['status'] = -8;
                    $result['message'] = $this->msg['_EMAIL_ALREADY_REGISTER_'];
                    $result['data'] = (object) array();
                    $this->response($result);
                } else {
                    $result['status'] = $this->errorCode['_GETTING_ERROR_REGISTRATION_'];
                    $result['message'] = $this->msg['_GETTING_ERROR_REGISTRATION_'] . $ex->getMessage();
                    $this->response(array("status" =>  $result['status'] , "message" =>  $result['message'], 'data' => array()));
                }
            }
        } else {
            $this->response(array("status" => $this->errorCode['_PERMISSION_DENIED_'], "message" =>  $this->msg['_PERMISSION_DENIED_'], 'data' => array()));
        }
    }

    /*save user for particular property loan type user reference*/
    public function actionpropertyUserReference()
    {
        if (isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='' && isset($_REQUEST['session_code']) && $_REQUEST['session_code']!='' && isset($_REQUEST['property_type_id']) && $_REQUEST['property_type_id']!='') {

            $postData = array();
            $transaction = Yii::app()->db->beginTransaction();
            try {

                $validationObj = new Validation();
                $res = $validationObj->propertyUserReference($_REQUEST);

                if ($res['status'] == 0)
                {
                    $postData['full_name'] = $_REQUEST['name'];
                    if (isset($_REQUEST['email']) && $_REQUEST['email'] != '') {
                        $postData['email'] = $_REQUEST['email'];
                    }

                    $postData['street'] = $_REQUEST['street'];
                    $postData['city'] = $_REQUEST['city'];
                    $postData['state'] = $_REQUEST['state'];
                    $postData['pincode'] = $_REQUEST['pincode'];
                    $postData['phone_number'] = $_REQUEST['mobile_number'];
                    $postData['employment_type'] = $_REQUEST['employment_type'];
                    $postData['annual_income'] = $_REQUEST['annual_income'];
                    $postData['user_id'] = $_REQUEST['user_id'];

                    $postData['status'] = 1;
                    $postData['created_at'] = date("Y-m-d H:i:s");
                    $postData['modified_at'] = date("Y-m-d H:i:s");

                    $TblUserRefObj = new TblUserRefrence();
                    $TblUserRefObj->setData($postData);
                    $user_ref_id = $TblUserRefObj->insertData();

                    $loanData = array();
                    if(isset($_REQUEST['property_type_id']) && $_REQUEST['property_type_id']!='')
                    {
                        $loanData['property_transaction_type'] = $_REQUEST['property_type_id'];
                    }

                    if(isset($_REQUEST['size']) && $_REQUEST['size']!='')
                    {
                        $loanData['property_size'] = $_REQUEST['size'];
                    }

                    if(isset($_REQUEST['size_type']) && $_REQUEST['size_type']!='')
                    {
                        $loanData['property_size_type'] = $_REQUEST['size_type'];
                    }

                    if(isset($_REQUEST['property_type']) && $_REQUEST['property_type']!='')
                    {
                        $loanData['property_type'] = $_REQUEST['property_type'];
                    }

                    if(isset($_REQUEST['description']) && $_REQUEST['description'])
                    {
                        $loanData['description'] = $_REQUEST['description'];
                    }
                    $loanData['user_ref_id'] = $user_ref_id;
                    $loanData['property_transaction_date'] = date("Y-m-d H:i:s");
                    $loanData['status'] = 1;
                    $loanData['created_at'] = date("Y-m-d H:i:s");

                    $TblPropertyTransactionObj = new TblPropertyTransaction();
                    $TblPropertyTransactionObj->setData($loanData);
                    $loan_id = $TblPropertyTransactionObj->insertData();

                    $transaction->commit();

                    if ($user_ref_id != '') {
                        $user_Data = $TblUserRefObj->getUserdetailsbyId($user_ref_id);
                        if (!empty($user_Data)) {

                            $result['status'] = $this->errorCode['_SUCCESS_'];
                            $result['message'] = $this->msg['_SUCCESS_'];
                            $result['data'] = $user_Data;
                            $this->response($result);
                        } else {
                            $result['status'] = $this->errorCode['_DATA_NOT_FOUND_'];
                            $result['message'] = $this->msg['_DATA_NOT_FOUND_'];
                            $result['data'] = array();
                            $this->response($result);
                        }
                    }
                    else {
                        $result['status'] = $this->errorCode['_GETTING_ERROR_REGISTRATION_'];
                        $result['message'] = $this->msg['_GETTING_ERROR_REGISTRATION_'];
                        $result['data'] = array();
                        $this->response($result);
                    }
                }
                else
                {
                    $this->response(array("status" => $res['status'], "message" => $res['message'], 'data' => array()));

                }
            }
            catch (Exception $ex) {
                $transaction->rollback();
                //echo $ex->getMessage();
                if (strpos($ex->getMessage(), '1062') !== false) {
                    $result['status'] = -8;
                    $result['message'] = $this->msg['_EMAIL_ALREADY_REGISTER_'];
                    $result['data'] = (object) array();
                    $this->response($result);
                } else {
                    $result['status'] = $this->errorCode['_GETTING_ERROR_REGISTRATION_'];
                    $result['message'] = $this->msg['_GETTING_ERROR_REGISTRATION_'] . $ex->getMessage();
                    $this->response(array("status" =>  $result['status'] , "message" =>  $result['message'], 'data' => array()));
                }
            }
        } else {
            $this->response(array("status" => $this->errorCode['_PERMISSION_DENIED_'], "message" =>  $this->msg['_PERMISSION_DENIED_'], 'data' => array()));
        }
    }

    /*bank list for drop down*/
    public function actionbankList()
    {
        if (isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='' && isset($_REQUEST['session_code']) && $_REQUEST['session_code']!='')
        {
            $TblUserSessionObj = new TblUsersession();
            $user = $TblUserSessionObj->checksession($_REQUEST['user_id'], $_REQUEST['session_code'], 1);

            if(!empty($user))
            {
                $transaction = Yii::app()->db->beginTransaction();

                try {
                    $user_id = $_REQUEST['user_id'];

                    $tblBankObj = new TblBankMaster();
                    $bank_list = $tblBankObj->getAllBankList();

                    if (!empty($bank_list)) {
                        $bankArr = array();
                        $i = 0;
                        foreach ($bank_list as $bank) {
                            $bankArr[$i] = $bank;
                            $i++;
                        }

                        //print_r($projectArr); die;
                        $transaction->commit();
                        $data = array();
                        $data['status'] = $this->errorCode['_SUCCESS_'];
                        $data['message'] = $this->msg['_SUCCESS_'];
                        $data['data'] = $bankArr;
                        $this->response($data);
                    } else {
                        $this->response(array("status" => $this->errorCode['_DATA_NOT_FOUND_'], "message" => $this->msg['_DATA_NOT_FOUND_'], 'data' => array()));
                    }

                }
                catch (Exception $e) {
                    $transaction->rollback();
                    $data = array();
                    $data['status'] = -111;
                    $data['message'] = $e->getMessage();
                    $data['data'] = array();
                    $this->response($data);
                }

            }

        }
    }

    /*bank loan registered user listing*/
    public function actionregisteredUserListForBankLoan()
    {
        if (isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='' && isset($_REQUEST['session_code']) && $_REQUEST['session_code']!='')
        {
            $TblUserSessionObj = new TblUsersession();
            $user = $TblUserSessionObj->checksession($_REQUEST['user_id'], $_REQUEST['session_code'], 1);

            if(!empty($user))
            {
                $transaction = Yii::app()->db->beginTransaction();

                try {
                    $user_id = $_REQUEST['user_id'];

                    $tblUserObj = new TblUser();
                    $bankLoanUserData = $tblUserObj->getRegisteredUserForBankLoanListById($user_id);

                    //echo "<pre>"; print_r($bankLoanUserData); die;
                    if (!empty($bankLoanUserData)) {
                        $bankArr = array();
                        $i = 0;
                        foreach ($bankLoanUserData as $bankUser) {
                            $bankArr[$i] = $bankUser;
                            $i++;
                        }

                        //print_r($projectArr); die;
                        $transaction->commit();
                        $data = array();
                        $data['status'] = $this->errorCode['_SUCCESS_'];
                        $data['message'] = $this->msg['_SUCCESS_'];
                        $data['data'] = $bankArr;
                        $this->response($data);
                    } else {
                        $this->response(array("status" => $this->errorCode['_DATA_NOT_FOUND_'], "message" => $this->msg['_DATA_NOT_FOUND_'], 'data' => array()));
                    }

                }
                catch (Exception $e) {
                    $transaction->rollback();
                    $data = array();
                    $data['status'] = -111;
                    $data['message'] = $e->getMessage();
                    $data['data'] = array();
                    $this->response($data);
                }

            }

        }
    }

    /*registered user listing for investment loan*/
    public function actionregisteredUserListForInvestmentLoan()
    {
        if (isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='' && isset($_REQUEST['session_code']) && $_REQUEST['session_code']!='')
        {
            $TblUserSessionObj = new TblUsersession();
            $user = $TblUserSessionObj->checksession($_REQUEST['user_id'], $_REQUEST['session_code'], 1);

            if(!empty($user))
            {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $user_id = $_REQUEST['user_id'];

                    $tblUserObj = new TblUser();
                    $invLoanUserData = $tblUserObj->getRegisteredUserForInvLoanListById($user_id);

                    //echo "<pre>"; print_r($bankLoanUserData); die;
                    if (!empty($invLoanUserData)) {
                        $invArr = array();
                        $i = 0;
                        foreach ($invLoanUserData as $invUser) {
                            $invArr[$i] = $invUser;
                            $i++;
                        }

                        //print_r($projectArr); die;
                        $transaction->commit();
                        $data = array();
                        $data['status'] = $this->errorCode['_SUCCESS_'];
                        $data['message'] = $this->msg['_SUCCESS_'];
                        $data['data'] = $invArr;
                        $this->response($data);
                    } else {
                        $this->response(array("status" => $this->errorCode['_DATA_NOT_FOUND_'], "message" => $this->msg['_DATA_NOT_FOUND_'], 'data' => array()));
                    }
                }
                catch (Exception $e) {
                    $transaction->rollback();
                    $data = array();
                    $data['status'] = -111;
                    $data['message'] = $e->getMessage();
                    $data['data'] = array();
                    $this->response($data);
                }

            }

        }
    }

    /*registered user listing for property loan*/
    public function actionregisteredUserListForPropertyLoan()
    {
        if (isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='' && isset($_REQUEST['session_code']) && $_REQUEST['session_code']!='')
        {
            $TblUserSessionObj = new TblUsersession();
            $user = $TblUserSessionObj->checksession($_REQUEST['user_id'], $_REQUEST['session_code'], 1);

            if(!empty($user))
            {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $user_id = $_REQUEST['user_id'];

                    $tblUserObj = new TblUser();
                    $propLoanUserData = $tblUserObj->getRegisteredUserForPropLoanListById($user_id);

                    //echo "<pre>"; print_r($bankLoanUserData); die;
                    if (!empty($propLoanUserData)) {
                        $propArr = array();
                        $i = 0;
                        foreach ($propLoanUserData as $propUser) {
                            $propArr[$i] = $propUser;
                            $i++;
                        }

                        //print_r($projectArr); die;
                        $transaction->commit();
                        $data = array();
                        $data['status'] = $this->errorCode['_SUCCESS_'];
                        $data['message'] = $this->msg['_SUCCESS_'];
                        $data['data'] = $propArr;
                        $this->response($data);
                    } else {
                        $this->response(array("status" => $this->errorCode['_DATA_NOT_FOUND_'], "message" => $this->msg['_DATA_NOT_FOUND_'], 'data' => array()));
                    }
                }
                catch (Exception $e) {
                    $transaction->rollback();
                    $data = array();
                    $data['status'] = -111;
                    $data['message'] = $e->getMessage();
                    $data['data'] = array();
                    $this->response($data);
                }

            }

        }
    }
}
