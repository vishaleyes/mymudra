<style>
    #email_forgot-error
    {
        color: #e73d4a;
    }
    .partner_login{
        font-size: 15px;
        font-weight: 600;
    }

    .form-group.has-error
    {
        /*border-bottom: 2px solid #ed6b75!important;*/
        border-bottom: none !important;
    }
</style>
<!-- BEGIN : LOGIN PAGE 5-1 -->
<div class="user-login-5">
    <div class="row bs-reset">
        <div class="col-md-6 bs-reset mt-login-5-bsfix">
            <div class="login-bg" style="background-image:url(assets/pages/img/login/bg1.jpg)">
            <!--<div class="login-bg" style="background-image:url(assets/pages/img/login/bg-opacity.png)">-->
                <!--<img class="login-logo" src="assets/pages/img/logo-big.png" />--> </div>
        </div>
        <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
            <div class="row">
                <div class="col-lg-12 col-md-12" style="text-align: center; margin-top: 15%;">
                    <h2>Create your account</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4 col-sm-6 col-sm-offset-3" style="text-align: center; margin-top: 1%;">
                    <a href="#contractor" data-toggle="tab" aria-expanded="true">User Sign Up</a>
                </div>
            </div>
            <div class="row">
                <div class="tab-content" style="margin-top: 1%;">
                    <div role="tabpanel" class="tab-pane fade active in" id="user">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                                <form id="user_signup" name="user_signup" method="post" action="<?php echo Yii::app()->params->base_path ; ?>admin/registerUser" class="form-validation">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control bs-select" id="employment_type" name="employment_type">
                                            <option value="">Select Employment Type</option>
                                            <option value="1">Salaried Employed</option>
                                            <option value="2">Self Employed</option>
                                        </select>
                                        <!--<input type="text" class="form-control" id="employment_type" name="employment_type" placeholder="Salary/Self Employ">-->
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="annual_income" name="annual_income" placeholder="Enter annual income">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="street" name="street" placeholder="Enter address">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="city" name="city" placeholder="Enter city">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="state" name="state" placeholder="Enter state">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Enter pincode">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    </div>
                                    <!--<div class="checkbox checkbox-primary s-c form-group">
                                        <input type="checkbox"  id="remember" class="rem form-control"  name="remember" checked>
                                        <label for="remember" class="c_label">
                                            Yes, I agree to Deal Pay's Terms of Service.
                                        </label>
                                    </div>-->
                                    <div class="clearfix"></div>
                                    <div class="signup-btn">
                                        <button type="submit" name="signupButton" class="btn btn-default">Register</button>
                                        <button type="button" name="cancelButton" class="btn btn-default"><a href="<?php echo Yii::app()->params->base_path;?>admin/adminLogin" style="color: #111213">Cancel</a></button>
                                    </div>
                                </form><!--End Form-->
                            </div>
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

        $.validator.addMethod("validEmail",function(value, element) {
            return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
        },"Please enter a valid email address");

        jQuery.validator.addMethod("noSpace", function(value, element) {
            return value.trim() != "" && value != "";
        }, "Please don't leave empty");

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

        $('#user_signup').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                email: {
                    //required: true,
                    validEmail: true,
                    noSpace: true,
                    remote: {url: "<?php echo Yii::app()->params->base_path; ?>admin/checkAdminEmailId", type: "post"}
                },
                full_name: {
                    required: true,
                },
                phone_number: {
                    required: true,
                    number: true,
                    maxlength: 10,
                    minlength: 10,
                },
                employment_type: {
                    required: true,
                },
                street: {
                    required: true,
                },
                city: {
                    required: true,
                },
                state: {
                    required: true,
                },
                pincode: {
                    required: true,
                },
                password: {
                    required: true,
                    noSpace:true,
                },
                annual_income: {
                    required: true,
                },
            },
            messages: {
                email: {
                    //required: "Please enter email id",
                    remote: "Email id already exists"
                },
                full_name: {
                    required: "Please Enter full name",
                },
                phone_number: {
                    required: "Please enter phone number",
                    maxlength: "Enter maximum 10 digits",
                    minlength: "Enter minimum 10 digits",
                },
                employment_type: {
                    required: "Please enter employment type",
                },
                street: {
                    required: "Please enter address",
                },
                city: {
                    required: "Please enter city",
                },
                state: {
                    required: "Please enter state",
                },
                pincode: {
                    required: "Please enter pincode",
                },
                password: {
                    required: "Please enter password",
                },
                annual_income: {
                    required: "Please enter annual income",
                },
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