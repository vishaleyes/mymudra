<!-- content -->

<section class="portlet light bordered">

    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        CHANGE PASSWORD
                    </h2>

                </div>
                <div class="body">
                    <form action="<?php echo Yii::app()->params->base_path; ?>admin/changePassword"
                          id="form_change_password" name="form_change_password"
                          class="bs-example form-horizontal" method="post" enctype="multipart/form-data">

                        <div class="form-body">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group form-md-line-input  col-md-8">
                                        <div class="form-line">
                                            <input type="password" name="old_password"
                                                   value="" id="old_password" class="form-control"
                                                   placeholder="Old Password" data-required="1"/>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input col-md-8">
                                        <div class="form-line ">
                                            <input type="password" name="new_password"
                                                   value="" id="new_password" class="form-control"
                                                   placeholder="New Password" data-required="1"/>
                                            <span id="spanemail" style="color:red"></span>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input col-md-8">
                                            <div class="form-line ">
                                                <input type="password" name="re_enter_password"
                                                       value="" id="re_enter_password" class="form-control"
                                                       placeholder="Confirm Password" data-required="1"/>
                                            </div>
                                        </div>

                                    </div>


                                </div>

                            </div>

                        </div>
                        <div class="row">&nbsp;</div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="adminId"
                                       value="<?php echo Yii::app()->session[_SITENAME_.'_admin']; ?>"/>

                                <button type="submit" name="FormSubmit" id="btn_submit"
                                        class="btn m-b-xs w-xs btn-primary waves-effect">Submit
                                </button>
                                <a href="<?php echo Yii::app()->params->base_path; ?>admin/changePassword">
                                    <button type="button" class="btn m-b-xs w-xs btn-danger waves-effect">
                                        Cancel
                                    </button>
                                </a>
                            </div>
                        </div>

                        </div>
                        <div class="form-actions fluid">

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Input -->

</section>


<script>

    $(document).ready(function () {

        $("#old_password-error").remove();

        $("#old_password").on("change blur",function () {
            var val = $.trim($(this).val());

            $("#old_password-error").remove();
            if(val == "")
            {
                $("#old_password").closest('.form-group').addClass('has-error');
                $('<span id="old_password-error" class="help-block" style="color: #e73d4a;">Please enter the old password</span>').insertAfter("#old_password");
                $("#btn_submit").prop("disabled", true);
                return false;
            }
            else
            {
                if($('.help-block').length == 0)
                {
                    $("#btn_submit").removeAttr("disabled");
                }
            }
        });

        $("#new_password").on("change blur",function () {
            var val = $.trim($(this).val());

            $("#new_password-error").remove();
            if(val == "")
            {
                $("#new_password").closest('.form-group').addClass('has-error');
                $('<span id="new_password-error" class="help-block" style="color: #e73d4a;">Please enter the new password</span>').insertAfter("#new_password");
                $("#btn_submit").prop("disabled", true);
                return false;
            }
            else
            {
                if($('.help-block').length == 0)
                {
                    $("#btn_submit").removeAttr("disabled");
                }
            }
        });

        $("#re_enter_password").on("change blur",function () {
            var val = $.trim($(this).val());

            $("#re_enter_password-error").remove();
            if(val == "")
            {
                $("#re_enter_password").closest('.form-group').addClass('has-error');
                $('<span id="re_enter_password-error" class="help-block" style="color: #e73d4a;">Please enter the confirm password</span>').insertAfter("#re_enter_password");
                $("#btn_submit").prop("disabled", true);
                return false;
            }
            else
            {
                if($('.help-block').length == 0)
                {
                    $("#btn_submit").removeAttr("disabled");
                }
            }
        });


        $('#form_change_password').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                old_password: {
                    required: true,
                    remote: {url: "<?php echo Yii::app()->params->base_path; ?>admin/checkOldPassword/", type: "post"}
                },
                new_password: {
                    required: true,
                    minlength: 6
                },
                re_enter_password: {
                    required: true,
                    equalTo: "#new_password"
                }
            },
            messages: {
                old_password: {
                    required: "Please enter the old password",
                    remote: "Old password does not match"
                },
                new_password: {
                    required: "Please enter the new password",
                },
                re_enter_password: {
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