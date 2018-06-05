<?php

/**

 * Copyright (c) 2011 All Right Reserved, Todooli, Inc.

 *

 * This source is subject to the Todooli Permissive License. Any Modification

 * must not alter or remove any copyright notices in the Software or Package,

 * generated or otherwise. All derivative work as well as any Distribution of

 * this asis or in Modified

form or derivative requires express written consent

 * from Todooli, Inc.

 *

 *

 * THIS CODE AND INFORMATION ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY

 * KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE

 * IMPLIED WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A

 * PARTICULAR PURPOSE.

 *

 *

**/ 

class Validation extends CFormModel 

{
	/*
	Validation for Seeker Sign Up Form
	PARAM : Array of Post Data
	*/
	public $msg;
	public $errorCode;


	public function __construct()
	{
		$this->msg = Yii::app()->params->msg;
		$this->errorCode = Yii::app()->params->errorCode;
	}


	function checkDateTime($data) {
		if (date('Y-m-d', strtotime($data)) == $data && date('Y-m-d', strtotime($data)) >= date('Y-m-d') ) {
            return true;
		} else {
			return false;
		}
	}	
	

	function signup($POST,$isBulkUpload=0)
	{
		$_POST = $POST;
		$validator	=	new FormValidator();
		$diveUserObj = new DiveUser();
		$generalObj	=	new General();
		
		$validator->addValidation("firstname","req",'_FNAME_VALIDATE_ACCOUNTMANAGER_');
		$validator->addValidation("firstname","name",'_FNAME_VALIDATE_SPECIAL_CHAR_');
		$validator->addValidation("firstname","maxlen=50",'_FNAME_VALIDATE_LENGTH_');
		$validator->addValidation("lastname","req",'_LNAME_VALIDATE_ACCOUNTMANAGER_');
		$validator->addValidation("lastname","name",'_LNAME_VALIDATE_SPECIAL_CHAR_');
		$validator->addValidation("lastname","req",'_LNAME_VALIDATE_LENGTH_');
		$validator->addValidation("username","maxlen=50",'_FNAME_VALIDATE_ACCOUNTMANAGER_');
		$validator->addValidation("password","req",'_PASSWORD_VALIDATE_ACCOUNTMANAGER_');
		$validator->addValidation("password","maxlen=50",'_PASSWORD_VALIDATE_LENGTH_');
		$validator->addValidation("email","email",'_INVALID_EMAIL_');
		$validator->addValidation("password","minlen=6",'_PASSWORD_LENGTH_VALIDATE_ACCOUNTMANAGER_');

	
		if(!isset($_POST['username']))
		{
			if(isset($_POST['username']))
			{
				$validator->addValidation("username","req",'_EMAIL_VALIDATE_ACCOUNT_MANAGER_');
			}

			if(!isset($_POST['username']))
			{
				$validator->addValidation("username","req",'_EMAIL_VALIDATE_ACCOUNT_MANAGER_');
			}
		}

		if(isset($_POST['username']))
		{
			if($_POST['username']=='')
			{
				$validator->addValidation("username","req",'_EMAIL_VALIDATE_ACCOUNT_MANAGER_');
			}
		}
		if(isset($_POST['username']) && $_POST['username']!='' && trim($_POST['username'])!=$this->msg['_USERNAME_'])
		{
			$validator->addValidation("username","username",'_USRENAME_VALIDATE_ARTIST_');
			$result = $diveUserObj->checkOtherUsername($_POST['username'],'',1);

			if(!empty($result)){
				$validator->addValidation("email_unique","req",'_USERNAME_ALREADY_AVAILABLE_');
			}
			$result = $diveUserObj->checkOtherEmail($_POST['email'],'',1);
			if(!empty($result)){
				$validator->addValidation("email_unique","req",'_EMAIL_ALREADY_AVAILABLE_');
			}
		}
		if(!$validator->ValidateForm())
		{
			$error_hash = $validator->GetError();
			if($this->errorCode[$error_hash] == 164)
			{
				/*$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash],'alternate_address'=>$coord['alternate_address']);*/
			}
			else
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
			}
			return $status;
		}
		else
		{
			return array('status'=>0,'message'=>'success');
		}
	}
	



	/*
	Validation for Forgot Password Form
	PARAM : Array of Post Data
	*/
    function forgot_password($POST)
    {
        $_POST = $POST;
        $validator = new FormValidator();
        $validator->addValidation("email","req",'_REQ_EMAIL_');
        $validator->addValidation("email","email",'_VALID_EMAIL_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }


	/*
	Validation for Reset Password Form
	PARAM : Array of Post Data
	*/
	function resetpassword($POST)
	{
		 $_POST = $POST;

		 $validator = new FormValidator();

		 $validator->addValidation("token","req",'VALIDATE_TOKEN');

		 $validator->addValidation("new_password","req",'_PASSWORD_VALIDATE_ACCOUNTMANAGER_');

		 $validator->addValidation("new_password","minlen=6",'_VALIDATE_PASSWORD_GT_6_');

		 $validator->addValidation("new_password_confirm","req",'_PASSWORD_CVALIDATE_ACCOUNTMANAGER_');

		 $validator->addValidation("new_password_confirm","minlen=6",'_VALIDATE_PASSWORD_GT_6_');

		 if(trim($_POST['new_password'])!=trim($_POST['new_password_confirm']))
  		{
     		$validator->addValidation("matchpassword","req",'_VALIDATE_PASS_CPASS_MATCH_');
  		}


		if(!$validator->ValidateForm())
		 {
			$error_hash = $validator->GetError();

			$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);

	 		return $status;
		 }
		 else
		 {
			return array('status'=>0,'message'=>'success');
		 }
	}

	function is_valid_email($email)
	{
		$result = TRUE;
		 if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {
			  $result = false;
		  }
		  else {
		  $result = true; }
			return $result;
	}
	function checkArrayDiff($dbArray,$chkArray)
	{
		if(!is_array($dbArray) || !is_array($chkArray) || empty($chkArray))
		{
			return false;
		}

		$result = array_diff($dbArray,$chkArray);

		if(count($result)==count($dbArray))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	 /*Start Code For VIIA Validation*/


    /* ------------------------------------------------------------------------*/
    /*
     * Function Name : updateCustomerPassword
     * Description : For update Customer Password
     * Developer : Rohan Varma
     * Date : 26-05-2017
     */
    function updateUserPassword($POST)
    {
        $_POST = $POST;

        $validator = new FormValidator();

        $validator->addValidation("user_id","req",'_REQ_USER_ID');
        //$validator->addValidation("user_type","req",'_REQ_USER_TYPE_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("old_password","req",'_REQ_OLD_PASSWORD_');
        $validator->addValidation("new_password","req",'_REQ_NEW_PASSWORD_');
        $validator->addValidation("new_password","minlen=6",'_PASSWORD_LENGTH_VALIDATE_');
        $validator->addValidation("new_password_confirm","req",'_CONFIRM_PASSWORD_REQ_');
        $validator->addValidation("new_password_confirm","minlen=6",'_PASSWORD_LENGTH_VALIDATE_');



        if(!$validator->ValidateForm())
        {
            /*if(trim($post['new_password'])!=trim($post['new_password_confirm']))
            {
                $validator->addValidation("matchpassword","req",'_CONFIRM_NEW_PASSWORD_NOT_MATCH_');
            }*/

            $error_hash = $validator->GetError();
            $status = array('status'=>-11,'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }


    function updatechangePassword($POST)
    {
        $_POST = $POST;


        $validator = new FormValidator();
        $validator->addValidation("email","req",'_REQ_EMAIL_');
        //$validator->addValidation("email","email",'_VALID_EMAIL_');
        $validator->addValidation("user_type","req",'_REQ_USER_TYPE_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    /* ------------------------------------------------------------------------*/
    /*
     * Function Name : updateProviderPassword
     * Description : For update Provider Password
     * Developer : Rohan Varma
     * Date : 26-05-2017
     */
    function updateProviderPassword($post)
    {
        $validator = new FormValidator();
        $validator->addValidation("password_new","req",'Password is required.');
        $validator->addValidation("provider_id","req",'Customer id is required.');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>-11,'message'=>$error_hash);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }

    }




    /*======================================= code start by priyank ======================================= */

    function registerCustomer($post,$isBulkUpload=0)
    {

        $_POST = $post;
        $validator = new FormValidator();
        //$TblBusinessObj	=	new TblBusiness();
        $generalObj	= new General();

        //$validator->addValidation("name","req",'_REQ_NAME_');
       // $validator->addValidation("email","req",'_REQ_EMAIL_');
        //$validator->addValidation("email","email",'_VALID_EMAIL_');
        $validator->addValidation("mobile_number","req",'_REQ_MOBILE_NUMBER_');
        $validator->addValidation("password","req",'_REQ_PASSWORD_');
        $validator->addValidation("password","maxlen=50",'_PASSWORD_LENGTH_VALIDATE_');
        /*$validator->addValidation("device_token","req",'_REQ_DEVICE_TOKEN_');*/

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }

    }

    function customerLogin($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();

        $validator->addValidation("mobile_number","req",'_REQ_MOBILE_NUMBER_');
        $validator->addValidation("password","req",'_REQ_PASSWORD_');
        $validator->addValidation("device_token","req",'_REQ_DEVICE_TOKEN_');
        $validator->addValidation("device_type","req",'_DEVICE_TYPE_PARAMS_REQUIRED_');
       // $validator->addValidation("user_type","req",'_REQ_USER_TYPE_');
        $validator->addValidation("endpoint_arn","req",'_REQ_ENDPOINT_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function verifyOTP($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        //$validator->addValidation("user_type","req",'_REQ_USER_TYPE_');
        $validator->addValidation("mobile_number","req",'_REQ_MOBILE_NUMBER_');
        $validator->addValidation("otp_code","req",'_OTP_PARAMS_REQUIRED_');
        $validator->addValidation("device_token","req",'_REQ_DEVICE_TOKEN_');
        $validator->addValidation("device_type","req",'_DEVICE_TYPE_PARAMS_REQUIRED_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function verifyOTPStore($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        //$validator->addValidation("user_type","req",'_REQ_USER_TYPE_');
        $validator->addValidation("mobile_number","req",'_REQ_MOBILE_NUMBER_');
        $validator->addValidation("otp_code","req",'_OTP_PARAMS_REQUIRED_');
        $validator->addValidation("device_token","req",'_REQ_DEVICE_TOKEN_');
        $validator->addValidation("device_type","req",'_DEVICE_TYPE_PARAMS_REQUIRED_');
        $validator->addValidation("store_id","req",'_REQ_STORE_ID_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }



    function verifyForgotPasswordCode($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
       // $validator->addValidation("user_type","req",'_REQ_USER_TYPE_');
        $validator->addValidation("user_id","req",'_REQ_USER_ID_');
        $validator->addValidation("verify_code","req",'_VERIFY_CODE_PARAMS_REQUIRED_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function carrierIsLogin($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	= new FormValidator();

        $validator->addValidation("user_id","req",'_REQ_USER_ID');
       // $validator->addValidation("user_type","req",'_REQ_USER_TYPE_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("is_online","req",'_REQ_IS_ONLINE_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function setCarrierLocation($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	= new FormValidator();

        $validator->addValidation("carrier_id","req",'_REQ_CARRIER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("latitude","req",'_REQ_LATITUDE_');
        $validator->addValidation("longtitude","req",'_REQ_LONGTITUDE_');
        //$validator->addValidation("service_request_id","req",'_REQ_SERVICE_REQUEST_ID_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function StoreIsLogin($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	= new FormValidator();

        $validator->addValidation("store_id","req",'_REQ_STORE_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("is_online","req",'_REQ_IS_ONLINE_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function getCategoryList($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	= new FormValidator();

        $validator->addValidation("customer_id","req",'_REQ_USER_ID');
        //$validator->addValidation("user_type","req",'_REQ_USER_TYPE_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function resetPasswordAPI($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        //$validator->addValidation("user_type","req",'_REQ_USER_TYPE_');
        $validator->addValidation("user_id","req",'_REQ_USER_ID_');
        $validator->addValidation("password","req",'_REQ_PASSWORD_');
        $validator->addValidation("password","maxlen=50",'_PASSWORD_LENGTH_VALIDATE_');
        $validator->addValidation("device_token","req",'_REQ_DEVICE_TOKEN_');
        $validator->addValidation("endpoint_arn","req",'_REQ_ENDPOINT_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function reSendOTP($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
       // $validator->addValidation("user_type","req",'_REQ_USER_TYPE_');
        //$validator->addValidation("mobile_number","req",'_REQ_MOBILE_NUMBER_');
        //$validator->addValidation("otp_code","req",'_OTP_PARAMS_REQUIRED_');
        $validator->addValidation("device_token","req",'_REQ_DEVICE_TOKEN_');
        $validator->addValidation("device_type","req",'_DEVICE_TYPE_PARAMS_REQUIRED_');
        $validator->addValidation("store_id","req",'_REQ_STORE_ID_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function reSendOTPOther($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        // $validator->addValidation("user_type","req",'_REQ_USER_TYPE_');
        //$validator->addValidation("mobile_number","req",'_REQ_MOBILE_NUMBER_');
        //$validator->addValidation("otp_code","req",'_OTP_PARAMS_REQUIRED_');
        $validator->addValidation("device_token","req",'_REQ_DEVICE_TOKEN_');
        $validator->addValidation("device_type","req",'_DEVICE_TYPE_PARAMS_REQUIRED_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function reSendEmail($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("user_type","req",'_REQ_USER_TYPE_');
        $validator->addValidation("email","req",'_REQ_EMAIL_');
        //$validator->addValidation("otp_code","req",'_OTP_PARAMS_REQUIRED_');
        $validator->addValidation("device_token","req",'_REQ_DEVICE_TOKEN_');
        $validator->addValidation("device_type","req",'_DEVICE_TYPE_PARAMS_REQUIRED_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function registerCarrier($post,$isBulkUpload=0)
    {

        $_POST = $post;
        $validator = new FormValidator();
        //$TblBusinessObj	=	new TblBusiness();
        $generalObj	= new General();

        $validator->addValidation("carrier_name","req",'_REQ_NAME_');
        // $validator->addValidation("email","req",'_REQ_EMAIL_');
        //$validator->addValidation("email","email",'_VALID_EMAIL_');
        $validator->addValidation("mobile_number","req",'_REQ_MOBILE_NUMBER_');
        $validator->addValidation("password","req",'_REQ_PASSWORD_');
        $validator->addValidation("password","maxlen=50",'_PASSWORD_LENGTH_VALIDATE_');
        $validator->addValidation("password_confirm","req",'_PASSWORD_CVALIDATE_ACCOUNTMANAGER_');

        $validator->addValidation("password_confirm","minlen=6",'_PASSWORD_LENGTH_VALIDATE_');

        if(isset($_POST['password_confirm']) && isset($_POST['password']) &&  trim($_POST['password'])!=trim($_POST['password_confirm']))
        {
            $validator->addValidation("matchpassword","req",'_VALIDATE_PASS_CPASS_MATCH_');
        }
        //$validator->addValidation("id_number","req",'_REQ_ID_NUMBER_');
        //$validator->addValidation("driving_license","req",'_REQ_LISENCE_NUMBER_');
        $validator->addValidation("bank_account","req",'_REQ_BANK_ACCOUNT_NUMBER_');

        $validator->addValidation("id_number_image","req",'_REQ_ID_NUMBER_IMAGE');
        $validator->addValidation("license_image","req",'_REQ_LISENCE_NUMBER_IMAGE');
        $validator->addValidation("bank_name","req",'_BANK_NAME_');

        $validator->addValidation("latitude","req",'_REQ_LATITUDE_');
        $validator->addValidation("longtitude","req",'_REQ_LONGTITUDE_');
        $validator->addValidation("endpoint_arn","req",'_REQ_ENDPOINT_');

        /*$validator->addValidation("device_token","req",'_REQ_DEVICE_TOKEN_');*/

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }

    }

    function AddAddress($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("address","req",'_REQ_ADDRESS_');
        $validator->addValidation("latitude","req",'_REQ_LATITUDE_');
        $validator->addValidation("longtitude","req",'_REQ_LONGTITUDE_');
        $validator->addValidation("address_type","req",'_REQ_ADDRESS_TYPE_');
        $validator->addValidation("city","req",'_REQ_CITY_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function deleteAddress($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("customer_addres_id","req",'_REQ_CUSTOMER_ADDRESS_ID_');
       // $validator->addValidation("address_type","req",'_REQ_ADDRESS_TYPE_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function EditAddress($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("address","req",'_REQ_ADDRESS_');
        $validator->addValidation("latitude","req",'_REQ_LATITUDE_');
        $validator->addValidation("longtitude","req",'_REQ_LONGTITUDE_');
        $validator->addValidation("city","req",'_REQ_CITY_');
        $validator->addValidation("customer_addres_id","req",'_REQ_CUSTOMER_ADDRESS_ID_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function getStoreList($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("category_id","req",'_REQ_CATEGORY_ID_');
        $validator->addValidation("longitude","req",'_REQ_LONGTITUDE_');
        $validator->addValidation("latitude","req",'_REQ_LATITUDE_');
       // $validator->addValidation("city","req",'_REQ_ADDRESS_TYPE_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function getStoreListForMap($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
           $validator->addValidation("longitude","req",'_REQ_LONGTITUDE_');
        $validator->addValidation("latitude","req",'_REQ_LATITUDE_');
        // $validator->addValidation("city","req",'_REQ_ADDRESS_TYPE_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function getStoreItemList($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("store_id","req",'_REQ_STORE_ID_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function getCartList($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("cart_id","req",'_REQ_CART_ID_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function getRecentAddressList($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');



        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function getCustomerOrderDEtails($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("order_id","req",'_REQ_ORDER_ID_');
        $validator->addValidation("order_type_id","req",'_REQ_ORDER_TYPE_ID_');



        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function getCarrierOrderDetails($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("carrier_id","req",'_REQ_CARRIER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("order_id","req",'_REQ_ORDER_ID_');
        $validator->addValidation("order_type_id","req",'_REQ_ORDER_TYPE_ID_');



        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function getCarrierActiveOrder($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("carrier_id","req",'_REQ_CARRIER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');




        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function CarrierPickedUpOrder($POST)
    {
        $_POST = $POST;
        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("carrier_id","req",'_REQ_CARRIER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("service_request_id","req",'_REQ_SERVICE_REQUEST_ID_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function addBillforCustomOrder($POST)
    {
        $_POST = $POST;
        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("carrier_id","req",'_REQ_CARRIER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("order_id","req",'_REQ_ORDER_ID_');
        $validator->addValidation("order_total","req",'_REQ_CUSTOM_ORDER_TOTAL_');
        //$validator->addValidation("bill_image","req",'_REQ_BILL_IMAGE_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function getCustomerInvoiceDetails($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("order_id","req",'_REQ_ORDER_ID_');
        $validator->addValidation("order_type_id","req",'_REQ_ORDER_TYPE_ID_');



        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function getCarrierLocationForcustomer($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("order_id","req",'_REQ_ORDER_ID_');
        $validator->addValidation("order_type_id","req",'_REQ_ORDER_TYPE_ID_');



        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function getCustomerProfile($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function checkvalidpromocode($POST,$isBulkUpload=0)
    {
        $_POST = $POST;
        $validator	=	new FormValidator();
        $generalObj	=	new General();

        if(isset($_POST['order_type_id']) && $_POST['order_type_id'] !="" )
        {
            if($_POST['order_type_id'] ==2 || $_POST['order_type_id'] ==3 ){
                $validator->addValidation("delivery_fee","req",'_REQ_DELIVERY_FEE_');
            }
        }
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("promocode","req",'_REQ_PROMO_CODE_');
        $validator->addValidation("order_type_id","req",'_REQ_ORDER_TYPE_ID_');
       // $validator->addValidation("partner_id","req",'_REQ_PARTNER_ID_');
       // $validator->addValidation("total_amount","req",'_REQ_TOTAL_AMOUNT_FOR_PROMOCODE_');



        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function placedReOrder($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("order_id","req",'_REQ_ORDER_ID_');
        $validator->addValidation("order_type_id","req",'_REQ_ORDER_TYPE_ID_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function PlacedCustomReOrder($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("order_id","req",'_REQ_ORDER_ID_');
        $validator->addValidation("order_type_id","req",'_REQ_ORDER_TYPE_ID_');
        /* $validator->addValidation("delivery_address","req",'_REQ_DELIVERY_ADDRESS_');
         $validator->addValidation("delivery_latitude","req",'_REQ_DELIVERY_LATITUDE_');
         $validator->addValidation("delivery_longtitude","req",'_REQ_DELIVERY_LONGTITUDE_');
         $validator->addValidation("pickup_address","req",'_REQ_PICKUP_ADDRESS_');
         $validator->addValidation("pickup_latitude","req",'_REQ_PICKUP_LATITUDE_');
         $validator->addValidation("pickup_longtitude","req",'_REQ_PICKUP_LONGTITUDE_');
         $validator->addValidation("delivery_fee","req",'_REQ_DELIVERY_FEE_');
         $validator->addValidation("description","req",'_REQ_DESCRIPTION_');
         $validator->addValidation("order_type_id","req",'_REQ_ORDER_TYPE_ID_');
         $validator->addValidation("city","req",'_REQ_CITY_');*/

        // $validator->addValidation("item_property_id","req",'_REQ_ITEM_PROPERTY_ID_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }


    function PlacedPackagedReOrder($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("order_type_id","req",'_REQ_ORDER_TYPE_ID_');
        $validator->addValidation("order_id","req",'_REQ_ORDER_ID_');
        /*$validator->addValidation("delivery_address","req",'_REQ_DELIVERY_ADDRESS_');
        $validator->addValidation("delivery_latitude","req",'_REQ_DELIVERY_LATITUDE_');
        $validator->addValidation("delivery_longtitude","req",'_REQ_DELIVERY_LONGTITUDE_');
        $validator->addValidation("pickup_address","req",'_REQ_PICKUP_ADDRESS_');
        $validator->addValidation("pickup_latitude","req",'_REQ_PICKUP_LATITUDE_');
        $validator->addValidation("pickup_longtitude","req",'_REQ_PICKUP_LONGTITUDE_');
        $validator->addValidation("delivery_fee","req",'_REQ_DELIVERY_FEE_');
        $validator->addValidation("description","req",'_REQ_DESCRIPTION_');
        $validator->addValidation("package_image","req",'_REQ_PACKAGE_IMAGE_');
        $validator->addValidation("recipient_phone_number","req",'_REQ_RECIPIENT_NNUMBER_');

        $validator->addValidation("city","req",'_REQ_CITY_');*/

        // $validator->addValidation("item_property_id","req",'_REQ_ITEM_PROPERTY_ID_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function getStoreInvoiceDetails($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("store_id","req",'_REQ_STORE_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("order_id","req",'_REQ_ORDER_ID_');
        //$validator->addValidation("order_type_id","req",'_REQ_ORDER_TYPE_ID_');



        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function getCarrierInvoiceReport($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("store_id","req",'_REQ_STORE_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("order_id","req",'_REQ_ORDER_ID_');
        //$validator->addValidation("order_type_id","req",'_REQ_ORDER_TYPE_ID_');



        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }


    function getItemDetails($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("item_id","req",'_REQ_ITEM_ID_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function AddToCartItem($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("category_id","req",'_REQ_CATEGORY_ID_');
        $validator->addValidation("store_id","req",'_REQ_STORE_ID_');
        $validator->addValidation("menu_item_id","req",'_REQ_MENU_ITEM_ID_');
        $validator->addValidation("quantity","req",'_REQ_QAUNTITY_');
        $validator->addValidation("delivery_fee","req",'_REQ_DELIVERY_FEE_');
        $validator->addValidation("delivery_address","req",'_REQ_ADDRESS_');
        $validator->addValidation("delivery_latitude","req",'_REQ_LATITUDE_');
        $validator->addValidation("delivery_longtitude","req",'_REQ_LONGTITUDE_');

       // $validator->addValidation("item_property_id","req",'_REQ_ITEM_PROPERTY_ID_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }


    function deleteCartItem($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("cart_item_id","req",'_REQ_CART_ITEM_ID_');
        $validator->addValidation("item_no","req",'_REQ_ITEM_NO_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function AddCartitemQauntity($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("cart_id","req",'_REQ_CART_ID_');
       // $validator->addValidation("cart_item_id","req",'_REQ_CART_ITEM_ID_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }




    function PlacedOrder($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("order_type_id","req",'_REQ_ORDER_TYPE_ID_');
        $validator->addValidation("payment_type","req",'_PAYMENT_TYPE_REQ_');
        $validator->addValidation("city","req",'_REQ_CITY_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }


    function changeDeliveryAddress($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("cart_id","req",'_REQ_CART_ID_');
        $validator->addValidation("delivery_fee","req",'_REQ_DELIVERY_FEE_');
        $validator->addValidation("delivery_address","req",'_REQ_ADDRESS_');
        $validator->addValidation("delivery_latitude","req",'_REQ_LATITUDE_');
        $validator->addValidation("delivery_longtitude","req",'_REQ_LONGTITUDE_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }


    function Customerlogout($POST)
    {
        $_POST = $POST;
        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
         $validator->addValidation("device_token","req",'_REQ_DEVICE_TOKEN_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }


    function Carrierlogout($POST)
    {
        $_POST = $POST;
        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("carrier_id","req",'_REQ_CARRIER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("device_token","req",'_REQ_DEVICE_TOKEN_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function Storelogout($POST)
    {
        $_POST = $POST;
        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("store_id","req",'_REQ_CARRIER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function CarrierAcceptDeliveryOrder($POST)
    {
        $_POST = $POST;
        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("carrier_id","req",'_REQ_CARRIER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("order_id","req",'_REQ_ORDER_ID_');
        $validator->addValidation("service_request_id","req",'_REQ_SERVICE_REQUEST_ID_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function PartnerAcceptDeliveryOrder($POST)
    {
        $_POST = $POST;
        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("store_id","req",'_REQ_STORE_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("order_id","req",'_REQ_ORDER_ID_');
        $validator->addValidation("service_request_id","req",'_REQ_SERVICE_REQUEST_ID_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function PartnerRejectDeliveryOrder($POST)
    {
        $_POST = $POST;
        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("store_id","req",'_REQ_STORE_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("order_id","req",'_REQ_ORDER_ID_');
        $validator->addValidation("service_request_id","req",'_REQ_SERVICE_REQUEST_ID_');
        $validator->addValidation("cancel_reason_id","req",'_REQ_SERVICE_REQUEST_ID_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function OrderItemList($POST)
    {
        $_POST = $POST;
        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("store_id","req",'_REQ_STORE_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("order_id","req",'_REQ_ORDER_ID_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function StoreOrderList($POST)
    {
        $_POST = $POST;
        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("store_id","req",'_REQ_STORE_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("list_type","req",'_LIST_TYPE_REQ_');



        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function StoreActiveList($POST)
    {
        $_POST = $POST;
        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("store_id","req",'_REQ_CARRIER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function CarrierOrderList($POST)
    {
        $_POST = $POST;
        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("carrier_id","req",'_REQ_STORE_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("list_type","req",'_LIST_TYPE_REQ_');



        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function CustomerOrderList($POST)
    {
        $_POST = $POST;
        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("is_active_order","req",'_IS_ACTIVE_ORDER_REQ_');




        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function CheckCarrierLogIn($POST)
    {
        $_POST = $POST;
        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("carrier_id","req",'_REQ_CARRIER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }



    function calculateDeliveryPrice($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        //$validator->addValidation("delivery_address","req",'_REQ_DELIVERY_ADDRESS_');
        $validator->addValidation("delivery_latitude","req",'_REQ_DELIVERY_LATITUDE_');
        $validator->addValidation("delivery_longtitude","req",'_REQ_DELIVERY_LONGTITUDE_');
       // $validator->addValidation("pickup_address","req",'_REQ_PICKUP_ADDRESS_');
        $validator->addValidation("pickup_latitude","req",'_REQ_PICKUP_LATITUDE_');
        $validator->addValidation("pickup_longtitude","req",'_REQ_PICKUP_LONGTITUDE_');

        // $validator->addValidation("item_property_id","req",'_REQ_ITEM_PROPERTY_ID_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }



    function PlacedCustomOrder($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("delivery_address","req",'_REQ_DELIVERY_ADDRESS_');
        $validator->addValidation("delivery_latitude","req",'_REQ_DELIVERY_LATITUDE_');
        $validator->addValidation("delivery_longtitude","req",'_REQ_DELIVERY_LONGTITUDE_');
        $validator->addValidation("pickup_address","req",'_REQ_PICKUP_ADDRESS_');
        $validator->addValidation("pickup_latitude","req",'_REQ_PICKUP_LATITUDE_');
        $validator->addValidation("pickup_longtitude","req",'_REQ_PICKUP_LONGTITUDE_');
        $validator->addValidation("delivery_fee","req",'_REQ_DELIVERY_FEE_');
        $validator->addValidation("description","req",'_REQ_DESCRIPTION_');
        $validator->addValidation("order_type_id","req",'_REQ_ORDER_TYPE_ID_');
        $validator->addValidation("city","req",'_REQ_CITY_');

        // $validator->addValidation("item_property_id","req",'_REQ_ITEM_PROPERTY_ID_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }




    function PlacedPackagedOrder($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("delivery_address","req",'_REQ_DELIVERY_ADDRESS_');
        $validator->addValidation("delivery_latitude","req",'_REQ_DELIVERY_LATITUDE_');
        $validator->addValidation("delivery_longtitude","req",'_REQ_DELIVERY_LONGTITUDE_');
        $validator->addValidation("pickup_address","req",'_REQ_PICKUP_ADDRESS_');
        $validator->addValidation("pickup_latitude","req",'_REQ_PICKUP_LATITUDE_');
        $validator->addValidation("pickup_longtitude","req",'_REQ_PICKUP_LONGTITUDE_');
        $validator->addValidation("delivery_fee","req",'_REQ_DELIVERY_FEE_');
        $validator->addValidation("description","req",'_REQ_DESCRIPTION_');
        $validator->addValidation("package_image","req",'_REQ_PACKAGE_IMAGE_');
        $validator->addValidation("recipient_phone_number","req",'_REQ_RECIPIENT_NNUMBER_');
        $validator->addValidation("order_type_id","req",'_REQ_ORDER_TYPE_ID_');
        $validator->addValidation("city","req",'_REQ_CITY_');

        // $validator->addValidation("item_property_id","req",'_REQ_ITEM_PROPERTY_ID_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }


    function CustomerCancelOrder($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("order_id","req",'_REQ_ORDER_ID_');
        $validator->addValidation("order_type_id","req",'_REQ_ORDER_TYPE_ID_');
        $validator->addValidation("service_request_id","req",'_REQ_SERVICE_REQUEST_ID_');

        // $validator->addValidation("item_property_id","req",'_REQ_ITEM_PROPERTY_ID_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function CarrierRating($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        $validator->addValidation("order_id","req",'_REQ_ORDER_ID_');
        $validator->addValidation("order_type_id","req",'_REQ_ORDER_TYPE_ID_');
        $validator->addValidation("rating","req",'_RATING_REQ_');
        // $validator->addValidation("item_property_id","req",'_REQ_ITEM_PROPERTY_ID_');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }



    /*======================================= code start by priyank ======================================= */






    /*======================================= code start by vyoma ======================================= */

    function carrierLogin($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();

        $validator->addValidation("mobile_number","req",'_REQ_MOBILE_NUMBER_');
        $validator->addValidation("password","req",'_REQ_PASSWORD_');
        $validator->addValidation("device_token","req",'_REQ_DEVICE_TOKEN_');
        $validator->addValidation("device_type","req",'_DEVICE_TYPE_PARAMS_REQUIRED_');
        $validator->addValidation("latitude","req",'_REQ_LATITUDE_');
        $validator->addValidation("longtitude","req",'_REQ_LONGTITUDE_');

       // $validator->addValidation("user_type","req",'_REQ_USER_TYPE_');
        /*$validator->addValidation("endpoint_arn","req",'_REQ_ENDPOINT_');*/

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    function partnerLogin($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();

        $validator->addValidation("mobile_number","req",'_REQ_MOBILE_NUMBER_');
        $validator->addValidation("password","req",'_REQ_PASSWORD_');
        $validator->addValidation("device_token","req",'_REQ_DEVICE_TOKEN_');
        $validator->addValidation("device_type","req",'_DEVICE_TYPE_PARAMS_REQUIRED_');
        // $validator->addValidation("user_type","req",'_REQ_USER_TYPE_');
        /*$validator->addValidation("endpoint_arn","req",'_REQ_ENDPOINT_');*/

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }


    function storeLogin($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();

        //$validator->addValidation("mobile_number","req",'_REQ_MOBILE_NUMBER_');
        $validator->addValidation("username","req",'_STORE_USERNAME_REQ_');
        $validator->addValidation("password","req",'_REQ_PASSWORD_');
        $validator->addValidation("device_token","req",'_REQ_DEVICE_TOKEN_');
        $validator->addValidation("device_type","req",'_DEVICE_TYPE_PARAMS_REQUIRED_');
        $validator->addValidation("endpoint_arn","req",'_REQ_ENDPOINT_');

        // $validator->addValidation("user_type","req",'_REQ_USER_TYPE_');
        /*$validator->addValidation("endpoint_arn","req",'_REQ_ENDPOINT_');*/

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }


    /*======================================= code End by vyoma ======================================= */

    function saveBestFor($POST)
    {
        $validator = new FormValidator();
        $validator->addValidation("bestfor","req",'Bestfor is required');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>-11,'message'=>$error_hash);
            return $status;
        }
        else{
            return array('status'=>0,'message'=>'success');
        }
    }


    function saveMenuCategory($POST)
    {
        $validator = new FormValidator();
        $validator->addValidation("menu_category","req",'Menucategory is required');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>-11,'message'=>$error_hash);
            return $status;
        }
        else{
            return array('status'=>0,'message'=>'success');
        }
    }

    function saveItemSize($POST)
    {
        $validator = new FormValidator();
        $validator->addValidation("item_size","req",'Itemsize is required');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>-11,'message'=>$error_hash);
            return $status;
        }
        else{
            return array('status'=>0,'message'=>'success');
        }
    }

    function saveSetting($POST)
    {
        $validator = new FormValidator();
        $validator->addValidation("radius","req",'Radius is required');
        $validator->addValidation("price_per_distance","req",'Price per distance is required');
        $validator->addValidation("price_per_minute","req",'Price per minute is required');
        $validator->addValidation("meter_starting_price","req",'Meter starting price is required');
        $validator->addValidation("min_delivery_price","req",'Min delivery price is required');
        $validator->addValidation("extension_radius","req",'Extension radius is required');
        $validator->addValidation("request_extenstion_time","req",'Request extension time is required');
        $validator->addValidation("resendotp_timer","req",'Resendotp timer is required');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>-11,'message'=>$error_hash);
            return $status;
        }
        else{
            return array('status'=>0,'message'=>'success');
        }
    }

    function saveCategoryType($POST)
    {
        $validator = new FormValidator();
        $validator->addValidation("category_name","req",'Category type is required');
        $validator->addValidation("category_id","req",'Category is required');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>-11,'message'=>$error_hash);
            return $status;
        }
        else{
            return array('status'=>0,'message'=>'success');
        }
    }

    function saveItemType($POST)
    {
        $validator = new FormValidator();
        $validator->addValidation("item_type","req",'Itemtype is required');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>-11,'message'=>$error_hash);
            return $status;
        }
        else{
            return array('status'=>0,'message'=>'success');
        }
    }

    function saveItemPropertyType($POST)
    {
        $validator = new FormValidator();
        $validator->addValidation("item_property_type","req",'Itemm propertytype is required');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>-11,'message'=>$error_hash);
            return $status;
        }
        else{
            return array('status'=>0,'message'=>'success');
        }
    }

    function saveItem($POST)
    {
        $validator = new FormValidator();
        $validator->addValidation("item_name","req",'Item name is required');
        $validator->addValidation("price","req",'Price is required');
        //$validator->addValidation("description","req",'Description is required');
        $validator->addValidation("category_type_id","req",'Category type is required');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>-11,'message'=>$error_hash);
            return $status;
        }
        else{
            return array('status'=>0,'message'=>'success');
        }
    }

    function saveItemProperty($POST)
    {
        $validator = new FormValidator();
        $validator->addValidation("name","req",'Item property name is required');
        $validator->addValidation("item_property_type_id","req",'Item property type is required');
        //$validator->addValidation("description","req",'Description is required');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>-11,'message'=>$error_hash);
            return $status;
        }
        else{
            return array('status'=>0,'message'=>'success');
        }
    }

    function savePartner($POST)
    {
        $validator = new FormValidator();
        $validator->addValidation("name","req",'Partner name is required');
        $validator->addValidation("email","req",'Email is required');
        $validator->addValidation("mobile_number","req",'Mobile number is required');
        //$validator->addValidation("partner_type_id","req",'Partner type is required');
        $validator->addValidation("category_id","req",'Category is required');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>-11,'message'=>$error_hash);
            return $status;
        }
        else{
            return array('status'=>0,'message'=>'success');
        }
    }

    function saveStore($POST)
    {
        $validator = new FormValidator();
        $validator->addValidation("partner_id","req",'Partner name is required');
        $validator->addValidation("address","req",'Address is required');
        //$validator->addValidation("store_type","req",'Store type is required');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>-11,'message'=>$error_hash);
            return $status;
        }
        else{
            return array('status'=>0,'message'=>'success');
        }
    }

    function saveCarrier($POST)
    {
        $validator = new FormValidator();
        $validator->addValidation("carrier_name","req",'Carrier name is required');
        /*$validator->addValidation("address","req",'Address is required');*/
        //$validator->addValidation("email","req",'Email is required');
        $validator->addValidation("mobile_number","req",'Mobile number is required');
        $validator->addValidation("bank_account","req",'Bank account number is required');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>-11,'message'=>$error_hash);
            return $status;
        }
        else{
            return array('status'=>0,'message'=>'success');
        }
    }


    function saveUser($POST)
    {
        $validator = new FormValidator();
        $validator->addValidation("name","req",'User name is required');
        $validator->addValidation("email","req",'Email is required');
        $validator->addValidation("phoneNumber","req",'Mobile number is required');
        $validator->addValidation("role_id","req",'Role is required');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>-11,'message'=>$error_hash);
            return $status;
        }
        else{
            return array('status'=>0,'message'=>'success');
        }
    }
    function saveRole($POST)
    {
        $validator = new FormValidator();
        $validator->addValidation("role","req",'Role is required');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>-11,'message'=>$error_hash);
            return $status;
        }
        else{
            return array('status'=>0,'message'=>'success');
        }
    }
    function savePromoCode($POST)
    {
        $validator = new FormValidator();
        /*$validator->addValidation("patner_id","req",'Partner id is required');*/
        $validator->addValidation("promocode","req",'Promo code is required');
        $validator->addValidation("limit_per_user","req",'Limit per user is required');
        $validator->addValidation("discount_type","req",'Discount type is required');
        $validator->addValidation("max_disc_amount","req",'Max disc amount is required');
        $validator->addValidation("min_transaction_amt","req",'Min transaction amt is required');
        $validator->addValidation("expire_date","req",'Expire date is required');
        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>-11,'message'=>$error_hash);
            return $status;
        }
        else{
            return array('status'=>0,'message'=>'success');
        }
    }

    function saveCustomer($POST)
    {
        $validator = new FormValidator();
        $validator->addValidation("name","req",'Customer name is required');
        //$validator->addValidation("email","req",'Email is required');
        $validator->addValidation("mobile_number","req",'Mobile number is required');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>-11,'message'=>$error_hash);
            return $status;
        }
        else{
            return array('status'=>0,'message'=>'success');
        }
    }

    function saveCarrierType($POST)
    {
        $validator = new FormValidator();
        $validator->addValidation("carrier_type","req",'Carrier type is required');


        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>-11,'message'=>$error_hash);
            return $status;
        }
        else{
            return array('status'=>0,'message'=>'success');
        }
    }

    function savePartnerType($POST)
    {
        $validator = new FormValidator();
        $validator->addValidation("type","req",'Partner type is required');
        $validator->addValidation("type_ar","req",'Partner type is required');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>-11,'message'=>$error_hash);
            return $status;
        }
        else{
            return array('status'=>0,'message'=>'success');
        }
    }

    /*bhoomi patel code start here*/

    function saveContactUs($POST)
    {
        $validator = new FormValidator();
        $validator->addValidation("phone_number","req",'Phone number is required');
        //$validator->addValidation("phone_number_ar","req",'Phone number is required');
        $validator->addValidation("email","req",'Email id is required');
       // $validator->addValidation("email_ar","req",'Email id is required');
        $validator->addValidation("instagram","req",'Instagram account id is required');
       // $validator->addValidation("instagram_ar","req",'Instagram account id is required');
        $validator->addValidation("twitter","req",'Twitter account id is required');
       // $validator->addValidation("twitter_ar","req",'Twitter account id is required');
        $validator->addValidation("support_email","req",'Support Email id is required');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>-11,'message'=>$error_hash);
            return $status;
        }
        else{
            return array('status'=>0,'message'=>'success');
        }
    }

    /*bhoomi patel code end here*/

    function clearPromocode($POST,$isBulkUpload=0)
    {
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();
        $validator->addValidation("customer_id","req",'_REQ_CUSTOMER_ID_');
        $validator->addValidation("session_code","req",'_REQ_SESSION_CODE_');
        //$validator->addValidation("cart_id","req",'_REQ_CART_ID_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }

    /*===============Bhoomi code start here for mymudra===================*/

    function userSignUp($post,$isBulkUpload=0)
    {

        $_POST = $post;
        $validator = new FormValidator();
        $generalObj	= new General();

        $validator->addValidation("name","req",'_REQ_NAME_');
        $validator->addValidation("email","req",'_REQ_EMAIL_ID_');
        $validator->addValidation("email","email",'_VALID_EMAIL_');
        $validator->addValidation("mobile_number","req",'_REQ_MOBILE_NUMBER_');
        $validator->addValidation("employment_type","req",'_REQ_EMPLOYMENT_TYPE_');
        $validator->addValidation("annual_income","req",'_REQ_ANNUAL_INCOME_');
        $validator->addValidation("password","maxlen=50",'_REQ_PASSWORD_');
        //$validator->addValidation("confirm_password","maxlen=50",'_REQ_CONFIRM_PASSWORD_');
        $validator->addValidation("street","req",'_REQ_ADDRESS_');
        $validator->addValidation("city","req",'_REQ_CITY_');
        $validator->addValidation("state","req",'_REQ_STATE_');
        $validator->addValidation("pincode","req",'_REQ_PINCODE_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }

    }

    function login($POST,$isBulkUpload=0)
    {   //echo "<pre>"; print_r($POST); die;
        $_POST = $POST;

        $validator	=	new FormValidator();
        $generalObj	=	new General();

        $validator->addValidation("email","req",'_REQ_EMAIL_');
        $validator->addValidation("password","req",'_REQ_PASSWORD_');
        $validator->addValidation("device_token","req",'_REQ_DEVICE_TOKEN_');
        $validator->addValidation("endpointArn","req",'_REQ_ENDPOINT_');

        if(!$validator->ValidateForm())
        {   //echo "if"; die;
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {   //echo "else"; die;
            return array('status'=>0,'message'=>'success');
        }
    }

    function forgotpassword($POST)
    {
        $_POST = $POST;
        $validator = new FormValidator();
        $validator->addValidation("email","req",'_REQ_EMAIL_');
        $validator->addValidation("email","email",'_VALID_EMAIL_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }
    }


    function userReferenceSignUp($post,$isBulkUpload=0)
    {

        $_POST = $post;
        $validator = new FormValidator();
        $generalObj	= new General();

        $validator->addValidation("name","req",'_REQ_NAME_');
        $validator->addValidation("email","req",'_REQ_EMAIL_ID_');
        $validator->addValidation("email","email",'_VALID_EMAIL_');
        $validator->addValidation("mobile_number","req",'_REQ_MOBILE_NUMBER_');
        $validator->addValidation("employment_type","req",'_REQ_EMPLOYMENT_TYPE_');
        $validator->addValidation("annual_income","req",'_REQ_ANNUAL_INCOME_');
        //$validator->addValidation("password","maxlen=50",'_REQ_PASSWORD_');
        //$validator->addValidation("confirm_password","maxlen=50",'_REQ_CONFIRM_PASSWORD_');
        $validator->addValidation("street","req",'_REQ_ADDRESS_');
        $validator->addValidation("city","req",'_REQ_CITY_');
        $validator->addValidation("state","req",'_REQ_STATE_');
        $validator->addValidation("pincode","req",'_REQ_PINCODE_');
        $validator->addValidation("loan_amount","req",'_REQ_LOAN_AMOUNT_');
        $validator->addValidation("loan_type_id","req",'_REQ_LOAN_TYPE_ID_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }

    }

    function invUserReferenceSignUp($post,$isBulkUpload=0)
    {

        $_POST = $post;
        $validator = new FormValidator();
        $generalObj	= new General();

        $validator->addValidation("name","req",'_REQ_NAME_');
        $validator->addValidation("email","req",'_REQ_EMAIL_ID_');
        $validator->addValidation("email","email",'_VALID_EMAIL_');
        $validator->addValidation("mobile_number","req",'_REQ_MOBILE_NUMBER_');
        $validator->addValidation("employment_type","req",'_REQ_EMPLOYMENT_TYPE_');
        $validator->addValidation("annual_income","req",'_REQ_ANNUAL_INCOME_');
        //$validator->addValidation("password","maxlen=50",'_REQ_PASSWORD_');
        //$validator->addValidation("confirm_password","maxlen=50",'_REQ_CONFIRM_PASSWORD_');
        $validator->addValidation("street","req",'_REQ_ADDRESS_');
        $validator->addValidation("city","req",'_REQ_CITY_');
        $validator->addValidation("state","req",'_REQ_STATE_');
        $validator->addValidation("pincode","req",'_REQ_PINCODE_');
        $validator->addValidation("inv_amount","req",'_REQ_INV_AMOUNT_');
        $validator->addValidation("inv_type_id","req",'_REQ_INV_TYPE_ID_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }

    }

    function propertyUserReference($post,$isBulkUpload=0)
    {

        $_POST = $post;
        $validator = new FormValidator();
        $generalObj	= new General();

        $validator->addValidation("name","req",'_REQ_NAME_');
        $validator->addValidation("property_type_id","req",'_REQ_PROPERTY_TYPE_ID_');
        $validator->addValidation("email","req",'_REQ_EMAIL_ID_');
        $validator->addValidation("email","email",'_VALID_EMAIL_');
        $validator->addValidation("mobile_number","req",'_REQ_MOBILE_NUMBER_');
        $validator->addValidation("employment_type","req",'_REQ_EMPLOYMENT_TYPE_');
        $validator->addValidation("annual_income","req",'_REQ_ANNUAL_INCOME_');
        //$validator->addValidation("password","maxlen=50",'_REQ_PASSWORD_');
        //$validator->addValidation("confirm_password","maxlen=50",'_REQ_CONFIRM_PASSWORD_');
        $validator->addValidation("street","req",'_REQ_ADDRESS_');
        $validator->addValidation("city","req",'_REQ_CITY_');
        $validator->addValidation("state","req",'_REQ_STATE_');
        $validator->addValidation("pincode","req",'_REQ_PINCODE_');
        $validator->addValidation("size","req",'_REQ_SIZE_');
        $validator->addValidation("size_type","req",'_REQ_SIZE_TYPE_');
        $validator->addValidation("property_type","req",'_REQ_PROPERTY_TYPE_');

        if(!$validator->ValidateForm())
        {
            $error_hash = $validator->GetError();
            $status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
            return $status;
        }
        else
        {
            return array('status'=>0,'message'=>'success');
        }

    }

}

