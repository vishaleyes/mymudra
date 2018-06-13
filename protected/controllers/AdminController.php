<?php
error_reporting(E_ALL);

date_default_timezone_set("Asia/Kolkata");
//require_once(FILE_PATH."/protected/extensions/mpdf/mpdf.php");
require_once ("protected/extensions/Classes/PHPExcel.php");
require_once("protected/extensions/phpmailer/autoload.php");
require_once('aws.phar');
require_once('aws/vendor/autoload.php');
require_once('sns.class.php');
require('protected/extensions/unifonic/Unifonic/Autoload.php');

use \Unifonic\API\Client;

use Aws\Sns\SnsClient;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class AdminController extends Controller {

    public $algo;
    public $adminmsg;
	public $errorCode;
    private $msg;

    public function actions()
    {
            return array(
                    // captcha action renders the CAPTCHA image displayed on the contact page
                    'captcha'=>array(
                            'class'=>'CCaptchaAction',
                            'backColor'=>0xFFFFFF,
                    ),
                    'page'=>array(
                            'class'=>'CViewAction',
                    ),
            );
    }

    public function beforeAction($action=NULL)
    {
          /*  $this->msg = Yii::app()->params->adminmsg;
            $this->errorCode = Yii::app()->params->errorCode;*/
        if (isset(Yii::app()->session[_SITENAME_.'_admin'])) {
            $this->layout = "main";
        } else {
            $this->layout = "main-login";
        }
        $this->msg = Yii::app()->params->msg;
        $this->errorCode = Yii::app()->params->errorCode;
        return true;

    }

	
	/* =============== Content Of Check Login Session =============== */

    function isLogin() {
        if (isset(Yii::app()->session[_SITENAME_.'_admin'])) {
            return true;
        } else {
            /*Yii::app()->user->setFlash("error", "Username or password required");
            //Yii::app()->session->destroy();
			$this->redirect(array("admin/Login"));
            exit;*/

            Yii::app()->user->setFlash("error", "Username or password required");
            //Yii::app()->session->destroy();
            if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            {
                //$this->renderPartial("projectListingAjax", array('data'=>$data,'ext'=>$ext));
                $url =  Yii::app()->params->base_path."admin/Login";

                echo "<script>history.pushState(null, null, '<?php echo $url;?>');location.reload();</script>";
            }
            else
            {
                $this->redirect(array("admin/Login"));
            }
            exit;

        }
    }

    function actionindex() 
	{
	    //$this->render("index");
		if(isset(Yii::app()->session[_SITENAME_.'_admin'])){
			$this->redirect(array("admin/dashboard"));
		} else {
			$this->redirect(array("admin/adminLogin"));
		}
    }
	
	function actionLogin()
	{
	    //$this->isLogin();
        $data = array();
        $data['id'] = 1;
		$this->render("index", array("data"=>$data));
	}

    function actionsignUp()
    {
        //$this->checkIsLogin();
        Yii::app()->session['current'] = 'signup';
        //$this->render("signUp");
        $this->render("registration");
    }
	
	function array_sort($array, $on, $order=SORT_ASC)
	{
	    $new_array = array();
            $sortable_array = array();

            if (count($array) > 0) {
                    foreach ($array as $k => $v) {
                        if (is_array($v)) {
                                foreach ($v as $k2 => $v2) {
                                    if ($k2 == $on) {
                                            $sortable_array[$k] = $v2;
                                    }
                                }
                        } else {
                                $sortable_array[$k] = $v;
                        }
                    }
            switch ($order) {
                case SORT_ASC:
                        asort($sortable_array);
                break;
                case SORT_DESC:
                        arsort($sortable_array);
                break;
                    }

                    foreach ($sortable_array as $k => $v) {
                            $new_array[$k] = $array[$k];
                    }
            }
            return $new_array;
	}
	
	function actionPrefferedLanguage($lang='eng')
	{
		if(isset(Yii::app()->session['admin']) && Yii::app()->session['admin']>0)
		{
			//$userObj=new User();
			//$userObj->setPrefferedLanguage(Yii::app()->session['userId'],$lang);
		}
		
		Yii::app()->session['prefferd_language']=$lang;
	
		$this->redirect(Yii::app()->params->base_path."admin/index");
	}

    function response($response = NULL) {
        // $this->endTimeCalculate($response);
        echo json_encode($response);
        die;
    }

    function file_contents_exist($url, $response_code = 200)
    {
        $headers = get_headers($url);

        if(substr($headers[0], 9, 3) == $response_code)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


	
	public function actionerror()
    {
        $this->render("error");
    }

    function actionadminLogin()
    {
        if(isset(Yii::app()->session[_SITENAME_.'_admin'])) {
            $this->redirect(array("admin/dashboard"));
        }
        //echo "<pre>"; print_r($_POST); die;
        if (isset($_POST['loginBtn']))
        {
            $time = time();

            if(isset($_POST['remember']) && $_POST['remember'] == 1)
            {
                setcookie("email", $_POST['email'], $time + 3600);
                setcookie("password", $_POST['password'], $time + 3600);
            }else{
                setcookie("email", "", $time + 3600);
                setcookie("password", "", $time + 3600);
            }

            if(isset($_POST['email']))
            {
                $email = $_POST['email'];
                $pwd = $_POST['password'];

                $TblUserObj	= new TblUser();
                $admin_data	= $TblUserObj->getadminDetailsByEmail($email);
            }

            if(isset($admin_data['status']) && $admin_data['status'] == 0)
            {
                Yii::app()->user->setFlash("error","Your account is in-active. Kindly contact administrator.");
                $this->redirect(array('admin/index'));
                exit;
            }

            $generalObj	=	new General();
            $isValid	=	$generalObj->validate_password($_POST['password'], $admin_data['password']);
            if($isValid === true)
            {
                Yii::app()->session[_SITENAME_.'_admin'] = $admin_data['user_id'];
                Yii::app()->session[_SITENAME_.'_email'] = $admin_data['email'];
                Yii::app()->session[_SITENAME_.'full_name'] = $admin_data['full_name'];
                //Yii::app()->session[_SITENAME_.'_avatar'] = $admin_data['avatar'];

                Yii::app()->session['active_tab'] = 'dashboard';
                $this->redirect(array("admin/dashboard"));
                exit;
            }
            else
            {
                Yii::app()->user->setFlash("error","Email or Password is not valid");
                $this->redirect(array('admin/index'));
                exit;
            }
        }
        else
        {
            $this->render("index");
        }

    }

    /*
    * Function Name : actionLogout
    * Description : For logout of Admin
    * Developer : Rohankumar Varma
    * Changed Date : 29-08-2017
    */
    function actionLogout()
    {   //echo "<pre>"; print_r($_REQUEST); die;
        unset(Yii::app()->session[_SITENAME_.'_admin']);
        //unset(Yii::app()->session[_SITENAME_.'_email']);
        unset(Yii::app()->session[_SITENAME_.'_name']);
        //unset(Yii::app()->session[_SITENAME_.'_avatar']);
        //unset(Yii::app()->session['itemData']);
        unset(Yii::app()->session['menu']);
        //unset(Yii::app()->session[_SITENAME_.'_role']);

        //session_destroy();
        $this->redirect(array("admin/index"));
    }

    /*
    * Function Name : actiondashboard
    * Description : For render to Dashboard page
    * Developer : Rohankumar Varma
    * Changed Date : 29-08-2017
    */
    function actiondashboard()
    {
        $this->isLogin();
        Yii::app()->session['current']	=  'Dashboard';
        Yii::app()->session['breadcums']	=  'Dashboard';

        //$this->render("dashboard",array('data'=>array()));

        $data = array();

        if(isset($_REQUEST['fromDate']) && $_REQUEST['fromDate'] != "")
        {
            $fromDate = date("Y-m-d",strtotime($_REQUEST['fromDate']));
        }
        else
        {
            $fromDate = "";
        }

        if(isset($_REQUEST['toDate']) && $_REQUEST['toDate'] != "")
        {
            $toDate = date("Y-m-d",strtotime($_REQUEST['toDate']));
        }
        else
        {
            $toDate = "";
        }

        $TblUserRefObj = new TblUserRefrence();
        $data['bankUser'] = $TblUserRefObj->getBankUserListByDate($fromDate,$toDate);

        $TblUserRefObj = new TblUserRefrence();
        $data['investmentUser'] = $TblUserRefObj->getInvestmentUserListByDate($fromDate,$toDate);

        $TblUserRefObj = new TblUserRefrence();
        $data['realEstateUser'] = $TblUserRefObj->getRealEstateUserListByDate($fromDate,$toDate);

        //echo "<pre>"; print_r($data['realEstateUser']); die;

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->renderPartial("dashboard",array("data" => $data));
            exit;
        } else {
            $this->render("dashboard",array("data" => $data));
            exit;
        }

    }

    /*
    * Function Name : actioncheckAdminEmailId
    * Description : For check admin emai id exists or not on forgot password page
    * Developer : Rohankumar Varma
    * Date : 29-08-2017
    */
    public function actioncheckAdminEmailId()
    {
        if(isset($_REQUEST['email']) && $_REQUEST['email'] != '')
        {
            $TblAdminObj = new TblUser();
            $response = $TblAdminObj->checkEmailExists($_REQUEST['email']);

            if(!empty($response))
            {
                echo 'false';
            }
            else
            {
                echo 'true';
            }
        }
    }


    /*
    * Function Name : actionforgot_Password
    * Description : For render to forgot password page
    * Developer : Rohankumar Varma
    * Date : 29-08-2017
    */
    function actionforgotPassword()
    {
        if (isset(Yii::app()->session[_SITENAME_.'_admin']))
        {
            Yii::app()->request->redirect( Yii::app()->params->base_path . 'admin');
        }
        if (isset($_POST['email']))
        {
            $TblAdminObj = new TblAdmin();
            $result = $TblAdminObj->forgot_password($_REQUEST['email']);
            $data = array();
            $data = $_POST;

            if($result[0] == 'success')
            {
                Yii::app()->user->setFlash("success", "Verification link is sent to your email address. Please check your email for verification code to reset your password successfully.");
                $data['message_static'] = $result[1];
                $this->render("forgotPasswordConfirmation", array("data" => $data));
            }
            else
            {
                Yii::app()->user->setFlash("error",$result[1]);
                $this->render("forgotPassword");
                exit;
            }
        }
        else
        {
            $this->render("forgotPassword");
        }
    }

    /*
    * Function Name : resetPassword
    * Description : For user Reset Password
    * Developer : Rohankumar Varma
    * Date : 29-08-2017
    */
    function actionresetPassword()
    {
        $message = '';
        $data = array();

        if (isset($_POST['submit_reset_password_btn'])) {
            $data = array();
            $data = $_POST;
            $TblAdminObj = new TblAdmin();
            $result = $TblAdminObj->resetpassword($data);
            $message = $result[1];
            if ($result[0] == 'success') {
                Yii::app()->user->setFlash("success", "Successfully changed Password.");
                header("Location: " . Yii::app()->params->base_path . 'admin/index');
                exit;
            } else {
                Yii::app()->user->setFlash("error", "Something went wrong.Please try after sometime.");
                header("Location: " . Yii::app()->params->base_path . 'admin/index');
                exit;
            }
        }

        if ($message != '') {
            Yii::app()->user->setFlash("success", $message);
        }
        if (isset($_REQUEST['token'])) {
            $token = trim($_REQUEST['token']);
            $TblAdminObj = new TblAdmin();
            $checkToken = $TblAdminObj->getIdByfpasswordConfirm($token);

            if($checkToken==0){
                Yii::app()->user->setFlash("error", "Forgot password link is expired.");
                $this->redirect(array('admin/index'));
            }
            $data['token']= $token;
        }
        $this->render('forgotPasswordConfirmation', $data);
    }


    /*
    * Function Name : actionchangePassword
    * Description : For admin change Password
    * Developer : Rohankumar Varma
    * Date : 25-05-2017
    */
    /*function actionchangePassword()
    {
        $this->isLogin();
        //Yii::app()->session['current'] = 'changePass';
        //print_r($_REQUEST);die;
        if(isset($_POST['admin_id']))
        {
            if(isset($_POST['old_password']) && $_POST['old_password'] != "" && isset($_POST['new_password']) && $_POST['new_password'] != "" && isset($_POST['re_enter_password']) && $_POST['re_enter_password'] != ""){
                try {
                    $data = array();
                    $generalObj = new General;
                    $data['password'] = $generalObj->encrypt_password($_POST['new_password']);
                    $data['updated_at'] = date("Y-m-d H:i:s");
                   // print_r($data);
                    $TblAdminObj = new TblAdmin();
                    $TblAdminObj->setData($data);
                    $TblAdminObj->insertData($_POST['admin_id']);
                    //Yii::app()->user->setFlash("success","Password change successfully");
                    echo json_encode(array("message" => "Password change successfully", "message_type" => "success"));
                } catch(Exception $e){
                    echo json_encode(array("message" => $e->getMessage(), "message_type" => "success"));
                }
            }
            else {
                echo json_encode(array("message"=>"Please fill all the require fields.", "message_type"=>"error"));
            }
            die;
        }
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->renderPartial('changePassword');
        }
        else{
            $this->render('changePassword');
        }
    }*/


    function actionprofile()
    {
        $this->isLogin();
        Yii::app()->session['active_tab'] = 'Profile';
        if(isset($_POST['FormSubmit']))
        {
            if(isset($_POST['name']) && $_POST['name']!='')
            {
                $data['name'] = $_POST['name'];
                Yii::app()->session['name'] = $data['name'];
            }

            if( isset($_REQUEST['email']) && $_REQUEST['email'] !='')
            {
                $TblUser = new TblUser();
                $bool = $TblUser->checkEmailId($_REQUEST['email']);

                if(!empty($bool))
                {
                    $TblUser = new TblUser();
                    $admin_data = $TblUser->getAdmindetailsbyId(Yii::app()->session[_SITENAME_.'_admin']);

                    if( $_REQUEST['email'] == $admin_data['email'] )
                    {
                        $data['email'] = $_REQUEST['email'];
                    }
                    else
                    {
                        //Yii::app()->user->setFlash("error","Email address is already registered.");
                        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                            $this->renderPartial("profile", array("adminData" => $data));
                        }
                        else{
                            $this->render("profile", array("adminData" => $data));
                        }
                        exit;
                    }
                }
                else
                {
                    $data['email'] = $_REQUEST['email'];
                }
            }

            $TblUser = new TblUser();
            $getAdmindata = $TblUser->getAdmindetailsbyId(Yii::app()->session[_SITENAME_.'_admin']);

            $path  =  "assets/upload/avatar/admin/".$getAdmindata['avatar'];

            if((isset($_FILES['avatar']['name']) && $_FILES['avatar']['name'] !="") && file_exists($path))
            {
                unlink( "assets/upload/avatar/admin/".$getAdmindata['avatar']);
            }

            if( ( isset($_FILES['avatar']['name']) ) && ( $_FILES['avatar']['name'] != "" ) )
            {
                $data['avatar']= "admin_".Yii::app()->session[_SITENAME_.'_admin'].".png";
                move_uploaded_file($_FILES['avatar']["tmp_name"],"assets/upload/avatar/admin/".$data['avatar']);
            }

            $TblUser = new TblUser();
            $TblUser->setData($data);
            $TblUser->insertData(Yii::app()->session[_SITENAME_.'_admin']);

            $TblUser = new TblUser();
            $adminData = $TblUser->getAdmindetailsbyId(Yii::app()->session[_SITENAME_.'_admin']);

            //Yii::app()->user->setFlash("success","Successfully updated profile.");
            if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                //$this->renderPartial("profile", array("adminData" => $adminData));
                echo json_encode(array("message"=>"Successfully updated profile.", "message_type"=>"success"));
            }
            else{
                $this->render("profile", array("adminData" => $adminData));
            }

        }
        else
        {
            $TblUser = new TblUser();
            $adminData = $TblUser->getAdmindetailsbyId(Yii::app()->session[_SITENAME_.'_admin']);

            if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $this->renderPartial("profile", array("adminData" => $adminData));
            }
            else{
                $this->render("profile", array("adminData" => $adminData));
            }
        }
    }


    public function saveS3Images($bucket=NULL,$keyname=NULL,$SourceFile=NULL,$page=NULL)
    {
        /*echo "<pre>";
        print_r($bucket);
        print_r($keyname);
        print_r($SourceFile);
        print_r($page);die;*/
        // Instantiate the client.
        $s3 = S3Client::factory(array(
            'key' => AMAZON_KEY_S3,
            'secret' => AMAZON_SECRET_S3,
            'region' => REGION
        ));
            //print_r($s3)
        try {
            // Upload data.
            $result = $s3->putObject(array(
                'Bucket' => $bucket,
                'Key'    => $keyname,
                'ContentType' => 'image/jpeg',
                'SourceFile'   => $SourceFile,
                'ACL'    => 'public-read'
            ));
            //print_r($result);die;
            return $result['ObjectURL'];

        } catch (S3Exception $e) {
            Yii::app()->user->setFlash("error", $e->getMessage());
            $this->redirect(array("admin/'.$page.'"));
        }
    }

    public function deleteS3Images($bucket=NULL,$keyname_old=NULL){

        $s3 = S3Client::factory(array(
            'key' => AMAZON_KEY_S3,
            'secret' => AMAZON_SECRET_S3,
            'region' => REGION
        ));

        $result = $s3->deleteObject(array(
            'Bucket' => $bucket,
            'Key'    => $keyname_old
        ));
    }

    function actionchangePassword()
    {
        $this->isLogin();
        Yii::app()->session['current'] = 'changePassword';

        if(isset($_POST['adminId']))
        {
            $data = array();
            $generalObj = new General;
            $data['password'] = $generalObj->encrypt_password($_POST['new_password']);
            $data['updatedAt'] = date("Y-m-d H:i:s");

            $TblAdminObj = new TblAdmin();
            $TblAdminObj->setData($data);
            $TblAdminObj->insertData($_POST['adminId']);

            Yii::app()->user->setFlash("success","Password change successfully");
            //$this->redirect(array('admin/changePassword'));
        }

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->renderPartial('changePassword');
        }
        else{
            $this->render('changePassword');
        }

        //$this->render('changePassword');
    }



    /*
    * Function Name : actioncheckOldPassword
    * Description : For admin check old Password
    * Developer : Rohankumar Varma
    * Date : 11-09-2017
    */
    function actioncheckOldPassword()
    {
        try{
            $this->isLogin();
            if(isset($_POST['old_password']) && $_POST['old_password'] != '')
            {
                $adminId = Yii::app()->session[_SITENAME_.'_admin'];

                $TblAdminObj = new TblAdmin();
                $old_password = $TblAdminObj->getAdminDataById($adminId);

                $generalObj = new General();
                $isValid = $generalObj->validate_password($_POST['old_password'], $old_password['password']);

                if($isValid === true)
                {
                    echo 'true';
                }
                else
                {
                    echo 'false';
                }
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
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

    /*
    * Function Name : registerUser
    * Description : For sign up users
    * Developer : Bhoomi Patel
    * Changed Date : 30-05-2018
    */

    function actionregisterUser()
    {   //echo "<pre>"; print_r($_POST); die;
        $validationObj = new Validation();
        $response = $validationObj->userSignUp($_POST);
        if($response['status'] == 0)
        {
            $data = array();
            $data['full_name'] =$_POST['full_name'];
            $data['phone_number'] =$_POST['phone_number'];
            $data['employment_type'] =$_POST['employment_type'];
            $data['email'] =$_POST['email'];
            $data['annual_income'] =$_POST['annual_income'];
            $data['street'] =$_POST['street'];
            $data['city'] =$_POST['city'];
            $data['state'] =$_POST['state'];
            $data['pincode'] =$_POST['pincode'];
            $generalObj = new General;
            $data['password'] = $generalObj->encrypt_password($_POST['password']);
            $everify_code = $generalObj->encrypt_password(rand(0,99).rand(0,99).rand(0,99).rand(0,99));
            $data['status'] = 1;

            if(isset($_POST['user_id'])&& $_POST['user_id'] != "")
            {
                $data['modified_at'] = date("Y-m-d H:i:s");
                $TblUserObj = new TblUser();
                $TblUserObj->setData($data);
                $TblUserObj->insertData($_POST['user_id']);

                Yii::app()->user->setFlash("success", "Successfully updated user");
            }
            else
            {
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['is_verified'] = $everify_code;
                $TblUserObj = new TblUser();
                $TblUserObj->setData($data);
                $user_id = $TblUserObj->insertData();

                Yii::app()->session['full_name'] = $_POST['full_name'];

                Yii::app()->user->setFlash("success", "You are successfully registered.");
            }
            $this->redirect(array('admin/adminLogin','email'=>$_POST['email']));
        }
        else
        {
            Yii::app()->user->setFlash("error",$response['message']);
            $this->redirect(array('admin/signUp'));
        }
    }

    /*not in use*/
    function actionuserListing()
    {
        $this->isLogin();
        if(isset($_REQUEST['menu_id']) && $_REQUEST['menu_id'] != "")
        {
            Yii::app()->session['current_menu_id'] = $_REQUEST['menu_id'];
        }

        if(isset($_REQUEST['menu_id']) && $_REQUEST['menu_id']  != '')
        {
            Yii::app()->session['menu_id'] = $_REQUEST['menu_id'];
        }

        Yii::app()->session['current'] = 'userList';
        Yii::app()->session['breadcums'] = 'userList';
        if(!isset($_REQUEST['sortType']))
        {
            $_REQUEST['sortType']='asc';
        }
        if(!isset($_REQUEST['sortBy']))
        {
            $_REQUEST['sortBy']='user_id';
        }
        if(!isset($_REQUEST['keyword']))
        {
            $_REQUEST['keyword']='';
        }

        $_REQUEST['currentSortType'] = $_REQUEST['sortType'];

        if($_REQUEST['sortType'] == 'asc')
        {
            $ext['sortType']='desc';
        }
        if($_REQUEST['sortType'] == 'desc')
        {
            $ext['sortType']='asc';
        }

        $ext['page'] = "";

        if(isset($_REQUEST['page']) && $_REQUEST['page']!=''){
            $ext['page'] = $_REQUEST['page'];
        }

        $ext['keyword'] = $_REQUEST['keyword'];
        $ext['sortBy'] = $_REQUEST['sortBy'];
        $ext['currentSortType'] = $_REQUEST['currentSortType'];

        $TblUserObj = new TblUser();
        $userData = $TblUserObj->getAllUserPaginated(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword']);

        $data['pagination']	= $userData['pagination'];
        $data['userList'] = $userData['userList'];

        //print "<pre>"; print_r($data); die;

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        {
            //$this->renderPartial("projectListingAjax", array('data'=>$data,'ext'=>$ext));
            $this->renderPartial("userListing", array('data'=>$data,'ext'=>$ext));
        }
        else
        {
            $this->render("userListing", array("data"=>$data,'ext'=>$ext ));
        }
    }

    function actionbankLoanListing()
    {
        $this->isLogin();
        if(isset($_REQUEST['menu_id']) && $_REQUEST['menu_id'] != "")
        {
            Yii::app()->session['current_menu_id'] = $_REQUEST['menu_id'];
        }

        if(isset($_REQUEST['menu_id']) && $_REQUEST['menu_id']  != '')
        {
            Yii::app()->session['menu_id'] = $_REQUEST['menu_id'];
        }

        Yii::app()->session['current'] = 'bankList';
        Yii::app()->session['breadcums'] = 'bankList';
        if(!isset($_REQUEST['sortType']))
        {
            $_REQUEST['sortType']='asc';
        }
        if(!isset($_REQUEST['sortBy']))
        {
            $_REQUEST['sortBy']='loan_type_id';
        }
        if(!isset($_REQUEST['keyword']))
        {
            $_REQUEST['keyword']='';
        }

        $_REQUEST['currentSortType'] = $_REQUEST['sortType'];

        if($_REQUEST['sortType'] == 'asc')
        {
            $ext['sortType']='desc';
        }
        if($_REQUEST['sortType'] == 'desc')
        {
            $ext['sortType']='asc';
        }

        $ext['page'] = "";

        if(isset($_REQUEST['page']) && $_REQUEST['page']!=''){
            $ext['page'] = $_REQUEST['page'];
        }

        $ext['keyword'] = $_REQUEST['keyword'];
        $ext['sortBy'] = $_REQUEST['sortBy'];
        $ext['currentSortType'] = $_REQUEST['currentSortType'];

        $TblLoanTypeObj = new TblLoanTypeMaster();
        $bankLoanData = $TblLoanTypeObj->getAllBankLoanPaginated(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword']);

        $data['pagination']	= $bankLoanData['pagination'];
        $data['bankLoanList'] = $bankLoanData['bankLoanList'];

        //print "<pre>"; print_r($data); die;

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        {
            //$this->renderPartial("projectListingAjax", array('data'=>$data,'ext'=>$ext));
            $this->renderPartial("bankLoanListing", array('data'=>$data,'ext'=>$ext));
        }
        else
        {
            $this->render("bankLoanListing", array("data"=>$data,'ext'=>$ext ));
        }
    }

    function actioninvAdvisoryListing()
    {
        $this->isLogin();
        if(isset($_REQUEST['menu_id']) && $_REQUEST['menu_id'] != "")
        {
            Yii::app()->session['current_menu_id'] = $_REQUEST['menu_id'];
        }

        if(isset($_REQUEST['menu_id']) && $_REQUEST['menu_id']  != '')
        {
            Yii::app()->session['menu_id'] = $_REQUEST['menu_id'];
        }

        Yii::app()->session['current'] = 'investmentAdvisoryList';
        Yii::app()->session['breadcums'] = 'investmentAdvisoryList';
        if(!isset($_REQUEST['sortType']))
        {
            $_REQUEST['sortType']='asc';
        }
        if(!isset($_REQUEST['sortBy']))
        {
            $_REQUEST['sortBy']='inv_type_id';
        }
        if(!isset($_REQUEST['keyword']))
        {
            $_REQUEST['keyword']='';
        }

        $_REQUEST['currentSortType'] = $_REQUEST['sortType'];

        if($_REQUEST['sortType'] == 'asc')
        {
            $ext['sortType']='desc';
        }
        if($_REQUEST['sortType'] == 'desc')
        {
            $ext['sortType']='asc';
        }

        $ext['page'] = "";

        if(isset($_REQUEST['page']) && $_REQUEST['page']!=''){
            $ext['page'] = $_REQUEST['page'];
        }

        $ext['keyword'] = $_REQUEST['keyword'];
        $ext['sortBy'] = $_REQUEST['sortBy'];
        $ext['currentSortType'] = $_REQUEST['currentSortType'];

        $TblInvTypeObj = new TblInvTypeMaster();
        $bankLoanData = $TblInvTypeObj->getAllInvAdvisoryListPaginated(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword']);

        $data['pagination']	= $bankLoanData['pagination'];
        $data['invAdvisoryList'] = $bankLoanData['invAdvisoryList'];

        //print "<pre>"; print_r($data); die;

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        {
            //$this->renderPartial("projectListingAjax", array('data'=>$data,'ext'=>$ext));
            $this->renderPartial("invAdvisoryListing", array('data'=>$data,'ext'=>$ext));
        }
        else
        {
            $this->render("invAdvisoryListing", array("data"=>$data,'ext'=>$ext ));
        }
    }

    function actionrealEstateListing()
    {
        $this->isLogin();
        if(isset($_REQUEST['menu_id']) && $_REQUEST['menu_id'] != "")
        {
            Yii::app()->session['current_menu_id'] = $_REQUEST['menu_id'];
        }

        if(isset($_REQUEST['menu_id']) && $_REQUEST['menu_id']  != '')
        {
            Yii::app()->session['menu_id'] = $_REQUEST['menu_id'];
        }

        Yii::app()->session['current'] = 'realEstateList';
        Yii::app()->session['breadcums'] = 'realEstateList';
        if(!isset($_REQUEST['sortType']))
        {
            $_REQUEST['sortType']='asc';
        }
        if(!isset($_REQUEST['sortBy']))
        {
            $_REQUEST['sortBy']='property_type_id';
        }
        if(!isset($_REQUEST['keyword']))
        {
            $_REQUEST['keyword']='';
        }

        $_REQUEST['currentSortType'] = $_REQUEST['sortType'];

        if($_REQUEST['sortType'] == 'asc')
        {
            $ext['sortType']='desc';
        }
        if($_REQUEST['sortType'] == 'desc')
        {
            $ext['sortType']='asc';
        }

        $ext['page'] = "";

        if(isset($_REQUEST['page']) && $_REQUEST['page']!=''){
            $ext['page'] = $_REQUEST['page'];
        }

        $ext['keyword'] = $_REQUEST['keyword'];
        $ext['sortBy'] = $_REQUEST['sortBy'];
        $ext['currentSortType'] = $_REQUEST['currentSortType'];

        $TblRealEstateObj = new TblPropertyTypeMaster();
        $realEstateData = $TblRealEstateObj->getAllRealEstateListPaginated(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword']);

        $data['pagination']	= $realEstateData['pagination'];
        $data['realEstateList'] = $realEstateData['realEstateList'];

        //print "<pre>"; print_r($data); die;

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        {
            //$this->renderPartial("projectListingAjax", array('data'=>$data,'ext'=>$ext));
            $this->renderPartial("realEstateListing", array('data'=>$data,'ext'=>$ext));
        }
        else
        {
            $this->render("realEstateListing", array("data"=>$data,'ext'=>$ext ));
        }
    }
    /*not in use code end here*/




    /*bank loan applied user listing, edit, chnage stage status code start here*/
    function actionbankLoanUserListing()
    {
        //echo "<pre>"; print_r($_REQUEST); die;
        $this->isLogin();

        $filter=array();
        $filter['date_from']='';$filter['date_to']='';

        if(isset($_REQUEST['menu_id']) && $_REQUEST['menu_id'] != "")
        {
            Yii::app()->session['current_menu_id'] = $_REQUEST['menu_id'];
        }

        if(isset($_REQUEST['menu_id']) && $_REQUEST['menu_id']  != '')
        {
            Yii::app()->session['menu_id'] = $_REQUEST['menu_id'];
        }

        Yii::app()->session['current'] = 'bankUserList';
        Yii::app()->session['breadcums'] = 'bankUserList';
        if(!isset($_REQUEST['sortType']))
        {
            $_REQUEST['sortType']='asc';
        }
        if(!isset($_REQUEST['sortBy']))
        {
            $_REQUEST['sortBy']='ur.user_ref_id';
        }
        if(!isset($_REQUEST['keyword']))
        {
            $_REQUEST['keyword']='';
        }

        $_REQUEST['currentSortType'] = $_REQUEST['sortType'];

        if($_REQUEST['sortType'] == 'asc')
        {
            $ext['sortType']='desc';
        }
        if($_REQUEST['sortType'] == 'desc')
        {
            $ext['sortType']='asc';
        }

        $ext['page'] = "";

        if(isset($_REQUEST['page']) && $_REQUEST['page']!=''){
            $ext['page'] = $_REQUEST['page'];
        }

        $ext['keyword'] = $_REQUEST['keyword'];
        $ext['sortBy'] = $_REQUEST['sortBy'];
        $ext['currentSortType'] = $_REQUEST['currentSortType'];

        if(isset($_REQUEST['date_from']) && $_REQUEST['date_from'] != "")
        {
            $filter['date_from'] = date("Y-m-d",strtotime($_REQUEST['date_from']));
        }
        if(isset($_REQUEST['date_to']) && $_REQUEST['date_to'] != "")
        {
            $filter['date_to'] = date("Y-m-d",strtotime($_REQUEST['date_to']));
        }
        $ext['filterData'] = $filter;

        $TbluserRefObj = new TblUserRefrence();
        $bankLoanAppliedUserData = $TbluserRefObj->getAllBankLoanAppliedUserPaginated(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$filter);

        $data['pagination']	= $bankLoanAppliedUserData['pagination'];
        $data['bankUserList'] = $bankLoanAppliedUserData['bankUserList'];

        //print "<pre>"; print_r($data); die;

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        {
            //$this->renderPartial("projectListingAjax", array('data'=>$data,'ext'=>$ext));
            $this->renderPartial("bankAppliedUserListing", array('data'=>$data,'ext'=>$ext));
        }
        else
        {
            $this->render("bankAppliedUserListing", array("data"=>$data,'ext'=>$ext ));
        }
    }

    public function actionchangeStageStatus()
    {
        //echo "<pre>"; print_r($_REQUEST); die;
        if(isset($_POST['FormSubmit'])){
            try{
                if(isset($_REQUEST['user_ref_id']) && $_REQUEST['user_ref_id']!="") {
                    $user_ref_id = $_REQUEST['user_ref_id'];
                    $loan_stage_id = $_REQUEST['loan_stage_id'];

                    $tblLoanTransObj = new TblLoanTransaction();
                    $data = $tblLoanTransObj->getDetailsByUserRefId($user_ref_id);
                    //echo "<pre>"; print_r($data); die;
                    $transactionData = array();
                    $transactionData['loan_id'] = $data['loan_transaction_id'];
                    $transactionData['loan_stage_id'] = $loan_stage_id;
                    $transactionData['stage_transaction_date'] = date("Y-m-d H:i:s");


                    if(isset($_REQUEST['loan_tran_ref_id']) && $_REQUEST['loan_tran_ref_id']!='')
                    {   //echo "if"; die;
                        $loan_tran_ref_id = $_REQUEST['loan_tran_ref_id'];
                        $transactionData['created_at'] = date("Y-m-d H:i:s");

                        $tblTransRefObj = new TblLoanTransReference();
                        $tblTransRefObj->setData($transactionData);
                        $tblTransRefObj->insertData($loan_tran_ref_id);
                    }
                    else {  //echo "else"; die;
                        $transactionData['modified_at'] = date("Y-m-d H:i:s");

                        $tblTransRefObj = new TblLoanTransReference();
                        $tblTransRefObj->setData($transactionData);
                        $loan_tran_ref_id = $tblTransRefObj->insertData();
                    }
                    //echo $loan_tran_ref_id; die;
                }
                $this->response(array("message" => "Successfully changed status", "message_type" => "success"));
                //Yii::app()->user->setFlash('success', "Successfully changed status");
                $this->redirect(array("admin/bankLoanUserListing"));
            }
            catch(Exception $e)
            {
                //$transaction->rollback();
                $this->response(array("message" => $e->getMessage(), "message_type" => "error"));
                //Yii::app()->user->setFlash('error', $e->getMessage());
                $this->redirect(array("admin/bankLoanUserListing"));
            }
        }
        else
        {
            $this->response(array("message" => "Error while change stage,Please try again.", "message_type" => "error"));
        }

    }

    public function actioneditUserDetails()
    {
        $this->isLogin();
        //echo "<pre>"; print_r($_REQUEST); die;
        Yii::app()->session['current'] = 'userDetails';
        Yii::app()->session['breadcums'] = 'userDetails';

        $userData = array();
        $user_id = Yii::app()->session[_SITENAME_ . '_admin'];

        if(isset($_REQUEST['user_ref_id']) && $_REQUEST['user_ref_id']!='')
        {
            $user_ref_id = $_REQUEST['user_ref_id'];

            $tblUserRefObj = new TblUserRefrence();
            $userData = $tblUserRefObj->getUserdetailsbyId($user_ref_id);

            $tblLoanTransactionObj = new TblLoanTransaction();
            $userData['loan_data'] = $tblLoanTransactionObj->getDetailsByUserRefId($user_ref_id);

            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

                $this->renderPartial("editUserDetails", array('userData' => $userData));
            } else {
                $this->render("editUserDetails", array('userData' => $userData));
            }
            //echo "<pre>"; print_r($userData); die;


        }
    }

    public function actionupdateUserDetails()
    {
        //echo "<pre>"; print_r($_REQUEST); die;

        $this->isLogin();
        try {
            $userDetails = array();
            $loanDetails = array();
            $loanRefDetails = array();

            if(isset($_REQUEST['user_ref_id']) && $_REQUEST['user_ref_id']!='')
            {
                $user_ref_id = $_REQUEST['user_ref_id'];

                //$userDetails['user_ref_id'] = $user_ref_id;
                $userDetails['full_name'] = $_REQUEST['fullName'];
                $userDetails['phone_number'] = $_REQUEST['phoneNumber'];
                $userDetails['email'] = $_REQUEST['email'];
                $userDetails['annual_income'] = $_REQUEST['annualIncome'];
                $userDetails['street'] = $_REQUEST['street'];
                $userDetails['city'] = $_REQUEST['city'];
                $userDetails['state'] = $_REQUEST['state'];
                $userDetails['pincode'] = $_REQUEST['pincode'];
                $userDetails['modified_at'] = date("Y-m-d H:i:s");

                $tblUserRefObj = new TblUserRefrence();
                $tblUserRefObj->setData($userDetails);
                $tblUserRefObj->insertData($user_ref_id);
            }

            if(isset($_REQUEST['loan_id']) && $_REQUEST['loan_id'])
            {
                $loan_id = $_REQUEST['loan_id'];

                //$loanDetails['loan_id'] = $loan_id;
                $loanDetails['loan_amount'] = $_REQUEST['loanAmount'];
                $loanDetails['bank_id'] = $_REQUEST['bank_id'];
                $loanDetails['load_transaction_date'] = date("Y-m-d H:i:s");
                $loanDetails['modified_at'] = date("Y-m-d H:i:s");
                $loanDetails['user_ref_id'] = $_REQUEST['user_ref_id'];
                $loanDetails['loan_type'] = $_REQUEST['loan_type'];

                if(isset($_REQUEST['loan_sub_type_id']) && $_REQUEST['loan_sub_type_id']!='')
                {
                    $loanDetails['loan_sub_type'] = $_REQUEST['loan_sub_type_id'];
                }

                if(isset($_REQUEST['bankName']) && $_REQUEST['bankName']!='')
                {
                    $loanDetails['bank_name'] = $_REQUEST['bankName'];
                }

                if(isset($_REQUEST['description']) && $_REQUEST['description']!='')
                {
                    $loanDetails['description'] = $_REQUEST['description'];
                }
                $loanDetails['modified_at'] = date("Y-m-d H:i:s");

                $tblLoanTransObj = new TblLoanTransaction();
                $tblLoanTransObj->setData($loanDetails);
                $tblLoanTransObj->insertData($loan_id);
            }
            else
            {
                $loanDetails['loan_amount'] = $_REQUEST['loanAmount'];
                $loanDetails['bank_id'] = $_REQUEST['bank_id'];
                $loanDetails['load_transaction_date'] = date("Y-m-d H:i:s");
                $loanDetails['created_at'] = date("Y-m-d H:i:s");
                $loanDetails['user_ref_id'] = $_REQUEST['user_ref_id'];
                $loanDetails['loan_type'] = $_REQUEST['loan_type'];

                if(isset($_REQUEST['loan_sub_type_id']) && $_REQUEST['loan_sub_type_id']!='')
                {
                    $loanDetails['loan_sub_type'] = $_REQUEST['loan_sub_type_id'];
                }

                if(isset($_REQUEST['bankName']) && $_REQUEST['bankName']!='')
                {
                    $loanDetails['bank_name'] = $_REQUEST['bankName'];
                }

                if(isset($_REQUEST['description']) && $_REQUEST['description']!='')
                {
                    $loanDetails['description'] = $_REQUEST['description'];
                }

                $tblLoanTransObj = new TblLoanTransaction();
                $tblLoanTransObj->setData($loanDetails);
                $loan_id = $tblLoanTransObj->insertData();
            }

            //echo  $loan_id; die;
            if(isset($_REQUEST['loan_tran_ref_id']) && $_REQUEST['loan_tran_ref_id']!='')
            {
                $loan_tran_ref_id = $_REQUEST['loan_tran_ref_id'];
                $loanRefDetails['loan_id'] = $loan_id;
                $loanRefDetails['loan_stage_id'] = $_REQUEST['loan_stage'];
                $loanRefDetails['stage_transaction_date'] = date("Y-m-d H:i:s");

                $loanRefDetails['modified_at'] = date("Y-m-d H:i:s");

                $tblLoanTransRefObj = new TblLoanTransReference();
                $tblLoanTransRefObj->setData($loanRefDetails);
                $tblLoanTransRefObj->insertData($loan_tran_ref_id);
            }
            else
            {
                $loanRefDetails['loan_id'] = $loan_id;
                $loanRefDetails['loan_stage_id'] = $_REQUEST['loan_stage'];
                $loanRefDetails['stage_transaction_date'] = date("Y-m-d H:i:s");

                $loanRefDetails['created_at'] = date("Y-m-d H:i:s");

                $tblLoanTransRefObj = new TblLoanTransReference();
                $tblLoanTransRefObj->setData($loanRefDetails);
                $prop_tran_ref_id = $tblLoanTransRefObj->insertData();
            }

            Yii::app()->user->setFlash('success', "Successfully updated user details");
            $this->redirect(array("admin/bankLoanUserListing"));
        }
        catch(Exception $e)
        {
            //$transaction->rollback();
            Yii::app()->user->setFlash('error', $e->getMessage());
            $this->redirect(array("admin/bankLoanUserListing"));
        }

    }
    /*bank loan applied user listing, edit, change stage status code end here*/

    /*investment advisory applied user listing, edit, change stage status code start here*/

    public function actioninvAdvisoryUserListing()
    {
        //echo "<pre>"; print_r($_REQUEST); die;
        $this->isLogin();

        $filter=array();
        $filter['date_from']='';$filter['date_to']='';

        if(isset($_REQUEST['menu_id']) && $_REQUEST['menu_id'] != "")
        {
            Yii::app()->session['current_menu_id'] = $_REQUEST['menu_id'];
        }

        if(isset($_REQUEST['menu_id']) && $_REQUEST['menu_id']  != '')
        {
            Yii::app()->session['menu_id'] = $_REQUEST['menu_id'];
        }

        Yii::app()->session['current'] = 'invAdvisoryUserList';
        Yii::app()->session['breadcums'] = 'invAdvisoryUserList';
        if(!isset($_REQUEST['sortType']))
        {
            $_REQUEST['sortType']='asc';
        }
        if(!isset($_REQUEST['sortBy']))
        {
            $_REQUEST['sortBy']='ur.user_ref_id';
        }
        if(!isset($_REQUEST['keyword']))
        {
            $_REQUEST['keyword']='';
        }

        $_REQUEST['currentSortType'] = $_REQUEST['sortType'];

        if($_REQUEST['sortType'] == 'asc')
        {
            $ext['sortType']='desc';
        }
        if($_REQUEST['sortType'] == 'desc')
        {
            $ext['sortType']='asc';
        }

        $ext['page'] = "";

        if(isset($_REQUEST['page']) && $_REQUEST['page']!=''){
            $ext['page'] = $_REQUEST['page'];
        }

        if(isset($_REQUEST['date_from']) && $_REQUEST['date_from'] != "")
        {
            $filter['date_from'] = date("Y-m-d",strtotime($_REQUEST['date_from']));
        }
        if(isset($_REQUEST['date_to']) && $_REQUEST['date_to'] != "")
        {
            $filter['date_to'] = date("Y-m-d",strtotime($_REQUEST['date_to']));
        }
        $ext['filterData'] = $filter;

        $ext['keyword'] = $_REQUEST['keyword'];
        $ext['sortBy'] = $_REQUEST['sortBy'];
        $ext['currentSortType'] = $_REQUEST['currentSortType'];

        $TbluserRefObj = new TblUserRefrence();
        $invAdvisoryAppliedUserData = $TbluserRefObj->getAllinvAdvisoryLoanAppliedUserPaginated(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$filter);

        $data['pagination']	= $invAdvisoryAppliedUserData['pagination'];
        $data['invAdvisoryUserList'] = $invAdvisoryAppliedUserData['invAdvisoryUserList'];

        //print "<pre>"; print_r($data); die;

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        {
            //$this->renderPartial("projectListingAjax", array('data'=>$data,'ext'=>$ext));
            $this->renderPartial("invAdvisoryAppliedUserListing", array('data'=>$data,'ext'=>$ext));
        }
        else
        {
            $this->render("invAdvisoryAppliedUserListing", array("data"=>$data,'ext'=>$ext ));
        }
    }

    public function actionchangeinvStageStatus()
    {
        //echo "<pre>"; print_r($_REQUEST); die;
        if(isset($_POST['FormSubmit'])) {

            try {
                if (isset($_REQUEST['user_ref_id']) && $_REQUEST['user_ref_id'] != "") {
                    $user_ref_id = $_REQUEST['user_ref_id'];
                    $inv_stage_id = $_REQUEST['inv_stage_id'];

                    $tblInvTransObj = new TblInvestmentTransaction();
                    $data = $tblInvTransObj->getDetailsByUserRefId($user_ref_id);
                    //echo "<pre>"; print_r($data); die;
                    $transactionData = array();
                    $transactionData['inv_id'] = $data['inv_transaction_id'];
                    $transactionData['inv_stage_id'] = $inv_stage_id;
                    $transactionData['stage_transaction_date'] = date("Y-m-d H:i:s");
                    $transactionData['status'] = 1;

                    if (isset($_REQUEST['inv_tran_ref_id']) && $_REQUEST['inv_tran_ref_id'] != '') {   //echo "if"; die;

                        $inv_tran_ref_id = $_REQUEST['inv_tran_ref_id'];
                        $transactionData['modified_at'] = date("Y-m-d H:i:s");

                        $tblTransRefObj = new TblInvTransReference();
                        $tblTransRefObj->setData($transactionData);
                        $tblTransRefObj->insertData($inv_tran_ref_id);
                    } else {  //echo "else"; die;
                        $transactionData['created_at'] = date("Y-m-d H:i:s");

                        $tblTransRefObj = new TblInvTransReference();
                        $tblTransRefObj->setData($transactionData);
                        $inv_tran_ref_id = $tblTransRefObj->insertData();
                    }
                }

                $this->response(array("message" => "Successfully changed status", "message_type" => "success"));
                //Yii::app()->user->setFlash('success', "Successfully changed status");
                $this->redirect(array("admin/invAdvisoryUserListing"));

            } catch (Exception $e) {

                //$transaction->rollback();
                $this->response(array("message" => $e->getMessage(), "message_type" => "error"));
                //Yii::app()->user->setFlash('error', $e->getMessage());
                $this->redirect(array("admin/invAdvisoryUserListing"));
            }
        }
        else
        {
            $this->response(array("message" => "Error while change stage,Please try again.", "message_type" => "error"));
        }
    }

    public function actioneditInvAdvisoryUserDetails()
    {
        $this->isLogin();
        Yii::app()->session['current'] = 'userDetails';
        Yii::app()->session['breadcums'] = 'userDetails';

        $userData = array();
        $user_id = Yii::app()->session[_SITENAME_ . '_admin'];

        if(isset($_REQUEST['user_ref_id']) && $_REQUEST['user_ref_id']!='')
        {
            $user_ref_id = $_REQUEST['user_ref_id'];

            $tblUserRefObj = new TblUserRefrence();
            $userData = $tblUserRefObj->getUserdetailsbyId($user_ref_id);

            $tblInvTransactionObj = new TblInvestmentTransaction();
            $userData['inv_data'] = $tblInvTransactionObj->getDetailsByUserRefId($user_ref_id);
            //echo "<pre>"; print_r($userData); die;
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

                $this->renderPartial("editInvAdvisoryUserDetails", array('userData' => $userData));
            } else {
                $this->render("editInvAdvisoryUserDetails", array('userData' => $userData));
            }
            //echo "<pre>"; print_r($userData); die;


        }
    }

    public function actionupdateInvAdvisoryUserDetails()
    {   //echo "<pre>"; print_r($_REQUEST); die;
        $this->isLogin();
        try {
            $userDetails = array();
            $loanDetails = array();
            $invRefDetails = array();

            if(isset($_REQUEST['user_ref_id']) && $_REQUEST['user_ref_id']!='')
            {
                $user_ref_id = $_REQUEST['user_ref_id'];

                $userDetails['user_ref_id'] = $user_ref_id;
                $userDetails['full_name'] = $_REQUEST['fullName'];
                $userDetails['phone_number'] = $_REQUEST['phoneNumber'];

                if(isset($_REQUEST['email']) && $_REQUEST['email']!='')
                {
                    $userDetails['email'] = $_REQUEST['email'];
                }

                $userDetails['annual_income'] = $_REQUEST['annualIncome'];
                $userDetails['street'] = $_REQUEST['street'];
                $userDetails['city'] = $_REQUEST['city'];
                $userDetails['state'] = $_REQUEST['state'];
                $userDetails['pincode'] = $_REQUEST['pincode'];
                $userDetails['modified_at'] = date("Y-m-d H:i:s");

                $tblUserRefObj = new TblUserRefrence();
                $tblUserRefObj->setData($userDetails);
                $tblUserRefObj->insertData($user_ref_id);

            }

            if(isset($_REQUEST['inv_id']) && $_REQUEST['inv_id'])
            {
                $inv_id = $_REQUEST['inv_id'];

                $loanDetails['inv_id'] = $inv_id;
                $loanDetails['inv_amount'] = $_REQUEST['invAmount'];
                $loanDetails['inv_type'] = $_REQUEST['inv_type'];
                $loanDetails['inv_transaction_date'] = date("Y-m-d H:i:s");

                if(isset($_REQUEST['description']) && $_REQUEST['description']!='')
                {
                    $loanDetails['description'] = $_REQUEST['description'];
                }
                $loanDetails['modified_at'] = date("Y-m-d H:i:s");
                $loanDetails['status'] = 1;

                $tblInvTransObj = new TblInvestmentTransaction();
                $tblInvTransObj->setData($loanDetails);
                $tblInvTransObj->insertData($inv_id);
            }
            else
            {
                $loanDetails['inv_amount'] = $_REQUEST['invAmount'];
                $loanDetails['inv_type'] = $_REQUEST['inv_type'];
                $loanDetails['inv_transaction_date'] = date("Y-m-d H:i:s");

                if(isset($_REQUEST['description']) && $_REQUEST['description']!='')
                {
                    $loanDetails['description'] = $_REQUEST['description'];
                }
                $loanDetails['created_at'] = date("Y-m-d H:i:s");
                $loanDetails['status'] = 1;

                $tblInvTransObj = new TblInvestmentTransaction();
                $tblInvTransObj->setData($loanDetails);
                $inv_id = $tblInvTransObj->insertData();
            }
            //echo $inv_id; die;
            if(isset($_REQUEST['inv_tran_ref_id']) && $_REQUEST['inv_tran_ref_id']!='')
            {
                $inv_tran_ref_id = $_REQUEST['inv_tran_ref_id'];
                $invRefDetails['inv_id'] = $inv_id;
                $invRefDetails['inv_stage_id'] = $_REQUEST['inv_stage'];
                $invRefDetails['stage_transaction_date'] = date("Y-m-d H:i:s");

                $invRefDetails['modified_at'] = date("Y-m-d H:i:s");

                $tblInvTransRefObj = new TblInvTransReference();
                $tblInvTransRefObj->setData($invRefDetails);
                $tblInvTransRefObj->insertData($inv_tran_ref_id);
            }
            else
            {   //echo "else"; die;
                $invRefDetails['inv_id'] = $inv_id;
                $invRefDetails['inv_stage_id'] = $_REQUEST['inv_stage'];
                $invRefDetails['stage_transaction_date'] = date("Y-m-d H:i:s");

                $invRefDetails['created_at'] = date("Y-m-d H:i:s");

                $tblInvTransRefObj = new TblInvTransReference();
                $tblInvTransRefObj->setData($invRefDetails);
                $inv_tran_ref_id = $tblInvTransRefObj->insertData();
            }

            Yii::app()->user->setFlash('success', "Successfully updated user details");
            $this->redirect(array("admin/invAdvisoryUserListing"));
        }
        catch(Exception $e)
        {
            //$transaction->rollback();
            Yii::app()->user->setFlash('error', $e->getMessage());
            $this->redirect(array("admin/invAdvisoryUserListing"));
        }
    }

    /*investment advisory applied user listing, edit, change stage status code end here*/


    /*Real estate or property applied user listing, edit, change stage status code start here*/

    public function actionrealEstateUserListing()
    {
        //echo "<pre>"; print_r($_REQUEST); die;
        $this->isLogin();

        $filter=array();
        $filter['date_from']='';$filter['date_to']='';

        if(isset($_REQUEST['menu_id']) && $_REQUEST['menu_id'] != "")
        {
            Yii::app()->session['current_menu_id'] = $_REQUEST['menu_id'];
        }

        if(isset($_REQUEST['menu_id']) && $_REQUEST['menu_id']  != '')
        {
            Yii::app()->session['menu_id'] = $_REQUEST['menu_id'];
        }

        Yii::app()->session['current'] = 'realEstateUserList';
        Yii::app()->session['breadcums'] = 'realEstateUserList';
        if(!isset($_REQUEST['sortType']))
        {
            $_REQUEST['sortType']='asc';
        }
        if(!isset($_REQUEST['sortBy']))
        {
            $_REQUEST['sortBy']='ur.user_ref_id';
        }
        if(!isset($_REQUEST['keyword']))
        {
            $_REQUEST['keyword']='';
        }

        $_REQUEST['currentSortType'] = $_REQUEST['sortType'];

        if($_REQUEST['sortType'] == 'asc')
        {
            $ext['sortType']='desc';
        }
        if($_REQUEST['sortType'] == 'desc')
        {
            $ext['sortType']='asc';
        }

        $ext['page'] = "";

        if(isset($_REQUEST['page']) && $_REQUEST['page']!=''){
            $ext['page'] = $_REQUEST['page'];
        }

        if(isset($_REQUEST['date_from']) && $_REQUEST['date_from'] != "")
        {
            $filter['date_from'] = date("Y-m-d",strtotime($_REQUEST['date_from']));
        }
        if(isset($_REQUEST['date_to']) && $_REQUEST['date_to'] != "")
        {
            $filter['date_to'] = date("Y-m-d",strtotime($_REQUEST['date_to']));
        }
        $ext['filterData'] = $filter;

        $ext['keyword'] = $_REQUEST['keyword'];
        $ext['sortBy'] = $_REQUEST['sortBy'];
        $ext['currentSortType'] = $_REQUEST['currentSortType'];

        $TbluserRefObj = new TblUserRefrence();
        $realEstateAppliedUserData = $TbluserRefObj->getAllrealEstateLoanAppliedUserPaginated(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$filter);

        $data['pagination']	= $realEstateAppliedUserData['pagination'];
        $data['realEstateUserList'] = $realEstateAppliedUserData['realEstateUserList'];

        //print "<pre>"; print_r($data); die;

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        {
            //$this->renderPartial("projectListingAjax", array('data'=>$data,'ext'=>$ext));
            $this->renderPartial("realEstateAppliedUserListing", array('data'=>$data,'ext'=>$ext));
        }
        else
        {
            $this->render("realEstateAppliedUserListing", array("data"=>$data,'ext'=>$ext ));
        }
    }

    public function actionchangeRealEstateStageStatus()
    {
        if(isset($_POST['FormSubmit']))
        {
            try{
                if(isset($_REQUEST['user_ref_id']) && $_REQUEST['user_ref_id']!="") {

                    $user_ref_id = $_REQUEST['user_ref_id'];
                    $prop_stage_id = $_POST['prop_stage_id'];

                    $tblpropTransObj = new TblPropertyTransaction();
                    $data = $tblpropTransObj->getDetailsByUserRefId($user_ref_id);

                    $transactionData = array();
                    $transactionData['property_id'] = $data['property_transaction_id'];
                    $transactionData['property_stage_id'] = $prop_stage_id;
                    $transactionData['prop_stage_transaction_date'] = date("Y-m-d H:i:s");
                    //$transactionData['status'] = 1;

                    if(isset($_REQUEST['prop_tran_ref_id']) && $_REQUEST['prop_tran_ref_id']!='')
                    {
                        $prop_tran_ref_id = $_REQUEST['prop_tran_ref_id'];
                        $transactionData['modified_at'] = date("Y-m-d H:i:s");
                        //echo "<pre>"; print_r($transactionData); die;
                        $tblTransRefObj = new TblPropTransReference();
                        $tblTransRefObj->setData($transactionData);
                        $tblTransRefObj->insertData($prop_tran_ref_id);
                    }
                    else {
                        $transactionData['created_at'] = date("Y-m-d H:i:s");

                        $tblTransRefObj = new TblPropTransReference();
                        $tblTransRefObj->setData($transactionData);
                        $prop_tran_ref_id = $tblTransRefObj->insertData();
                    }
                }

                $this->response(array("message" => "Successfully changed status", "message_type" => "success"));
                //Yii::app()->user->setFlash('success', "Successfully changed status");
                $this->redirect(array("admin/realEstateUserListing"));
            }
            catch(Exception $e)
            {
                //$transaction->rollback();
                $this->response(array("message" => $e->getMessage(), "message_type" => "error"));
                //Yii::app()->user->setFlash('error', $e->getMessage());
                $this->redirect(array("admin/realEstateUserListing"));
            }
        }
        else
        {
            $this->response(array("message" => "Error while change stage,Please try again.", "message_type" => "error"));
        }

    }

    public function actioneditRealEstateUserDetails()
    {   //echo "<pre>"; print_r($_REQUEST); die;
        $this->isLogin();
        Yii::app()->session['current'] = 'userDetails';
        Yii::app()->session['breadcums'] = 'userDetails';

        $userData = array();
        $user_id = Yii::app()->session[_SITENAME_ . '_admin'];

        if(isset($_REQUEST['user_ref_id']) && $_REQUEST['user_ref_id']!='')
        {
            $user_ref_id = $_REQUEST['user_ref_id'];

            $tblUserRefObj = new TblUserRefrence();
            $userData = $tblUserRefObj->getUserdetailsbyId($user_ref_id);

            $tblPropTransactionObj = new TblPropertyTransaction();
            $userData['prop_data'] = $tblPropTransactionObj->getDetailsByUserRefId($user_ref_id);
            //echo "<pre>"; print_r($userData['prop_data']); die;

            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

                $this->renderPartial("editRealEstateUserDetails", array('userData' => $userData));
            } else {
                $this->render("editRealEstateUserDetails", array('userData' => $userData));
            }
            //echo "<pre>"; print_r($userData); die;

        }
    }

    public function actionupdateRealEstateUserDetails()
    {   //echo "<pre>"; print_r($_REQUEST); die;
        $this->isLogin();
        try {
            $userDetails = array();
            $propDetails = array();
            $propRefDetails =  array();

            if(isset($_REQUEST['user_ref_id']) && $_REQUEST['user_ref_id']!='')
            {
                $user_ref_id = $_REQUEST['user_ref_id'];

                $userDetails['user_ref_id'] = $user_ref_id;
                $userDetails['full_name'] = $_REQUEST['fullName'];
                $userDetails['phone_number'] = $_REQUEST['phoneNumber'];

                if(isset($_REQUEST['email']) && $_REQUEST['email']!='')
                {
                    $userDetails['email'] = $_REQUEST['email'];
                }

                $userDetails['annual_income'] = $_REQUEST['annualIncome'];
                $userDetails['street'] = $_REQUEST['street'];
                $userDetails['city'] = $_REQUEST['city'];
                $userDetails['state'] = $_REQUEST['state'];
                $userDetails['pincode'] = $_REQUEST['pincode'];
                $userDetails['modified_at'] = date("Y-m-d H:i:s");

                $tblUserRefObj = new TblUserRefrence();
                $tblUserRefObj->setData($userDetails);
                $tblUserRefObj->insertData($user_ref_id);

            }

            $tblPropertyTransObj = new TblPropertyTransaction();
            $propTransData = $tblPropertyTransObj->getDetailsByUserRefId($user_ref_id);
            //echo "<pre>"; print_r($propTransData); die;

            if(isset($_REQUEST['property_id']) && $_REQUEST['property_id']!='')
            {   //echo "if"; die;
                $property_id = $_REQUEST['property_id'];

                //$propDetails['property_id'] = $property_id;
                $propDetails['property_size'] = $_REQUEST['propSize'];
                $propDetails['property_size_type'] = $_REQUEST['prop_size_type'];
                $propDetails['property_type'] = $_REQUEST['prop_type'];
                //$propDetails['user_ref_id'] = $_REQUEST['user_ref_id'];
                $propDetails['property_transaction_type'] = $_REQUEST['loan_type'];
                $propDetails['status'] = 1;

                if(isset($_REQUEST['prop_sub_type_id']) && $_REQUEST['prop_sub_type_id']!='')
                {
                    $propDetails['property_sub_type'] = $_REQUEST['prop_sub_type_id'];
                }

                if(isset($_REQUEST['description']) && $_REQUEST['description']!='')
                {
                    $propDetails['description'] = $_REQUEST['description'];
                }

                $propDetails['modified_at'] = date("Y-m-d H:i:s");

                $tblPropertyTransObj = new TblPropertyTransaction();
                $tblPropertyTransObj->setData($propDetails);
                $tblPropertyTransObj->insertData($property_id);
            }
            else
            {
                $propDetails['property_size'] = $_REQUEST['propSize'];
                $propDetails['property_size_type'] = $_REQUEST['prop_size_type'];
                $propDetails['property_type'] = $_REQUEST['prop_type'];
                $propDetails['user_ref_id'] = $_REQUEST['user_ref_id'];
                $propDetails['property_transaction_type'] = $_REQUEST['loan_type'];
                $propDetails['status'] = 1;

                if(isset($_REQUEST['prop_sub_type_id']) && $_REQUEST['prop_sub_type_id']!='')
                {
                    $propDetails['property_sub_type'] = $_REQUEST['prop_sub_type_id'];
                }

                if(isset($_REQUEST['description']) && $_REQUEST['description']!='')
                {
                    $propDetails['description'] = $_REQUEST['description'];
                }
                $propDetails['created_at'] = date("Y-m-d H:i:s");

                $tblPropertyTransObj = new TblPropertyTransaction();
                $tblPropertyTransObj->setData($propDetails);
                $property_id = $tblPropertyTransObj->insertData();
            }

            //echo $property_id; die;

            if(isset($_REQUEST['prop_tran_ref_id']) && $_REQUEST['prop_tran_ref_id']!='')
            {
                $prop_tran_ref_id = $_REQUEST['prop_tran_ref_id'];
                $propRefDetails['property_id'] = $property_id;
                $propRefDetails['property_stage_id'] = $_REQUEST['prop_stage'];
                $propRefDetails['prop_stage_transaction_date'] = date("Y-m-d H:i:s");

                $propRefDetails['modified_at'] = date("Y-m-d H:i:s");

                $tblPropertyTransRefObj = new TblPropTransReference();
                $tblPropertyTransRefObj->setData($propRefDetails);
                $tblPropertyTransRefObj->insertData($prop_tran_ref_id);
            }
            else
            {
                $propRefDetails['property_id'] = $property_id;
                $propRefDetails['property_stage_id'] = $_REQUEST['prop_stage'];
                $propRefDetails['prop_stage_transaction_date'] = date("Y-m-d H:i:s");

                $propRefDetails['created_at'] = date("Y-m-d H:i:s");

                $tblPropertyTransRefObj = new TblPropTransReference();
                $tblPropertyTransRefObj->setData($propRefDetails);
                $prop_tran_ref_id = $tblPropertyTransRefObj->insertData();
            }
            //echo $prop_tran_ref_id; die;
            Yii::app()->user->setFlash('success', "Successfully updated user details");
            $this->redirect(array("admin/realEstateUserListing"));
        }
        catch(Exception $e)
        {
            //$transaction->rollback();
            Yii::app()->user->setFlash('error', $e->getMessage());
            $this->redirect(array("admin/realEstateUserListing"));
        }
    }

    /*Real estate or property applied user listing, edit, change stage status code end here*/

    public function actiongetBankLoanSubType()
    {   //echo "<pre>"; print_r($_REQUEST['loan_type']); die;
        $this->isLogin();
        if (isset($_REQUEST['loan_type']) && $_REQUEST['loan_type'] != '') {
            $result = "";
            //if ($_REQUEST['loan_type'] == 3) {
                $TblLoanTypeMasterObj = new TblLoanTypeMaster();
                $get_loan_sub_type_list = $TblLoanTypeMasterObj->getBankSubLoanTypeListById($_REQUEST['loan_type']);

                if (!empty($get_loan_sub_type_list)) {
                    foreach ($get_loan_sub_type_list as $row_sub_list) {
                        $result .= '<option value="' . $row_sub_list["loan_type_id"] . '">' . $row_sub_list["description"] . '</option>';
                    }
                }
            echo $result;
        }
        else{
            echo "false";
        }
    }

    public function actiongetRealEstateLoanSubType()
    {   //echo "<pre>"; print_r($_REQUEST['loan_type']); die;
        $this->isLogin();
        if (isset($_REQUEST['loan_type']) && $_REQUEST['loan_type'] != '') {
            $result = "";
            //if ($_REQUEST['loan_type'] == 3) {
            $TblPropertyTypeMasterObj = new TblPropertyTypeMaster();
            $get_loan_sub_type_list = $TblPropertyTypeMasterObj->getPropertySubLoanTypeListById($_REQUEST['loan_type']);
            //echo "<pre>"; print_r($get_loan_sub_type_list); die;
            if (!empty($get_loan_sub_type_list)) {
                foreach ($get_loan_sub_type_list as $row_sub_list) {
                    $result .= '<option value="' . $row_sub_list["property_type_id"] . '">' . $row_sub_list["description"] . '</option>';
                }
            }
            echo $result;
        }
        else{
            echo "false";
        }
    }


    /* export report functionality*/

    public function actionsendExportOfBankLoanUser()
    {
        error_reporting(E_ALL);
        $from_date = $_REQUEST['fromExportDate'];
        $to_date = $_REQUEST['toExportDate'];

        $this->actionbankLoanAppliedUserOfSelectedMonth($from_date, $to_date);

        $file = "assets/reports/monthlyBankLoanReport/monthlyBankLoanAppliedUsers_" . date("M-Y") . ".xlsx";

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        flush(); // Flush system output buffer
        readfile($file);
        $this->redirect(array("admin/bankLoanUserListing"));


    }

    function actionbankLoanAppliedUserOfSelectedMonth($from_date = NULL, $to_date = NULL) {

        $body = '<table cellpadding="5" cellspacing="5">
				<tr><td><b>Bank Loan Applied Users</b></td>
				</tr>
		';

        $resolvedTasksData = '<tr><td><table align="center" width="100%"><tr>
                               <td colspan="2" style="line-height:20px;padding:10px 0 10px 10px;font-weight:bold;color:#666;font-size:14px;vertical-align:top;">
                                <table border="1" bordercolor="#CED7E0" width="100%" cellpadding="1" cellspacing="1" style="text-align:center">
                                <tr style="font-size:12px">
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                </tr>
								<tr style="font-size:18px;background-color:#CED7E0;">
									<td style="text-align:center"><b>User ID<b></td>
									<td style="text-align:center">User Name</td>
									<td style="text-align:center">Reference By</td>
									<td style="text-align:center">Phone Number</td>
									<td style="text-align:center">Annual Income</td>
									<td style="text-align:center">Loan Amount</td>
									<td style="text-align:center">Loan Type</td>
									<td style="text-align:center">Loan Sub Type</td>
									<td style="text-align:center">Loan Stage</td>
									<td style="text-align:center">Created Date</td>
                                </tr>';

        $tblUserRefObj = new TblUserRefrence();
        $bank_loan_user_data = $tblUserRefObj->getBankLoanUsersForReport($from_date, $to_date);
        //echo "<pre>"; print_r($bank_loan_user_data); die;

        if (!empty($bank_loan_user_data)) {
            foreach ($bank_loan_user_data as $val) {
                $resolvedTasksData .= '<tr style="font-size:14px">
                                        <td style="text-align:center">' . $val['user_ref_id'] . '</td>
                                        <td style="text-align:center">' . $val['full_name'] . '</td>
                                        <td style="text-align:center">' . $val['referenceBy'] . '</td>
                                        <td style="text-align:center">' . $val['phone_number'] . '</td>
                                        <td style="text-align:center">' . $val['annual_income'] . '</td>
                                        <td style="text-align:center">' . $val['loan_amount'] . '</td>
                                        <td style="text-align:center">' . $val['loan_type_name'] . '</td>
                                        <td style="text-align:center">' . $val['loan_sub_type_name'] . '</td>
                                        
                                        <td style="text-align:center">' . $val['loan_stage_name']  . '</td>
                                        <td style="text-align:center">' . date("Y-m-d",strtotime($val['createdDate'])) . '</td>      
                                    </tr>';
                }
            }


            $resolvedTasksData .= '</table></td></tr></table></td></tr>';

        $body .= $resolvedTasksData;
        $body .= "</table>";
        //echo $body;die;

        if (!file_exists('assets/reports/monthlyBankLoanReport')) {
            mkdir('assets/reports/monthlyBankLoanReport', 0777, true);
        }
        $file = "assets/reports/monthlyBankLoanReport/monthlyBankLoanAppliedUsers_" . date("M-Y") . ".xlsx";

        // save $table inside temporary file that will be deleted later
        $tmpfile = tempnam(sys_get_temp_dir(), 'html');
        file_put_contents($tmpfile, $body);

        //Code added by priyank on 22-sep-16
        $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '666666'),
                'size' => 12,
                'name' => 'Verdana'
            ),
            'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
        );
        //Code end
        // insert $table into $objPHPExcel's Active Sheet through $excelHTMLReader
        error_reporting(0);
        $objPHPExcel = new PHPExcel();

        $excelHTMLReader = PHPExcel_IOFactory::createReader('HTML');
        $excelHTMLReader->loadIntoExisting($tmpfile, $objPHPExcel);
        $objPHPExcel->getActiveSheet()->setTitle('Monthly Employee Effrots'); // Change sheet's title if you want
        //Code added by priyank on 22-sep-16
        for ($col = 'A'; $col !== 'Q'; $col++) {
            $objPHPExcel->getActiveSheet()
                ->getColumnDimension($col)
                ->setAutoSize(true);
            $lastrow = $objPHPExcel->getActiveSheet()->getHighestRow();

            $objPHPExcel->getActiveSheet()
                ->getStyle($col . '1:' . $col . $lastrow)
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $objPHPExcel->getActiveSheet()->getStyle($col . "1")->applyFromArray($styleArray);
        }
        //Code end

        unlink($tmpfile); // delete temporary file because it isn't needed anymore
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($file);

        return $file;
    }


    public function actionsendExportOfInvestmentLoanUser()
    {
        error_reporting(E_ALL);
        $from_date = $_REQUEST['fromExportDate'];
        $to_date = $_REQUEST['toExportDate'];

        $this->actionInvestmentLoanAppliedUserOfSelectedMonth($from_date, $to_date);

        $file = "assets/reports/monthlyInvestmentLoanReport/monthlyInvestmentLoanAppliedUsers_" . date("M-Y") . ".xlsx";

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        flush(); // Flush system output buffer
        readfile($file);
        $this->redirect(array("admin/invAdvisoryUserListing"));
    }

    function actionInvestmentLoanAppliedUserOfSelectedMonth($from_date = NULL, $to_date = NULL) {

        $body = '<table cellpadding="5" cellspacing="5">
				<tr><td><b>Investment Advisory Loan Applied Users</b></td>
				</tr>
		';

        $resolvedTasksData = '<tr><td><table align="center" width="100%"><tr>
                               <td colspan="2" style="line-height:20px;padding:10px 0 10px 10px;font-weight:bold;color:#666;font-size:14px;vertical-align:top;">
                                <table border="1" bordercolor="#CED7E0" width="100%" cellpadding="1" cellspacing="1" style="text-align:center">
                                <tr style="font-size:12px">
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                </tr>
								<tr style="font-size:18px;background-color:#CED7E0;">
									<td style="text-align:center"><b>User Reference ID<b></td>
									<td style="text-align:center">User Name</td>
									<td style="text-align:center">Reference By</td>
									<td style="text-align:center">Phone Number</td>
									<td style="text-align:center">Annual Income</td>
									<td style="text-align:center">Investment Amount</td>
									<td style="text-align:center">Investment Type</td>
									<td style="text-align:center">Investment Advisory Stage</td>
									<td style="text-align:center">Created Date</td>
                                </tr>';

        $tblUserRefObj = new TblUserRefrence();
        $inv_loan_user_data = $tblUserRefObj->getInvLoanUsersForReport($from_date, $to_date);
        //echo "<pre>"; print_r($inv_loan_user_data); die;

        if (!empty($inv_loan_user_data)) {
            foreach ($inv_loan_user_data as $val) {
                $resolvedTasksData .= '<tr style="font-size:14px">
                                        <td style="text-align:center">' . $val['user_ref_id'] . '</td>
                                        <td style="text-align:center">' . $val['full_name'] . '</td>
                                        <td style="text-align:center">' . $val['referenceBy'] . '</td>
                                        <td style="text-align:center">' . $val['phone_number'] . '</td>
                                        <td style="text-align:center">' . $val['annual_income'] . '</td>
                                        <td style="text-align:center">' . $val['inv_amount'] . '</td>
                                        <td style="text-align:center">' . $val['inv_type_name'] . '</td>
                                        <td style="text-align:center">' . $val['inv_stage_name'] . '</td>
                                        <td style="text-align:center">' . date("Y-m-d",strtotime($val['createdDate'])) . '</td>      
                                    </tr>';
            }
        }


        $resolvedTasksData .= '</table></td></tr></table></td></tr>';

        $body .= $resolvedTasksData;
        $body .= "</table>";
        //echo $body;die;

        if (!file_exists('assets/reports/monthlyInvestmentLoanReport')) {
            mkdir('assets/reports/monthlyInvestmentLoanReport', 0777, true);
        }
        $file = "assets/reports/monthlyInvestmentLoanReport/monthlyInvestmentLoanAppliedUsers_" . date("M-Y") . ".xlsx";

        // save $table inside temporary file that will be deleted later
        $tmpfile = tempnam(sys_get_temp_dir(), 'html');
        file_put_contents($tmpfile, $body);

        //Code added by priyank on 22-sep-16
        $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '666666'),
                'size' => 12,
                'name' => 'Verdana'
            ),
            'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
        );
        //Code end
        // insert $table into $objPHPExcel's Active Sheet through $excelHTMLReader
        error_reporting(0);
        $objPHPExcel = new PHPExcel();

        $excelHTMLReader = PHPExcel_IOFactory::createReader('HTML');
        $excelHTMLReader->loadIntoExisting($tmpfile, $objPHPExcel);
        $objPHPExcel->getActiveSheet()->setTitle('Monthly Employee Effrots'); // Change sheet's title if you want
        //Code added by priyank on 22-sep-16
        for ($col = 'A'; $col !== 'Q'; $col++) {
            $objPHPExcel->getActiveSheet()
                ->getColumnDimension($col)
                ->setAutoSize(true);
            $lastrow = $objPHPExcel->getActiveSheet()->getHighestRow();

            $objPHPExcel->getActiveSheet()
                ->getStyle($col . '1:' . $col . $lastrow)
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $objPHPExcel->getActiveSheet()->getStyle($col . "1")->applyFromArray($styleArray);
        }
        //Code end

        unlink($tmpfile); // delete temporary file because it isn't needed anymore
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($file);

        return $file;
    }


    public function actionsendExportOfRealEstateLoanUser()
    {
        error_reporting(E_ALL);
        $from_date = $_REQUEST['fromExportDate'];
        $to_date = $_REQUEST['toExportDate'];

        $this->actionRealEstateLoanAppliedUserOfSelectedMonth($from_date, $to_date);

        $file = "assets/reports/monthlyRealEstateLoanReport/monthlyRealEstateLoanAppliedUsers_" . date("M-Y") . ".xlsx";

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        flush(); // Flush system output buffer
        readfile($file);
        $this->redirect(array("admin/realEstateUserListing"));
    }

    function actionRealEstateLoanAppliedUserOfSelectedMonth($from_date = NULL, $to_date = NULL) {

        $body = '<table cellpadding="5" cellspacing="5">
				<tr><td><b>Real Estate Loan Applied Users</b></td>
				</tr>
		';

        $resolvedTasksData = '<tr><td><table align="center" width="100%"><tr>
                               <td colspan="2" style="line-height:20px;padding:10px 0 10px 10px;font-weight:bold;color:#666;font-size:14px;vertical-align:top;">
                                <table border="1" bordercolor="#CED7E0" width="100%" cellpadding="1" cellspacing="1" style="text-align:center">
                                <tr style="font-size:12px">
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                </tr>
								<tr style="font-size:18px;background-color:#CED7E0;">
									<td style="text-align:center"><b>User Reference ID<b></td>
									<td style="text-align:center">User Name</td>
									<td style="text-align:center">Reference By</td>
									<td style="text-align:center">Phone Number</td>
									<td style="text-align:center">Annual Income</td>
									<td style="text-align:center">Property Type</td>
									<td style="text-align:center">Property Size</td>
									<td style="text-align:center">Property Size Unit</td>
									<td style="text-align:center">Real Estate Loan Type</td>
									<td style="text-align:center">Stage</td>
									<td style="text-align:center">Created Date</td>
                                </tr>';

        $tblUserRefObj = new TblUserRefrence();
        $prop_loan_user_data = $tblUserRefObj->getRealEstateLoanUsersForReport($from_date, $to_date);
        //echo "<pre>"; print_r($prop_loan_user_data); die;

        if (!empty($prop_loan_user_data)) {
            foreach ($prop_loan_user_data as $val) {

                if(isset($val['property_type']) && $val['property_type']=1)
                {
                    $property_type = "New";
                }
                else
                {
                    $property_type = "Old";
                }

                $resolvedTasksData .= '<tr style="font-size:14px">
                                        <td style="text-align:center">' . $val['user_ref_id'] . '</td>
                                        <td style="text-align:center">' . $val['full_name'] . '</td>
                                        <td style="text-align:center">' . $val['referenceBy'] . '</td>
                                        <td style="text-align:center">' . $val['phone_number'] . '</td>
                                        <td style="text-align:center">' . $val['annual_income'] . '</td>
                                        <td style="text-align:center">' . $property_type . '</td>
                                        <td style="text-align:center">' . $val['property_size'] . '</td>
                                        <td style="text-align:center">' . $property_type . '</td>
                                        <td style="text-align:center">' . $val['size_type_name'] . '</td>
                                        <td style="text-align:center">' . $val['prop_stage_name'] . '</td>
                                        <td style="text-align:center">' . date("Y-m-d",strtotime($val['createdDate'])) . '</td>      
                                    </tr>';
            }
        }


        $resolvedTasksData .= '</table></td></tr></table></td></tr>';

        $body .= $resolvedTasksData;
        $body .= "</table>";
        //echo $body;die;

        if (!file_exists('assets/reports/monthlyRealEstateLoanReport')) {
            mkdir('assets/reports/monthlyRealEstateLoanReport', 0777, true);
        }
        $file = "assets/reports/monthlyRealEstateLoanReport/monthlyRealEstateLoanAppliedUsers_" . date("M-Y") . ".xlsx";

        // save $table inside temporary file that will be deleted later
        $tmpfile = tempnam(sys_get_temp_dir(), 'html');
        file_put_contents($tmpfile, $body);

        //Code added by priyank on 22-sep-16
        $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '666666'),
                'size' => 12,
                'name' => 'Verdana'
            ),
            'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
        );
        //Code end
        // insert $table into $objPHPExcel's Active Sheet through $excelHTMLReader
        error_reporting(0);
        $objPHPExcel = new PHPExcel();

        $excelHTMLReader = PHPExcel_IOFactory::createReader('HTML');
        $excelHTMLReader->loadIntoExisting($tmpfile, $objPHPExcel);
        $objPHPExcel->getActiveSheet()->setTitle('Monthly Employee Effrots'); // Change sheet's title if you want
        //Code added by priyank on 22-sep-16
        for ($col = 'A'; $col !== 'Q'; $col++) {
            $objPHPExcel->getActiveSheet()
                ->getColumnDimension($col)
                ->setAutoSize(true);
            $lastrow = $objPHPExcel->getActiveSheet()->getHighestRow();

            $objPHPExcel->getActiveSheet()
                ->getStyle($col . '1:' . $col . $lastrow)
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $objPHPExcel->getActiveSheet()->getStyle($col . "1")->applyFromArray($styleArray);
        }
        //Code end

        unlink($tmpfile); // delete temporary file because it isn't needed anymore
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($file);

        return $file;
    }
}



