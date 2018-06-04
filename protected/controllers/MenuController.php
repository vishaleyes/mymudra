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

class MenuController extends Controller {

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

       //die('test');

        $this->layout='column8';

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
            $fp = fopen(_SITENAME_ . '_Partner.txt', 'a+');
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
      //  print_r($_SERVER['REQUEST_METHOD']);die;

    }

    public function actionpossibleErrors() {
        $this->render('possibleErrorsList');
    }

    public function actionlist() {

        echo "list" ;print_r($_GET);
        //$this->renderPartial('apilist');
        //$this->redirect(array("admin/index"));
    }

    public function actionUpdate() {

        echo "wrwwere";
        $method = $_SERVER['REQUEST_METHOD'];
        if ('PUT' === $method) {

            parse_str(file_get_contents('php://input'), $_PUT);
            var_dump($_PUT); //$_PUT contains put fields
        }
        //print_r($_POST);
    }
    public function actionDelete() {


        print_r($_GET);
    }

    function actionshowLogs() {
        $handle = @fopen(_SITENAME_ . '_Partner.txt', "r");
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
        $handle = fopen(_SITENAME_ . '_Partner.txt', "w");
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
        $sessionData['endpoint_arn'] = $endpoint_arn;
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

    /*
         Function : deleteSession
         Description : Create function for delete session.
         Developed By : vyoma Panchal
         Date:- 01-APR-2016
        */

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

    /*Function : emailSend
     Description :send the email
     Developed By : Priyank Patel
     Date:- 22-Aug-2017
    */
    function emailSend($message=NULL,$email=NULL,$subject=NULL)
    {
        $mail = new PHPMailer;
        $mail->Host = MANDRILL_HOST;      // Specify main and backup server
        $mail->Port = MANDRILL_PORT;      // Set the SMTP port
        $mail->SMTPAuth = true;
        $mail->isSMTP();          // Enable SMTP authentication
        $mail->Username = MANDRILL_USERNAME; // SMTP username
        $mail->Password = MANDRILL_PASSWORD; // SMTP password
        //$mail->SMTPDebug  = 4;
        $mail->SMTPSecure = MANDRILL_SMTPSECURE;
        $mail->SetFrom('no-reply@viia.com', 'viia');
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        //$address = RIDE_APPROVAL_ADMIN;
        $mail->AddAddress($email);
        $result = $mail->Send();
        return $result;
    }

    /*=============================  User  Defined Function End===============================*/
}
