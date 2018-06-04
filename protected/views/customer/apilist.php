<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Viia</title>
<link href="<?php echo Yii::app()->params->base_url; ?>themefiles/assets/admin/layout/css/apipage.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>

<script>
$(document).ready(function(){

	// hide #back-top first
	$("#back-top").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

});
</script>


</head>
<body>
<div class="maincontainer">
    <div class="hdr">
                <div class="container">
                    <div class="logo">
                        <img src="<?php echo Yii::app()->params->base_url; ?>assets/pages/img/login_logo.png" style="margin-top: 80px;height: 100px;width: 100px;" />
                    </div>
                    
                    <div class="links">
                    
                        <h1>Viia REST API!</h1>
                        
                        <ul>
                        
                        
                        <li> <a  href="<?php echo Yii::app()->params->base_path; ?>admin">ADMIN PANEL</a></li>
                       <br />
                        <li> <a href="<?php echo Yii::app()->params->base_path; ?>customer">Refresh Page</a> </li>
                        <br />
                         <li> <a href="<?php echo Yii::app()->params->base_path; ?>customer/possibleErrors">Possible Errors List</a> </li>
                    </ul>
                </div>
            
        </div>
    </div>
    <div class="container">
      <div class="txt">
    <p>If you are exploring Viia REST API for the very first time, you should start by reading the Guide. 	</p>
    </div>
    
      <div style="float:right">
        <ul style="list-style:none">
        
        <a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/showLogs"><li class="btn">ShowLog</li></a><br /><li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
        
        <a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/clearLogs"><li class="btn">ClearLogs</li></a>
        
        </ul>
      </div>
      
    </div>
    <div class="container">
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/register">register</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>mobile_number,password</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>name,email,device_type,os_version,app_version,device_model</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td><b>device_type</b>:1- Android , 2 - IOS
                    </td>
                  </tr>
                </table>
            </div>
            <br/>
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/verifyOTP">verifyOTP</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>mobile_number,otp_code,device_token,device_type</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>endpoint_arn,new_mobile_number</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td><b>device_type</b>:1- Android , 2 - IOS


                    </td>
                  </tr>
                </table>
            </div>
        <br/>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/resendOTP">resendOTP</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>mobile_number,device_token,device_type</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>endpoint_arn,is_forgot</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td><b>device_type</b>:1- Android , 2 - IOS
                        <br/>

                        <b>is_forgot</b> : Resend otp for forgotpassword or mobile verification
                    </td>
                </tr>
            </table>
        </div>
            <br/>
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/login">login</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>mobile_number,password,device_token,device_type,endpoint_arn</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>os_version,device_model,app_version</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td><b>device_type</b>:1- Android , 2 - IOS

                    </td>

                  </tr>
                </table>
            </div>
            <br/>
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/forgotPassword">forgotPassword</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>email</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                  </tr>

                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>
                        <p>Check Response Params 'is_mobile' for identify verification type mobile number or email</p>
                        <b>is_mobile : </b> 1- mobile verify , 0- for email verify
                      </td>
                  </tr>
                </table>
            </div>
        <br/>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/updateCustomerProfile">updateCustomerProfile</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id,session_code</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>name,email,mobile_number</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>PUT</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td> -</td>
                </tr>
            </table>
        </div>
            <br/>
            <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/changePassword">changePassword</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id,session_code,old_password,new_password,new_password_confirm</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                </tr>

                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
            </table>
        </div>
            <br/>
            <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/verifyForgotPasswordCode">verifyForgotPasswordCode</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id,verify_code</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET</td>
                </tr>

                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>  -
                    </td>
                </tr>
            </table>
        </div>
            <br/>
            <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/resetPassword">resetPassword</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id,password,device_token,endpoint_arn</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>PUT</td>
                </tr>

                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>  -
                    </td>
                </tr>
            </table>
        </div>
            <br/>
            <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/getCategoryList">getCategoryList</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET</td>
                </tr>

                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>  -
                    </td>
                </tr>
            </table>
        </div>


        <br>

        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/getSystemConfig">getSystemConfig</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET</td>
                </tr>

                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td> -
                    </td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/expireOTP">expireOTP</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>mobile_number,device_token,device_type</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>endpoint_arn</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>PUT</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td><b>device_type</b>:1- Android , 2 - IOS

                    </td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/addAddress">addAddress</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>address,latitude,longtitude,address_type,city</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td><b>address_type</b>: Work, Home , Other

                    </td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/deleteAddress">deleteAddress</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,customer_addres_id</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>DELETE</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-

                    </td>
                </tr>
            </table>
        </div>

        <br>
        <!--<div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/getAddress">getAddress</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-

                    </td>
                </tr>
            </table>
        </div>-->
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/getNearStoreList">getNearStoreList</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,latitude,longitude,category_id</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-

                    </td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/getStoreItemList">getStoreItemList</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,store_id</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-

                    </td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/getStoreItemDetails">getStoreItemDetails</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,item_id</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-

                    </td>
                </tr>
            </table>
        </div>

        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/addToCart">addToCart</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,category_id,store_id,menu_item_id,quantity,delivery_fee,
                        delivery_address,delivery_latitude,delivery_longtitude</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-

                    </td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/addToCart1">addToCart1</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,category_id,store_id,menu_item_id,quantity,delivery_fee,
                        delivery_address,delivery_latitude,delivery_longtitude</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-

                    </td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/getcartList">getcartList</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,cart_id</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-

                    </td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/getcartList1">getcartList1</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,cart_id</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-

                    </td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/deleteCartItem">deleteCartItem</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,cart_item_id,item_no</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>DELETE</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-

                    </td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/getcartSummary">getcartSummary</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,cart_id</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-

                    </td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/addCartItemQuantity">addCartItemQuantity</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,cart_id</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>PUT</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-

                    </td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/addCartItemQuantity1">addCartItemQuantity1</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,cart_id</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>PUT</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/deleteCartItemQuantity">deleteCartItemQuantity</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,cart_id,cart_item_id</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>DELETE</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-

                    </td>
                </tr>
            </table>
            </div>
                <br>
                <div class="apidetail">
                    <table width="940">
                        <tr>
                            <td width="70">Name</td>
                            <td width="10">:</td>
                            <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/deleteCartItemQuantity1">deleteCartItemQuantity1</a></td>
                        </tr>
                        <tr>
                            <td>Required Params</td>
                            <td>:</td>
                            <td>customer_id,session_code,cart_id</td>
                        </tr>
                        <tr>
                            <td>Optional Params</td>
                            <td>:</td>
                            <td>app_language</td>
                        </tr>
                        <tr>
                            <td>Method</td>
                            <td>:</td>
                            <td>DELETE</td>
                        </tr>
                        <tr>
                            <td>Fields</td>
                            <td>:</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>Notes</td>
                            <td>:</td>
                            <td>-

                            </td>
                        </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/placedOrder">placedOrder</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,order_type_id,city</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/changeDeliveryAddress">changeDeliveryAddress</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,cart_id,delivery_fee,delivery_address,delivery_latitude,
                        delivery_longtitude</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/editAddress">editAddress</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>address,latitude,longtitude,city,customer_addres_id</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>PUT</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/logout">logout</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,device_token</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/calculateDeliveryPrice">calculateDeliveryPrice</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,delivery_latitude,delivery_longtitude,pickup_latitude,pickup_longtitude</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/cancelOrder">cancelOrder</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,order_id,order_type_id,service_request_id</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/recentAddresslist">recentAddresslist</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/OrderDetails">OrderDetails</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,order_id,order_type_id</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/carrierRating">carrierRating</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,order_id,order_type_id,rating</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/orderList">orderList</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,is_active_order</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/orderInvoice">orderInvoice</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,order_id,order_type_id</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/getCarrierLocation">getCarrierLocation</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,order_id,order_type_id</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/getProfile">getProfile</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
            </table>
        </div>
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>customer/placedReOrder">placedReOrder</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>customer_id,session_code,order_id,order_type_id</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>app_language</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                </tr>
                <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div style="height:50px;"></div>
<p id="back-top" style="display: block;">
    <a href="#top"><span></span></a>
</p>
</body>    
</html>