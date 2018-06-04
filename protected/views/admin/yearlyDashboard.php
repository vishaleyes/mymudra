<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box  hover-zoom-effect">
            <div class="icon bg-pink">
                <i class="material-icons">person</i>
            </div>
            <div class="content">
                <div class="text">CUSTOMERS</div>
                <div class="number"><?= $data['total_yearly_mobile_customers']['total_customer']; ?>
                    <?php if($data['total_customers_this_year']['total_customer'] >= $data['total_customers_last_year']['total_customer'])
                    {
                        ?>
                        <i class="material-icons text-success" style="font-size: 30px;vertical-align: text-bottom;">trending_up</i>
                        <?php
                    }
                    else
                    {
                        ?>
                        <i class="material-icons text-danger" style="font-size: 30px;vertical-align: text-bottom;">trending_down</i>
                        <?php
                    }?>
                </div>
                <p style="font-size: 10px;">Total - <?= $data['total_customers']; ?></p>
            </div>
        </div>
    </div>


    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box  hover-zoom-effect">
            <div class="icon bg-cyan">
                <i class="material-icons">account_balance</i>
            </div>
            <div class="content">
                <div class="text">PROPERTIES</div>
                <div class="number"><?= $data['current_yearly_property']; ?>
                    <?php if($data['current_yearly_property'] >= $data['last_yearly_property'])
                    {
                        ?>
                        <i class="material-icons text-success" style="font-size: 30px;vertical-align: text-bottom;">trending_up</i>
                        <?php
                    }
                    else
                    {
                        ?>
                        <i class="material-icons text-danger" style="font-size: 30px;vertical-align: text-bottom;">trending_down</i>
                        <?php
                    }?>
                </div>
                <p style="font-size: 10px;">Total - <?= $data['total_property']; ?></p>
            </div>
        </div>
    </div>


    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box  hover-zoom-effect">
            <div class="icon bg-orange">
                <i class="material-icons">attach_money</i>
            </div>
            <div class="content">
                <div class="text">TOTAL REVENUE</div>
                <div class="number" style="font-size: 18px"><?=
                    number_format($data['yearly_current_revenue']['total_revenue'], 2, ".", ","); ?>
                    <?php if($data['yearly_current_revenue']['total_revenue'] >= $data['yearly_last_revenue']['total_revenue'])
                    {
                        ?>
                        <i class="material-icons text-success" style="font-size: 30px;vertical-align: text-bottom;">trending_up</i>
                        <?php
                    }
                    else
                    {
                        ?>
                        <i class="material-icons text-danger" style="font-size: 30px;vertical-align: text-bottom;">trending_down</i>
                        <?php
                    }?>
                </div>
                <p style="font-size: 10px;">Total - <?= $data['total_revenue']['total_revenue']; ?></p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box  hover-zoom-effect">
            <div class="icon bg-green">
                <i class="material-icons">cloud_download</i>
            </div>
            <div class="content">
                <div class="text">DOWNLOADS</div>
                <div class="number" style="font-size: 15px;">
                    <i class="fa fa-android green" style="color: green" aria-hidden="true"></i>

                    <?php
                    if(isset($data['total_yearly_mobile_customers']['Android']) && $data['total_yearly_mobile_customers']['Android'] != "")
                    {
                        $android = $data['total_yearly_mobile_customers']['Android'];
                    }
                    else
                    {
                        $android = '0';
                    }

                    ?>
                    <?= $android; ?>

                    <?php if($data['total_yearly_mobile_customers']['total_customer'] >= $data['total_last_yearly_mobile_customers']['total_customer'])
                    {
                        ?>
                        <i class="material-icons text-success" style="font-size: 30px;vertical-align: text-bottom;">trending_up</i>
                        <?php
                    }
                    else
                    {
                        ?>
                        <i class="material-icons text-danger" style="font-size: 30px;vertical-align: text-bottom;">trending_down</i>
                        <?php
                    }?>

                </div>
                <p style="font-size: 15px;"><i class="fa fa-apple" style="color: gray"  aria-hidden="true"></i>
                    <?php
                    if(isset($data['total_yearly_mobile_customers']['IOS']) && $data['total_yearly_mobile_customers']['IOS'] != "")
                    {
                        $IOS = $data['total_yearly_mobile_customers']['IOS'];
                    }
                    else
                    {
                        $IOS = '0';
                    }

                    ?>
                    <?= $IOS; ?></p>
            </div>
        </div>
    </div>

</div>