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
                                <b>Bank Loan User Details
                            </h4>
                        </div>
                        <div class="col-md-3 margin-top-10" style="text-align: right;">

                            <!--<a href="javascript:void(0);"  lang="<?php /*echo Yii::app()->params->base_path;*/?>ConPowerOfAttorney/conPowerOfAttorneyListing/tender_id/<?php /*echo $userData['tender_id']; */?>/tender_project_type_id/<?php /*echo $userData['tender_project_type_id']; */?>" class="btn btn-sm green sort">Back</a>--></div>
                    </div>
                </div>

                <div class="body">
                    <!-- Default form -->
                    <form id="update_user_details_form" name="update_user_details_form" action="<?php echo Yii::app()->params->base_path;?>admin/updateUserDetails" method="post" enctype="multipart/form-data">
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
                                    <label class="control-label">Email<span class="text-error">* &nbsp;</span>:</label>
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
                                    <label class="control-label">Loan Amount<span class="text-error">*</span>:</label>
                                    <div class="controls"><input type="text" class="form-control" name="loanAmount" placeholder="Enter loan amount" value="<?php if(isset($userData['loan_data']['loan_amount']) && $userData['loan_data']['loan_amount'] != "") { echo $userData['loan_data']['loan_amount']; } ?>" id="loanAmount" /><span id="loanAmountErr"></span></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group form-md-line-input  col-md-4">
                                    <label class="control-label">Description<span class="text-error">*</span>:</label>
                                    <div class="controls"><input type="text" class="form-control" name="description" placeholder="Enter description" value="<?php if(isset($userData['loan_data']['description']) && $userData['loan_data']['description'] != "") { echo $userData['loan_data']['description']; } ?>" id="description" /><span id="descriptionErr"></span></div>
                                </div>
                                <div class="form-group form-md-line-input  col-md-4">
                                    <label class="control-label">bank<span class="text-error">*</span>:</label>
                                    <select class="form-control edited bs-select" id="bank_id" name="bank_id" data-actions-box="true" data-search="true">
                                        <option value="">Select Bank</option>
                                        <?php
                                        $TblbankObj = new TblBankMaster();
                                        $bankData = $TblbankObj->getAllBankList();
                                        foreach ($bankData as $bank)
                                        {
                                            if($userData['loan_data']['bank_id'] == $bank['bank_id'])
                                            {
                                                $selected = "selected";
                                            }
                                            else
                                            {
                                                $selected = "";
                                            }
                                            ?>
                                            <option value="<?php echo $bank['bank_id']; ?>" <?php echo $selected; ?>>
                                                <?php echo $bank['bank_name']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group form-md-line-input  col-md-4">
                                    <label class="control-label">Loan Type<span class="text-error">*</span>:</label>
                                    <select class="form-control edited bs-select" id="loan_type" name="loan_type" data-actions-box="true" data-search="true">
                                        <option value="">Select Loan Type</option>
                                        <?php
                                        $TblBankLoanTypeObj = new TblLoanTypeMaster();
                                        $loanTypeData = $TblBankLoanTypeObj->getLoanTypeList();
                                        foreach ($loanTypeData as $type)
                                        {
                                            if($userData['loan_data']['loan_type'] == $type['loan_type_id'])
                                            {
                                                $selected = "selected";
                                            }
                                            else
                                            {
                                                $selected = "";
                                            }
                                            ?>
                                            <option value="<?php echo $type['loan_type_id']; ?>" <?php echo $selected; ?>>
                                                <?php echo $type['description']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group form-md-line-input  col-md-4">
                                    <label class="control-label">Stage<span class="text-error">*</span>:</label>
                                    <select class="form-control edited bs-select" id="loan_stage" name="loan_stage" data-actions-box="true" data-search="true">
                                        <option value="">Select Stage</option>
                                        <?php
                                        $TblLoanStageObj = new TblLoanStageMaster();
                                        $loanStageData = $TblLoanStageObj->getLoanStage();
                                        foreach ($loanStageData as $stage)
                                        {
                                            if($userData['loan_data']['loan_stage_id'] == $stage['loan_stage_id'])
                                            {
                                                $selected = "selected";
                                            }
                                            else
                                            {
                                                $selected = "";
                                            }
                                            ?>
                                            <option value="<?php echo $stage['loan_stage_id']; ?>" <?php echo $selected; ?>>
                                                <?php echo $stage['loan_stage_name']; ?></option>
                                            <?php
                                        }
                                        ?>s
                                    </select>
                                </div>
                                <div class="form-group form-md-line-input hidden col-md-4">
                                    <label class="control-label">Bank Name<span class="text-error">*</span>:</label>
                                    <div class="controls"><input type="text" class="form-control" name="bankName" placeholder="Enter bank name" value="<?php if(isset($userData['loan_data']['bank_name']) && $userData['loan_data']['bank_name'] != "") { echo $userData['loan_data']['bank_name']; } ?>" id="bankName" /><span id="bankNameErr"></span></div>
                                </div>
                            </div>

                            <!--<div class="row">-->
                            <div class="form-actions align-right col-md-6">
                                <input type="hidden" name="user_ref_id" id="user_ref_id" value="<?php if(isset($userData['user_ref_id']) && $userData['user_ref_id'] != "") { echo $userData['user_ref_id'];}?>"/>
                                <input type="hidden" name="loan_id" id="loan_id" value="<?php if(isset($userData['loan_data']['loan_id']) && $userData['loan_data']['loan_id'] != "") { echo $userData['loan_data']['loan_id'];}?>"/>
                                <input type="hidden" name="loan_tran_ref_id" id="loan_tran_ref_id" value="<?php if(isset($userData['loan_data']['loan_tran_ref_id']) && $userData['loan_data']['loan_tran_ref_id'] != "") { echo $userData['loan_data']['loan_tran_ref_id'];}?>"/>


                                <a class="" style="margin-top:5px;" title="Save" type="submit">
                                    <button type="submit" class="btn btn-sm green btn-outline margin-bottom-10 margin-right-10 " name="FormSubmit">Save</button></a>
                                <a href="javascript:;" class=" btn btn-sm red btn-outline margin-bottom-10 margin-right-10 sort" lang="<?php echo Yii::app()->params->base_path;?>admin/bankLoanUserListing"> Cancel</a>

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

        $('.sort').click(function() {
            var url	=	$(this).attr('lang');
            $("html, body").animate({ scrollTop: 0 }, "slow");
            $arr = $(this).attr('lang').split("*");
            if($arr == '')
            {
                $arr = $(this).attr('lang').split("*");
            }
            loadBoxContent(url+'<?php echo $extraPaginationPara ; ?>','mainContainer');
            history.pushState(null, null, $arr[0]);
        });

        $("form[name = 'update_user_details_form']").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                fullName: {
                    required: true,
                },
                phoneNumber : {
                    required: true,
                },
                email: {
                    required: true,
                },
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
                loanAmount : {
                    required: true,
                },
                bank_id : {
                    required: true,
                },
                bankName : {
                    required: true,
                },
            },
            messages: {
                fullName: {
                    required: "Please enter full name",
                },
                phoneNumber : {
                    required: "Please enter phone number",
                },
                email: {
                    required: "Please enter email",
                },
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
                loanAmount : {
                    required: "Please enter loan amount",
                },
                bank_id : {
                    required: "Please select bank",
                },
                bankName : {
                    required: "Please enter bank name",
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