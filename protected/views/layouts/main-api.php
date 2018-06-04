<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Viia</title>
    <meta name="description" content="Book your events or meetings" />
    <meta name="keywords" content="Meetings, Events, Book, Bookings, Book your events, Book your meeting" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Viia">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

<!--    <link rel="icon" href="--><?php //echo Yii::app()->params->base_url ; ?><!--assets/img/icon_small.png" type="image/x-icon"/>-->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="<?php echo Yii::app()->params->base_url ; ?>assets/bower_components/font-awesome/css/font-awesome.min.css" type="text/css" />
    <!-- Bootstrap Core Css -->
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/admin/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link rel="stylesheet" href="<?php echo Yii::app()->params->base_url ; ?>assets/admin/plugins/node-waves/waves.css" type="text/css" />
    <!-- Animation Css -->
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/admin/plugins/animate-css/animate.css" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/admin/css/style.css" rel="stylesheet">
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/admin/css/themes/all-themes.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/admin/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->params->base_url ; ?>assets/admin/plugins/bootstrap-select/css/bootstrap-select.min.css" type="text/css" />
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/admin/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />


    <style>
        #quotationTable tr td
        {
            vertical-align: middle;
        }
        .dropdown-menu > li > a,.navbar-nav .open .dropdown-menu > li > a, .navbar-nav .open .dropdown-menu .dropdown-header{
            padding: 7px 10px;
        }
        .user-info{
            height: 100px !important;
        }
        .sidebar{
            width: 250px !important;
        }
        section.content{
            margin: 100px 15px 0 265px;
        }
        .btn:not(.btn-link):not(.btn-circle) i {
            font-size: 13px;
            position: relative;
            top: 0px;
        }
        .sidebar .menu .list a{
            padding: 0px 10px;

        }
        .sidebar .menu .list a span{
            font-weight:normal !important;
        }
        .sidebar .menu .list a i {
            font-size: 18px;
            padding: 7px 10px;
            width: 32px;
        }
        .sidebar .user-info .info-container{
            padding: 0 11px;
        }
        .table-bordered tbody tr td, .table-bordered tbody tr th{
            padding: 10px 10px;
        }
        .table-bordered tbody tr td lable, .table-bordered tbody tr th lable{
            margin-top: 5px;
        }
        th > label, td > label {
            margin-bottom: -11px;
        }
        .btn-square{
            font-size: 10px !important;
        }
    </style>



    <script src="<?php echo Yii::app()->params->base_url ; ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>

<script>
    function closeMSG() {
        $('.error-msg-area').html('');

    }
</script>

</head>
<?php if(isset(Yii::app()->session[_SITENAME_.'_admin']) && Yii::app()->session[_SITENAME_.'_admin']!='')
{
    $class_login = "theme-blue";
}else {
    $class_login = "theme-blue";
}
?>
<body class="<?= $class_login;?>">

<div class="error-msg-area">
    <?php //echo Yii::app()->user->setFlash('error', "adsf asdf as fsadf sadf asdfas df asdfasdfas as dfasdfasd fasdf");?>
    <?php if(Yii::app()->user->hasFlash('success')): ?>
        <div class="alert alert-success">
            <button class="close" data-close="alert" onclick="closeMSG();"><i class="fa fa-close"></i></button>
            <span>
               <?php echo Yii::app()->user->getFlash('success'); ?> </span>
        </div>
        <div class="clear"></div>
    <?php endif; ?>
    <?php if(Yii::app()->user->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <button class="close" data-close="alert" onclick="closeMSG();"><i class="fa fa-close"></i></button>
            <span>
               <?php echo Yii::app()->user->getFlash('error'); ?> </span>
        </div>
    <?php endif; ?>
</div>

<?php if(isset(Yii::app()->session[_SITENAME_.'_admin']) && Yii::app()->session[_SITENAME_.'_admin']!='') { ?>
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <div>
        <?php echo Yii::app()->user->setFlash('error', "adsfasdfasfsadf");?>
        <?php if(Yii::app()->user->hasFlash('success')): ?>
            <div class="alert alert-success">
                <button class="close" data-close="alert"></button>
                <span>
               <?php echo Yii::app()->user->getFlash('success'); ?> </span>
            </div>
            <div class="clear"></div>
        <?php endif; ?>
        <?php if(Yii::app()->user->hasFlash('error')): ?>
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                <span>
               <?php echo Yii::app()->user->getFlash('error'); ?> </span>
            </div>
        <?php endif; ?>
    </div>
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="<?php echo Yii::app()->params->base_path ; ?>admin/dashboard">Viia</a>
            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">7</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">

                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->
                    <!-- Tasks -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">flag</i>
                            <span class="label-count">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">TASKS</li>
                            <li class="body">
                                <ul class="menu tasks">

                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Tasks -->
                    <li class="dropdown pull-right" class="js-right-sidebar" class="material-icons">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right" style="margin-right: 17px;">
                            <li><a href="<?php echo Yii::app()->params->base_path ; ?>admin/profile"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="<?php echo Yii::app()->params->base_path ; ?>admin/setting"><i class="material-icons">settings</i>Settings</a></li>
                            <li><a href="<?php echo Yii::app()->params->base_path ; ?>admin/changePassword"><i class="material-icons">vpn_key</i>Change Password</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="<?php echo Yii::app()->params->base_path ; ?>admin/Logout"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">


                <div class="row">
                    <div class="col-md-3 col-xs-3">
                        <div class="image" style="margin-left: -5px;">
                            <?php
                            if (isset($adminData['avatar']) && ($adminData['avatar'] != '')  ) {
                                Yii::app()->session['avatar'] = $adminData['avatar'];
                                $url = Yii::app()->params->base_url . "assets/upload/avatar/admin/" . $adminData['avatar'];
                            } else {
                                $url = Yii::app()->params->base_url . "assets/upload/avatar/admin/" . Yii::app()->session[_SITENAME_.'_avatar'];
                            }
                            ?>
                            <img src="<?= $url;?>" width="70" height="70" alt="User" />
                        </div>
                    </div>
                    <div class="col-md-9 col-xs-9">
                        <div class="info-container">

                            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= Yii::app()->session[_SITENAME_.'_name'];?></div>
                            <div class="email"><?= Yii::app()->session[_SITENAME_.'_email'];?></div>
                            <div class="btn-group user-helper-dropdown">
                                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="<?php echo Yii::app()->params->base_path ; ?>admin/profile"><i class="material-icons">person</i>Profile</a></li>
                                    <li role="seperator" class="divider"></li>
                                    <li><a href="<?php echo Yii::app()->params->base_path ; ?>admin/setting"><i class="material-icons">settings</i>Settings</a></li>
                                    <li><a href="<?php echo Yii::app()->params->base_path ; ?>admin/changePassword"><i class="material-icons">vpn_key</i>Change Password</a></li>
                                    <li role="seperator" class="divider"></li>
                                    <li><a href="<?php echo Yii::app()->params->base_path ; ?>admin/Logout"><i class="material-icons">input</i>Sign Out</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">

                    <li <?php if(isset(Yii::app()->session['current']) && Yii::app()->session['current'] == 'dashboard') { ?> class="active" <?php } ?>>
                        <a href="<?php echo Yii::app()->params->base_path ; ?>admin/dashboard">
                            <i class="fa fa-home col-md-2"></i>
                            <span class=""><b >Dashboard</b></span>
                        </a>
                    </li>
                    <?php $company_arr = array('newcustomer','customer'); ?>
                    <li <?php if(isset(Yii::app()->session['current']) && in_array(Yii::app()->session['current'],$company_arr)) { ?> class="active" <?php } ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-user col-md-2"></i>
                            <span class=""><b>Customers</b></span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php if(isset(Yii::app()->session['current']) && Yii::app()->session['current'] == 'newcustomer') { ?> class="active" <?php } ?>>
                                <a href="<?php echo Yii::app()->params->base_path ; ?>admin/newCustomerListing" title="New Customers" class="">
                                    <span>New Customers</span>
                                </a>

                            </li>
                            <li <?php if(isset(Yii::app()->session['current']) && Yii::app()->session['current'] == 'customer') { ?> class="active" <?php } ?>>
                                <a href="<?php echo Yii::app()->params->base_path ; ?>admin/customerListing" title="Customers" class="">
                                    <span>Customers</span>
                                </a>

                            </li>
                        </ul>
                    </li>

                    <?php $provider_arr = array('newprovider','provider'); ?>
                    <li <?php if(isset(Yii::app()->session['current']) && in_array(Yii::app()->session['current'],$provider_arr)) { ?> class="active" <?php } ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-user col-md-2"></i>
                            <span><b>Providers</b></span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php if(isset(Yii::app()->session['current']) && Yii::app()->session['current'] == 'newprovider') { ?> class="active" <?php } ?>>
                                <a href="<?php echo Yii::app()->params->base_path ; ?>admin/newProviderListing" title="New Providers" class="">
                                    <span>New Providers</span>
                                </a>

                            </li>
                            <li <?php if(isset(Yii::app()->session['current']) && Yii::app()->session['current'] == 'provider') { ?> class="active" <?php } ?>>
                                <a href="<?php echo Yii::app()->params->base_path ; ?>admin/providerListing" title="Providers" class="">
                                    <span>Providers</span>
                                </a>

                            </li>
                        </ul>
                    </li>



                    <?php $provider_arr = array('newvenue','venue'); ?>
                    <li <?php if(isset(Yii::app()->session['current']) && in_array(Yii::app()->session['current'],$provider_arr)) { ?> class="active" <?php } ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-map-marker col-md-2"></i>
                            <span><b>Venues</b></span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php if(isset(Yii::app()->session['current']) && Yii::app()->session['current'] == 'newvenue') { ?> class="active" <?php } ?>>
                                <a href="<?php echo Yii::app()->params->base_path ; ?>admin/newVenueListing" title="New Venues" class="">
                                    <span>New Venues</span>
                                </a>

                            </li>
                            <li <?php if(isset(Yii::app()->session['current']) && Yii::app()->session['current'] == 'venue') { ?> class="active" <?php } ?>>
                                <a href="<?php echo Yii::app()->params->base_path ; ?>admin/venueListing" title="Venues" class="">
                                    <span>Venues</span>
                                </a>

                            </li>
                        </ul>
                    </li>


                    <li <?php if(isset(Yii::app()->session['current']) && Yii::app()->session['current'] == 'roomTypeList') { ?> class="active" <?php } ?>>
                        <a href="<?php echo Yii::app()->params->base_path ; ?>admin/roomTypeListing" title="Room Types">
                            <i class="fa fa-home col-md-2"></i>
                            <span><b>Room Types</b></span>
                        </a>
                    </li>

                    <li <?php if(isset(Yii::app()->session['current']) && Yii::app()->session['current'] =='Chair_type') { ?> class="active" <?php } ?>>
                        <a href="<?php echo Yii::app()->params->base_path ; ?>admin/ChairTypeListing" title="Chair Type List">
                            <i class="fa fa-wheelchair col-md-2"></i>
                            <span><b>Chair Types</b></span>
                        </a>
                    </li>

                    <li <?php if(isset(Yii::app()->session['current']) && Yii::app()->session['current'] == '') { ?> class="active" <?php } ?>>
                        <a href="<?php echo Yii::app()->params->base_path ; ?>admin/roomTypeListing" title="Revenue">
                            <i class="fa fa-money col-md-2"></i>
                            <span><b>Revenue</b></span>
                        </a>
                    </li>

                    <li <?php if(isset(Yii::app()->session['current']) && Yii::app()->session['current'] == '') { ?> class="active" <?php } ?>>
                        <a href="<?php echo Yii::app()->params->base_path ; ?>admin/roomTypeListing" title="Bookings List">
                            <i class="fa fa-calendar-o col-md-2"></i>
                            <span><b>Bookings</b></span>
                        </a>
                    </li>


                    <li <?php if(isset(Yii::app()->session['current']) && Yii::app()->session['current'] == 'reservationsList') { ?> class="active" <?php } ?>>
                        <a href="<?php echo Yii::app()->params->base_path ; ?>admin/reservationListing" title="Reservations List">
                            <i class="fa fa-calendar col-md-2"></i>
                            <span><b>Reservations</b></span>
                        </a>
                    </li>


                    <li <?php if(isset(Yii::app()->session['current']) && Yii::app()->session['current'] == 'promo_code') { ?> class="active" <?php } ?>>
                        <a href="<?php echo Yii::app()->params->base_path ; ?>admin/PromocodeListing" title="Promocode List">
                            <i class="fa fa-tag col-md-2"></i>
                            <span><b>Promocodes</b></span>
                        </a>
                    </li>


                    <li <?php if(isset(Yii::app()->session['current']) && Yii::app()->session['current'] == '') { ?> class="active" <?php } ?>>
                        <a href="<?php echo Yii::app()->params->base_path ; ?>admin/roomTypeListing" title="Notifications List">
                            <i class="fa fa-bell col-md-2"></i>
                            <span><b>Notifications</b></span>
                        </a>
                    </li>

                    <li <?php if(isset(Yii::app()->session['current']) && Yii::app()->session['current'] == '') { ?> class="active" <?php } ?>>
                        <a href="<?php echo Yii::app()->params->base_path ; ?>admin/roomTypeListing" title="Messages List">
                            <i class="fa fa-comment col-md-2"></i>
                            <span><b>Messages</b></span>
                        </a>
                    </li>
                    <li <?php if(isset(Yii::app()->session['current']) && Yii::app()->session['current'] =='services') { ?> class="active" <?php } ?>>
                        <a href="<?php echo Yii::app()->params->base_path ; ?>admin/ServiceListing" title="Service List">
                            <i class="fa fa-wrench col-md-2"></i>
                            <span><b>Services</b></span>
                        </a>
                    </li>





                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; <?= date('Y');?> <a href="javascript:void(0);">Viia</a>
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->

    </section>


    <?php echo $content; ?>
<?php }else{?>
    <?php echo $content; ?>
<?php }?>

<!-- Bootstrap Core Js -->
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/admin/plugins/bootstrap/js/bootstrap.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/js/jquery.validate.js"></script>
<!-- Select Plugin Js -->
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/admin/plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/admin/plugins/node-waves/waves.js"></script>

<!-- Autosize Plugin Js -->
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/admin/plugins/autosize/autosize.js"></script>

<!-- Moment Plugin Js -->
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/admin/plugins/momentjs/moment.js"></script>
<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/admin/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/admin/plugins/jquery-countto/jquery.countTo.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/admin/js/basic-form-elements.js"></script>


<!-- Custom Js -->
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/admin/js/admin.js"></script>

<script src="<?php echo Yii::app()->params->base_url ; ?>assets/js/bootbox/bootbox.min.js"></script>
<?php
if(isset(Yii::app()->session[_SITENAME_.'_admin']) && isset(Yii::app()->session['current']) && Yii::app()->session['current']=='dashboard')
{ ?>
    <script src="<?php echo Yii::app()->params->base_url ; ?>assets/admin/js/pages/index.js"></script>
    <!-- Demo Js -->
    <script src="<?php echo Yii::app()->params->base_url ; ?>assets/admin/js/demo.js"></script>
    <script src="<?php echo Yii::app()->params->base_url ; ?>assets/js/bootstrap-select.min.js"></script>
    <script src="<?php echo Yii::app()->params->base_url ; ?>assets/bower_components/jquery-ui/ui/jquery-ui.js"></script>
<?php }?>

</body>
</html>
