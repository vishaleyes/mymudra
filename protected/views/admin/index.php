<style>
    #email_forgot-error
    {
        color: #e73d4a;
    }
    .partner_login{
        font-size: 15px;
        font-weight: 600;
    }
</style>
<!-- BEGIN : LOGIN PAGE 5-1 -->
<div class="user-login-5">
    <div class="row bs-reset">
        <div class="col-md-6 bs-reset mt-login-5-bsfix">
            <div class="login-bg" style="background-image:url(assets/pages/img/login/bg1.jpg)">
                <!--<img class="login-logo" src="assets/pages/img/logo-big.png" />--> </div>
        </div>
        <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
            <div class="login-content" style="margin-top:15%; ">
                <div class="row"><div class="right-head pull-right">Don't Have Account? - <a href="http://localhost/mymudra/index.php?r=admin/signUp" title="sign up" class="login-link">Sign Up</a></div></div>

                <div class="row"><h1><img class="login-logo img-responsive" style="position: relative; top:0px; left:0px;height: 150px;width:200px;" src="<?php echo Yii::app()->params->base_url ; ?>assets/pages/img/login_logo.png" /></h1></div>
                <h3 class="hidden-sm hidden-md uppercase" style="font-weight: 600; color: #f17342;"> Admin </h3>
                <form action="<?php echo Yii::app()->params->base_path; ?>admin/adminLogin" class="login-form" method="post">
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        <span>Enter any username and password. </span>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Email" name="email" required value="<?php if(isset($_COOKIE['email']) && $_COOKIE['email'] != "0") { echo $_COOKIE['email']; } ?>"/> </div>
                        <div class="col-xs-6">
                            <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Password" name="password" required  value="<?php if(isset($_COOKIE['password']) && $_COOKIE['password'] != "0") { echo $_COOKIE['password']; }?>" /> </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="rem-password">
                                <label class="rememberme mt-checkbox mt-checkbox-outline">
                                    <input type="checkbox" name="remember" value="1" /> Remember me
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-8 text-right">
                            <div class="forgot-password">
                                <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                            </div>
                            <button class="btn green" name="loginBtn" id="loginBtn" type="submit">Sign In</button>
                        </div>
                    </div>
                    <!--<div class="row margin-top-20">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-8 text-right">
                            <div class="forgot-password">
                                <a href="<?php /*echo Yii::app()->params->base_path; */?>partner/partnerLogin" class="partner_login">Viia - Partner Login</a>
                            </div>
                        </div>
                    </div>-->
                </form>

                <!-- BEGIN FORGOT PASSWORD FORM -->
                <form class="forget-form"  method="post" name="form_forgotpass" id="form_forgotpass" action="<?php echo Yii::app()->params->base_path; ?>admin/forgotPassword">
                    <h3 class="font-green">Forgot Password ?</h3>
                    <p> Enter your e-mail address below to reset your password. </p>
                    <div class="form-group">
                        <input class="form-control placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Email" name="email" id="email_forgot" /> </div>
                    <div class="form-actions">
                        <button type="button" id="back-btn" class="btn green btn-outline">Back</button>
                        <button type="submit" id="forgotBtn" class="btn btn-success uppercase pull-right">Submit</button>
                    </div>
                </form>
                <!-- END FORGOT PASSWORD FORM -->

            </div>
            <div class="login-footer">
                <div class="row bs-reset">
                    <div class="col-xs-5 bs-reset">
                        <ul class="login-social">
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-social-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-social-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-social-dribbble"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-7 bs-reset">
                        <div class="login-copyright text-right">
                            <p>Copyright &copy; ViiA <?php $year = (new DateTime)->format("Y"); echo $year;?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END : LOGIN PAGE 5-1 -->

<script>
    $(document).ready(function(){

        $('.login-form input').keypress(function(e) { //alert("hi");
            if (e.which == 13) {
                $("#loginBtn").trigger('click');
            }
        });
        $('.forget-form input').keypress(function(e) {
            if (e.which == 13) {
                $("#forgotBtn").trigger('click');
            }
        });

        $("#back-btn").click(function ()
        {
            $("#email_forgot").val("");
            $('.has-error').removeClass('has-error');
            var validator = $("#form_forgotpass").validate();
            validator.resetForm();
        });

        $('#form_forgotpass').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                email: {
                    required: true,
                    email:true,
                    remote: {url: "<?php echo Yii::app()->params->base_path; ?>admin/checkAdminEmailId", type: "post"}
                }
            },
            messages: {
                email:
                    {
                        required: "Please enter email id",
                        email: "Please enter valid email id",
                        remote: "Email id not exists"
                    }
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                $('.alert-danger', $('.form-horizontal')).show();
            },
            highlight: function (element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            onfocusout: function(element) {
                $(element).valid();
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
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
</script>