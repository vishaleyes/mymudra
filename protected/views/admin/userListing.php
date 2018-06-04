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

    /*function sendnotification()
    {
        var serviceproviderid = new Array();
        $.each($("input[name='serviceproviderid']:checked"), function() {
            serviceproviderid.push($(this).val());
            // or you can do something to the actual checked checkboxes by working directly with  'this'
            // something like $(this).hide() (only something useful, probably) :P
        });



        if(serviceproviderid=='')
        {
            bootbox.alert("Please select at list one service provider for send notification.", function() {
                // Example.show("Hello world callback");
            });
        }
        else
        {
            $('#myModalsend').modal('show');
        }
    }
*/
</script>
<link href="<?php echo Yii::app()->params->base_url; ?>/assets/global/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" type="text/css" />

<script src="<?php echo Yii::app()->params->base_url; ?>/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url; ?>/assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
<section class="content portlet light bordered">
    <div class="portlet-title">
        <div class="caption"> <i class="icon-bubble font-dark hide"></i> <span class="caption-subject font-hide bold uppercase">User Listing</span> </div>

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
            <a href="javascript:void(0);" class="btn btn-sm green btn-outline pull-right margin-bottom-10" data-toggle="modal" data-target="#myModalNewShift" style="margin-top:5px;"><i class="icon-plus"></i> New Shift </a>
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
                            <th width="3%">
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/shift_id/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>' style="text-decoration:none">#
                                    <?php if($ext['sortType'] == 'asc' && $ext['sortBy'] =='shift_id'){ ?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='shift_id'){?>
                                        <i class="fa fa-sort-up" style="float:right !important"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-unsorted" style="float:right !important" ></i>
                                    <?php }?>
                                </a>
                            </th>
                            <th style="cursor:pointer; text-align: left;">
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/shift_name/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>' style="text-decoration:none">User Name
                                    <?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'shift_name'){ ?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='shift_name'){?>
                                        <i class="fa fa-sort-up" style="float:right !important"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-unsorted" style="float:right !important" ></i>
                                    <?php }?>
                                </a>
                            </th>
                            <th style="cursor:pointer; text-align: left;">
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/fullday_hours/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>' style="text-decoration:none">Phone Number
                                    <?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'fullday_hours'){ ?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='fullday_hours'){?>
                                        <i class="fa fa-sort-up" style="float:right !important"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-unsorted" style="float:right !important" ></i>
                                    <?php }?>
                                </a>
                            </th>
                            <th style="cursor:pointer; text-align: left;">
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/leave_1_4_min/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>' style="text-decoration:none">City
                                    <?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'leave_1_4_min'){ ?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='leave_1_4_min'){?>
                                        <i class="fa fa-sort-up" style="float:right !important"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-unsorted" style="float:right !important" ></i>
                                    <?php }?>
                                </a>
                            </th>
                            <th style="cursor:pointer; text-align: left;">
                                <a href="javascript:;" class="sort" lang='<?php echo Yii::app()->params->base_path;?>admin/<?php echo $controller_action ?>/sortType/<?php echo $ext['sortType'];?>/sortBy/leave_1_4_max/keyword/<?php echo $ext['keyword'];?>/page/<?php echo $ext['page']; ?>' style="text-decoration:none">State
                                    <?php if($ext['sortType'] == 'asc' && $ext['sortBy'] == 'leave_1_4_max'){ ?>
                                        <i class="fa fa-sort-down" style="float:right !important"></i>
                                    <?php } else if($ext['sortType'] == 'desc' && $ext['sortBy'] =='leave_1_4_max'){?>
                                        <i class="fa fa-sort-up" style="float:right !important"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-unsorted" style="float:right !important" ></i>
                                    <?php }?>
                                </a>
                            </th>
                            <th style="cursor:pointer;  text-align: center;">
                                <a > Created At </a>
                            </th>
                            <th style="cursor:pointer; text-align: center;">
                                <a > Status </a>
                            </th>

                            <th style="cursor:pointer;  text-align: center;">
                                <a > Action </a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        if(!empty($data['userList']))
                        {

                            foreach($data['userList'] as $row)
                            {

                                $cnt = count($data['userList']);
                                $cnt_page = $data['pagination']->itemCount;
                                ?>

                                <tr>
                                    <td class="text-center"><?php if(isset($row['user_id']) && $row['user_id']!=''){  $user_id =  $row['user_id']; }else{ $user_id = "---";} ?>
                                        <?php echo $user_id;?>

                                    </td>

                                    <td style="text-align: left;">
                                        <?php
                                        if(isset($row['full_name']) && $row['full_name']!='') {
                                            $shift_name = $row['full_name'];
                                        }
                                        else
                                        { $shift_name =  "---";}

                                        echo $shift_name;
                                        ?> </td>
                                    <td style="text-align: left;">
                                        <?php
                                        if(isset($row['phone_number']) && $row['phone_number']!='') {
                                            $fullday_hours = $row['phone_number'];
                                        }
                                        else
                                        { $fullday_hours =  "---";}

                                        echo $fullday_hours;
                                        ?> </td>
                                    <td style="text-align: left;">
                                        <?php
                                        if(isset($row['city']) && $row['city']!='') {
                                            $leave_1_4_min = $row['city'];
                                        }
                                        else
                                        { $leave_1_4_min =  "---";}

                                        echo $leave_1_4_min;
                                        ?> </td>
                                    <td style="text-align: left;">
                                        <?php
                                        if(isset($row['state']) && $row['state']!='') {
                                            $leave_1_4_max = $row['state'];
                                        }
                                        else
                                        { $leave_1_4_max =  "---";}

                                        echo $leave_1_4_max;
                                        ?> </td>

                                    <td style="text-align:center;"> <?php if(isset($row['created_at']) && $row['created_at']!=''){ echo $row['created_at']; }else{ echo "---";} ?> </td>


                                    <td style="text-align:center;"><?php if (isset($row['status']) && $row['status'] != '' && $row['status'] == '1') {
                                            echo "<i class='fa fa-check-circle' style='color:green; font-size: 18px;'></i>";
                                        } else {
                                            echo "<i class='fa fa-times-circle' style='color:red; font-size: 18px;'></i>";
                                        } ?> </td>


                                    <td style="text-align:center;width: 75px;">

                                        <span>
                                            <?php if($permission['edit'] == 1){ ?>
                                                <a href="javascript:void(0);" title="Edit Shift" ><i class="fa fa-edit" data-toggle="modal" data-target="#myModal<?= $row['shift_id'];?>"></i></a><?php } ?>


                                            <!-- Modal -->
                                            <div id="myModal<?= $row['shift_id'];?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog">

                                                                <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title pull-left">Update Shift</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" class="form-horizontal col-md-12" method="post" id="update_shift_form_<?= $row['shift_id'];?>" name="update_shift_form_<?= $row['shift_id'];?>">
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-md-line-input  ">
                                                                        <label class="control-label pull-left ">Shift<span class="text-error">* &nbsp;</span>:</label>
                                                                        <div class="controls"><input class="form-control" name="shift_name" placeholder="Enter shift" id="shift_name" value="<?= $shift_name;?>" type="text"></div>
                                                                        <input type="hidden" name="shift_id" id="shift_id" value="<?= $row['shift_id']; ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group form-md-line-input  ">
                                                                <label class="control-label pull-left">Fullday Hours<span class="text-error">* </span>:</label>
                                                                <div class="controls"><input class="form-control" name="hours" placeholder="Enter Hours" value="<?= $fullday_hours;?>" id="hours"  type="text"></div>
                                                                </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                <div class="form-group form-md-line-input  ">
                                                                <label class="control-label pull-left">1_4_leave_min<span class="text-error">* </span>:</label>
                                                                    <div class="controls"><input class="form-control" name="leave_1_4_min" placeholder="Enter 1/4 leave min" value="<?= $leave_1_4_min;?>" id="leave_1_4_min"  type="text"></div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input  ">
                                                                    <label class="control-label pull-left">1_4_leave_max<span class="text-error">* </span>:</label>
                                                                    <div class="controls"><input class="form-control" name="leave_1_4_max" placeholder="Enter 1/4 leave max" value="<?= $leave_1_4_max;?>" id="leave_1_4_max"  type="text"></div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input  ">
                                                                    <label class="control-label pull-left">1_2_leave_min<span class="text-error">* </span>:</label>
                                                                    <div class="controls"><input class="form-control" name="leave_1_2_min" placeholder="Enter 1/2 leave min" value="<?= $leave_1_2_min;?>" id="leave_1_2_min"  type="text"></div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input  ">
                                                                    <label class="control-label pull-left ">1_2_leave_max<span class="text-error">* </span>:</label>
                                                                    <div class="controls"><input class="form-control" name="leave_1_2_max" placeholder="Enter 1/2 leave max" value="<?= $leave_1_2_max;?>" id="leave_1_2_max"  type="text"></div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input  ">
                                                                    <label class="control-label pull-left">3_4_leave_min<span class="text-error">* </span>:</label>
                                                                    <div class="controls"><input class="form-control" name="leave_3_4_min" placeholder="Enter 3/4 leave min" value="<?= $leave_3_4_min;?>" id="leave_3_4_min"  type="text"></div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input  ">
                                                                    <label class="control-label pull-left">3_4_leave_max<span class="text-error">* </span>:</label>
                                                                    <div class="controls"><input class="form-control" name="leave_3_4_max" placeholder="Enter 3/4 leave max" value="<?= $leave_3_4_max;?>" id="leave_3_4_max"  type="text"></div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input  ">
                                                                    <label class="control-label pull-left">Holiday Ot Min<span class="text-error">* </span>:</label>
                                                                    <div class="controls"><input class="form-control" name="holiday_ot_min" placeholder="Enter min holiday" value="<?= $holiday_ot_min;?>" id="holiday_ot_min"  type="text"></div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input  ">
                                                                    <label class="control-label pull-left">Holiday Ot Max<span class="text-error">* </span>:</label>
                                                                    <div class="controls"><input class="form-control" name="holiday_ot_max" placeholder="Enter max holiday" value="<?= $holiday_ot_max;?>" id="holiday_ot_max"  type="text"></div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input  ">
                                                                    <label class="control-label pull-left">Working Ot Min<span class="text-error">* </span>:</label>
                                                                    <div class="controls"><input class="form-control" name="working_ot_min" placeholder="Enter min working" value="<?= $working_ot_min;?>" id="working_ot_min"  type="text"></div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input  ">
                                                                    <label class="control-label pull-left">Working Ot Max<span class="text-error">* </span>:</label>
                                                                    <div class="controls"><input class="form-control" name="working_ot_max" placeholder="Enter max working" value="<?= $working_ot_max;?>" id="working_ot_max"  type="text">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input  ">
                                                                    <label class="control-label pull-left">First Week OF<span class="text-error">* </span>:</label>
                                                                    <div class="controls">
                                                                        <select class="form-control bs-select" name="first_weekoff" id="first_weekoff">
                                                                            <option value="Sunday" <?php if(isset($row['first_weekoff']) && $row['first_weekoff']=='Sunday') {
                                                                                echo "selected";
                                                                            }?>>Sunday</option>
                                                                            <option value="Monday" <?php if(isset($row['first_weekoff']) && $row['first_weekoff']=='Monday') {
                                                                                echo "selected";
                                                                            }?>>Monday</option>
                                                                            <option value="Tuesday" <?php if(isset($row['first_weekoff']) && $row['first_weekoff']=='Tuesday') {
                                                                                echo "selected";
                                                                            }?>>Tuesday</option>
                                                                            <option value="Wednesday" <?php if(isset($row['first_weekoff']) && $row['first_weekoff']=='Wednesday') {
                                                                                echo "selected";
                                                                            }?>>Wednesday</option>
                                                                            <option value="Thursday" <?php if(isset($row['first_weekoff']) && $row['first_weekoff']=='Thursday') {
                                                                                echo "selected";
                                                                            }?>>Thursday</option>
                                                                            <option value="Friday" <?php if(isset($row['first_weekoff']) && $row['first_weekoff']=='Friday') {
                                                                                echo "selected";
                                                                            }?>>Friday</option>
                                                                            <option value="Saturday" <?php if(isset($row['first_weekoff']) && $row['first_weekoff']=='Saturday') {
                                                                                echo "selected";
                                                                            }?>>Saturday</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input  ">
                                                                    <label class="control-label pull-left">First Week OF Days<span class="text-error">* </span>:</label>
                                                                    <div class="controls">
                                                                        <select class="form-control bs-select" name="first_weekoff_rule" id="first_weekoff_rule" multiple disabled>
                                                                            <option value="">Select First Week Of Days</option>
                                                                            <option value="1" selected>1</option>
                                                                            <option value="2" selected>2</option>
                                                                            <option value="3" selected>3</option>
                                                                            <option value="4" selected>4</option>
                                                                            <option value="5" selected>5</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input  ">
                                                                    <label class="control-label pull-left">Second Week OF<span class="text-error">* </span>:</label>
                                                                    <div class="controls">
                                                                        <select class="form-control bs-select" name="second_weekoff" id="second_weekoff" title="Second Week Off is required">
                                                                            <option value="">Select Second Week Of</option>
                                                                            <option value="Sunday" <?php if(isset($row['second_weekoff']) && $row['second_weekoff']=='Saturday') {
                                                                                echo "selected";
                                                                            }?>>Sunday</option>
                                                                            <option value="Monday" <?php if(isset($row['second_weekoff']) && $row['second_weekoff']=='Monday') {
                                                                                echo "selected";
                                                                            }?>>Monday</option>
                                                                            <option value="Tuesday" <?php if(isset($row['second_weekoff']) && $row['second_weekoff']=='Tuesday') {
                                                                                echo "selected";
                                                                            }?>>Tuesday</option>
                                                                            <option value="Wednesday" <?php if(isset($row['second_weekoff']) && $row['second_weekoff']=='Wednesday') {
                                                                                echo "selected";
                                                                            }?>>Wednesday</option>
                                                                            <option value="Thursday" <?php if(isset($row['second_weekoff']) && $row['second_weekoff']=='Thursday') {
                                                                                echo "selected";
                                                                            }?>>Thursday</option>
                                                                            <option value="Friday" <?php if(isset($row['second_weekoff']) && $row['second_weekoff']=='Friday') {
                                                                                echo "selected";
                                                                            }?>>Friday</option>
                                                                            <option value="Saturday" <?php if(isset($row['second_weekoff']) && $row['second_weekoff']=='Saturday') {
                                                                                echo "selected";
                                                                            }?>>Saturday</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-md-line-input  ">
                                                                    <label class="control-label pull-left">Second Week OF Days<span class="text-error">* </span>:</label>
                                                                    <div class="controls">
                                                                        <?php
                                                                        if(isset($row['second_weekoff_rule']) && $row['second_weekoff_rule']!=""){
                                                                            $second_weekoff_arr =  explode(",",$row['second_weekoff_rule']);
                                                                        }
                                                                        else{
                                                                            $second_weekoff_arr =  array();
                                                                        }
                                                                        ?>
                                                                        <select class="form-control bs-select" name="second_weekoff_rule[]" id="second_weekoff_rule" multiple>
                                                                            <option value="">Select Second Week Of Days</option>
                                                                            <?php
                                                                            if(!empty($second_weekoff_arr) && in_array('1',$second_weekoff_arr)) {
                                                                                $rule_1_sel = "selected";
                                                                            }
                                                                            else{
                                                                                $rule_1_sel = "";
                                                                            }
                                                                            ?>
                                                                            <option value="1" <?php echo $rule_1_sel;?>>1</option>
                                                                            <?php
                                                                            if(!empty($second_weekoff_arr) && in_array('2',$second_weekoff_arr)) {
                                                                                $rule_2_sel = "selected";
                                                                            }
                                                                            else{
                                                                                $rule_2_sel = "";
                                                                            }
                                                                            ?>
                                                                            <option value="2" <?php echo $rule_2_sel;?>>2</option>
                                                                            <?php
                                                                            if(!empty($second_weekoff_arr) && in_array('3',$second_weekoff_arr)) {
                                                                                $rule_3_sel = "selected";
                                                                            }
                                                                            else{
                                                                                $rule_3_sel = "";
                                                                            }
                                                                            ?>
                                                                            <option value="3" <?php echo $rule_3_sel;?>>3</option>
                                                                            <?php
                                                                            if(!empty($second_weekoff_arr) && in_array('4',$second_weekoff_arr)) {
                                                                                $rule_4_sel = "selected";
                                                                            }
                                                                            else{
                                                                                $rule_4_sel = "";
                                                                            }
                                                                            ?>
                                                                            <option value="4" <?php echo $rule_4_sel;?>>4</option>
                                                                            <?php
                                                                            if(!empty($second_weekoff_arr) && in_array('5',$second_weekoff_arr)) {
                                                                                $rule_5_sel = "selected";
                                                                            }
                                                                            else{
                                                                                $rule_5_sel = "";
                                                                            }
                                                                            ?>
                                                                            <option value="5" <?php echo $rule_5_sel;?>>5</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                           <div class="form-actions align-right pull-left">
                                                               <button type="submit" name="FormSubmit" class="btn btn-large btn-success" onclick="updateShift(<?php echo $row['shift_id'];?>);">Submit</button>
                                                               <button type="button" class="btn btn-large btn-danger" data-dismiss="modal">Cancel</button>
                                                           </div>
                                                       </form>
                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                        </span>
                                        <span>
                                            <?php if($permission['edit'] == 1){ ?>
                                                <a href="javascript:void(0);" title="Week Off Details" ><i class="fa fa-list" data-toggle="modal" data-target="#myModalWeekOff<?= $row['shift_id'];?>"></i></a><?php } ?>

                                            <!-- Modal -->
                                                <div id="myModalWeekOff<?= $row['shift_id'];?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">

                                                                    <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title pull-left">Week Off Days</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-md-line-input  ">
                                                                        <label class="control-label pull-left">First Week OF<span class="text-error"></span></label>
                                                                        <div class="controls">
                                                                            <select class="form-control bs-select" name="first_weekoff" id="first_weekoff" disabled>
                                                                                <option value="Sunday" <?php if(isset($row['first_weekoff']) && $row['first_weekoff']=='Sunday') {
                                                                                    echo "selected";
                                                                                }?>>Sunday</option>
                                                                                <option value="Monday" <?php if(isset($row['first_weekoff']) && $row['first_weekoff']=='Monday') {
                                                                                    echo "selected";
                                                                                }?>>Monday</option>
                                                                                <option value="Tuesday" <?php if(isset($row['first_weekoff']) && $row['first_weekoff']=='Tuesday') {
                                                                                    echo "selected";
                                                                                }?>>Tuesday</option>
                                                                                <option value="Wednesday" <?php if(isset($row['first_weekoff']) && $row['first_weekoff']=='Wednesday') {
                                                                                    echo "selected";
                                                                                }?>>Wednesday</option>
                                                                                <option value="Thursday" <?php if(isset($row['first_weekoff']) && $row['first_weekoff']=='Thursday') {
                                                                                    echo "selected";
                                                                                }?>>Thursday</option>
                                                                                <option value="Friday" <?php if(isset($row['first_weekoff']) && $row['first_weekoff']=='Friday') {
                                                                                    echo "selected";
                                                                                }?>>Friday</option>
                                                                                <option value="Saturday" <?php if(isset($row['first_weekoff']) && $row['first_weekoff']=='Saturday') {
                                                                                    echo "selected";
                                                                                }?>>Saturday</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-md-line-input  ">
                                                                        <label class="control-label pull-left">First Week OF Days<span class="text-error"> </span></label>
                                                                        <div class="controls">
                                                                            <select class="form-control bs-select" name="first_weekoff_rule" id="first_weekoff_rule" multiple disabled>
                                                                                <option value="">Select First Week Of Days</option>
                                                                                <option value="1" selected>1</option>
                                                                                <option value="2" selected>2</option>
                                                                                <option value="3" selected>3</option>
                                                                                <option value="4" selected>4</option>
                                                                                <option value="5" selected>5</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-md-line-input  ">
                                                                        <label class="control-label pull-left">Second Week OF<span class="text-error"> </span></label>
                                                                        <div class="controls">
                                                                            <select class="form-control bs-select" name="second_weekoff" id="second_weekoff" title="Second Week Off is required" disabled>
                                                                                <option value="">Select Second Week Of</option>
                                                                                <option value="Sunday" <?php if(isset($row['second_weekoff']) && $row['second_weekoff']=='Saturday') {
                                                                                    echo "selected";
                                                                                }?>>Sunday</option>
                                                                                <option value="Monday" <?php if(isset($row['second_weekoff']) && $row['second_weekoff']=='Monday') {
                                                                                    echo "selected";
                                                                                }?>>Monday</option>
                                                                                <option value="Tuesday" <?php if(isset($row['second_weekoff']) && $row['second_weekoff']=='Tuesday') {
                                                                                    echo "selected";
                                                                                }?>>Tuesday</option>
                                                                                <option value="Wednesday" <?php if(isset($row['second_weekoff']) && $row['second_weekoff']=='Wednesday') {
                                                                                    echo "selected";
                                                                                }?>>Wednesday</option>
                                                                                <option value="Thursday" <?php if(isset($row['second_weekoff']) && $row['second_weekoff']=='Thursday') {
                                                                                    echo "selected";
                                                                                }?>>Thursday</option>
                                                                                <option value="Friday" <?php if(isset($row['second_weekoff']) && $row['second_weekoff']=='Friday') {
                                                                                    echo "selected";
                                                                                }?>>Friday</option>
                                                                                <option value="Saturday" <?php if(isset($row['second_weekoff']) && $row['second_weekoff']=='Saturday') {
                                                                                    echo "selected";
                                                                                }?>>Saturday</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-md-line-input  ">
                                                                        <label class="control-label pull-left">Second Week OF Days<span class="text-error"> </span></label>
                                                                        <div class="controls">
                                                                            <?php
                                                                            if(isset($row['second_weekoff_rule']) && $row['second_weekoff_rule']!=""){
                                                                                $second_weekoff_arr =  explode(",",$row['second_weekoff_rule']);
                                                                            }
                                                                            else{
                                                                                $second_weekoff_arr =  array();
                                                                            }
                                                                            ?>
                                                                            <select class="form-control bs-select" name="second_weekoff_rule[]" id="second_weekoff_rule" multiple disabled>
                                                                                <option value="">Select Second Week Of Days</option>
                                                                                <?php
                                                                                if(!empty($second_weekoff_arr) && in_array('1',$second_weekoff_arr)) {
                                                                                    $rule_1_sel = "selected";
                                                                                }
                                                                                else{
                                                                                    $rule_1_sel = "";
                                                                                }
                                                                                ?>
                                                                                <option value="1" <?php echo $rule_1_sel;?>>1</option>
                                                                                <?php
                                                                                if(!empty($second_weekoff_arr) && in_array('2',$second_weekoff_arr)) {
                                                                                    $rule_2_sel = "selected";
                                                                                }
                                                                                else{
                                                                                    $rule_2_sel = "";
                                                                                }
                                                                                ?>
                                                                                <option value="2" <?php echo $rule_2_sel;?>>2</option>
                                                                                <?php
                                                                                if(!empty($second_weekoff_arr) && in_array('3',$second_weekoff_arr)) {
                                                                                    $rule_3_sel = "selected";
                                                                                }
                                                                                else{
                                                                                    $rule_3_sel = "";
                                                                                }
                                                                                ?>
                                                                                <option value="3" <?php echo $rule_3_sel;?>>3</option>
                                                                                <?php
                                                                                if(!empty($second_weekoff_arr) && in_array('4',$second_weekoff_arr)) {
                                                                                    $rule_4_sel = "selected";
                                                                                }
                                                                                else{
                                                                                    $rule_4_sel = "";
                                                                                }
                                                                                ?>
                                                                                <option value="4" <?php echo $rule_4_sel;?>>4</option>
                                                                                <?php
                                                                                if(!empty($second_weekoff_arr) && in_array('5',$second_weekoff_arr)) {
                                                                                    $rule_5_sel = "selected";
                                                                                }
                                                                                else{
                                                                                    $rule_5_sel = "";
                                                                                }
                                                                                ?>
                                                                                <option value="5" <?php echo $rule_5_sel;?>>5</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </span>
                                        <span>
                                            <?php /*if($permission['delete'] == 1){
                                                if(isset($row['status']) && $row['status']== 1){*/?><!--
                                            <a href="javascript:void(0);" title="Delete Shift" onclick="deleteConfirmAction(<?php /*echo $row['shift_id']; */?>);" ><i class="fa fa-trash"></i></a>
                                                --><?php /*}} */?>
                                            <?php if($permission['delete'] == 1){ ?>
                                                <?php if (isset($row['status']) && $row['status'] != '' && $row['status'] == '1') {
                                                    ?>
                                                    <a href="javascript:;" class="text-info" title="DeActive" onclick="stausConfirmaction('<?php echo $row['shift_id']; ?>','0');"> <i class="glyphicon glyphicon-remove"></i></a>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <a href="javascript:;" class="text-info" title="Active" onclick="stausConfirmaction('<?php echo $row['shift_id']; ?>','1');"> <i class="glyphicon glyphicon-ok"></i></a>
                                                    <?php
                                                }
                                                ?>
                                            <?php } ?>

                                    </span>&nbsp;
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