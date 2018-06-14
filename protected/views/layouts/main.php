<style>
    .dropdown-toggle > i {
        color: #fff !important;
    }

    .page-content {
        padding: 0px 0 0 20px !important;
    }

</style>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>MyMudra</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #4 for statistics, charts, recent events and reports" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
    <script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?php echo Yii::app()->params->base_url ; ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />

    <!-- date picker css -->
    <link href="<?php echo Yii::app()->params->base_url; ?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"
          rel="stylesheet" type="text/css"/>

    <script src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
            type="text/javascript"></script>
    <script>


        function initMenu()
        {
            $(document).ready(function() {
                $('li.nav').click(function() {
                    $("#Loaderaction").css('display','inline-block');
                    //$j('#update-message').removeClass().addClass('');
                    //$j('#update-message').html('');
                    $('li.nav').removeClass('active');
                    $(this).addClass("active");
                    var arr=[];
                    if($(this).children('a').attr("lang"))
                    {
                        arr = $(this).children('a').attr("lang").split("*")
                    }

                    if($(this).children('a').attr("rel"))
                    {
                        arr = $(this).children('a').attr("rel").split("*");
                    }
                    //console.log($arr);
                    $('.tabRef').removeClass('current');
                    //inner tab menu id
                    var innerId=$(this).children('a').attr('id');
                    var parentTab=$(this).attr('lang');

                    if(parentTab!='')
                    {
                        $('#'+parentTab).addClass('current');
                    }
                    else
                    {
                        $(this).addClass('current');
                    }
                    if(innerId=='howItWorks')
                    {
                        $('#middle').load("<?php echo Yii::app()->params->base_path;?>site/HowItWorks");
                    }
                    else
                    {

                        //$('#mainContainer').html('<div class="menuLoader"><img src="'+imgPath+'/spinner-small.gif" alt="loading" border="0" /> Loading...</div>').show();
                        if($(this).attr("lang")=='home')
                        {
                            $('.leftSlidebar').hide();
                        }
                        else
                        {
                            if($('.leftSlidebar').is(":hidden"))
                            {
                                $('.leftSlidebar').show();
                            }
                        }
                        $('#currentBreadcum').html($(this).attr("lang"));
                        if(arr.length > 0 && arr[0]) {
                            $.ajax({
                                url: arr[0],
                                data: '',
                                success: function (response) {
                                    $('#mainContainer').html(response);
                                    history.pushState(null, null, arr[0]);
                                    $("#Loaderaction").css('display', 'none');

                                    //inner tab menu
                                    //$('#update-message').html('');
                                    //close inner tab menu
                                    return false;
                                }
                            });
                        }

                    }

                });
            });

        }
        initMenu();
    </script>
    <style>
        .rightAlign{
            position: relative;
            text-align: right;
            bottom:41px;
        }
    </style>

</head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top" >
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="index.html">
                <img src="assets/pages/img/login_logo.png" alt="logo" class="logo-default" style="height: 70px; width: 110px; margin-top: 0px;" /> </a>
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN PAGE ACTIONS -->
        <!-- DOC: Remove "hide" class to enable the page header actions -->
        <!--<div class="page-actions">
            <div class="btn-group">
                <button type="button" class="btn red-haze btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <span class="hidden-sm hidden-xs">Actions&nbsp;</span>
                    <i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="javascript:;">
                            <i class="icon-docs"></i> New Post </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="icon-tag"></i> New Comment </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="icon-share"></i> Share </a>
                    </li>
                    <li class="divider"> </li>
                    <li>
                        <a href="javascript:;">
                            <i class="icon-flag"></i> Comments
                            <span class="badge badge-success">4</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="icon-users"></i> Feedbacks
                            <span class="badge badge-danger">2</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>-->
        <!-- END PAGE ACTIONS -->
        <!-- BEGIN PAGE TOP -->
        <div class="page-top">
            <!-- BEGIN HEADER SEARCH BOX -->
            <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
            <!-- <form class="search-form" action="page_general_search_2.html" method="GET">
                 <div class="input-group">
                     <input type="text" class="form-control input-sm" placeholder="Search..." name="query">
                     <span class="input-group-btn">
                                 <a href="javascript:;" class="btn submit">
                                     <i class="icon-magnifier"></i>
                                 </a>
                             </span>
                 </div>
             </form>-->
            <!-- END HEADER SEARCH BOX -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="separator hide"> </li>
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <!-- DOC: Apply "dropdown-hoverable" class after "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                    <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                    <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
                        <!--<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-bell"></i>
                            <span class="badge badge-success"> 7 </span>
                        </a>-->
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3>
                                    <span class="bold">12 pending</span> notifications</h3>
                                <a href="page_user_profile_1.html">view all</a>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">just now</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-success">
                                                            <i class="fa fa-plus"></i>
                                                        </span> New user registered. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">3 mins</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Server #12 overloaded. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">10 mins</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> Server #2 not responding. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">14 hrs</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </span> Application error. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">2 days</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Database overloaded 68%. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">3 days</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> A user IP blocked. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">4 days</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> Storage Server #4 not responding dfdfdfd. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">5 days</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </span> System Error. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">9 days</span>
                                            <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Storage server failed. </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- END NOTIFICATION DROPDOWN -->
                    <li class="separator hide"> </li>
                    <!-- BEGIN INBOX DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <!--<li class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-envelope-open"></i>
                            <span class="badge badge-danger"> 4 </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3>You have
                                    <span class="bold">7 New</span> Messages</h3>
                                <a href="app_inbox.html">view all</a>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                    <li>
                                        <a href="#">
                                                    <span class="photo">
                                                        <img src="assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                            <span class="subject">
                                                        <span class="from"> Lisa Wong </span>
                                                        <span class="time">Just Now </span>
                                                    </span>
                                            <span class="message"> Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                                    <span class="photo">
                                                        <img src="assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                            <span class="subject">
                                                        <span class="from"> Richard Doe </span>
                                                        <span class="time">16 mins </span>
                                                    </span>
                                            <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                                    <span class="photo">
                                                        <img src="assets/layouts/layout3/img/avatar1.jpg" class="img-circle" alt=""> </span>
                                            <span class="subject">
                                                        <span class="from"> Bob Nilson </span>
                                                        <span class="time">2 hrs </span>
                                                    </span>
                                            <span class="message"> Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                                    <span class="photo">
                                                        <img src="assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                            <span class="subject">
                                                        <span class="from"> Lisa Wong </span>
                                                        <span class="time">40 mins </span>
                                                    </span>
                                            <span class="message"> Vivamus sed auctor 40% nibh congue nibh... </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                                    <span class="photo">
                                                        <img src="assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                            <span class="subject">
                                                        <span class="from"> Richard Doe </span>
                                                        <span class="time">46 mins </span>
                                                    </span>
                                            <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>-->
                    <!-- END INBOX DROPDOWN -->
                    <li class="separator hide"> </li>
                    <!-- BEGIN TODO DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <!-- <li class="dropdown dropdown-extended dropdown-tasks dropdown-dark" id="header_task_bar">
                         <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                             <i class="icon-calendar"></i>
                             <span class="badge badge-primary"> 3 </span>
                         </a>
                         <ul class="dropdown-menu extended tasks">
                             <li class="external">
                                 <h3>You have
                                     <span class="bold">12 pending</span> tasks</h3>
                                 <a href="?p=page_todo_2">view all</a>
                             </li>
                             <li>
                                 <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                     <li>
                                         <a href="javascript:;">
                                                     <span class="task">
                                                         <span class="desc">New release v1.2 </span>
                                                         <span class="percent">30%</span>
                                                     </span>
                                             <span class="progress">
                                                         <span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                             <span class="sr-only">40% Complete</span>
                                                         </span>
                                                     </span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="javascript:;">
                                                     <span class="task">
                                                         <span class="desc">Application deployment</span>
                                                         <span class="percent">65%</span>
                                                     </span>
                                             <span class="progress">
                                                         <span style="width: 65%;" class="progress-bar progress-bar-danger" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                                             <span class="sr-only">65% Complete</span>
                                                         </span>
                                                     </span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="javascript:;">
                                                     <span class="task">
                                                         <span class="desc">Mobile app release</span>
                                                         <span class="percent">98%</span>
                                                     </span>
                                             <span class="progress">
                                                         <span style="width: 98%;" class="progress-bar progress-bar-success" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100">
                                                             <span class="sr-only">98% Complete</span>
                                                         </span>
                                                     </span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="javascript:;">
                                                     <span class="task">
                                                         <span class="desc">Database migration</span>
                                                         <span class="percent">10%</span>
                                                     </span>
                                             <span class="progress">
                                                         <span style="width: 10%;" class="progress-bar progress-bar-warning" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                                             <span class="sr-only">10% Complete</span>
                                                         </span>
                                                     </span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="javascript:;">
                                                     <span class="task">
                                                         <span class="desc">Web server upgrade</span>
                                                         <span class="percent">58%</span>
                                                     </span>
                                             <span class="progress">
                                                         <span style="width: 58%;" class="progress-bar progress-bar-info" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">
                                                             <span class="sr-only">58% Complete</span>
                                                         </span>
                                                     </span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="javascript:;">
                                                     <span class="task">
                                                         <span class="desc">Mobile development</span>
                                                         <span class="percent">85%</span>
                                                     </span>
                                             <span class="progress">
                                                         <span style="width: 85%;" class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                                             <span class="sr-only">85% Complete</span>
                                                         </span>
                                                     </span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="javascript:;">
                                                     <span class="task">
                                                         <span class="desc">New UI release</span>
                                                         <span class="percent">38%</span>
                                                     </span>
                                             <span class="progress progress-striped">
                                                         <span style="width: 38%;" class="progress-bar progress-bar-important" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">
                                                             <span class="sr-only">38% Complete</span>
                                                         </span>
                                                     </span>
                                         </a>
                                     </li>
                                 </ul>
                             </li>
                         </ul>
                     </li>-->
                    <!-- END TODO DROPDOWN -->
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username username-hide-on-mobile"> <?php echo Yii::app()->session[_SITENAME_.'_name']; ?> </span>
                            <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                            <img alt="" class="img-circle" src="assets/layouts/layout4/img/avatar9.jpg" /> </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <!--  <li class="nav" id="profile" lang="profile">
                                  <a href="javascript:void(0);" lang="#">
                                      <i class="icon-user"></i> My Profile </a>
                              </li> -->
                            <?php if(isset( Yii::app()->session[_SITENAME_.'_role']) && Yii::app()->session[_SITENAME_.'_role']== 1){?>
                                <li class="nav" id="setting" lang="setting">
                                    <a href="javascript:void(0);" lang="<?php echo Yii::app()->params->base_path ; ?>admin/setting">
                                        <i class="icon-settings"></i> Settings </a>
                                </li>
                            <?php }?>
                            <?php if(isset( Yii::app()->session[_SITENAME_.'_role']) && Yii::app()->session[_SITENAME_.'_role']== 1){?>
                                <li class="nav" id="contact" lang="contact-us">
                                    <a href="javascript:void(0);" lang="<?php echo Yii::app()->params->base_path ; ?>admin/contactUs">
                                        <i class="glyphicon glyphicon-phone-alt"></i> Contact Us </a>
                                </li>
                            <?php }?>

                            <li class="nav" id="changePassword" lang="changePassword">
                                <a href="<?php echo Yii::app()->params->base_path ; ?>admin/changePassword">
                                    <i class="icon-key"></i> Change Password
                                    <!--<span class="badge badge-danger"> 3 </span>-->
                                </a>
                            </li>

                            <li class="divider"> </li>
                            <li>
                                <a href="<?php echo Yii::app()->params->base_path ; ?>admin/Logout">
                                    <i class="icon-logout"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <!--<li class="dropdown dropdown-extended quick-sidebar-toggler">
                        <span class="sr-only">Toggle Quick Sidebar</span>
                        <i class="icon-logout"></i>
                    </li>-->
                    <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->


<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">


    <div id="update_message" class="custom-alerts alert alert-success" style="display: none"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><i class="fa-lg fa fa-check"></i>&nbsp;<span id="msg"></span></div>




    <?php if(Yii::app()->user->hasFlash('success')): ?>
        <div id="msgbox" class="custom-alerts alert alert-success" ><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><i class="fa-lg fa fa-check"></i>
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
    <?php endif; ?>


    <?php if(Yii::app()->user->hasFlash('error')): ?>
        <div id="msgbox" class="custom-alerts alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><i class="fa-lg fa fa-warning"></i>
            <?php echo Yii::app()->user->getFlash('error'); ?>
        </div>
    <?php endif; ?>
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <!-- BEGIN SIDEBAR -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">

            <?php
            $TblAdminMenuObj = new TblMenu();
            $menus = $TblAdminMenuObj->getAllMenus();
            //echo "<pre>"; print_r($menus); die;

            /*$TblRolePermissionObj = new TblRolePermission();
            $menu_ids = $TblRolePermissionObj->getMenusByRoleID(Yii::app()->session[_SITENAME_.'_role']);*/

            //$menu_arr = explode(",", $menu_ids['menu_ids']);

            //$TblRolePermissionObj = new TblRolePermission();
            //$allMenu = $TblRolePermissionObj->getAllPermissionByRole(Yii::app()->session[_SITENAME_.'_role']);

            //print "<pre>";
            //$arr = explode(",",$allMenu);
            //print_r($menus);die;
            ?>


            <!-- BEGIN SIDEBAR MENU -->
            <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
            <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
            <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
            <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">


                <?php foreach ($menus as $row) { ?>

                    <?php //if ($row['menu_name'] == "Dashboard" && in_array($row['menu_id'], $menu_arr)) { ?>
                    <?php if (isset($row['menu_name']) && $row['menu_name']!='' && isset($row['menu_id']) && $row['menu_id']!='') { ?>

                        <li <?php if (isset(Yii::app()->session['current']) && Yii::app()->session['current'] == $row['menu_name']) { ?> class="nav-item start active open" <?php } ?>>
                            <a href="<?php echo Yii::app()->params->base_path; ?><?php echo $row['page_url']; ?>"
                               class="nav-link nav-toggle">
                                <i class="<?php echo $row['menu_icon']; ?>"></i>
                                <span class="title"><?php echo $row['menu_name']; ?></span>
                                <span class="selected"></span>

                            </a>
                        </li>
                    <?php } else { ?>
                        <?php if(in_array($row['menu_id'], $menu_arr)) { ?>
                            <li <?php if (isset(Yii::app()->session['current']) && Yii::app()->session['current'] == $row['current_session']) { ?> class="active nav nav-item start" <?php } else { ?> class="nav nav-item start" <?php } ?>
                                    id="<?php echo $row['menu_name']; ?>" >
                                <a href="<?php echo Yii::app()->params->base_path; ?><?php echo "admin/".$row['page_url']; ?>/menu_id/<?php echo $row['menu_id']; ?>"  class="nav-link nav-toggle">
                                    <i class="<?php echo $row['menu_icon']; ?>"></i>
                                    <span class="title"><?php echo $row['menu_name']; ?></span>

                                </a>
                            </li>
                        <?php } ?>
                    <?php } ?>

                <?php } ?>

            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">

                <!-- BEGIN PAGE TOOLBAR -->

                <!-- END PAGE TOOLBAR -->
            </div>
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE BREADCRUMB -->
            <!--<ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="<?php /*echo Yii::app()->params->base_path; */?>admin/dashboard">Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li id="currentBreadcum">
                    <span class="active"><?php /*echo Yii::app()->session['breadcums']; */?></span>
                </li>
            </ul>-->
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="col-md-3" style="float: left; z-index: 9999; position: absolute; left: 44%; top: -18px;"><img style="display:none;float:left" src="<?php echo Yii::app()->params->base_url;?>/assets/pages/img/loading14.gif" id="Loaderaction">
            </div>
            <div id="mainContainer">

                <?php echo $content; ?>
            </div>

            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->

    <!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"> <?php echo date("Y"); ?> &copy; Mymudra  |&nbsp;
        <a href="https://www.bypeopletechnologies.com/" title="Developed by byPeople Technologies" target="_blank">byPeople Technologies</a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN QUICK NAV -->
<!--<nav class="quick-nav">
    <a class="quick-nav-trigger" href="#0">
        <span aria-hidden="true"></span>
    </a>
    <ul>
        <li>
            <a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" target="_blank" class="active">
                <span>Purchase Metronic</span>
                <i class="icon-basket"></i>
            </a>
        </li>
        <li>
            <a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/reviews/4021469?ref=keenthemes" target="_blank">
                <span>Customer Reviews</span>
                <i class="icon-users"></i>
            </a>
        </li>
        <li>
            <a href="http://keenthemes.com/showcast/" target="_blank">
                <span>Showcase</span>
                <i class="icon-user"></i>
            </a>
        </li>
        <li>
            <a href="http://keenthemes.com/metronic-theme/changelog/" target="_blank">
                <span>Changelog</span>
                <i class="icon-graph"></i>
            </a>
        </li>
    </ul>
    <span aria-hidden="true" class="quick-nav-bg"></span>
</nav>-->
<div class="quick-nav-overlay"></div>
<!-- END QUICK NAV -->
<!--[if lt IE 9]>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/excanvas.min.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/jquery-validation/js/jquery.validate.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<!--<script src="assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>-->
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/pages/scripts/dashboard.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>


<script src="<?php echo Yii::app()->params->base_url; ?>assets/js/maplace.min.js"></script>
<!--<script src="https://maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.22&key=<?= GOOGLE_KEY;?>">
</script>-->
<!-- END THEME LAYOUT SCRIPTS -->
<script>
    $(document).ready(function()
    {
        $('#clickmewow').click(function()
        {
            $('#radio1003').attr('checked', 'checked');
        });

        var msgBox = $('#update_message');
        setTimeout(function ()
        {
            msgBox.fadeOut();
        }, 8000);

        var msgBox2 = $('#msgBox');
        setTimeout(function ()
        {
            msgBox2.fadeOut();
        }, 8000);

        var msgBox3 = $('#msgbox');
        setTimeout(function ()
        {
            msgBox3.fadeOut();
        }, 8000);



    })
</script>
</body>

</html>