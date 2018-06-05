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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/userSignUp">userSignUp</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>name,email,mobile_number,password,employment_type,annual_income.street,city,state,pincode</td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/login">login</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>email,password,device_token</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>endpointArn</td>
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
                    <td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/loanTypeList">loanTypeList</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id,session_code,loan_type</td>
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
                    <td></td>
                  </tr>
                </table>
            </div>
            <br/>
            <div class="apidetail">
            <table width="940">
                <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/bankLoanUserReference">bankLoanUserReference</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id,session_code,name,email,mobile_number,employment_type,annual_income,street,city,state,pincode,loan_amount,loan_type_id</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>bank_id</td>
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
                    <td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/invAdvisoryUserReference">invAdvisoryUserReference</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id,session_code,name,email,mobile_number,employment_type,annual_income,street,city,state,pincode,inv_amount,inv_type_id</td>
                </tr>
                <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>description</td>
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
                    <td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/propertyUserReference">propertyUserReference</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id,session_code,property_type_id,name,email,mobile_number,employment_type,annual_income,street,city,state,pincode,size,size_type,property_type</td>
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/bankList">bankList</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id,session_code</td>
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
                    <td>-
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/registeredUserListForBankLoan">registeredUserListForBankLoan</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id,session_code</td>
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
                    <td>-
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
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/registeredUserListForInvestmentLoan">registeredUserListForInvestmentLoan</a></td>
                </tr>
                <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id,session_code</td>
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
                    <td>-</td>
                </tr>
            </table>
        </div>
            <br/>
           

    </div>
</div>
<div style="height:50px;"></div>
<p id="back-top" style="display: block;">
    <a href="#top"><span></span></a>
</p>
</body>    
</html>