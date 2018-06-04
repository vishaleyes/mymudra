<style>
    .navbar-brand img
    {
        max-height:199px;
    }
    .margin-top-20px
    {
        margin-top:25px;
    }
    .login-page{
        background: #fff;
    }
    .logo{
        height: 150px;
    }
    .help-block {
        margin-top: 34px;
        position: absolute;
        color: red;
    }
    
</style>
<script>
$(document).ready(function(){
	$('body').addClass('login-page');
});
</script>
<div class="login-box col-lg-12 col-md-12 col-sm-12 col-xs-12" >
    <div class="logo">
        <a href="javascript:void(0);" class=""><img src="<?php Yii::app()->params->base_url; ?>assets/img/logo.png" alt="Viia" class="" style="width: 150px; height: 90px!important; margin:0px auto;margin-top:15px;"/></a>
        <!-- <a href="javascript:void(0);">Admin<b>BSB</b></a>-->
    </div>

    <div class="row">
        <div class="col-xs-12 pln text-center">
            <h2 class="text-dark mbn confirmation-header"><i class="fa fa-check text-success"></i> Reset Password</h2>
        </div>

    </div>

    <hr class="alt short mv25">

    <div class="card">
        <div class="body">
            <form name="form-horizontal" id="login_form" enctype="multipart/form-data" method="post" action="<?php echo Yii::app()->params->base_path; ?>api/saveResetPassword" class="form-validation">
                <div class="msg"></div>
                <div class="input-group">
                    <div class="form-line">
                        <label class="control-label" id="lbl_newpassword">Enter Verification Code:<span style="color:red;">*</span></label>
                        <input type="text" name="token" id="token" class="form-control" placeholder="verification code"  <?php if( isset($token) ) {?>value="<?php echo $token;?>" readonly<?php }?>/>
                    </div>
                </div>

                <div class="input-group">
                    <div class="form-line">
                        <label class="control-label" id="lbl_newpassword">New Password:<span style="color:red;">*</span></label>
                        <input type="password" name="new_password" id="new_password"  class="form-control" placeholder="password" />
                    </div>
                </div>

                <div class="input-group">
                    <div class="form-line">
                        <label class="control-label" id="lbl_newpassword">Confirm Password:<span style="color:red;">*</span></label>
                        <input type="password"  name="new_password_confirm" id="new_password_confirm" placeholder="confirm password" class="form-control" value="" />
                    </div>
                </div>

                <div class="row">

                    <div class="col-xs-4">

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 ">
                        <button class="btn btn-block bg-pink waves-effect" type="submit" name="submit_reset_password_btn">Submit</button>

                        <input type="hidden" id="user_type" name="user_type" value="<?php echo $user_type; ?>" >
                    </div>

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
                token: {
                    required: true,
                },
                new_password:{
                    required: true,
                    minlength:6,
                },
                new_password_confirm:{
                    required:true,
                    equalTo: "#new_password"
                }
            },
            messages: {
                token:
                    {
                        required: "Please enter verification code",
                    },
                new_password:
                    {
                        required: "Please enter password",
                    },
                new_password_confirm:
                    {
                        required: "Please enter confirm password",
                        equalTo: "New password and confirm password does not match"
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
