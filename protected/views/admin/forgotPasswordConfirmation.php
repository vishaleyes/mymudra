<style>
  .login-logo img {
      margin: 0px auto;
  }
  .login-title,.login-paragraph {
      text-align: center;
  }

</style>


<!-- content -->

<section class="portlet light bordered">

    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12" style="margin-top: 70px;">
            <div class="login-logo">
                <img src="<?php echo Yii::app()->params->base_url ; ?>assets/pages/img/login_logo.png" class="img-responsive" alt="logo" style="height: 62px;
                        width: 150px;">
            </div>
            <h1 class="login-title">Reset Password</h1>
            <p class="login-paragraph">Verification Link is sent to Your Mail Address.<br/>
                Please check your mail in order to verify your account. </p>
        </div>
        <div class="col-lg-9 col-md-9 col-lg-offset-3 col-md-offset-3 ">
            <!--<div class="col-lg-12">
                <div class="login-logo">
                    <img src="<?php /*echo Yii::app()->params->base_url ; */?>assets/pages/img/login_logo.png" class="img-responsive" alt="logo" style="height: 62px;
                        width: 150px;">
                </div>
                <h1 class="login-title">Reset Password</h1>
                <p class="login-paragraph">Verification Link is sent to Your Mail Address.
                    Please check your mail in order to verify your account. </p>
            </div>-->
            <div class="card">

                <!--<div class="header">
                    <h2>
                        CHANGE PASSWORD
                    </h2>
                </div>-->
                <div class="body">
                    <form action="<?php echo Yii::app()->params->base_path; ?>admin/resetPassword"
                          id="form_change_password" name="profile_form"
                          class="bs-example form-horizontal" method="post" enctype="multipart/form-data">

                        <div class="form-body">

                            <div class="row">
                                <div class="col-md-6 col-md-offset-2 ">

                                    <div class="row">
                                        <div class="form-group form-md-line-input  col-md-10">
                                            <div class="form-line">
                                                <input type="text" name="token" id="token" class="form-control" placeholder="verification code"  <?php if( isset($token) ) {?>value="<?php echo $token;?>" <?php }?> readonly/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group form-md-line-input col-md-10">
                                            <div class="form-line ">
                                                <input type="password" name="new_password"
                                                       value="<?php if (isset($AreaData['area']) && $AreaData['area'] != '') {
                                                           echo $AreaData['area'];
                                                       } ?>" id="new_password" class="form-control"
                                                       placeholder="New Password" data-required="1"/>
                                                <span id="spanemail" style="color:red"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group form-md-line-input col-md-10">
                                            <div class="form-line ">
                                                <input type="password" name="new_password_confirm"
                                                       value="<?php if (isset($AreaData['area']) && $AreaData['area'] != '') {
                                                           echo $AreaData['area'];
                                                       } ?>" id="new_password_confirm" class="form-control"
                                                       placeholder="Confirm Password" data-required="1"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="text-center">
                                            <input type="hidden" name="admin_id"
                                                   value="<?php echo $_REQUEST['admin_id']; ?>"/>

                                            <button type="submit" name="submit_reset_password_btn"
                                                    class="btn m-b-xs w-xs btn-primary waves-effect col-md-4">Submit
                                            </button>

                                        </div>
                                    </div>



                                </div>
                            </div>

                        </div>

                </div>

                <div class="row">&nbsp;</div>
                <!--<div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="admin_id"
                               value="<?php /*echo $_REQUEST['admin_id']; */?>"/>

                        <button type="submit" name="FormSubmit"
                                class="btn m-b-xs w-xs btn-primary waves-effect">Submit
                        </button>

                    </div>
                </div>-->

            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-1 text-center">
                    <div class="register-link text-center"><a href="#" class="active">Need More Help?</a></div>
                    <div class="register-link text-center">Already have an account ? - <a href="<?php echo Yii::app()->params->base_path; ?>admin/index">Login Now</a></div>
                </div>

            </div>
            <div class="form-actions fluid">

            </div>
            </form>
        </div>
    </div>

    <!-- #END# Input -->

</section>


<script>

    $(document).ready(function () {


        $('#form_change_password').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                new_password: {
                    required: true,
                    minlength: 6
                },
                new_password_confirm: {
                    required: true,
                    equalTo: "#new_password"
                }
            },
            messages: {
                new_password: {
                    required: "Please enter the new password",
                },
                new_password_confirm: {
                    required: "Please enter the confirm password",
                    equalTo: "Enter confirm password same as password"
                }
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                $('.alert-danger', $('.form-horizontal')).show();
            },
            highlight: function (element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            onfocusout: function (element) {
                $(element).valid();
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element.closest('.form-control'));
                $("#name-error").css("position","absolute");
            },
            submitHandler: function (form) { //alert("call");

                //$('.form-horizontal').submit();
                form.submit(); // form validation success, call ajax form submit
                //submitForm();
            }
        });


    });

    function submitForm()
    {
        var formData = $("#form_change_password").serialize();
        $.ajax ({
            url: '<?php echo Yii::app()->params->base_path; ?>admin/changePassword',
            data: formData,
            method: 'post',
            cache: false,
            success: function(response)
            {
                var obj = $.parseJSON(response);
                if(obj.message_type == "success")
                {
                    $("#update_message").addClass("custom-alerts alert alert-success");
                }
                else
                {
                    $("#update_message").addClass("custom-alerts alert alert-danger");
                }

                $('#form_change_password')[0].reset();
                $("#msg").html(obj.message);
                $("#update_message").fadeIn();
                setTimeout(function() { $("#update_message").fadeOut('2000');}, 10000 );


            }
        });
    }
    setTimeout(function () {
        $('.alert-success').fadeOut();
    }, 6000);

</script>
<!-- / content -->