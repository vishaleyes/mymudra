<style>
    .control-label {
        text-align: left !important;
        margin-bottom: 0  !important;
        padding-top: 16px  !important;
        font-weight: 700  !important;
    }
    .mask ,.maskPer
    {
        text-align: left !important;
    }
</style>
<?php //echo "<pre>"; print_r($data); die;?>
<script src="<?php echo Yii::app()->params->base_url ; ?>/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
<section class="content portlet light bordered">

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        CONTACT US
                    </h2>
                </div>
                <div class="body">
                    <form action="<?php echo Yii::app()->params->base_path; ?>admin/saveContactUs" id="form_contactUs" name="form_contactUs" class="bs-example form-horizontal" method="post" enctype="multipart/form-data">

                        <div class="form-body">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="">

                                        <div class="col-md-6">
                                            <label class="control-label">Phone Number</label>
                                            <!--<a href="#" data-toggle="tooltip" title=""><i class="fa fa-paper-plane "> </i></a>-->
                                            <div class="form-group form-md-line-input col-md-12">
                                                <div class="form-line">
                                                    <input type="text" name="phone_number"  id="phone_number" class="form-control mask" placeholder="Enter phone number" data-required="1" value="<?php echo $data['phone_number']; ?>" >
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <label class="control-label">Email</label>
                                            <!--<a href="#" data-toggle="tooltip" title=""><i class="fa fa-paper-plane "> </i></a>-->
                                            <div class="form-group form-md-line-input col-md-12">
                                                <div class="form-line">
                                                    <input class="form-control" id="email" type="text" name="email" data-required="1" placeholder="Enter email" value="<?php echo $data['email']; ?>" />
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <label class="control-label">Instagram</label>
                                            <!--<a href="#" data-toggle="tooltip" title=""><i class="fa fa-paper-plane "> </i></a>-->
                                            <div class="form-group form-md-line-input col-md-12">
                                                <div class="form-line">
                                                    <input class="form-control" id="instagram" type="text" name="instagram" data-required="1" placeholder="Enter Instagram account id" value="<?php echo $data['instagram']; ?>" />
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <label class="control-label">Twitter</label>
                                            <!--<a href="#" data-toggle="tooltip" title=""><i class="fa fa-paper-plane "> </i></a>-->
                                            <div class="form-group form-md-line-input col-md-12">
                                                <div class="form-line">
                                                    <input class="form-control" id="twitter" type="text" name="twitter" data-required="1" placeholder="Enter Twitter account id" value="<?php echo $data['twitter']; ?>" />
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <label class="control-label">Support Email</label>
                                            <!--<a href="#" data-toggle="tooltip" title=""><i class="fa fa-paper-plane "> </i></a>-->
                                            <div class="form-group form-md-line-input col-md-12">
                                                <div class="form-line">
                                                    <input class="form-control" id="support_email" type="text" data-required="1" name="support_email" placeholder="Enter support email id" value="<?php echo $data['support_email']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">

                                        <input class="form-control" id="contact_us_id" type="hidden" name="contact_us_id" placeholder="Resendotp Timer" value="<?php echo $data['contact_us_id']; ?>" />

                                        <div class="col-md-6" style="margin-top:5px;">
                                            <button type="submit" name="FormSubmit" class="btn green-haze btn-outline sbold uppercase">UPDATE</button>
                                            <a href="<?php echo Yii::app()->params->base_path; ?>admin/dashboard">
                                                <button type="button" class="btn red-mint btn-outline sbold uppercase">Cancel</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>


<script>
    $(document).ready(function(){

        $('.mask').inputmask({alias: 'numeric',
            allowMinus: false,
            digits: 2,
            //min: 1,
            //max: 100.00
        });

        $('.maskPer').inputmask({alias: 'numeric',
            allowMinus: false,
            digits: 2,
            //min: 1,
            max: 100.00
        });

        $('#form_contactUs').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                phone_number: {
                    required: true,

                },
                email: {
                    required: true,

                },
                instagram: {
                    required: true
                },
                twitter: {
                    required: true,

                },
                support_email: {
                    required: true,

                }
            },
            messages: {
                phone_number: {
                    required: "Please enter phone number",
                                   },
                email: {
                    required: "Please enter phone number",
                },
                instagram: {
                    required: "Please enter phone number"
                },
                twitter: {
                    required: "Please enter phone number",

                },
                support_email: {
                    required: "Please enter phone number",

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

            }
        });

    });

    setTimeout(function()
    {
        $('.alert-success').fadeOut();
    }, 6000 );

</script>

<!--<script src="<?php /*echo Yii::app()->params->base_url ; */?>/assets/pages/scripts/form-input-mask.min.js" type="text/javascript"></script>-->