<style>
    .form-group.form-md-line-input
    {
        opacity: 10 !important;
    }
    td{
        vertical-align: middle !important;
    }
    #second_weekoff-error,#second_weekoff_rule-error{
        top: 33px;
    }
    .help-block
    {
        color: 	#FF0000;
        text-align: left;
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
        var prop_stage_id = $("#prop_stage_id").val();
        var date_from = $("#date_from").val();
        var date_to = $("#date_to").val();

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
                data: 'keyword='+keyword+'&prop_stage_id='+prop_stage_id+'&date_from='+date_from+'&date_to='+date_to,
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
                data: 'keyword='+keyword+'&prop_stage_id='+prop_stage_id+'&date_from='+date_from+'&date_to='+date_to,
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
        <div class="caption"> <i class="icon-bubble font-dark hide"></i> <span class="caption-subject font-hide bold uppercase">Real Estate User Listing</span> </div>

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
        <div class="col-sm-3 col-xs-12 pull-right" style="margin-top:5px;">
            <div class="">
                <a class="btn btn-sm green  btn-outline pull-right margin-bottom-10 margin-right-10" data-toggle="modal" data-target="#myModalExportReport" title="Monthly Report"><i class="fa fa-file-excel-o"></i> Export </a>
            </div>
            <div id="myModalExportReport" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title  text-center">Real Estate Loan Applied Users Report</h4>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo Yii::app()->params->base_path; ?>admin/sendExportOfRealEstateLoanUser"
                                  class="form-horizontal col-md-12" method="post" id="monthly_report_form"
                                  name="monthly_report_form">

                                <div class="col-md-12">
                                    <div class="form-group form-md-line-input  ">
                                        <label class="control-label">Start Date<span
                                                    class="text-error">* &nbsp;</span>:</label>
                                        <div class="controls"><input type="text" class="form-control" name="fromExportDate" id="fromExportDate" placeholder="Select Start Date" value="" data-date-format="dd-mm-yyyy"/></div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group form-md-line-input  ">
                                        <label class="control-label">End Date<span
                                                    class="text-error">* &nbsp;</span>:</label>
                                        <div class="controls"><input type="text" class="form-control" name="toExportDate" id="toExportDate" placeholder="Select End Date" value="" data-date-format="dd-mm-yyyy"/></div>
                                    </div>
                                </div>

                                <div class="form-actions text-right">

                                    <a href="javascript:;" class=" btn btn-sm red btn-outline" data-dismiss="modal">
                                        Cancel</a>

                                    <a class="" style="margin-top:5px;" title="Save" type="submit">
                                        <button type="submit" class="btn btn-sm green btn-outline">Export</button>
                                    </a>


                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                        </div>
                    </div>

                </div>
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
            <form class="form-horizontal" id="real_estate_loan_filter" method="post" name="real_estate_loan_filter" novalidate="novalidate">
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
                            <a class="btn  btn-sm green btn-outline" onclick="searchRealEstateLoanData();" data-toggle="tooltip" title="Search">
                                <i class="fa fa-search"></i></a>
                        </div>

                        <div class="col-md-3 pull-right">
                            <select class="form-control form-filter input-sm"  name="prop_stage_id" id="prop_stage_id" onchange="getSearchData(this.value);">
                                <option value="">-Select Stage-</option>
                                <?php
                                $tbPropStageObj = new TblPropertyStageMaster();
                                $stage_data = $tbPropStageObj->getStageList();

                                foreach($stage_data as $stage)
                                {
                                    if(isset($ext['prop_stage_id']) && $ext['property_stage_id'] != "")
                                    {
                                        if($ext['prop_stage_id'] == $stage['property_stage_id'])
                                        {
                                            $stage_sel = "selected";
                                        }
                                        else
                                        {
                                            $stage_sel = "";
                                        }
                                    }
                                    ?>
                                    <option value="<?php echo $stage['property_stage_id'];?>"  <?php echo $stage_sel; ?>><?php echo $stage['prop_stage_name']; ?></option>
                                <?php }
                                ?>
                            </select>
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
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/ur.user_ref_id/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>/date_from/<?php echo $ext['filterData']['date_from'];?>/date_to/<?php echo $ext['filterData']['date_to'];?>/prop_stage_id/<?php echo $ext['prop_stage_id']; ?>' style="text-decoration:none">#
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
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/ur.full_name/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>/date_from/<?php echo $ext['filterData']['date_from'];?>/date_to/<?php echo $ext['filterData']['date_to'];?>/prop_stage_id/<?php echo $ext['prop_stage_id']; ?>' style="text-decoration:none">User Name
                                    <?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'ur.full_name'){ ?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='ur.full_name'){?>
                                        <i class="fa fa-sort-up" style="float:right !important"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-unsorted" style="float:right !important" ></i>
                                    <?php }?>
                                </a>
                            </th>
                            <th style="cursor:pointer; text-align: center;">
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/u.full_name/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>/date_from/<?php echo $ext['filterData']['date_from'];?>/date_to/<?php echo $ext['filterData']['date_to'];?>/prop_stage_id/<?php echo $ext['prop_stage_id']; ?>' style="text-decoration:none">Reference By
                                    <?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'u.full_name'){ ?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='u.full_name'){?>
                                        <i class="fa fa-sort-up" style="float:right !important"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-unsorted" style="float:right !important" ></i>
                                    <?php }?>
                                </a>
                            </th>
                            <th style="cursor:pointer; text-align: center;">
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/ur.phone_number/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>/date_from/<?php echo $ext['filterData']['date_from'];?>/date_to/<?php echo $ext['filterData']['date_to'];?>/prop_stage_id/<?php echo $ext['prop_stage_id']; ?>' style="text-decoration:none">Phone Number
                                    <?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'ur.phone_number'){ ?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='ur.phone_number'){?>
                                        <i class="fa fa-sort-up" style="float:right !important"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-unsorted" style="float:right !important" ></i>
                                    <?php }?>
                                </a>
                            </th>
                            <!--<th style="cursor:pointer; text-align: center;">
                                <a href="javascript:;" class="sort" lang='<?php /*echo Yii::app()->params->base_path;*/?>admin/<?php /*echo $controller_action */?>/sortType/<?php /*echo $ext['sortType'];*/?>/sortBy/annual_income/keyword/<?php /*echo $ext['keyword'];*/?>/page/<?php /*echo $ext['page']; */?>' style="text-decoration:none">Annual Income
                                    <?php /*if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'annual_income'){ */?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php /*} else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='annual_income'){*/?>
                                        <i class="fa fa-sort-up" style="float:right !important"></i>
                                    <?php /*} else { */?>
                                        <i class="fa fa-unsorted" style="float:right !important" ></i>
                                    <?php /*}*/?>
                                </a>
                            </th>-->
                            <th style="cursor:pointer; text-align: center;">
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/property_type/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>/date_from/<?php echo $ext['filterData']['date_from'];?>/date_to/<?php echo $ext['filterData']['date_to'];?>/prop_stage_id/<?php echo $ext['prop_stage_id']; ?>' style="text-decoration:none">Property Type
                                    <?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'property_type'){ ?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='property_type'){?>
                                        <i class="fa fa-sort-up" style="float:right !important"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-unsorted" style="float:right !important" ></i>
                                    <?php }?>
                                </a>
                            </th>
                            <th style="cursor:pointer; text-align: center;">
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/property_amount/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>/date_from/<?php echo $ext['filterData']['date_from'];?>/date_to/<?php echo $ext['filterData']['date_to'];?>/prop_stage_id/<?php echo $ext['prop_stage_id']; ?>' style="text-decoration:none">Property Amount
                                    <?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'property_amount'){ ?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='property_amount'){?>
                                        <i class="fa fa-sort-up" style="float:right !important"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-unsorted" style="float:right !important" ></i>
                                    <?php }?>
                                </a>
                            </th>
                            <th style="cursor:pointer; text-align: center;">
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/ptm.description/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>/date_from/<?php echo $ext['filterData']['date_from'];?>/date_to/<?php echo $ext['filterData']['date_to'];?>/prop_stage_id/<?php echo $ext['prop_stage_id']; ?>' style="text-decoration:none">Real Estate Type
                                    <?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'ptm.description'){ ?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='ptm.description'){?>
                                        <i class="fa fa-sort-up" style="float:right !important"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-unsorted" style="float:right !important" ></i>
                                    <?php }?>
                                </a>
                            </th>
                            <th style="cursor:pointer; text-align: center;">
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/prop_stage_name/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>/date_from/<?php echo $ext['filterData']['date_from'];?>/date_to/<?php echo $ext['filterData']['date_to'];?>/prop_stage_id/<?php echo $ext['prop_stage_id']; ?>' style="text-decoration:none">Real Estate Stage
                                    <?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'prop_stage_name'){ ?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='prop_stage_name'){?>
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
                        if(!empty($data['realEstateUserList']))
                        {
                            foreach($data['realEstateUserList'] as $row)
                            {
                                $cnt = count($data['realEstateUserList']);
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
                                        if(isset($row['referenceBy']) && $row['referenceBy']!='') {
                                            $full_name = trim($row['full_name']);
                                            $reference = trim($row['referenceBy']);

                                            if(0 == strcasecmp($full_name,$reference))
                                            {
                                                $reference_by_name = "Self";
                                            }
                                            else
                                            {
                                                $reference_by_name = $row['referenceBy'];
                                            }
                                            //$annual_income = $row['referenceBy'];
                                        }
                                        else
                                        { $reference_by_name =  "---";}

                                        echo $reference_by_name;
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

                                    <!--<td style="text-align: center;">
                                        <?php
/*                                        if(isset($row['annual_income']) && $row['annual_income']!='') {
                                            $annual_income = $row['annual_income'];
                                        }
                                        else
                                        { $annual_income =  "---";}

                                        echo $annual_income;
                                        */?> </td>-->

                                    <td style="text-align: center;">
                                        <?php
                                        if(isset($row['property_type']) && $row['property_type']=='1') {
                                            $prop_type = "New";
                                        }
                                        else if(isset($row['property_type']) && $row['property_type']=='2')
                                        {
                                            $prop_type = "Old";
                                        }
                                        else
                                        { $prop_type =  "---";}

                                        echo $prop_type;
                                        ?> </td>

                                    <td style="text-align: center;">
                                        <?php
                                        if(isset($row['property_amount']) && $row['property_amount']!='') {
                                            $prop_type = $row['property_amount'];
                                        }else
                                        { $prop_type =  "---";}

                                        echo $prop_type;
                                        ?> </td>


                                    <td style="text-align: center;">
                                        <?php
                                        if(isset($row['prop_type_name']) && $row['prop_type_name']!='') {
                                            $prop_type_name = $row['prop_type_name'];
                                        }
                                        else
                                        { $prop_type_name =  "---";}

                                        echo $prop_type_name;
                                        ?> </td>

                                    <td style="text-align: center;">
                                        <?php
                                        if(isset($row['prop_stage_name']) && $row['prop_stage_name']!='') {
                                            $stage_name = $row['prop_stage_name'];
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

                                        <a class="sort" title="Edit" lang='<?php echo Yii::app()->params->base_path;?>admin/editRealEstateUserDetails/user_ref_id/<?php echo $row['user_ref_id']; ?>'><i class="glyphicon glyphicon-edit"></i></a>

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
                                                        <form action="" class="form-horizontal col-md-12" method="post" id="stageStatus_form_<?php echo $row['user_ref_id']; ?>" name="stageStatus_form_<?php echo $row['user_ref_id']; ?>">
                                                            <div class="row">
                                                                <input type="hidden" name="user_ref_id" id="user_ref_id" value="<?= $row['user_ref_id']; ?>">
                                                                <input type="hidden" name="prop_tran_ref_id" id="prop_tran_ref_id" value="<?= $row['prop_tran_ref_id']; ?>">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h4 class="text-left"><strong>Real Estate Stage</strong></h4>
                                                                    <select class="form-control edited bs-select" id="prop_stage_id" name="prop_stage_id" data-actions-box="true" data-search="true">
                                                                        <option value="">Select Stage</option>
                                                                        <?php
                                                                        $TblPropStageObj = new TblPropertyStageMaster();
                                                                        $stageData = $TblPropStageObj->getStageList();

                                                                        foreach ($stageData as $stage)
                                                                        {
                                                                            if($row['property_stage_id'] == $stage['property_stage_id'])
                                                                            {
                                                                                $selected = "selected";
                                                                            }
                                                                            else
                                                                            {
                                                                                $selected = "";
                                                                            }
                                                                            ?>
                                                                            <option value="<?php echo $stage['property_stage_id']; ?>" <?php echo $selected; ?>>
                                                                                <?php echo $stage['prop_stage_name']; ?></option>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row" style="margin-top: 30px; text-align: left;">
                                                                <div class="col-md-12">
                                                                    <label class="control-label ">Comment if any</label>
                                                                    <div class="controls">
                                                                        <textarea class="form-control" name="comment" id="comment" value=""><?php echo $row['comment']; ?></textarea>
                                                                        <span id="comment-error" class="help-block hidden" style="color: #e73d4a;">Please enter comment</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row" style="margin-top: 30px; text-align: left;">
                                                                <div class="col-md-12">
                                                                    <button type="submit" name="FormSubmit" class="btn btn-large btn-success" onclick="updateStage('<?php echo $row['user_ref_id'];?>','<?php echo $row['prop_tran_ref_id']; ?>');">Submit</button>
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
                                '&date_to='.$ext['filterData']['date_to'].'&prop_stage_id='.$ext['prop_stage_id'];
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

        /*$('.sort').on('click',function (e) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            var url	=	$(this).attr('lang');
            loadBoxContent(url+'?php echo $extraPaginationPara ; ?>','mainContainer');
        });*/

    });

    function updateStage(user_ref_id,prop_tran_ref_id){

        $('#stageStatus_form_'+user_ref_id+'').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                prop_stage_id: {
                    required: true,
                },
            },
            messages: {
                prop_stage_id: {
                    required: "Please select stage",
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

                submitUpdatedStage(user_ref_id,prop_tran_ref_id);
            }
        });
    }

    function submitUpdatedStage(user_ref_id,prop_tran_ref_id)
    {
        //alert(user_ref_id);
        //alert(prop_tran_ref_id);

        $("#Loaderaction").css('display', 'inline-block');
        $( "#mainContainer" ).css( 'opacity', '0.5' );
        $("html, body").animate({scrollTop: 0}, "slow");

        var formdata = $("#stageStatus_form_"+user_ref_id).serialize();
        //alert(formdata);
        //return false;
        $.ajax ({
            url: '<?php echo Yii::app()->params->base_path; ?>admin/changeRealEstateStageStatus',
            data: formdata,
            method: 'post',
            cache: false,
            dataType: 'json',
            success: function(response)
            {   //alert(response.message_type);
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


    setTimeout(function()
    {
        $('.alert-success').fadeOut();
    }, 6000 );
</script>
<script>
    $(document).ready(function () {

        $('#monthly_report_form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                fromExportDate: {
                    required: true,
                },
                toExportDate: {
                    required: true,
                }
            },
            messages: {
                fromExportDate: {
                    required: "Please select start date",
                },
                toExportDate: {
                    required: "Please select end date",
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
                $("#name-error").css("position", "absolute");
            },
            submitHandler: function (form) {

                //sendEffortMail();
                //$('.form-horizontal').submit();
                form.submit(); // form validation success, call ajax form submit
                //submitForm();
            }
        });

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

        $('#fromExportDate').datepicker({
            /* startDate: today,*/
            endDate: today,
            autoclose: true,
            format: 'dd-mm-yyyy',
        }).on('changeDate', function (selected) {

            var minDate = new Date(selected.date.valueOf());
            $('#toExportDate').datepicker('setStartDate', minDate);
            $('#fromExportDate').closest('.form-group').removeClass('has-error');
            $('#fromExportDate-error').remove();
        });

        $('#toExportDate').datepicker({
            endDate: today,
            autoclose: true,
            format: 'dd-mm-yyyy',
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#fromExportDate').datepicker('setEndDate', minDate);
            $('#toExportDate').closest('.form-group').removeClass('has-error');
            $('#toExportDate-error').remove();
        });


        $('.bs-select').selectpicker('refresh');

    });

    setTimeout(function () {
        $('.alert-success').fadeOut();
    }, 6000);

    function searchRealEstateLoanData()
    {
        //return false;
        $("#date_from-error").remove();
        $("#date_to-error").remove();

        var date_from = $("#date_from").val();
        var date_to = $("#date_to").val();
        var keyword = $("#keyword").val();

        if(date_from !='' && date_to !='')
        {
            var formData = $("#real_estate_loan_filter").serialize();

            $("#Loaderaction").css('display','inline-block');
            $.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->params->base_path;?>admin/realEstateUserListing',
                data: '&date_from='+date_from+'&date_to='+date_to+'&keyword='+keyword,
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

    function getSearchData(val)
    {
        var date_from = $("#date_from").val();
        var date_to = $("#date_to").val();
        var keyword = $("#keyword").val();

        $("#Loaderaction").css('display', 'inline-block');
        $( "#mainContainer" ).css( 'opacity', '0.50' );
        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->params->base_path;?>admin/realEstateUserListing',
            data: 'prop_stage_id='+val+'&date_from='+date_from+'&date_to='+date_to+'&keyword='+keyword,
            cache: false,
            success: function (data) {
                $("#mainContainer").html(data);
                $("#prop_stage_id").val(val);
                $("#Loaderaction").css('display', 'none');
                $( "#mainContainer" ).css( 'opacity', '1' );
            }
        });
    }
</script>