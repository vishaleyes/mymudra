<style>
    .number {
        font-size: 18px !important;
    }
    .daterangepicker .calendar td, .daterangepicker .calendar th{
        min-width:22px;
    }
</style>
<?php //echo "<pre>"; print_r($data); die;?>
<div class="page-head">

    <div class="page-title">
        <h1>Admin Dashboard
            <small id="header_text"></small>
        </h1>
    </div>

    <div class="page-toolbar">
        <div id="dashboard-report-range1" data-display-range="0" class="pull-right tooltips btn btn-fit-height green" data-placement="left" >
            <i class="icon-calendar"></i>&nbsp;
            <span class="thin uppercase hidden-xs"></span>&nbsp;
            <i class="fa fa-angle-down"></i>
        </div>
    </div>

</div>


<div class="row">
    <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 blue" href="javascript:void(0);" data-toggle="modal" data-target="#myModalNewShift">
            <div class="visual">
                <i class="fa fa-users"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="1349" id="total_partner"><?php if(isset($data['total_partner']) && $data['total_partner']!=''){echo $data['total_partner'];} else {echo "--";}?></span>
                </div>
                <div class="desc"> Bank Loan </div>
            </div>
        </a>

        <div id="myModalNewShift" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <!--<h4 class="modal-title">New Shift</h4>-->
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo Yii::app()->params->base_path ; ?>admin/addUser" class="form-horizontal col-md-12" method="post" id="new_shift_form" name="new_shift_form">
                            <div class="col-md-12">
                                <div class="form-group form-md-line-input  ">
                                    <!--<label class="control-label">First Week OF<span class="text-error">* </span>:</label>-->
                                    <div class="controls">
                                        <select class="form-control bs-select" name="for" id="for">
                                            <option value="">Select</option>
                                            <option value="1">For Self</option>
                                            <option value="2">For Others</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions align-right">
                                <button type="submit" name="FormSubmit" class="btn btn-large btn-success">Submit</button>
                                <button type="button" class="btn btn-large btn-danger"  data-dismiss="modal">Cancel</button>
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
    <!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 red" href="#">
            <div class="visual">
                <i class="fa fa-building-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="12,5"><?php /*echo $data['total_store'];*/?></span></div>
                <div class="desc"> Total Store </div>
            </div>
        </a>
    </div>-->
    <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 yellow-casablanca" href="#">
            <div class="visual">
                <i class="fa fa-suitcase"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="12,5" id="total_carrier"><?php echo $data['total_carrier']; ?></span></div>
                <div class="desc"> Investment Advisory </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 green" href="#">
            <div class="visual">
                <i class="fa fa-usd"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="12,5" id="total_revenue"><?php echo $data['revenue_data'];?></span>$ </div>
                <div class="desc"> Real Estate </div>
            </div>
        </a>
    </div>
    <!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 yellow-crusta" href="#">
            <div class="visual">
                <i class="fa fa-user"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="12,5" id="total_customer"><?php /*echo $data['customer_data']['total_customer'];*/?></span></div>
                <div class="desc"> Total Customer </div>
            </div>
        </a>
    </div>-->
</div>


<div class="row hide">
    <div class="col-lg-6 col-xs-12 col-sm-12">
        <!-- BEGIN PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart font-dark hide"></i>
                    <span class="caption-subject font-dark bold uppercase">Revenue</span>
                    <span class="caption-helper">weekly stats...</span>
                </div>

            </div>
            <div class="portlet-body">
                <canvas id="bar_chart" height="150"></canvas>
            </div>
        </div>
        <!-- END PORTLET-->
    </div>
    <div class="col-lg-6 col-xs-12 col-sm-12">
        <!-- BEGIN PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-share font-red-sunglo hide"></i>
                    <span class="caption-subject font-dark bold uppercase">Order</span>
                    <span class="caption-helper">weekly stats...</span>
                </div>

            </div>
            <div class="portlet-body">
                <canvas id="bar_chart1" height="150"></canvas>
            </div>
        </div>
        <!-- END PORTLET-->
    </div>
</div>

<div class="row hide">
    <div class="col-lg-12 col-xs-12 col-sm-12">
        <!-- BEGIN REGIONAL STATS PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-share font-dark hide"></i>
                    <span class="caption-subject font-dark bold uppercase">Regional Stats</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                        <i class="icon-cloud-upload"></i>
                    </a>
                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                        <i class="icon-wrench"></i>
                    </a>
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" data-container="false" data-placement="bottom" href="javascript:;"> </a>
                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                        <i class="icon-trash"></i>
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div id="region_statistics_loading">
                    <img src="../assets/global/img/loading.gif" alt="loading" /> </div>
                <div id="region_statistics_content" class="display-none">
                    <div class="btn-toolbar margin-bottom-10">
                        <div class="btn-group btn-group-circle" data-toggle="buttons">
                            <a href="" class="btn grey-salsa btn-sm active"> Users </a>
                            <a href="" class="btn grey-salsa btn-sm"> Orders </a>
                        </div>
                        <div class="btn-group pull-right">
                            <a href="" class="btn btn-circle grey-salsa btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Select Region
                                <span class="fa fa-angle-down"> </span>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="javascript:;" id="regional_stat_world"> World </a>
                                </li>
                                <li>
                                    <a href="javascript:;" id="regional_stat_usa"> USA </a>
                                </li>
                                <li>
                                    <a href="javascript:;" id="regional_stat_europe"> Europe </a>
                                </li>
                                <li>
                                    <a href="javascript:;" id="regional_stat_russia"> Russia </a>
                                </li>
                                <li>
                                    <a href="javascript:;" id="regional_stat_germany"> Germany </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="vmap_world" class="vmaps display-none"> </div>
                    <div id="vmap_usa" class="vmaps display-none"> </div>
                    <div id="vmap_europe" class="vmaps display-none"> </div>
                    <div id="vmap_russia" class="vmaps display-none"> </div>
                    <div id="vmap_germany" class="vmaps display-none"> </div>
                </div>
            </div>
        </div>
        <!-- END REGIONAL STATS PORTLET-->
    </div>
</div>


<script src="<?php echo Yii::app()->params->base_url ; ?>assets/admin/plugins/chartjs/Chart.bundle.js"></script>

<script>
    /*$(document).ready(function () {

     });*/

    $(function () {
        new Chart(document.getElementById("line_chart").getContext("2d"), getChartJs('line'));
        new Chart(document.getElementById("line_chart1").getContext("2d"), getChartJs('line1'));
        new Chart(document.getElementById("bar_chart").getContext("2d"), getChartJs('bar'));
        new Chart(document.getElementById("bar_chart1").getContext("2d"), getChartJs('bar1'));
    });
    function getChartJs(type) {
        var config = null;

        if (type === 'line') {
            config = {
                type: 'bar',
                data: {
                    labels: ['January','February','March','April','May','June','July','August','September','October','November','December'],
                    datasets: [{
                        label: "Partner Order Revenue",
                        data: ['<?php echo $data['monthly_partner_revenue']['Jan'];?>',
                            '<?php echo $data['monthly_partner_revenue']['Feb'];?>',
                            '<?php echo $data['monthly_partner_revenue']['Mar'];?>',
                            '<?php echo $data['monthly_partner_revenue']['Apr'];?>',
                            '<?php echo $data['monthly_partner_revenue']['May'];?>',
                            '<?php echo $data['monthly_partner_revenue']['Jun'];?>',
                            '<?php echo $data['monthly_partner_revenue']['Jul'];?>',
                            '<?php echo $data['monthly_partner_revenue']['Aug'];?>',
                            '<?php echo $data['monthly_partner_revenue']['Sep'];?>',
                            '<?php echo $data['monthly_partner_revenue']['Oct'];?>',
                            '<?php echo $data['monthly_partner_revenue']['Nov'];?>',
                            '<?php echo $data['monthly_partner_revenue']['Dec'];?>'],
                        borderColor: 'rgba(77, 179, 162)', //borderColor: 'rgba(77, 179, 162, 0.75)',
                        backgroundColor: 'rgba(77, 179, 162)', //backgroundColor: 'rgba(77, 179, 162, 0.3)',
                        pointBorderColor: 'rgba(77, 179, 162)', //pointBorderColor: 'rgba(77, 179, 162, 0)',
                        pointBackgroundColor: 'rgba(77, 179, 162)', //pointBackgroundColor: 'rgba(77, 179, 162, 0.9)',
                        pointBorderWidth: 1
                    },
                        {
                            label: "Customer Order Revenue",
                            data: ['<?php echo $data['monthly_customer_revenue']['Jan'];?>',
                                '<?php echo $data['monthly_customer_revenue']['Feb'];?>',
                                '<?php echo $data['monthly_customer_revenue']['Mar'];?>',
                                '<?php echo $data['monthly_customer_revenue']['Apr'];?>',
                                '<?php echo $data['monthly_customer_revenue']['May'];?>',
                                '<?php echo $data['monthly_customer_revenue']['Jun'];?>',
                                '<?php echo $data['monthly_customer_revenue']['Jul'];?>',
                                '<?php echo $data['monthly_customer_revenue']['Aug'];?>',
                                '<?php echo $data['monthly_customer_revenue']['Sep'];?>',
                                '<?php echo $data['monthly_customer_revenue']['Oct'];?>',
                                '<?php echo $data['monthly_customer_revenue']['Nov'];?>',
                                '<?php echo $data['monthly_customer_revenue']['Dec'];?>'],
                            borderColor: 'rgba(243, 106, 90)', //borderColor: 'rgba(243, 106, 90, 0.75)',
                            backgroundColor: 'rgba(243, 106, 90)', //backgroundColor: 'rgba(243, 106, 90, 0.3)',
                            pointBorderColor: 'rgba(243, 106, 90)', //pointBorderColor: 'rgba(243, 106, 90, 0)',
                            pointBackgroundColor: 'rgba(243, 106, 90)', //pointBackgroundColor: 'rgba(243, 106, 90, 0.9)',
                            pointBorderWidth: 1
                        }
                        ,
                        {
                            label: "Package Order Revenue",
                            data: ['<?php echo $data['monthly_package_revenue']['Jan'];?>',
                                '<?php echo $data['monthly_package_revenue']['Feb'];?>',
                                '<?php echo $data['monthly_package_revenue']['Mar'];?>',
                                '<?php echo $data['monthly_package_revenue']['Apr'];?>',
                                '<?php echo $data['monthly_package_revenue']['May'];?>',
                                '<?php echo $data['monthly_package_revenue']['Jun'];?>',
                                '<?php echo $data['monthly_package_revenue']['Jul'];?>',
                                '<?php echo $data['monthly_package_revenue']['Aug'];?>',
                                '<?php echo $data['monthly_package_revenue']['Sep'];?>',
                                '<?php echo $data['monthly_package_revenue']['Oct'];?>',
                                '<?php echo $data['monthly_package_revenue']['Nov'];?>',
                                '<?php echo $data['monthly_package_revenue']['Dec'];?>'],
                            borderColor: '#3598dc', //borderColor: 'rgba(102, 102, 255, 0.75)',
                            backgroundColor: '#3598dc', //backgroundColor: 'rgba(102, 102, 255, 0.3)',
                            pointBorderColor: '#3598dc', //pointBorderColor: 'rgba(102, 102, 255, 0)',
                            pointBackgroundColor: '#3598dc', //pointBackgroundColor: 'rgba(102, 102, 255, 0.9)',
                            pointBorderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    legend: false
                }
            }
        }
        else if (type === 'line1') {
            config = {
                type: 'bar',
                data: {
                    labels: ['January','February','March','April','May','June','July','August','September','October','November','December'],
                    datasets: [{
                        label: "Partner Order",
                        data: ['<?php echo $data['monthly_partner_order']['Jan'];?>',
                            '<?php echo $data['monthly_partner_order']['Feb'];?>',
                            '<?php echo $data['monthly_partner_order']['Mar'];?>',
                            '<?php echo $data['monthly_partner_order']['Apr'];?>',
                            '<?php echo $data['monthly_partner_order']['May'];?>',
                            '<?php echo $data['monthly_partner_order']['Jun'];?>',
                            '<?php echo $data['monthly_partner_order']['Jul'];?>',
                            '<?php echo $data['monthly_partner_order']['Aug'];?>',
                            '<?php echo $data['monthly_partner_order']['Sep'];?>',
                            '<?php echo $data['monthly_partner_order']['Oct'];?>',
                            '<?php echo $data['monthly_partner_order']['Nov'];?>',
                            '<?php echo $data['monthly_partner_order']['Dec'];?>'],
                        borderColor: 'rgba(77, 179, 162)',//borderColor: 'rgba(77, 179, 162, 0.75)',
                        backgroundColor: 'rgba(77, 179, 162)', //backgroundColor: 'rgba(77, 179, 162, 0.3)',
                        pointBorderColor: 'rgba(77, 179, 162)', //pointBorderColor: 'rgba(77, 179, 162, 0)',
                        pointBackgroundColor: 'rgba(77, 179, 162)', //pointBackgroundColor: 'rgba(77, 179, 162, 0.9)',
                        pointBorderWidth: 1
                    },
                        {
                            label: "Customer Order",
                            data: ['<?php echo $data['monthly_customer_order']['Jan'];?>',
                                '<?php echo $data['monthly_customer_order']['Feb'];?>',
                                '<?php echo $data['monthly_customer_order']['Mar'];?>',
                                '<?php echo $data['monthly_customer_order']['Apr'];?>',
                                '<?php echo $data['monthly_customer_order']['May'];?>',
                                '<?php echo $data['monthly_customer_order']['Jun'];?>',
                                '<?php echo $data['monthly_customer_order']['Jul'];?>',
                                '<?php echo $data['monthly_customer_order']['Aug'];?>',
                                '<?php echo $data['monthly_customer_order']['Sep'];?>',
                                '<?php echo $data['monthly_customer_order']['Oct'];?>',
                                '<?php echo $data['monthly_customer_order']['Nov'];?>',
                                '<?php echo $data['monthly_customer_order']['Dec'];?>'],
                            borderColor: 'rgba(243, 106, 90)', //borderColor: 'rgba(243, 106, 90, 0.75)',
                            backgroundColor: 'rgba(243, 106, 90)', //backgroundColor: 'rgba(243, 106, 90, 0.3)',
                            pointBorderColor: 'rgba(243, 106, 90)', //pointBorderColor: 'rgba(243, 106, 90, 0)',
                            pointBackgroundColor: 'rgba(243, 106, 90)', //pointBackgroundColor: 'rgba(243, 106, 90, 0.9)',
                            pointBorderWidth: 1
                        }
                        ,
                        {
                            label: "Package Order",
                            data: ['<?php echo $data['monthly_package_order']['Jan'];?>',
                                '<?php echo $data['monthly_package_order']['Feb'];?>',
                                '<?php echo $data['monthly_package_order']['Mar'];?>',
                                '<?php echo $data['monthly_package_order']['Apr'];?>',
                                '<?php echo $data['monthly_package_order']['May'];?>',
                                '<?php echo $data['monthly_package_order']['Jun'];?>',
                                '<?php echo $data['monthly_package_order']['Jul'];?>',
                                '<?php echo $data['monthly_package_order']['Aug'];?>',
                                '<?php echo $data['monthly_package_order']['Sep'];?>',
                                '<?php echo $data['monthly_package_order']['Oct'];?>',
                                '<?php echo $data['monthly_package_order']['Nov'];?>',
                                '<?php echo $data['monthly_package_order']['Dec'];?>'],
                            borderColor: '#3598dc', //borderColor: 'rgba(102, 102, 255, 0.75)',
                            backgroundColor: '#3598dc', //backgroundColor: 'rgba(102, 102, 255, 0.3)',
                            pointBorderColor: '#3598dc', //pointBorderColor: 'rgba(102, 102, 255, 0)',
                            pointBackgroundColor: '#3598dc', //pointBackgroundColor: 'rgba(102, 102, 255, 0.9)',
                            pointBorderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    legend: false
                }
            }
        }
        else if (type === 'bar') {
            config = {
                type: 'bar',
                data: {
                    labels: [<?php echo $data['dates_details'];?>],
                    datasets: [{
                        label: "Partner Order Revenue",
                        data: [<?php echo $data['weekly_partner_revenue_details'];?>],
                        backgroundColor: 'rgba(0, 188, 212, 0.8)'
                    },{
                        label: "Customer Order Revenue",
                        data: [<?php echo $data['weekly_customer_revenue_details'];?>],
                        backgroundColor: '#659be0'
                    },{
                        label: "Package Order Revenue",
                        data: [<?php echo $data['weekly_package_revenue_details'];?>],
                        backgroundColor: '#ed6b75'
                    }]
                },
                options: {
                    responsive: true,
                    legend: false
                }
            }
        }
        else if (type === 'bar1') {
            config = {
                type: 'bar',
                data: {
                    labels: [<?php echo $data['dates_details'];?>],
                    datasets: [{
                        label: "Partner Order Revenue",
                        data: [<?php echo $data['weekly_partner_order_details'];?>],
                        backgroundColor: 'rgba(0, 188, 212, 0.8)'
                    },{
                        label: "Customer Order Revenue",
                        data: [<?php echo $data['weekly_customer_order_details'];?>],
                        backgroundColor: '#659be0'
                    },{
                        label: "Package Order Revenue",
                        data: [<?php echo $data['weekly_package_order_details'];?>],
                        backgroundColor: '#ed6b75'
                    }]
                },
                options: {
                    responsive: true,
                    legend: false
                }
            }
        }
        return config;
    }
</script>
<script>
$(document).ready(function(){
    $('#dashboard-report-range1').daterangepicker({
        "ranges": {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
            'Last 7 Days': [moment().subtract('days', 6), moment()],
            'Last 30 Days': [moment().subtract('days', 29), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
        },
        "locale": {
            "format": "MM/DD/YYYY",
            "separator": " - ",
            "applyLabel": "Apply",
            "cancelLabel": "Cancel",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "Custom",
            "daysOfWeek": [
                "Su",
                "Mo",
                "Tu",
                "We",
                "Th",
                "Fr",
                "Sa"
            ],
            "monthNames": [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"
            ],
            "firstDay": 1
        },
        //"startDate": "11/08/2015",
        //"endDate": "11/14/2015",
        opens: (App.isRTL() ? 'right' : 'left'),
    }, function(start, end, label) {
        if ($('#dashboard-report-range1').attr('data-display-range') != '0') {
            $('#dashboard-report-range1 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $("html, body").animate({scrollTop: 0}, "slow");
        $("#Loaderaction").css('display', 'inline-block');

        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->params->base_path; ?>admin/getAdminDashboardFilterData',
            data: "start_date="+start+"&end_date="+end,
            cache: false,
            dataType: 'json',
            success: function (data) {
                $("#total_revenue").text(data.data.revenue);
                $("#total_carrier").text(data.data.store);
                $("#total_partner").text(data.data.partner);
                $("#total_customer").text(data.data.customer);
                $("#header_text").text(label +" ("+ start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY') +")");
                $("#Loaderaction").css('display','none');
            }
        });

    });
    if ($('#dashboard-report-range1').attr('data-display-range') != '0') {
        $('#dashboard-report-range1 span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
    }
    $('#dashboard-report-range1').show();
})
</script>
