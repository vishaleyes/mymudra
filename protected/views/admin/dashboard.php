<style>
    .number {
        font-size: 18px !important;
    }
    /*.daterangepicker .calendar td, .daterangepicker .calendar th{
        min-width:22px;
    }*/
</style>
<?php //echo "<pre>"; print_r($data); die;?>
<div class="page-head">

    <div class="page-title">
        <h1>Admin Dashboard
            <small id="header_text"></small>
        </h1>
    </div>

    <!--<div class="page-toolbar">
        <div id="dashboard-report-range1" data-display-range="0" class="pull-right tooltips btn btn-fit-height green" data-placement="left" >
            <i class="icon-calendar"></i>&nbsp;
            <span class="thin uppercase hidden-xs"></span>&nbsp;
            <i class="fa fa-angle-down"></i>
        </div>
    </div>-->

</div>


<div class="row">
    <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 blue" href="<?php echo Yii::app()->params->base_path; ?>admin/bankLoanUserListing">
            <div class="visual">
                <i class="fa fa-users"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="1349" id="bankUser"><?php if(isset($data['bankUser']) && $data['bankUser']!=''){echo count($data['bankUser']);} else {echo "--";}?></span>
                </div>
                <div class="desc"> Bank Loan </div>
            </div>
        </a>
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
        <a class="dashboard-stat dashboard-stat-v2 yellow-casablanca" href="<?php echo Yii::app()->params->base_path; ?>admin/invAdvisoryUserListing">
            <div class="visual">
                <i class="fa fa-suitcase"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="12,5" id="investmentUser"><?php echo count($data['investmentUser']); ?></span></div>
                <div class="desc"> Investment Advisory </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 green" href="<?php echo Yii::app()->params->base_path; ?>admin/realEstateUserListing">
            <div class="visual">
                <i class="fa fa-usd"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="12,5" id="realEstateUser"><?php echo count($data['realEstateUser']);?></span></div>
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





