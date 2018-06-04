<style>
.navbar-brand img
{
	max-height:199px;
}
.margin-top-20px
{
	margin-top:20px;
}
.login-page{
    background: #fff;
}
.logo{
    height: 150px;
}
.help-block {
    margin-top: 35px;
    position: absolute;
}
</style>
<div class="login-box col-xs-12">
    <div class="logo">
        <a href="javascript:void(0);" class=""><img src="<?php Yii::app()->params->base_url; ?>assets/img/logo.png" alt="Talaq" class="" style="width: 150px; height: 150px!important; margin: 0px auto; "/></a>
       <!-- <a href="javascript:void(0);">Admin<b>BSB</b></a>-->

    </div>
    <div class="card">
        <div class="body">
            <form name="form" id="login_form" method="post" action="<?php echo Yii::app()->params->base_path; ?>admin/adminLogin" class="form-validation">
                <div class="msg">Sign in to start your session</div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                    <div class="form-line">
                        <input type="email" placeholder="Email" class="form-control " ng-model="user.email" name="email" id="email" value="<?php if(isset($_COOKIE['email']) && $_COOKIE['email'] != "0") { echo $_COOKIE['email']; } ?>" >
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input type="password" name="password" id="password" value="<?php if(isset($_COOKIE['password']) && $_COOKIE['password'] != "0") { echo $_COOKIE['password']; }?>" placeholder="Password" class="form-control " ng-model="user.password" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                        <label for="rememberme">Remember Me</label>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" type="submit" name="loginBtn">SIGN IN</button>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-6">
                        <!--<a href="sign-up.html">Register Now!</a>-->
                    </div>
                    <div class="col-xs-12 align-right">
                        <a href="<?php echo Yii::app()->params->base_path; ?>admin/forgotPassword">Forgot Password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

  $(document).ready(function(){
	
	$('#login_form').validate({
				errorElement: 'span', //default input error message container
				errorClass: 'help-block', // default input error message class
				focusInvalid: false, // do not focus the last invalid input
				rules: {
					email: {
						required: true,
						email:true,
					},
					password:{
						required: true,
					}
				},
				messages: {
					email:
					{
						required: "Please enter email id",
						email: "Please enter valid email id"
					},
					password:
					{
						required: "Please enter password",
					}
					
				},
				invalidHandler: function (event, validator) { //display error alert on form submit   
					$('.alert-danger', $('.form-horizontal')).show();
				},
				highlight: function (element) { // hightlight error inputs
					$(element).closest('.input-group').addClass('has-error'); // set error class to the control group
				},
				onfocusout: function(element) { 
					$(element).valid();  
				},
				success: function (label) {
					label.closest('.input-group').removeClass('has-error');
					label.remove();
				},
				errorPlacement: function (error, element) {
					error.insertAfter(element.closest('.form-control'));
				},
				submitHandler: function (form) {
					
					//$('.form-horizontal').submit();
					form.submit(); // form validation success, call ajax form submit
				}
			});
	

	
	});


setTimeout(function() 
					 {
						$('.alert-success').fadeOut();
					 }, 6000 );
</script>
