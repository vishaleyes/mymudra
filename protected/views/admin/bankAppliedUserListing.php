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
        <div class="caption"> <i class="icon-bubble font-dark hide"></i> <span class="caption-subject font-hide bold uppercase">Bank Loan Listing</span> </div>

        <?php

        //echo "<pre>"; print_r($data); die;
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
            <!--<div class="col-md-12">-->
                <form class="form-horizontal"  id="bank_loan_filter" method="post" name="bank_loan_filter" novalidate="novalidate">
                <div class="form-body">

                    <div class="col-md-12  margin-bottom-30 ">
                        <div class="col-md-2 ">
                            <div class="input-group " data-date-format="dd-mm-yyyy">
                                <input type="text" class="form-control form-filter input-sm" readonly name="date_from" id="date_from" placeholder="From"
                                       value="<?php if(isset($ext['filterData']['date_from']) && $ext['filterData']['date_from'] !=''){ echo date("d-m-Y",strtotime($ext['filterData']['date_from'])); } elseif(!isset($ext['filterData']['date_from'])){ echo ''; }?>">
                                <span class="input-group-btn" style="vertical-align: top;" id="date_from_btn">
                                        <button class="btn btn-sm default" type="button" style="padding: 7px 10px;">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                            </div>

                        </div>

                        <div class="col-md-2">
                            <div class="input-group " data-date-format="dd-mm-yyyy">
                                <input type="text" class="form-control form-filter input-sm" readonly name="date_to" id="date_to" placeholder="To"
                                       value="<?php if(isset($ext['filterData']['date_to']) && $ext['filterData']['date_to'] !=''){ echo date("d-m-Y",strtotime($ext['filterData']['date_to']));} elseif(!isset($ext['filterData']['date_to'])){ echo ''; }?>">
                                <span class="input-group-btn" style="vertical-align: top;" id="date_to_btn">
                                        <button class="btn btn-sm default" type="button" style="padding: 7px 10px;">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                            </div>

                        </div>

                        <div class="col-md-3">
                            <a class="btn  btn-sm green btn-outline" onclick="searchBankLoanData();" data-toggle="tooltip" title="Search">
                                <i class="fa fa-search"></i></a>
                        </div>

                    </div>

                </div>
                </form>
            <!--</div>-->
        </div>
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
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/ur.user_ref_id/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>' style="text-decoration:none">#
                                    <?php if($ext['sortType'] == 'asc' && $ext['sortBy'] =='ur.user_ref_id'){ ?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='ur.user_ref_id'){?>
                                        <i class="fa fa-sort-up" style="float:right !important"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-unsorted" style="float:right !important" ></i>
                                    <?php }?>
                                </a>
                            </th>
                            <th style="cursor:pointer; text-align: center;">
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/full_name/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>' style="text-decoration:none">User Name
                                    <?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'full_name'){ ?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='full_name'){?>
                                        <i class="fa fa-sort-up" style="float:right !important"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-unsorted" style="float:right !important" ></i>
                                    <?php }?>
                                </a>
                            </th>
                            <th style="cursor:pointer; text-align: center;">
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/phone_number/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>' style="text-decoration:none">Phone Number
                                    <?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'phone_number'){ ?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='phone_number'){?>
                                        <i class="fa fa-sort-up" style="float:right !important"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-unsorted" style="float:right !important" ></i>
                                    <?php }?>
                                </a>
                            </th>
                            <th style="cursor:pointer; text-align: center;">
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/annual_income/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>' style="text-decoration:none">Annual Income
                                    <?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'annual_income'){ ?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='annual_income'){?>
                                        <i class="fa fa-sort-up" style="float:right !important"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-unsorted" style="float:right !important" ></i>
                                    <?php }?>
                                </a>
                            </th>
                            <th style="cursor:pointer; text-align: center;">
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/loan_amount/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>' style="text-decoration:none">Loan Amount
                                    <?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'loan_amount'){ ?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='loan_amount'){?>
                                        <i class="fa fa-sort-up" style="float:right !important"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-unsorted" style="float:right !important" ></i>
                                    <?php }?>
                                </a>
                            </th>
                            <th style="cursor:pointer; text-align: center;">
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/ltm.description/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>' style="text-decoration:none">Loan Type
                                    <?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'ltm.description'){ ?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='ltm.description'){?>
                                        <i class="fa fa-sort-up" style="float:right !important"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-unsorted" style="float:right !important" ></i>
                                    <?php }?>
                                </a>
                            </th>
                            <th style="cursor:pointer; text-align: center;">
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/loan_stage_name/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>' style="text-decoration:none">Loan Stage
                                    <?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'loan_stage_name'){ ?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='loan_stage_name'){?>
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
                            //echo "<pre>"; print_r($data); die;
                        if(!empty($data['bankUserList']))
                        {
                            foreach($data['bankUserList'] as $row)
                            {
                                $cnt = count($data['bankUserList']);
                                $cnt_page = $data['pagination']->itemCount;
                                ?>

                                <tr>
                                    <td class="text-center"><?php if(isset($row['user_ref_id']) && $row['user_ref_id']!=''){ $user_id =  $row['user_ref_id']; }else{ $user_id = "---";} ?>
                                        <?php echo $user_id;?>

                                    </td>

                                    <td style="text-align: center;">
                                        <?php
                                        if(isset($row['full_name']) && $row['full_name']!='') {
                                            $name = $row['full_name'];
                                        }
                                        else
                                        { $name =  "---";}

                                        echo $name;
                                        ?> </td>

                                    <td style="text-align: center;">
                                        <?php
                                        if(isset($row['phone_number']) && $row['phone_number']!='') {
                                            $state = $row['phone_number'];
                                        }
                                        else
                                        { $state =  "---";}

                                        echo $state;
                                        ?> </td>

                                    <td style="text-align: center;">
                                        <?php
                                        if(isset($row['annual_income']) && $row['annual_income']!='') {
                                            $annual_income = $row['annual_income'];
                                        }
                                        else
                                        { $annual_income =  "---";}

                                        echo $annual_income;
                                        ?> </td>

                                    <td style="text-align: center;">
                                        <?php
                                        if(isset($row['loan_amount']) && $row['loan_amount']!='') {
                                            $loan_amount = $row['loan_amount'];
                                        }
                                        else
                                        { $loan_amount =  "---";}

                                        echo $loan_amount;
                                        ?> </td>

                                    <td style="text-align: center;">
                                        <?php
                                        if(isset($row['loan_type_name']) && $row['loan_type_name']!='') {
                                            $loan_type_name = $row['loan_type_name'];
                                        }
                                        else
                                        { $loan_type_name =  "---";}

                                        echo $loan_type_name;
                                        ?> </td>

                                    <td style="text-align: center;">
                                        <?php
                                        if(isset($row['loan_stage_name']) && $row['loan_stage_name']!='') {
                                            $stage_name = $row['loan_stage_name'];
                                        }
                                        else
                                        { $stage_name =  "---";}

                                        echo $stage_name;
                                        ?> </td>

                                    <td style="text-align:center;"> <?php if(isset($row['createdDate']) && $row['createdDate']!=''){ echo date("d-m-y",strtotime($row['createdDate'])); }else{ echo "---";} ?> </td>


                                    <!--<td style="text-align:center;"><?php /*if (isset($row['status']) && $row['status'] != '' && $row['status'] == '1') {
                                            echo "<i class='fa fa-check-circle' style='color:green; font-size: 18px;'></i>";
                                        } else {
                                            echo "<i class='fa fa-times-circle' style='color:red; font-size: 18px;'></i>";
                                        } */?> </td>-->


                                    <td style="text-align:center;width: 75px;">

                                        <a class="sort" title="Edit" lang='<?php echo Yii::app()->params->base_path;?>admin/editUserDetails/user_ref_id/<?php echo $row['user_ref_id']; ?>'><i class="glyphicon glyphicon-edit"></i></a>

                                        <a href="javascript:;" class="" data-toggle="modal" data-target="#ModalStageStatus_<?php echo $row['user_ref_id']; ?>" title="change stage status"><i class="glyphicon glyphicon-ok"></i></a>

                                        <div id="ModalStageStatus_<?php echo $row['user_ref_id']; ?>" class="modal fade" role="dialog" style="width: 100%;">
                                            <div class="modal-dialog" style="width: 30%;">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title text-center"><?php echo $row['full_name'];?>'s status details</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?php echo Yii::app()->params->base_path; ?>admin/changeStageStatus/user_ref_id/<?php echo $row['user_ref_id'];?>/loan_tran_ref_id/<?php echo $row['loan_tran_ref_id']; ?>" class="form-horizontal col-md-12" method="post" id="stageStatus_form_<?php echo $row['user_ref_id']; ?>" name="stageStatus_form_<?php echo $row['user_ref_id']; ?>">

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h4 class="text-left"><strong>Loan Stage</strong></h4>
                                                                    <select class="form-control edited bs-select" id="loan_stage_id" name="loan_stage_id" data-actions-box="true" data-search="true">
                                                                        <option value="">Select Stage</option>
                                                                        <?php
                                                                            $TblLoanStageObj = new TblLoanStageMaster();
                                                                            $stageData = $TblLoanStageObj->getLoanStage();

                                                                            foreach ($stageData as $stage)
                                                                            {
                                                                                if($row['loan_stage_id'] == $stage['loan_stage_id'])
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
                                                                            ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row" style="margin-top: 20px; text-align: left;">
                                                                <div class="col-md-12">
                                                                    <button type="submit" class="btn btn-large btn-success">Submit</button>
                                                                    <button type="button" name="FormSubmit" class="btn btn-large btn-danger" data-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>
                                                    <div class="modal-footer"></div>
                                                </div>

                                            </div>
                                        </div>
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
                            $extraPaginationPara='&keyword='.$ext['keyword'].'&date_from='.$ext['filterData']['date_from'].
                                '&date_to='.$ext['filterData']['date_to'];
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

</script>
<script>
    $(document).ready(function () {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!

        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd;
        }
        if (mm < 10) {
            mm = '0' + mm;
        }
        var today = yyyy + '-' + mm + '-' + dd + ' 00:00:00';

        $('#date_to_btn').on('click', function (e) {
            $('#date_to').focus();
        });

        $('#date_from_btn').on('click', function (e) {
            $('#date_from').focus();
        });

        $('#date_from').datepicker({
            /* startDate: today,*/
            endDate: today,
            autoclose: true,
            format: 'dd-mm-yyyy',
        }).on('changeDate', function (selected) {

            var minDate = new Date(selected.date.valueOf());
            $('#date_to').datepicker('setStartDate', minDate);
            $('#date_from').closest('.form-group').removeClass('has-error');
            $('#date_from-error').remove();
        });

        $('#date_to').datepicker({
            endDate: today,
            autoclose: true,
            format: 'dd-mm-yyyy',
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#date_from').datepicker('setEndDate', minDate);
            $('#date_to').closest('.form-group').removeClass('has-error');
            $('#date_to-error').remove();
        });


        $('.bs-select').selectpicker('refresh');
    });


    setTimeout(function () {
        $('.alert-success').fadeOut();
    }, 6000);

    function searchBankLoanData()
    {
        //return false;
        $("#date_from-error").remove();
        $("#date_to-error").remove();

        var date_from = $("#date_from").val();
        var date_to = $("#date_to").val();

        if(date_from !='' && date_to !='')
        {
            var formData = $("#bank_loan_filter").serialize();

            $("#Loaderaction").css('display','inline-block');
            $.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->params->base_path;?>admin/bankLoanUserListing',
                data: formData,
                cache: false,
                success: function(data)
                {
                    $("#mainContainer").html(data);
                    $("#Loaderaction").css('display','none');
                }
            });

        }else if(date_from == '')
        {
            $('<span id="date_from-error" class="help-block font-red">Please select the from date.</span>').insertAfter("#date_from");
            return false;
        }else if( date_to == ''){
            $('<span id="date_to-error" class="help-block font-red">Please select the to date.</span>').insertAfter("#date_to");
            return false;
        }else {
            $('<span id="date_from-error" class="help-block font-red">Please select the from and to date.</span>').insertAfter("#date_from");
            return false;
        }

    }
</script>