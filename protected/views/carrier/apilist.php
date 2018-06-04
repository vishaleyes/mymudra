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
                        <li> <a href="<?php echo Yii::app()->params->base_path; ?>carrier">Refresh Page</a> </li>
                        <br />
                         <li> <a href="<?php echo Yii::app()->params->base_path; ?>carrier/possibleErrors">Possible Errors List</a> </li>
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
        
        <a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/showLogs"><li class="btn">ShowLog</li></a><br /><li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
        
        <a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/clearLogs"><li class="btn">ClearLogs</li></a>
        
        </ul>
      </div>
      
    </div>
    <div class="container">
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/register">register</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>mobile_number,password,carrier_name,bank_account,id_number,driving_license,<br>password_confirm,device_type</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>email,device_token,device_type,device_model,app_version,app_language</td>
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
                        <br>

                        <b>id_number: </b> Pass Base64 data of image<br>
                        <b> driving_license:- </b> Pass Base64 data of image


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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/login">login</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>mobile_number,password,device_token,device_type</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>endpoint_arn,os_version,device_model,app_version</td>
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
           <br>
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/verifyOTP">verifyOTP</a></td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/resendOTP">resendOTP</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>mobile_number,device_token,device_type,is_forgot</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>endpoint_arn</td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/forgotPassword">forgotPassword</a></td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/changePassword">changePassword</a></td>
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
                    <td>PUT</td>
                </tr>

                <tr>
                    <td>Notes</td>
                    <td>:</td>
                  -
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/verifyForgotPasswordCode">verifyForgotPasswordCode</a></td>
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
                    <td>GET and POST</td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/resetPassword">resetPassword</a></td>
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
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/expireOTP">expireOTP</a></td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/carrierIsOnline">carrierIsOnline</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id,session_code,is_online</td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/getSystemConfig">getSystemConifg</a></td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/setLocation">setLocation</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>carrier_id,session_code,latitude,longtitude,service_request_id</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>service_type,order_id</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>PUT</td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/logout">logout</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>carrier_id,session_code,device_token</td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/sentContactUs">sentContactUs</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>carrier_id,session_code</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>comment</td>
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
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/acceptDeliveryOrder">acceptDeliveryOrder</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>carrier_id,session_code,order_id,service_request_id</td>
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
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/rejectDeliveryOrder">rejectDeliveryOrder</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>carrier_id,session_code,order_id,service_request_id</td>
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
        <br>
        <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/OrderDetails">OrderDetails</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>carrier_id,session_code,order_id,order_type_id</td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/setItemPickedUp">setItemPickedUp</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>carrier_id,session_code,service_request_id</td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/setEndOrder">setEndOrder</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>carrier_id,session_code,service_request_id</td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/addBill">addBill</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>carrier_id,session_code,order_id,order_total</td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/orderInvoice">orderInvoice</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>carrier_id,session_code,order_id,order_type_id</td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/orderReport">orderReport</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>carrier_id,session_code,list_type</td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/activeOrder">activeOrder</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>carrier_id,session_code</td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>carrier/getWallet">getWallet</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>carrier_id,session_code</td>
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