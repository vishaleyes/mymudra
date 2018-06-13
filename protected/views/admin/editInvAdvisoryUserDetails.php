<style>
    .form-group.form-md-line-input .help-block
    {
        opacity: 10 !important;
        color: #e73d4a;
    }
    .form-group .help-block
    {
        opacity: 10 !important;
        color: #e73d4a;
    }
    .white-font
    {
        color: white !important;
    }
    .form-horizontal .control-label {
        text-align: left !important;
        font-weight: 600;
    }
    .mt-repeater .mt-repeater-title {
        font-size: 18px;
        text-transform: none !important;
        margin-top: 0;
        font-weight: 600;
    }
    .form-control {
        border-radius: 0px !important;
    }
    .fileinput-button input {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        opacity: 0;
        -ms-filter: 'alpha(opacity=0)';
        font-size: 200px;
        direction: ltr;
        cursor: pointer;
    }

    input[type=file] {
        display: block;
    }

    b, optgroup, strong{
        font-weight:600 !important;
    }

    .fileinput-preview.thumbnail.mb20 {
        width: 50px;
        height: 50px;
    }
    /*.img-responsive {
        width: 50px;
        height: 50px;
    }*/

    .btn.btn-outline.green-sharp {
        margin-left: 05px;
    }

    .bootstrap-select.btn-group .dropdown-menu.inner {
        max-width: 600px;
        overflow-x: auto;
        min-width: 200px;
    }
</style>
<style>
    .text-error{
        color:red;
        margin-left: 2px;
    }
</style>
<?php //echo "<pre>"; print_r($userData); die;?>

<section class="portlet light bordered">

    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-md-9">
                            <h4>
                                <b>Investment Advisory User Details
                            </h4>
                        </div>
                        <div class="col-md-3 margin-top-10" style="text-align: right;">

                            <!--<a href="javascript:void(0);"  lang="<?php /*echo Yii::app()->params->base_path;*/?>ConPowerOfAttorney/conPowerOfAttorneyListing/tender_id/<?php /*echo $userData['tender_id']; */?>/tender_project_type_id/<?php /*echo $userData['tender_project_type_id']; */?>" class="btn btn-sm green sort">Back</a>--></div>
                    </div>
                </div>

                <div class="body">
                    <!-- Default form -->
                    <form id="update_inv_user_details_form" name="update_inv_user_details_form" action="<?php echo Yii::app()->params->base_path;?>admin/updateInvAdvisoryUserDetails" method="post" enctype="multipart/form-data">
                        <div class="widget">
                            <div class="row">
                                <div class="form-group form-md-line-input  col-md-4">
                                    <label class="control-label">Full Name<span class="text-error">* &nbsp;</span>:</label>
                                    <div class="controls"><input type="text" class="form-control" name="fullName" placeholder="Enter Full Name" value="<?php if(isset($userData['full_name']) && $userData['full_name'] != "") { echo $userData['full_name']; } ?>" id="fullName" /><span id="fullNameErr"></span></div>
                                </div>
                                <div class="form-group form-md-line-input  col-md-4">
                                    <label class="control-label">Phone Number<span class="text-error">*</span>:</label>
                                    <div class="controls"><input type="text" class="form-control" name="phoneNumber" placeholder="Enter Phone Number" value="<?php if(isset($userData['phone_number']) && $userData['phone_number'] != "") { echo $userData['phone_number']; } ?>" id="phoneNumber" /><span id="phoneNumberErr"></span></div>
                                </div>
                                <div class="form-group form-md-line-input  col-md-4">
                                    <label class="control-label">Email:</label>
                                    <div class="controls"><input type="text" class="form-control" name="email" placeholder="Enter email" value="<?php if(isset($userData['email']) && $userData['email'] != "") { echo $userData['email']; } ?>" id="email" /><span id="emailErr"></span></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group form-md-line-input  col-md-4">
                                    <label class="control-label">Street<span class="text-error">*</span>:</label>
                                    <div class="controls"><input type="text" class="form-control" name="street" placeholder="Enter address" value="<?php if(isset($userData['street']) && $userData['street'] != "") { echo $userData['street']; } ?>" id="street" /><span id="streetErr"></span></div>
                                </div>
                                <div class="form-group form-md-line-input  col-md-4">
                                    <label class="control-label">City<span class="text-error">*</span>:</label>
                                    <div class="controls"><input type="text" class="form-control" name="city" placeholder="Enter city" value="<?php if(isset($userData['city']) && $userData['city'] != "") { echo $userData['city']; } ?>" id="city" /><span id="cityErr"></span></div>
                                </div>
                                <div class="form-group form-md-line-input  col-md-4">
                                    <label class="control-label">State<span class="text-error">*</span>:</label>
                                    <div class="controls"><input type="text" class="form-control" name="state" placeholder="Enter state" value="<?php if(isset($userData['state']) && $userData['state'] != "") { echo $userData['state']; } ?>" id="state" /><span id="stateErr"></span></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group form-md-line-input  col-md-4">
                                    <label class="control-label">Pincode<span class="text-error">*</span>:</label>
                                    <div class="controls"><input type="text" class="form-control" name="pincode" placeholder="Enter pincode" value="<?php if(isset($userData['pincode']) && $userData['pincode'] != "") { echo $userData['pincode']; } ?>" id="pincode" /><span id="pincodeErr"></span></div>
                                </div>
                                <div class="form-group form-md-line-input  col-md-4">
                                    <label class="control-label">Annual Income<span class="text-error">*</span>:</label>
                                    <div class="controls"><input type="text" class="form-control" name="annualIncome" placeholder="Enter annual income" value="<?php if(isset($userData['annual_income']) && $userData['annual_income'] != "") { echo $userData['annual_income']; } ?>" id="annualIncome" /><span id="annualIncomeErr"></span></div>
                                </div>
                                <div class="form-group form-md-line-input  col-md-4">
                                    <label class="control-label">Investment Amount<span class="text-error">*</span>:</label>
                                    <div class="controls"><input type="text" class="form-control" name="invAmount" placeholder="Enter Investment amount" value="<?php if(isset($userData['inv_data']['inv_amount']) && $userData['inv_data']['inv_amount'] != "") { echo $userData['inv_data']['inv_amount']; } ?>" id="invAmount" /><span id="invAmountErr"></span></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group form-md-line-input  col-md-4">
                                    <label class="control-label">Description:</label>
                                    <div class="controls"><input type="text" class="form-control" name="description" placeholder="Enter description" value="<?php if(isset($userData['inv_data']['description']) && $userData['inv_data']['description'] != "") { echo $userData['inv_data']['description']; } ?>" id="description" /><span id="descriptionErr"></span></div>
                                </div>
                                <div class="form-group form-md-line-input  col-md-4">
                                    <label class="control-label">Investment Type<span class="text-error">*</span>:</label>
                                    <select class="form-control edited bs-select" id="inv_type" name="inv_type" data-actions-box="true" data-search="true">
                                        <option value="">Select Type</option>
                                        <?php
                                        $TblInvTypeObj = new TblInvTypeMaster();
                                        $invTypeData = $TblInvTypeObj->getInvTypeList();
                                        foreach ($invTypeData as $type)
                                        {
                                            if($userData['inv_data']['inv_type'] == $type['inv_type_id'])
                                            {
                                                $selected = "selected";
                                            }
                                            else
                                            {
                                                $selected = "";
                                            }
                                            ?>
                                            <option value="<?php echo $type['inv_type_id']; ?>" <?php echo $selected; ?>>
                                                <?php echo $type['description']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group form-md-line-input  col-md-4">
                                    <label class="control-label">Investment Stage<span class="text-error">*</span>:</label>
                                    <select class="form-control edited bs-select" id="inv_stage" name="inv_stage" data-actions-box="true" data-search="true">
                                        <option value="">Select Stage</option>
                                        <?php
                                        $TblInvStageObj = new TblInvStageMaster();
                                        $invStageData = $TblInvStageObj->getInvStage();
                                        foreach ($invStageData as $stage)
                                        {
                                            if($userData['inv_data']['inv_stage_id'] == $stage['inv_stage_id'])
                                            {
                                                $selected = "selected";
                                            }
                                            else
                                            {
                                                $selected = "";
                                            }
                                            ?>
                                            <option value="<?php echo $stage['inv_stage_id']; ?>" <?php echo $selected; ?>>
                                                <?php echo $stage['inv_stage_name']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!--<div class="row">-->
                            <div class="form-actions align-right col-md-6">
                                <input type="hidden" name="user_ref_id" id="user_ref_id" value="<?php if(isset($userData['user_ref_id']) && $userData['user_ref_id'] != "") { echo $userData['user_ref_id'];}?>"/>
                                <!--<input type="hidden" name="inv_id" id="inv_id" value="<?php /*if(isset($userData['inv_data']['inv_id']) && $userData['inv_data']['inv_id'] != "") { echo $userData['inv_data']['inv_id'];}*/?>"/>-->
                                <input type="hidden" name="inv_id" id="inv_id" value="<?php if(isset($userData['inv_data']['inv_transaction_id']) && $userData['inv_data']['inv_transaction_id'] != "") { echo $userData['inv_data']['inv_transaction_id'];}?>"/>
                                <input type="hidden" name="inv_tran_ref_id" id="inv_tran_ref_id" value="<?php if(isset($userData['inv_data']['inv_tran_ref_id']) && $userData['inv_data']['inv_tran_ref_id'] != "") { echo $userData['inv_data']['inv_tran_ref_id'];}?>"/>


                                <a class="" style="margin-top:5px;" title="Save" type="submit">
                                    <button type="submit" class="btn btn-sm green btn-outline margin-bottom-10 margin-right-10 " name="FormSubmit">Save</button></a>
                                <a href="javascript:;" class=" btn btn-sm red btn-outline margin-bottom-10 margin-right-10 sort" lang="<?php echo Yii::app()->params->base_path;?>admin/invAdvisoryUserListing"> Cancel</a>

                            </div>
                            <!--</div>-->

                        </div>
                    </form>
                    <!-- /default form -->
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    function loadBoxContent(urlData,boxid)
    {
        $("#Loaderaction").css('display','inline-block');
        $("html, body").animate({scrollTop: 0}, "slow");
        $( "#mainContainer" ).css( 'opacity', '0.5' );
        $.ajax({
            type: 'POST',
            url: urlData,
            data: '',
            cache: true,
            success: function(data)
            {
                if(data=="logout")
                {
                    window.location.href = '<?php echo Yii::app()->params->base_path;?>site';
                    return false;
                }
                $("#mainContainer").html(data);
                $(window).scrollTop(0);
                $("#Loaderaction").css('display','none');
                $( "#mainContainer" ).css( 'opacity', '1' );
            }
        });
    }

    $(document).ready(function()
    {
        var i=0;
        jQuery("input,textarea").on('keypress',function(e){
            //alert();
            if(jQuery(this).val().length < 1){
                if(e.which == 32){
                    //alert(e.which);
                    return false;
                }
            }
            else {
                if(e.which == 32){
                    if(i != 0){
                        return false;
                    }
                    i++;
                }
                else{
                    i=0;
                }
            }
        });

        $("#monthYear").datepicker({
            changeMonth: true,
            changeYear: true,
            viewMode: "months",
            minViewMode: "months",
            format: 'MM-yyyy',
        }).on('change', function (ev) {
            if ($(this).valid()) {
                $(this).closest('.form-group').removeClass('has-error');
                $('.this-error').remove();
            }
        });

        $('.onlyNumber').keypress(function(e){
            if (this.value.length == 0 && e.which == 48 ){
                return false;
            }

        });

        $(".date-picker").datepicker({
        }).on('change', function (ev) {
            if ($(this).valid()) {
                $(this).closest('.form-group').removeClass('has-error');
                $('.this-error').remove();
            }
        });

        $('#link_pager a').each(function(){
            $(this).click(function(ev){
                $("#paginationLoader").css('display','inline-block');
                ev.preventDefault();
                $.get(this.href,{ajax:true},function(html){
                    $('#mainContainer').html(html);
                    $("#paginationLoader").css('display','none');
                });


            });
        });

        $('.sort').click(function(e) {
            $("html, body").animate({ scrollTop: 0 }, "slow");
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            $(this).prop("disabled", true);
            var url	=	$(this).attr('lang');
            $arr = $(this).attr('lang').split("*");
            if($arr == '')
            {
                $arr = $(this).attr('lang').split("*");
            }
            history.pushState(null, null, $arr[0]);
            loadBoxContent(url+'<?php echo $extraPaginationPara ; ?>','mainContainer');

        });

        $("form[name = 'update_inv_user_details_form']").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                fullName: {
                    required: true,
                },
                phoneNumber : {
                    required: true,
                    maxlength: 10,
                    minlength: 10,
                },
                /*email: {
                    required: true,
                },*/
                street: {
                    required: true,
                },
                city  : {
                    required: true,
                },
                state : {
                    required: true,
                },
                pincode : {
                    required: true,
                },
                annualIncome : {
                    required: true,
                },
                invAmount : {
                    required: true,
                },
                inv_stage : {
                    required: true,
                },
                inv_type : {
                    required: true,
                },
            },
            messages: {
                fullName: {
                    required: "Please enter full name",
                },
                phoneNumber : {
                    required: "Please enter phone number",
                    maxlength: "Please enter maximum 10 digits",
                    minlength: "Please enter minimum 10 digits",
                },
                /*email: {
                    required: "Please enter email",
                },*/
                street: {
                    required: "Please enter address",
                },
                city  : {
                    required: "Please enter city",
                },
                state : {
                    required: "Please enter state",
                },
                pincode : {
                    required: "Please enter pincode",
                },
                annualIncome : {
                    required: "Please enter annual income",
                },
                invAmount : {
                    required: "Please enter investment amount",
                },
                inv_stage : {
                    required: "Please select stage",
                },
                inv_type : {
                    required: "Please select investment type",
                },
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
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->