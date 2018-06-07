<style>
    .form-group.form-md-line-input .help-block
    {
        opacity: 10 !important;
    }
    td{
        vertical-align: middle !important;
    }
    #second_weekoff-error,#second_weekoff_rule-error{
        top: 33px;
    }
</style>
<script>
    (function($){
        $.fn.setCursorToTextEnd = function() {
            $initialVal = this.val();
            this.val($initialVal + ' ');
            this.val($initialVal);
        };
    })(jQuery);

    function getSearch(event)
    {
        if(event.keyCode == 13)
        {
            $("#Loaderaction").css('display','inline-block');
            $( "#mainContainer" ).css( 'opacity', '0.5' );
            $("html, body").animate({scrollTop: 0}, "slow");
            var keyword = $("#keyword").val();
            //alert(keyword);
            $.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->params->base_path;?>admin/<?php echo Yii::app()->controller->action->id; ?>',
                data: 'keyword='+keyword,
                cache: false,
                success: function(data)
                {
                    $("#mainContainer").html(data);
                    $("#keyword").val(keyword).focus();
                    $('#keyword').setCursorToTextEnd();
                    $("#Loaderaction").css('display','none');
                    $("#Loaderaction").css('display', 'none');
                    $( "#mainContainer" ).css( 'opacity', '1' );
                }
            });
        }
        else if(event == 13)
        {
            $("#Loaderaction").css('display','inline-block');
            var keyword = $("#keyword").val();
            //alert(keyword);
            $.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->params->base_path;?>admin/<?php echo Yii::app()->controller->action->id; ?>',
                data: 'keyword='+keyword,
                cache: false,
                success: function(data)
                {
                    $("#mainContainer").html(data);
                    $("#keyword").val(keyword).focus();
                    $("#Loaderaction").css('display','none');
                    $("#Loaderaction").css('display', 'none');
                    $( "#mainContainer" ).css( 'opacity', '1' );
                    $('#keyword').setCursorToTextEnd();
                }
            });
        }
    }
    $( document ).ready(function() {
        $("#checkAll").change(function () {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
        });
    });

</script>
<link href="<?php echo Yii::app()->params->base_url; ?>/assets/global/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" type="text/css" />

<script src="<?php echo Yii::app()->params->base_url; ?>/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url; ?>/assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
<section class="content portlet light bordered">
    <div class="portlet-title">
        <div class="caption"> <i class="icon-bubble font-dark hide"></i> <span class="caption-subject font-hide bold uppercase">Loan Listing</span> </div>

        <?php
        //$TblRolePermissionObj = new TblRolePermission();
        //$permission = $TblRolePermissionObj->getPermissionAccess(Yii::app()->session[_SITENAME_ . '_role'], Yii::app()->session['menu_id']);
        ?>

        <div class="col-sm-3 col-xs-12 pull-right" style="margin-top:5px;">
            <div class="">
                <input type="text" placeholder="Search" name="keyword" id="keyword" onkeyup="getSearch(event);" class="input-sm form-control" value="<?php if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']!=''){ echo $_REQUEST['keyword'];}?>">
            </div>
        </div>
        <?php //if($permission['add'] == 1){ ?>
        <!--<a href="javascript:void(0);" class="btn btn-sm green btn-outline pull-right margin-bottom-10" data-toggle="modal" data-target="#myModalNewShift" style="margin-top:5px;"><i class="icon-plus"></i> New Shift </a>-->
        <?php //} ?>
        <!-- Modal -->
    </div>
    <div class="portlet-body">
        <div class="row">
            <div class="col-md-12">
                <div id="rideapprovmsg" class="margin-top-10px">
                    <?php //echo Yii::app()->admin->setFlash('error', "adsfasdfasfsadf");?>
                    <div class="alert alert-danger" style="display:none;">
                        <button class="close" data-close="alert"></button>
                        <span id="rideapprovmsg1">
                                            </span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="margin-top-10px table-responsive" id="userList">
                    <?php
                    $controller_action = Yii::app()->controller->action->id ;

                    ?>
                    <table  class="table table-striped table-bordered margin-top-10px" id="userTable">
                        <thead>
                        <tr>
                            <!--<th width="3%">
                                <label class="i-checks m-b-none">
                                    <input type="checkbox" id="checkAll"><i title="Select All"></i>
                                </label>
                            </th>-->
                            <th width="5%">
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/loan_type_id/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>' style="text-decoration:none">#
                                    <?php if($ext['sortType'] == 'asc' && $ext['sortBy'] =='loan_type_id'){ ?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='loan_type_id'){?>
                                        <i class="fa fa-sort-up" style="float:right !important"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-unsorted" style="float:right !important" ></i>
                                    <?php }?>
                                </a>
                            </th>
                            <th style="cursor:pointer; text-align: center;">
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/description/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>' style="text-decoration:none">Loan Type
                                    <?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'description'){ ?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='description'){?>
                                        <i class="fa fa-sort-up" style="float:right !important"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-unsorted" style="float:right !important" ></i>
                                    <?php }?>
                                </a>
                            </th>
                            <th style="cursor:pointer;  text-align: center;">
                                <a > Created At </a>
                            </th>
                            <!--<th style="cursor:pointer; text-align: center;">
                                <a > Status </a>
                            </th>-->
                            <th style="cursor:pointer;  text-align: center;">
                                <a > Action </a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        if(!empty($data['bankLoanList']))
                        {

                            foreach($data['bankLoanList'] as $row)
                            {

                                $cnt = count($data['bankLoanList']);
                                $cnt_page = $data['pagination']->itemCount;
                                ?>

                                <tr>
                                    <td class="text-center"><?php if(isset($row['loan_type_id']) && $row['loan_type_id']!=''){ $loan_type_id =  $row['loan_type_id']; }else{ $loan_type_id = "---";} ?>
                                        <?php echo $loan_type_id;?>

                                    </td>

                                    <td style="text-align: center;">
                                        <?php
                                        if(isset($row['description']) && $row['description']!='') {
                                            $description = $row['description'];
                                        }
                                        else
                                        { $description =  "---";}

                                        echo $description;
                                        ?> </td>

                                    <td style="text-align:center;"> <?php if(isset($row['created_at']) && $row['created_at']!=''){ echo $row['created_at']; }else{ echo "---";} ?> </td>


                                    <!--<td style="text-align:center;"><?php /*if (isset($row['status']) && $row['status'] != '' && $row['status'] == '1') {
                                            echo "<i class='fa fa-check-circle' style='color:green; font-size: 18px;'></i>";
                                        } else {
                                            echo "<i class='fa fa-times-circle' style='color:red; font-size: 18px;'></i>";
                                        } */?> </td>-->


                                    <td style="text-align:center;width: 75px;">
                                        <a href="<?php echo Yii::app()->params->base_path;?>admin/addUser" title="Add User" ><i class="icon-plus"></i></a>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        else
                        {
                            ?>
                            <tr>
                                <td colspan="100%" style="text-align:center">Record Not Found</td>
                            </tr>
                            <?php
                        }?>
                        </tbody>
                    </table>


                    <?php

                    if($cnt_page > 0 && $data['pagination']->getItemCount()  > $data['pagination']->getLimit()){?>
                        <div class="paginationDiv pull-right">
                            <?php
                            $extraPaginationPara='&keyword='.$ext['keyword'];
                            $this->widget('application.extensions.WebPager',
                                array( 'cssFile'=>Yii::app()->params->base_url."themefiles/assets/admin/layout/css/pagination.css",
                                    'extraPara'=>$extraPaginationPara,
                                    'pages' => $data['pagination'],
                                    'id'=>'link_pager',
                                ));
                            ?>
                        </div>
                        <?php
                    }?>
                </div>
            </div>

        </div>
    </div>


</section>
<script>
    function stausConfirmaction(shift_id,status)
    {
        $.ajax ({
            url: '<?php echo Yii::app()->params->base_path; ?>shift/changeShiftStatus',
            data: 'shift_id='+shift_id+'&status='+status,
            method: 'post',
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.message_type == "success")
                {
                    $("#update_message").addClass("custom-alerts alert alert-success");
                }
                else
                {
                    $("#update_message").addClass("custom-alerts alert alert-danger");
                }
                $("#Loaderaction").css('display','block');
                $.get('<?php echo Yii::app()->params->base_path;?>shift/<?php echo $controller_action ?>/menu_id/<?php echo $ext['menu_id']; ?>',{ajax:true},function(html){
                    $('#mainContainer').html(html);
                    $("#Loaderaction").css('display','none');
                    $("#msg").html(response.message);
                    $("#update_message").fadeIn();
                    setTimeout(function() { $("#update_message").fadeOut('2000');}, 60000 );
                });
            }
        });
    }

    $(document).ready(function()
    {

        $('#link_pager a').each(function(){
            $(this).click(function(ev){
                $("#paginationLoader").css('display','inline-block');
                $("html, body").animate({scrollTop: 0}, "slow");
                $("#Loaderaction").css('display', 'inline-block');
                $( "#mainContainer" ).css( 'opacity', '0.5' );
                ev.preventDefault();
                $.get(this.href,{ajax:true},function(html){
                    $('#mainContainer').html(html);
                    $("#paginationLoader").css('display','none');
                    $("#Loaderaction").css('display', 'none');
                    $( "#mainContainer" ).css( 'opacity', '1' );

                });
            });
        });

        $('.sort').on('click',function (e) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            var url	=	$(this).attr('lang');
            loadBoxContent(url+'<?php echo $extraPaginationPara ; ?>','mainContainer');
        });
    });

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

    /*function stausConfirmaction(shift_id,status)
    {
        if(status == 1){

            bootbox.confirm("Are you sure want to inactive this shift ?", function(confirmed)
            {
                if(confirmed == true)
                {
                    window.location="?php echo Yii::app()->params->base_path;?>shift/changeShiftStatus/status/"+status+"/page/?php echo $ext['page']; ?>/s_id/"+shift_id+"";
                }
                else
                {
                    return true;
                }
            });

        }else {

            bootbox.confirm("Are you sure want to active this shift ?", function(confirmed)
            {
                if(confirmed == true)
                {
                    window.location="?php echo Yii::app()->params->base_path;?>shift/changeShiftStatus/status/"+status+"/page/?php echo $ext['page']; ?>/s_id/"+shift_id+"";
                }
                else
                {
                    return true;
                }
            });
        }
    }
*/

    function deleteConfirmAction(shift_id)
    {
        bootbox.confirm("Are you sure want to delete this Shift ?", function(confirmed)
        {
            if(confirmed == true)
            {
                window.location="<?php echo Yii::app()->params->base_path;?>shift/deleteshift/shift_id/"+shift_id+" ";
            }
            else
            {
                return true;
            }

        });
    }


    setTimeout(function()
    {
        $('.alert-success').fadeOut();
    }, 6000 );
</script>
<script>

    /*function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }*/

    function updateShift(shift_id){
        $('#update_shift_form_'+shift_id+'').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                shift_name: {
                    required: true,
                    remote: {url: "<?php echo Yii::app()->params->base_path; ?>shift/checkshift/shift_id/"+shift_id+"", type: "post"}
                },
                hours: {
                    required: true,
                },
                leave_1_4_min:{
                    required: true,
                    //le: '#leave_1_4_max',
                },
                leave_1_4_max: {
                    required: true,
                    //ge: '#leave_1_4_min',
                },
                leave_1_2_min: {
                    required: true,
                },
                leave_1_2_max: {
                    required: true,
                },
                leave_3_4_min: {
                    required: true,
                },
                leave_3_4_max: {
                    required: true,
                },
                holiday_ot_min: {
                    required: true,
                },
                holiday_ot_max: {
                    required: true,
                },
                working_ot_min: {
                    required: true,
                },
                working_ot_max: {
                    required: true,
                },
                first_weekoff: {
                    required: true,
                },
                second_weekoff: {
                    required: true,
                },
                'second_weekoff_rule[]': {
                    required: true,
                },
            },
            messages: {
                shift_name: {
                    required: "Shift is required",
                    remote: "Shift already exist"
                },
                hours: {
                    required: "Hours is required",
                },
                leave_1_4_min:{
                    required: "leave_min is required",
                    le: "leave_min must be greater than leave_max",
                },
                leave_1_4_max: {
                    required: "leave_min is required",
                    ge: "leave_max must be greater than leave_min",
                },
                leave_1_2_min: {
                    required: "leave_min is required",
                },
                leave_1_2_max: {
                    required: "leave_max is required",
                },
                leave_3_4_min: {
                    required: "leave_min is required",
                },
                leave_3_4_max: {
                    required: "leave_max is required",
                },
                holiday_ot_min: {
                    required: "holiday min is required",
                },
                holiday_ot_max: {
                    required: "holiday max is required",

                },
                working_ot_min: {
                    required: "working min is required",

                },
                working_ot_max: {
                    required: "working max is required",
                },
                first_weekoff: {
                    required: "first week off is required",
                },
                second_weekoff: {
                    required: "Second week off is required",
                },
                'second_weekoff_rule[]': {
                    required: "Second week off day is required",
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
                $("#name-error").css("position","absolute");
            },
            submitHandler: function (form) {

                submitUpdatedForm(shift_id);
            }
        });
    }

    $(document).ready(function () {

        $('.bs-select').selectpicker('refresh');
        //$('#first_weekoff_rule').attr('dis','readonly');
        $("#first_weekoff_rule").prop("disabled", true);

        $("#leave_1_4_max").focusout(function(){

            if(parseFloat($("#leave_1_4_min").val()) > parseFloat($("#leave_1_4_max").val()))
            {
                //$(".error").css("display","block").css("color","red");
                //$("#submit").prop('disabled',true);
                $('#leave_1_4_min').closest('.form-group').addClass('has-error');
                $('<span id="leave_1_4_min-error" class="help-block">leave_1_4_min should not greater than leave_1_4_max</span>').insertAfter($('#leave_1_4_min'));
                //$('#leave_1_4_max').closest('.form-group').addClass('has-error');
                //$('<span id="leave_1_4_max-error" class="help-block">leave_1_4_max should not less than leave_1_4_min</span>').insertAfter($('#leave_1_4_max'));
            }
            else {
                //$(".error").css("display","none");
                //$("#submit").prop('disabled',false);
                $('#leave_1_4_min').closest('.form-group').removeClass('has-error');
                $('#leave_1_4_min-error').remove();
                //$('#leave_1_4_max').closest('.form-group').removeClass('has-error');
                //$('#leave_1_4_max-error').remove();
            }
        });

        $("#leave_1_2_max").focusout(function(){

            if(parseFloat($("#leave_1_2_min").val()) > parseFloat($("#leave_1_2_max").val()))
            {
                //$(".error").css("display","block").css("color","red");
                //$("#submit").prop('disabled',true);
                $('#leave_1_2_min').closest('.form-group').addClass('has-error');
                $('<span id="leave_1_2_min-error" class="help-block">leave_1_2_min should not greater than leave_1_2_max</span>').insertAfter($('#leave_1_2_min'));
            }
            else {
                //$(".error").css("display","none");
                //$("#submit").prop('disabled',false);
                $('#leave_1_2_min').closest('.form-group').removeClass('has-error');
                $('#leave_1_2_min-error').remove();
            }
        });

        $("#leave_3_4_max").focusout(function(){

            if(parseFloat($("#leave_3_4_min").val()) > parseFloat($("#leave_3_4_max").val()))
            {
                //$(".error").css("display","block").css("color","red");
                //$("#submit").prop('disabled',true);
                $('#leave_3_4_min').closest('.form-group').addClass('has-error');
                $('<span id="leave_3_4_min-error" class="help-block">leave_3_4_min should not greater than leave_3_4_max</span>').insertAfter($('#leave_3_4_min'));
            }
            else {
                //$(".error").css("display","none");
                //$("#submit").prop('disabled',false);
                $('#leave_3_4_min').closest('.form-group').removeClass('has-error');
                $('#leave_1_4_min-error').remove();
            }
        });

        $("#holiday_ot_max").focusout(function(){

            if(parseFloat($("#holiday_ot_min").val()) > parseFloat($("#holiday_ot_max").val()))
            {
                //$(".error").css("display","block").css("color","red");
                //$("#submit").prop('disabled',true);
                $('#holiday_ot_min').closest('.form-group').addClass('has-error');
                $('<span id="holiday_ot_min-error" class="help-block">holiday_ot_min should not greater than holiday_ot_max</span>').insertAfter($('#holiday_ot_min'));
            }
            else {
                //$(".error").css("display","none");
                //$("#submit").prop('disabled',false);
                $('#holiday_ot_min').closest('.form-group').removeClass('has-error');
                $('#holiday_ot_min-error').remove();
            }
        });

        $("#working_ot_max").focusout(function(){

            if(parseFloat($("#working_ot_min").val()) > parseFloat($("#working_ot_max").val()))
            {
                //$(".error").css("display","block").css("color","red");
                //$("#submit").prop('disabled',true);
                $('#working_ot_min').closest('.form-group').addClass('has-error');
                $('<span id="working_ot_min-error" class="help-block">working_ot_min should not greater than working_ot_max</span>').insertAfter($('#working_ot_min'));
            }
            else {
                //$(".error").css("display","none");
                //$("#submit").prop('disabled',false);
                $('#working_ot_min').closest('.form-group').removeClass('has-error');
                $('#working_ot_min-error').remove();
            }
        });

        $('#new_shift_form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                shift_name: {
                    required: true,
                    remote: {url: "<?php echo Yii::app()->params->base_path; ?>shift/checkshift/", type: "post"}
                },
                hours: {
                    required: true,
                },
                leave_1_4_min:{
                    required: true,
                    // le: '#leave_1_4_max',
                },
                leave_1_4_max: {
                    required: true,
                    // ge: '#leave_1_4_min',
                },
                leave_1_2_min: {
                    required: true,
                },
                leave_1_2_max: {
                    required: true,
                },
                leave_3_4_min: {
                    required: true,
                },
                leave_3_4_max: {
                    required: true,
                },
                holiday_ot_min: {
                    required: true,
                },
                holiday_ot_max: {
                    required: true,
                },
                working_ot_min: {
                    required: true,
                },
                working_ot_max: {
                    required: true,
                },
                first_weekoff: {
                    required: true,
                },
                second_weekoff: {
                    required: true,
                },
                'second_weekoff_rule[]': {
                    required: true,
                },
            },
            messages: {
                shift_name: {
                    required: "Shift is required",
                    remote: "Shift already exist"
                },
                hours: {
                    required: "Hours is required",
                },
                leave_1_4_min:{
                    required: "leave_min is required",
                    le: "Must be less than leave_1_4_max",
                },
                leave_1_4_max: {
                    required: "leave_min is required",
                    ge: "Must be greater than leave_1_4_min",
                },
                leave_1_2_min: {
                    required: "leave_min is required",
                },
                leave_1_2_max: {
                    required: "leave_max is required",
                },
                leave_3_4_min: {
                    required: "leave_min is required",
                },
                leave_3_4_max: {
                    required: "leave_max is required",
                },
                holiday_ot_min: {
                    required: "holiday min is required",
                },
                holiday_ot_max: {
                    required: "holiday max is required",
                },
                working_ot_min: {
                    required: "working min is required",
                },
                working_ot_max: {
                    required: "working max is required",
                },
                first_weekoff: {
                    required: "first week off is required",
                },
                second_weekoff: {
                    required: "Second week off is required",
                },
                'second_weekoff_rule[]': {
                    required: "Second week off day is required",
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
                $("#name-error").css("position","absolute");
            },
            submitHandler: function (form) {
                //var dataValidate = checkValidation();
                //$('.form-horizontal').submit();
                //form.submit(); // form validation success, call ajax form submit
                submitForm();
            }
        });
    });

    function submitForm()
    {
        //alert("okay");
        $("#Loaderaction").css('display', 'inline-block');
        $( "#mainContainer" ).css( 'opacity', '0.5' );
        $("html, body").animate({scrollTop: 0}, "slow");
        var formData = $("#new_shift_form").serialize();
        $.ajax ({
            url: '<?php echo Yii::app()->params->base_path; ?>shift/addShift',
            data: formData,
            method: 'post',
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.message_type == "success")
                {
                    $("#update_message").addClass("custom-alerts alert alert-success");
                }
                else
                {
                    $("#update_message").addClass("custom-alerts alert alert-danger");
                }
                //$("#myModalNewShift").modal('hide');
                $(".fade").remove();
                $("#Loaderaction").css('display','block');
                $.get('<?php echo Yii::app()->params->base_path;?>shift/<?php echo $controller_action ?>',{ajax:true},function(html){
                    $('#mainContainer').html(html);
                    $("#Loaderaction").css('display','none');
                    $( "#mainContainer" ).css( 'opacity', '1' );
                    $("html, body").animate({scrollTop: 0}, "slow");
                    $("#msg").html(response.message);
                    $("#update_message").fadeIn();
                    setTimeout(function() { $("#update_message").fadeOut('2000');}, 60000 );
                });

            }
        });
    }

    function submitUpdatedForm(shift_id)
    {
        $("#Loaderaction").css('display', 'inline-block');
        $( "#mainContainer" ).css( 'opacity', '0.5' );
        $("html, body").animate({scrollTop: 0}, "slow");
        var formData = $("#update_shift_form_"+shift_id).serialize();
        $.ajax ({
            url: '<?php echo Yii::app()->params->base_path; ?>shift/addShift',
            data: formData,
            method: 'post',
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if(response.message_type == "success")
                {
                    $("#update_message").addClass("custom-alerts alert alert-success");
                }
                else
                {
                    $("#update_message").addClass("custom-alerts alert alert-danger");
                }
                $(".fade").remove();
                $("#Loaderaction").css('display','block');
                $.get(this.href,{ajax:true},function(html){
                    $('#mainContainer').html(html);
                    $("#Loaderaction").css('display','none');
                    $( "#mainContainer" ).css( 'opacity', '1' );
                    $("html, body").animate({scrollTop: 0}, "slow");
                    $("#msg").html(response.message);
                    $("#update_message").fadeIn();
                    setTimeout(function() { $("#update_message").fadeOut('2000');}, 60000 );
                });

            }
        });
    }
    setTimeout(function () {
        $('.alert-success').fadeOut();
    }, 6000);

</script>