<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MyMudra</title>
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
                        <img src="<?php echo Yii::app()->params->base_url; ?>assets/img/logo1.png" alt="MyMudra" style="margin-top: 80px;height: 100px;width: 100px;" />
                    </div>
                    
                    <div class="links">
                    
                        <h1>MyMudra REST API!</h1>
                        
                        <ul>
                        
                        
                        <li> <a  href="<?php echo Yii::app()->params->base_path; ?>admin">ADMIN PANEL</a></li>
                       <br />
                        <li> <a href="<?php echo Yii::app()->params->base_path; ?>api">Refresh Page</a> </li>
                        <br />
                         <li> <a href="<?php echo Yii::app()->params->base_path; ?>api/possibleErrors">Possible Errors List</a> </li>
                    </ul>
                </div>
            
        </div>
    </div>
    <div class="container">
      <div class="txt">
    <p>If you are exploring MyMudra REST API for the very first time, you should start by reading the Guide. 	</p>
    </div>
    
      <div style="float:right">
        <ul style="list-style:none">
        
        <a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/showLogs"><li class="btn">ShowLog</li></a><br /><li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
        
        <a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/clearLogs"><li class="btn">ClearLogs</li></a>
        
        </ul>
      </div>
      
    </div>
    <div class="container">
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/customerRegistration">customerRegistration</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>name,email,mobile_number,password</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>device_type,os_version,app_version,device_model</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/verifyOTP">verifyOTP</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_type,mobile_number,otp_code,device_token,device_type</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>endpoint_arn</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
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
                        <b>user_type</b>:1- customer , 2- Carrier , 3 - Partner
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/customerLogin">customerLogin</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_type,mobile_number,password,device_token,device_type</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>endpoint_arn,os_version,device_model,app_version</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/forgotPassword">forgotPassword</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>email,user_type</td>
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
                    <td>  <b>user_type: </b>1- customer , 2- Carrier , 3 - Partner<br/>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/carrierLogin">carrierLogin</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_type,mobile_number,password,device_token,device_type</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>endpoint_arn,os_version,device_model,app_version</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/partnerLogin">partnerLogin</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_type,mobile_number,password,device_token,device_type</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>endpoint_arn,os_version,device_model,app_version</td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET and POST</td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/changePassword">changePassword</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id,session_code,user_type,old_password,new_password,new_password_confirm</td>
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
                    <td>  <b>user_type:: </b>:1- customer , 2- Carrier , 3 - Partner
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/verifyForgotPasswordCode">verifyForgotPasswordCode</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id,user_type,verify_code</td>
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
                    <td>  <b>user_type:: </b>:1- customer , 2- Carrier , 3 - Partner
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/resetPassword">resetPassword</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id,user_type,password,device_token,endpoint_arn</td>
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
                    <td>  <b>user_type:: </b>:1- customer , 2- Carrier , 3 - Partner
                    </td>
                </tr>
            </table>
        </div>
            <br/>
            
            <br/>
           

    </div>
</div>
<div style="height:50px;"></div>
<p id="back-top" style="display: block;">
    <a href="#top"><span></span></a>
</p>
</body>    
</html>