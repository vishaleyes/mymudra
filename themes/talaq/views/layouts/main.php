<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Talaq</title>
    <link rel="icon" href="<?php echo Yii::app()->params->base_url ; ?>assets/img/icon_small.png" type="image/x-icon"/>
    <!-- Bootstrap -->
    <link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/customer/css/bootstrap.css" rel="stylesheet">

    <!-- style -->
    <link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/customer/css/style.css" rel="stylesheet">

    <!-- Media -->
    <link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/customer/css/media.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/customer/css/font-awesome.min.css" rel="stylesheet">

    <!-- Time Picker CSS -->
    <!--<link href="<?php /*echo Yii::app()->params->base_url ; */?>themefiles/assets/customer/css/bootstrap-datetimepicker.css" rel="stylesheet">-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        #terms_condition-error {
            left: -19px;
            position: relative;
            top: 52px;
            width: 100%;
        }
    </style>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/customer/js/jquery-1.11.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/customer/js/bootstrap.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDP76rTZusQqYFwVBTwkw_1fB1_a-IJJvs" /></script>
    <script type='text/javascript'>

    var infos = [];

    var infowindow = new google.maps.InfoWindow();
    var flightPlanCoordinates = [];
    var bounds = new google.maps.LatLngBounds();
    var markersArray = [];
    var infos = [];
    var lineCoordinatesArray = [];


    //This javascript will load when the page loads.
    jQuery(document).ready( function($){


        var mapHeight = $(window).height();
        $("#map").height( mapHeight - 300 );


        var MY_MAPTYPE_ID = 'custom_style';

        function parse_place(place)
        {
            var location = [];

            for (var ac = 0; ac < place.address_components.length; ac++)
            {
                var component = place.address_components[ac];

                switch(component.types[0])
                {
                    case 'locality':
                        location['city'] = component.long_name;
                        break;
                    case 'administrative_area_level_1':
                        location['state'] = component.long_name;
                        break;
                    case 'country':
                        location['country'] = component.long_name;
                        break;
                }
            };

            return location;
        }

        function initialize() {

            if (!navigator.geolocation){
                output.innerHTML = "<p>Geolocation is not supported by your browser</p>";
                return;
            }
            if(navigator.geolocation)
            {
                navigator.geolocation.getCurrentPosition(function (pos) {
                    var geocoder = new google.maps.Geocoder();
                    var lat = pos.coords.latitude;
                    var lng = pos.coords.longitude;
                    $('#latitude').val(lat);
                    $('#longitude').val(lng);
                    var latlng = new google.maps.LatLng(lat, lng);

                    //reverse geocode the coordinates, returning location information.
                    geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                        var result = results[0];
                        var city = '';

                        for (var i = 0, len = result.address_components.length; i < len; i++) {
                            var ac = result.address_components[i];

                            if (ac.types.indexOf('administrative_area_level_2') >= 0) {
                                city = ac.long_name;
                            }
                        }
                        $('#search_city').val(city);
                    });

                    //return location;

                    //$('#dis_data').val(p);
                   // alert(location);
                });

            } else {

                //alert('Geo Location feature is not supported in this browser.');
                handleLocationError(false, infoWindow, map.getCenter());
            }


        }
        <?php
            if(!isset(Yii::app()->session[_SITENAME_.'_search_city']) || Yii::app()->session[_SITENAME_.'_search_city']==""){
                ?>
                    google.maps.event.addDomListener(window, 'load', initialize);
                <?php
            }
            ?>


    });

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {

        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
    }


    </script>

</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            <a class="navbar-brand" href="<?php echo Yii::app()->params->base_path; ?>customer/"><img src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/customer/img/header_logo.png" class="img-responsive"></a></div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="defaultNavbar1">
            <ul class="nav navbar-nav">
                <?php
                if (isset(Yii::app()->session[_SITENAME_.'_customer'])) {
                    if(isset(Yii::app()->session[_SITENAME_.'__customer_current']) && Yii::app()->session[_SITENAME_.'__customer_current']=="myBooking"){
                        $myBooking_active = "active";
                    }
                    else{
                        $myBooking_active = "";
                    }
                    ?>
                    <li class="<?= $myBooking_active?>"><a href="<?php echo Yii::app()->params->base_path; ?>customer/myBooking"><?= Yii::app()->params->msg['_MY_BOOKING_']; ?><span
                                    class="sr-only">(current)</span></a></li>
                    <?php
                }
                ?>
                <li><a href="#"><?=  Yii::app()->params->msg['_PAYMENT_'];?></a></li>
                <li><a href="#"><?=  Yii::app()->params->msg['_ASK_FOR_ASSISTANCE_'];?></a></li>
                <?php
                if (isset(Yii::app()->session[_SITENAME_.'_customer'])) {
                if(isset(Yii::app()->session[_SITENAME_.'__customer_current']) && Yii::app()->session[_SITENAME_.'__customer_current']=="myFavourite"){
                    $myFavourite_active = "active";
                }
                else{
                    $myFavourite_active = "";
                }
                ?>
                    <li class="<?= $myFavourite_active?>"><a href="<?php echo Yii::app()->params->base_path; ?>customer/myFavourite"><?=  Yii::app()->params->msg['_MY_LIST_'];?></a></li>
                    <?php
                }
                ?>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i> +1-888-45678-890</a></li>
                <li class="hidden-xs hidden-sm"><a>|</a></li>
                <li class="dropdown"><a href="#"id="dLabel" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <?php if(isset(Yii::app()->session['prefferd_language']) && Yii::app()->session['prefferd_language'] == 'eng') {
                            echo "English";
                        }
                        else
                        {
                            echo "Arabic";
                        }
                        ?>
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="dLabel"  role="menu" >
                        <li <?php if(isset(Yii::app()->session['prefferd_language']) && Yii::app()->session['prefferd_language'] == 'eng') { ?> class="active" <?php } ?>><a href="<?php echo Yii::app()->params->base_path; ?>customer/changeLanguage/lang/1">English</a></li>
                        <li <?php if(isset(Yii::app()->session['prefferd_language']) && Yii::app()->session['prefferd_language'] == 'ar') { ?> class="active" <?php } ?>><a href="<?php echo Yii::app()->params->base_path; ?>customer/changeLanguage/lang/2">Arabic</a></li>
                    </ul>
                </li>
                <li class="hidden-xs hidden-sm"><a>|</a></li>
                <?php
                if(isset(Yii::app()->session[_SITENAME_.'_customer']) && Yii::app()->session[_SITENAME_.'_customer']!=''){
                    ?>
                    <li><a href="<?php echo Yii::app()->params->base_path; ?>customer/logout" ><?=  Yii::app()->params->msg['_LOGOUT_'];?></a></li>
                    <?php
                }
                else{
                    ?>
                    <li><a href="javascript:void(0);" data-toggle="modal" data-target="#myModalLogin"><?=  Yii::app()->params->msg['_LOGIN_REGISTRATION_'];?></a></li>
                <?php
                }
                ?>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<?php
$user = "";

/*Code start for facebook social login */
if (!isset($_GET['code'])) {
    require 'Facebook/autoload.php';
    $fb = new Facebook\Facebook([
        'app_id' => APP_ID,
        'app_secret' => APP_SECRET,
        'default_graph_version' => 'v2.9',
    ]);

    $helper = $fb->getRedirectLoginHelper();

    $permissions = ['email']; // Optional permissions
    $loginUrl = $helper->getLoginUrl('' . Yii::app()->params->base_path . 'customer/index' . '', $permissions);
}
else {
    $loginUrl = "";
}

//facebook code end

/*Code start for google social login and register*/

    require 'Google/autoload.php';
    $client = new Google_Client();
    $client->setClientId(CLIENT_ID);
    $client->setClientSecret(CLIENT_SECRET);
    $client->setRedirectUri('http://localhost/talaq_new/index.php?r=customer/gplusLogin');
    $client->addScope("email");
    $client->addScope("profile");
    $service = new Google_Service_Oauth2($client);


    if (isset($_GET['code'])) {
        $client->authenticate($_GET['code']);
        Yii::app()->session['access_token'] = $client->getAccessToken();
        $client->setAccessToken(Yii::app()->session['access_token']);
        //header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        //exit;
    }
    //unset(Yii::app()->session['access_token']);
    /************************************************
    If we have an access token, we can make
    requests, else we generate an authentication URL.
     ************************************************/
    if (isset(Yii::app()->session['access_token']) && Yii::app()->session['access_token']) {
        $client->setAccessToken(Yii::app()->session['access_token']);
    } else {
        $authUrl = $client->createAuthUrl();
    }

    if (!isset($authUrl)){
        $user = $service->userinfo->get(); //get user info
        $gpluse_id = $user['id'];

        if (!empty($user) && (!isset(Yii::app()->session[_SITENAME_.'_customer_reg_err_msg']) || Yii::app()->session[_SITENAME_.'_customer_reg_err_msg']=="") && !isset(Yii::app()->session[_SITENAME_.'_customer'])) {

            $TblCustomerObj = new TblCustomer();
            $customer_data = $TblCustomerObj->authanticateUserEmail($gpluse_id,"","");

            if (!empty($customer_data)) {

                if($customer_data['is_verified']!='1'){
                    Yii::app()->session[_SITENAME_.'_customer_reg_err_msg'] = "Your account is not verified.";
                }
                else if($customer_data['status']==0){
                    Yii::app()->session[_SITENAME_.'_customer_reg_err_msg'] = "Your account is deactivated by admin.";
                }
                else if($customer_data['status']==2){
                    Yii::app()->session[_SITENAME_.'_customer_reg_err_msg'] = "Your account is hold by admin.";
                }
                else
                {
                    Yii::app()->session[_SITENAME_.'_customer'] = $customer_data['customer_id'];
                    Yii::app()->session[_SITENAME_.'_customer_email'] = $customer_data['email'];
                    Yii::app()->session[_SITENAME_.'_customer_name'] = $customer_data['first_name']." ".$customer_data['last_name'];

                    unset(Yii::app()->session['access_token']);
                    echo "<script>window.location = '".Yii::app()->params->base_path."customer/';</script>";
                }

                if(isset(Yii::app()->session[_SITENAME_.'_customer_reg_err_msg']) && Yii::app()->session[_SITENAME_.'_customer_reg_err_msg']!=''){
                    unset(Yii::app()->session['access_token']);
                    $authUrl = $client->createAuthUrl();
                }
            }
        }
    }
// google socail login code end


include_once("twitter/twitteroauth.php");

if(!isset($_REQUEST['oauth_token'])){
    /*code start for twitter social login*/
    $OAUTH_CALLBACK = Yii::app()->params->base_path."customer/index";
    $twitter_connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
    $request_token = $twitter_connection->getRequestToken($OAUTH_CALLBACK);

//Received token info from twitter
    Yii::app()->session['token'] 			= $request_token['oauth_token'];
    Yii::app()->session['token_secret'] 	= $request_token['oauth_token_secret'];

//Any value other than 200 is failure, so continue only if http code is 200
    if($twitter_connection->http_code == '200') {
        //redirect user to twitter
        $twitter_url = $twitter_connection->getAuthorizeURL($request_token['oauth_token']);
    }
}
/*
echo $_REQUEST['oauth_token']."<br/>";
echo Yii::app()->session['token'];
die;*/
if(isset($_REQUEST['oauth_token']) && Yii::app()->session['token'] == $_REQUEST['oauth_token']) {

    $twitter_connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, Yii::app()->session['token'], Yii::app()->session['token_secret']);


    $access_token = $twitter_connection->getAccessToken($_REQUEST['oauth_verifier']);
    if ($twitter_connection->http_code == '200') {
        $user = $twitter_connection->get('account/verify_credentials');
        $twitter_id = $user['id'];

        if (!empty($user) && (!isset(Yii::app()->session[_SITENAME_.'_customer_reg_err_msg']) || Yii::app()->session[_SITENAME_.'_customer_reg_err_msg']=="") && !isset(Yii::app()->session[_SITENAME_.'_customer'])) {

            $TblCustomerObj = new TblCustomer();
            $customer_data = $TblCustomerObj->authanticateUserEmail("","",$twitter_id);

            if (!empty($customer_data)) {

                if($customer_data['is_verified']!='1'){
                    Yii::app()->session[_SITENAME_.'_customer_reg_err_msg'] = "Your account is not verified.";
                }
                else if($customer_data['status']==0){
                    Yii::app()->session[_SITENAME_.'_customer_reg_err_msg'] = "Your account is deactivated by admin.";
                }
                else if($customer_data['status']==2){
                    Yii::app()->session[_SITENAME_.'_customer_reg_err_msg'] = "Your account is hold by admin.";
                }
                else
                {
                    Yii::app()->session[_SITENAME_.'_customer'] = $customer_data['customer_id'];
                    Yii::app()->session[_SITENAME_.'_customer_email'] = $customer_data['email'];
                    Yii::app()->session[_SITENAME_.'_customer_name'] = $customer_data['first_name']." ".$customer_data['last_name'];

                    unset(Yii::app()->session['access_token']);
                    echo "<script>window.location = '".Yii::app()->params->base_path."customer/';</script>";
                }

                if(isset(Yii::app()->session[_SITENAME_.'_customer_reg_err_msg']) && Yii::app()->session[_SITENAME_.'_customer_reg_err_msg']!=''){
                    unset(Yii::app()->session['token_secret']);
                    unset(Yii::app()->session['token']);
                    $authUrl = $client->createAuthUrl();
                }
            }
        }
    }
}
/*code end*/
?>
		<div>
      	    <?php if(Yii::app()->user->hasFlash('success')): ?>
          	<div class="alert alert-success">
                <button class="close" data-close="alert"></button>
                <span><?php echo Yii::app()->user->getFlash('success'); ?> </span>
            </div>
            <div class="clear"></div>
            <?php endif; ?>
            <?php if(Yii::app()->user->hasFlash('error')): ?>
            <div class="alert alert-danger">
			    <button class="close" data-close="alert"></button>
                <span><?php echo Yii::app()->user->getFlash('error'); ?></span>
            </div>
            <?php endif; ?>
         </div>
        <input type="hidden" name="dis_data" id="dis_data" value="">
        <!-- Modal -->
        <div class="modal lr-modal fade" id="myModalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <?php
                                if(isset(Yii::app()->session['user']) && Yii::app()->session['user']!=''){
                                    $user = Yii::app()->session['user'];
                                }


                                if(empty($user) || (isset(Yii::app()->session[_SITENAME_.'_customer_reg_err_msg']) && Yii::app()->session[_SITENAME_.'_customer_reg_err_msg']!='')){
                                    $login_tab_active = "active";
                                    $reg_tab_active = "";
                                }
                                else{
                                    $login_tab_active = "";
                                    $reg_tab_active = "active";
                                }
                                ?>
                                <li role="presentation" class="<?= $login_tab_active;?>"><a href="#login" aria-controls="login" role="tab" data-toggle="tab"><?=  Yii::app()->params->msg['_CUSTOMER_LOGIN_'];?></a></li>
                                <li role="presentation" class="<?= $reg_tab_active;?>"><a href="#register" aria-controls="register" role="tab" data-toggle="tab"><?=  Yii::app()->params->msg['_REGISTER_'];?></a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="alert alert-danger <?php
                                if(!isset(Yii::app()->session[_SITENAME_.'_customer_reg_err_msg'])){ echo "hide";}
                                ?>" id="login_reg_err_msg_div" style="margin-bottom:0px;margin-top:10px;">
                                    <button class="close" data-close="alert"></button>
                                    <span id="login_reg_err_msg"><?php
                                    if((isset(Yii::app()->session[_SITENAME_.'_customer_reg_err_msg']) && Yii::app()->session[_SITENAME_.'_customer_reg_err_msg']!='')){ echo Yii::app()->session[_SITENAME_.'_customer_reg_err_msg'];}
                                        ?></span>
                                </div>
                                <div class="alert alert-success hide" id="login_reg_success_msg_div" style="margin-bottom:0px;margin-top:10px;">
                                    <button class="close" data-close="alert"></button>
                                    <span id="login_reg_success_msg"></span>
                                </div>

                                <div role="tabpanel" class="tab-pane <?= $login_tab_active;?>" id="login">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="l-r" action="<?php echo Yii::app()->params->base_path; ?>customer/customerLogin" method="post" name="login_form" id="login_form">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="control-label"><?=  Yii::app()->params->msg['_USERNAME_'];?></label>
                                                    <input type="text" class="form-control" id="username" name="username" placeholder="<?=  Yii::app()->params->msg['_USERNAME_'];?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1" class="control-label"><?=  Yii::app()->params->msg['_PASSWORD_'];?></label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="<?=  Yii::app()->params->msg['_PASSWORD_'];?>">
                                                </div>
                                                <div class="checkbox-custom-brown">
                                                    <div class="checkbox">
                                                        <input id="remember" name="remember" value="1" class="styled" type="checkbox">
                                                        <label for="remember">
                                                            <?=  Yii::app()->params->msg['_REMEMBER_ME_'];?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <!--onclick="showForgotPassword();"-->
                                                <a class="fogotpassword-link" href="javascript:void(0);"  data-toggle="modal" data-target="#myModalForgot" data-dismiss="modal"><?=  Yii::app()->params->msg['_FORGOT_PASSWORD_'];?></a>
                                                <div class="clearfix"></div>
                                                <div class="login-btn">
                                                    <button type="submit" class="btn btn-default" name="loginBtn" id="loginBtn"><?=  Yii::app()->params->msg['_LOGIN_NOW_'];?> <img style="display:none;float: left; position: absolute; margin-top: -34px; width: 20%;" src="<?php echo Yii::app()->params->base_url;?>/assets/img/loading_dots.gif" id="Loaderaction"></button>
                                                </div>
                                                <div class="row">
                                                    <p class="text-center"><?=  Yii::app()->params->msg['_OR_WITH_LOGIN_'];?></p>
                                                    <div class="col-sm-4 text-center"><a href="<?php
                                                        if (isset($loginUrl)) {
                                                            echo $loginUrl;
                                                        }
                                                        ?>" class="fb"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></div>
                                                    <div class="col-sm-4 text-center"><a href="<?php
                                                        if(isset($twitter_url)){
                                                            echo $twitter_url;
                                                        }
                                                        ?>" class="tw"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a></div>
                                                    <div class="col-sm-4 text-center"><a href="<?php
                                                        if(isset($authUrl)){
                                                            echo $authUrl;
                                                        }
                                                        ?>" class="gg"><i class="fa fa-google" aria-hidden="true"></i> Google</a></div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane <?= $reg_tab_active;?>" id="register">
                                    <div class="row">
                                        <div class="col-md-12" >
                                            <form class="l-r" action="<?php echo Yii::app()->params->base_path; ?>customer/customerRegister" method="post"  id="register_form" name="register_form">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php
                                                            if (isset($user['name']) && $user['name'] != '') {
                                                                $name_arr =  explode(" ", $user['name']);
                                                            }
                                                            if(!empty($name_arr) && $name_arr[0]!=''){
                                                                $cust_first_name = $name_arr[0];
                                                            }
                                                            else{
                                                                $cust_first_name = "";
                                                            }
                                                            if(!empty($name_arr) && $name_arr[1]!=''){
                                                                $cust_last_name = $name_arr[1];
                                                            }
                                                            else{
                                                                $cust_last_name = "";
                                                            }
                                                            ?>
                                                            <label for="first_name" class="control-label"><?=  Yii::app()->params->msg['_FIRST_NAME_'];?></label>
                                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="<?=  Yii::app()->params->msg['_FIRST_NAME_'];?>" value="<?= $cust_first_name;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="last_name" class="control-label"><?=  Yii::app()->params->msg['_LAST_NAME_'];?></label>
                                                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="<?=  Yii::app()->params->msg['_LAST_NAME_'];?>" value="<?= $cust_last_name;?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email" class="control-label"><?=  Yii::app()->params->msg['_EMAIL_'];?></label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="<?=  Yii::app()->params->msg['_EMAIL_'];?>" value="<?php
                                                    if ($user['email'] != '') {
                                                        echo $user['email'];
                                                    }
                                                    ?>">
                                                </div>
                                                <div class="form-group">
                                                    <?php
                                                    if (isset($user['name']) && $user['name'] != '') {
                                                        $user_name =  str_replace(" ", "", $user['name']);
                                                    } else{
                                                        $user_name = "";
                                                    }
                                                    ?>
                                                    <label for="username" class="control-label"><?=  Yii::app()->params->msg['_USERNAME_'];?></label>
                                                    <input type="text" class="form-control" id="username" name="username" placeholder="<?=  Yii::app()->params->msg['_USERNAME_'];?>" value="<?= $user_name;?>">
                                                </div>
                                                <?php
                                                if (empty($user)) {
                                                    ?>
                                                    <div class="form-group">
                                                        <label for="password" class="control-label"><?=  Yii::app()->params->msg['_PASSWORD_'];?></label>
                                                        <input type="password" class="form-control" id="password"
                                                               name="password" placeholder="<?=  Yii::app()->params->msg['_PASSWORD_'];?>">
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="form-group">
                                                    <label for="mobile_number" class="control-label"><?=  Yii::app()->params->msg['_MOBILE_NUMBER_'];?></label>
                                                    <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="<?=  Yii::app()->params->msg['_MOBILE_NUMBER_'];?>">
                                                </div>
                                                <div class="radio radio-info">
                                                    <input id="account_verify_type" value="1" name="account_verify_type" checked="" type="radio">
                                                    <label for="account_verify_type"> <?=  Yii::app()->params->msg['_VERIFY_VAI_EMAIL_'];?> </label>
                                                </div>
                                                <div class="radio radio-info">
                                                    <input id="account_verify_type_1" value="2" name="account_verify_type" type="radio">
                                                    <label for="account_verify_type_1"><?=  Yii::app()->params->msg['_VERIFY_VAI_PHONE_'];?> </label>
                                                </div>
                                                <div class="checkbox-custom-brown form-group">
                                                    <div class="checkbox">
                                                        <input id="terms_condition" name="terms_condition" class="styled terms_condition form-control" type="checkbox" value="1">
                                                        <label for="terms_condition">
                                                            <?=  Yii::app()->params->msg['_I_AGREE_TERMS_AND_CONDITION_'];?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="login-btn">
                                                    <?php
                                                    //print_r($user)
                                                    if(isset($gpluse_id) && $gpluse_id!=''){
                                                       ?><input type="hidden" name="gmail_id" id="gmail_id" value="<?= $gpluse_id;?>">
                                                        <?php
                                                    }
                                                    else if(!empty($twitter_id) && $twitter_id!=''){
                                                        ?>
                                                        <input type="hidden" name="twitter_id" id="twitter_id" value="<?= $twitter_id;?>">
                                                        <?php
                                                    }
                                                    else if(!empty($user) && $user['id']!=''){
                                                        ?>
                                                        <input type="hidden" name="facebook_id" id="facebook_id" value="<?= $user['id'];?>">
                                                        <?php
                                                    }
                                                    ?>

                                                    <button type="submit" class="btn btn-default" id="register_btn"><?=  Yii::app()->params->msg['_REGISTER_'];?> <img style="display:none;float: left; position: absolute; margin-top: -34px; width: 20%;" src="<?php echo Yii::app()->params->base_url;?>/assets/img/loading_dots.gif" id="Loaderaction_reg"></button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Forgot Modal -->
        <div class="modal lr-modal fade" id="myModalForgot" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h5>Forgot Password ?</h5>
                    </div>
                    <div class="modal-body">
                        <div>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="alert alert-danger <?php
                                if(!isset(Yii::app()->session[_SITENAME_.'_customer_reg_err_msg'])){ echo "hide";}
                                ?>" id="forgot_err_msg_div" style="margin-bottom:0px;margin-top:10px;">
                                    <button class="close" data-close="alert"></button>
                                    <span id="forgot_err_msg"><?php
                                        if((isset(Yii::app()->session[_SITENAME_.'_customer_reg_err_msg']) && Yii::app()->session[_SITENAME_.'_customer_reg_err_msg']!='')){ echo Yii::app()->session[_SITENAME_.'_customer_reg_err_msg'];}
                                        ?></span>
                                </div>
                                <div class="alert alert-success hide" id="forgot_success_msg_div" style="margin-bottom:0px;margin-top:10px;">
                                    <button class="close" data-close="alert"></button>
                                    <span id="forgot_success_msg"></span>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                            <form class="l-r" action="" method="post" name="forgot_password_form" id="forgot_password_form">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="control-label"><?=  Yii::app()->params->msg['_EMAIL_'];?></label>
                                                    <input type="text" class="form-control" id="forgot_email" name="forgot_email" placeholder="<?=  Yii::app()->params->msg['_EMAIL_'];?>">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="login-btn">
                                                    <button type="submit" class="btn btn-default" name="loginBtn" id="forgotBtn"><?=  Yii::app()->params->msg['_SUBMIT_'];?> <img style="display:none;float: left; position: absolute; margin-top: -34px; width: 20%;" src="<?php echo Yii::app()->params->base_url;?>/assets/img/loading_dots.gif" id="Loaderaction2"></button>
                                                </div>
                                                <div class="register-link text-center"><?=  Yii::app()->params->msg['_ALREADY_ACCOUNT_'];?> - <a href="javascript:void(0);" onclick="showLoginModel();"><?=  Yii::app()->params->msg['_LOGIN_NOW_'];?></a></div>
                                            </form>
                                        </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reset Password Modal -->
        <div class="modal lr-modal fade" id="myModalResetPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h5><?=  Yii::app()->params->msg['_RESET_PASSWORD_'];?></h5>
                    </div>
                    <div class="modal-body">
                        <div>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="alert alert-danger <?php
                                if(!isset(Yii::app()->session[_SITENAME_.'_customer_reg_err_msg'])){ echo "hide";}
                                ?>" id="reset_password_err_msg_div" style="margin-bottom:0px;margin-top:10px;">
                                    <button class="close" data-close="alert"></button>
                                    <span id="reset_password_err_msg"><?php
                                        if((isset(Yii::app()->session[_SITENAME_.'_customer_reg_err_msg']) && Yii::app()->session[_SITENAME_.'_customer_reg_err_msg']!='')){ echo Yii::app()->session[_SITENAME_.'_customer_reg_err_msg'];}
                                        ?></span>
                                </div>
                                <div class="alert alert-success hide" id="reset_password_success_msg_div" style="margin-bottom:0px;margin-top:10px;">
                                    <button class="close" data-close="alert"></button>
                                    <span id="reset_password_success_msg"></span>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                            <form class="l-r" action="" method="post" name="reset_password_form" id="reset_password_form">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="control-label"><?=  Yii::app()->params->msg['_ENTER_VERIFICATION_CODE_'];?></label>
                                                    <input type="text" class="form-control" id="token" name="token" placeholder="<?=  Yii::app()->params->msg['_VERIFICATION_CODE_'];?>" <?php
                                                    if(isset($_REQUEST['token']) && $_REQUEST['token']!=''){
                                                        $token = $_REQUEST['token'];
                                                    }

                                                    if( isset($token) ) {?>value="<?php echo $token;?>" readonly  <?php }?> >
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="control-label"><?=  Yii::app()->params->msg['_NEW_PASSWORD_'];?></label>
                                                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="<?=  Yii::app()->params->msg['_PASSWORD_'];?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="control-label"><?=  Yii::app()->params->msg['_CONFIRM_PASSWORD_'];?></label>
                                                    <input type="password" class="form-control" id="new_password_confirm" name="new_password_confirm" placeholder="<?=  Yii::app()->params->msg['_CONFIRM_PASSWORD_'];?>">
                                                </div>

                                                <div class="clearfix"></div>

                                                <div class="login-btn">
                                                    <button type="submit" class="btn btn-default"  id="submit_reset_password" name="submit_reset_password" ><?=  Yii::app()->params->msg['_SUBMIT_'];?> <img style="display:none;float: left; position: absolute; margin-top: -34px; width: 20%;" src="<?php echo Yii::app()->params->base_url;?>/assets/img/loading_dots.gif" id="Loaderaction3"></button>
                                                </div>
                                                <div class="register-link text-center"><a href="#" class="active"><?=  Yii::app()->params->msg['_NEED_MORE_HELP_'];?></a></div>
                                                <div class="register-link text-center"><?=  Yii::app()->params->msg['_ALREADY_ACCOUNT_'];?> - <a href="javascript:void(0);" onclick="showLoginModel();"><?=  Yii::app()->params->msg['_LOGIN_NOW_'];?></a></div>

                                            </form>
                                        </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <?php echo $content; ?>


        <!--Footer-->
        <footer>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-4 text-center">
                        <div class="footer-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                        <div class="footer-title"><?=  Yii::app()->params->msg['_ADDRESS_'];?></div>
                        <div class="footer-content">3931 Hinkle Deegan Lake Road<br> Binghamton, NY 13904 </div>
                    </div>
                    <div class="col-lg-4 col-md-4 text-center">
                        <div class="footer-icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                        <div class="footer-title"><?=  Yii::app()->params->msg['_EMAIL_'];?></div>
                        <div class="footer-content">info@travel.com <br> info@tourism.com</div>
                    </div>
                    <div class="col-lg-4 col-md-4 text-center">
                        <div class="footer-icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                        <div class="footer-title"><?=  Yii::app()->params->msg['_PHONE_'];?></div>
                        <div class="footer-content">+1800 246 7813<br> +1800 246 7543 </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12"><div class="footer-divider"></div></div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="social-icons">
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p class="text-center copyright">© <?php echo date("Y"); ?> <span><?=  Yii::app()->params->msg['_TALAQ_'];?></span>.  <?=  Yii::app()->params->msg['_ALL_RESERVED_'];?></p>
                    </div>
                </div>
            </div>
        </footer>


        <script src="<?php echo Yii::app()->params->base_url ; ?>assets/js/jquery.validate.js"></script>

        <script>
            function showForgotPassword(){
                $('#myModalLogin').modal('hide');
                $('#myModalForgot').modal('show').fadeIn('slow');
            }
            function showLoginModel(){
                $('#myModalForgot').modal('hide');
                $('#myModalResetPassword').modal('hide');
                $('#myModalLogin').modal('show').fadeIn('slow');
            }
            function myModalResetPassword(){
                $('#myModalForgot').modal('hide');
                $('#myModalResetPassword').modal('show').fadeIn('slow');
            }

            function customerLogin(){

                $("#Loaderaction").css('display', 'inline-block');
                //alert(keyword);
                $.ajax({
                    type: 'POST',
                    url: '<?php echo Yii::app()->params->base_path; ?>customer/customerLogin',
                    data: $("#login_form").serialize(),
                    cache: false,
                    success: function (data)
                    {
                        if(data == 'true'){
                            window.location = '<?php echo Yii::app()->params->base_path; ?>customer/';
                        }
                        else
                        {
                            $('#login_reg_err_msg').html(data);
                            $('#login_reg_err_msg_div').removeClass('hide')
                            setTimeout(function()
                            {
                                $('#login_reg_err_msg_div').addClass('hide');
                            }, 6000 );
                        }

                        $("#Loaderaction").css('display', 'none');
                    }
                });
            }

            function customerForgotPassword(){

                $("#Loaderaction2").css('display', 'inline-block');
                //alert(keyword);
                $.ajax({
                    type: 'POST',
                    url: '<?php echo Yii::app()->params->base_path; ?>customer/forgotPassword',
                    data: $("#forgot_password_form").serialize(),
                    cache: false,
                    success: function (data)
                    {
                        if(data.status == '1'){
                            $('#forgot_success_msg').html(data.message);
                            $('#forgot_email').val('');

                            $('#forgot_success_msg_div').removeClass('hide');
                            setTimeout(function()
                            {
                                $('#forgot_success_msg_div').addClass('hide');
                            }, 6000 );
                        }
                        else
                        {
                            $('#forgot_err_msg').html(data.message);
                            $('#forgot_err_msg_div').removeClass('hide')
                            setTimeout(function()
                            {
                                $('#forgot_err_msg_div').addClass('hide');
                            }, 6000 );
                        }

                        $("#Loaderaction2").css('display', 'none');
                    }
                });
            }
            function customerResetPassword(){

                $("#Loaderaction3").css('display', 'inline-block');
                $.ajax({
                    type: 'POST',
                    url: '<?php echo Yii::app()->params->base_path; ?>customer/saveResetPassword',
                    data: $("#reset_password_form").serialize(),
                    cache: false,
                    datatype: 'json',
                    success: function (data)
                    {
                        if(data.status == '1'){
                            $('#reset_password_success_msg').html(data.message);
                            $('#token').val('');
                            $('#new_password').val('');
                            $('#new_password_confirm').val('');
                            $('#reset_password_success_msg_div').removeClass('hide');
                            setTimeout(function()
                            {
                                $('#myModalResetPassword').modal('hide');
                                $('#reset_password_success_msg_div').addClass('hide');
                            }, 6000 );
                        }
                        else
                        {
                            $('#reset_password_err_msg').html(data.message);
                            $('#reset_password_err_msg_div').removeClass('hide')
                            setTimeout(function()
                            {
                                $('#reset_password_err_msg_div').addClass('hide');
                            }, 6000 );
                        }

                        $("#Loaderaction3").css('display', 'none');
                    }
                });
            }

            function customerRegister(){

                $("#Loaderaction_reg").css('display', 'inline-block');
                $('#register_btn').attr("disabled","disabled");
                //alert(keyword);
                $.ajax({
                    type: 'POST',
                    url: '<?php echo Yii::app()->params->base_path; ?>customer/customerRegistration',
                    data: $("#register_form").serialize(),
                    cache: false,
                    dataType: 'json',
                    success: function (data)
                    {
                        //alert(data.message);
                        if(data.status == '1'){
                            window.location = '<?php echo Yii::app()->params->base_path; ?>customer/';
                        }
                        else
                        {
                            if(data.data.is_register == 1)
                            {



                                $('#login_reg_success_msg').html(data.message);
                                $('#login_reg_success_msg_div').removeClass('hide');
                                $('#register_form')[0].reset();
                                $('#first_name').val("");
                                $('#last_name').val("");
                                $('#username').val("");
                                $('#email').val("");
                                $('#facebook_id').val("");
                                $('#gmail_id').val("");
                                setTimeout(function()
                                {
                                    $('#login_reg_success_msg_div').addClass('hide');
                                    $('#myModalLogin').modal('hide');
                                    window.location = '<?php echo Yii::app()->params->base_path; ?>customer/';
                                }, 6000 );
                            }
                            else{
                                $('#login_reg_err_msg').html(data.message);
                                $('#login_reg_err_msg_div').removeClass('hide');
                                setTimeout(function()
                                {
                                    $('#login_reg_err_msg_div').addClass('hide');
                                }, 6000 );
                            }

                        }
                        $('#register_btn').removeAttr("disabled");
                        $("#Loaderaction_reg").css('display', 'none');
                    }
                });
            }
            $(document).ready(function(){

                $('#myModalForgot').on('hidden.bs.modal', function (e) {
                    $('body').css('padding-right', '0px');
                });



            <?php
                    if(isset($_REQUEST['token']) && $_REQUEST['token']!=''){
                        ?>
                            myModalResetPassword();
                        <?php
                    }
                    ?>


            <?php
            if(!empty($user)){
                ?>
                   $('#myModalLogin').modal('show');
                <?php
            }
                if(isset(Yii::app()->session[_SITENAME_.'_customer_reg_err_msg']) && Yii::app()->session[_SITENAME_.'_customer_reg_err_msg']!=''){

             ?>
                //alert('okay');
                $('#myModalLogin').modal('show');
                setTimeout(function()
                {
                    $('#login_reg_err_msg_div').addClass('hide');
                        window.location = '<?php echo Yii::app()->params->base_path; ?>customer/';
                    }, 6000 );
                <?php
                unset(Yii::app()->session['user']);
                unset(Yii::app()->session[_SITENAME_.'_customer_reg_err_msg']);
            }?>

                $('#login_form').validate({
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    rules: {
                        username: {
                            required: true,
                        },
                        password:{
                            required: true,
                        }
                    },
                    messages: {
                        username:
                            {
                                //required: "<?=  Yii::app()->params->msg['_REQ_USERNAME_'];?>",
                                required: "<?=  Yii::app()->params->msg['_USERNAME_REQ_'];?>",
                            },
                        password:
                            {
                                required: "<?=  Yii::app()->params->msg['_PASSWORD_REQ_'];?>",
                            }

                    },
                    invalidHandler: function (event, validator) { //display error alert on form submit
                        $('.alert-danger', $('.form-horizontal')).show();
                    },
                    highlight: function (element) { // hightlight error inputs
                        $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
                    },
                    onfocusout: function(element) {
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
                        customerLogin();
                        //$('.form-horizontal').submit();
                        //form.submit(); // form validation success, call ajax form submit
                    }
                });
                $('#forgot_password_form').validate({
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    rules: {
                        forgot_email: {
                            required: true,
                            email: true,
                        },
                    },
                    messages: {
                        forgot_email: {
                                required: "<?=  Yii::app()->params->msg['_EMAIL_REQ_'];?>",
                                email: "<?=  Yii::app()->params->msg['_INVALID_EMAIL_'];?>",
                            },
                    },
                    invalidHandler: function (event, validator) { //display error alert on form submit
                        $('.alert-danger', $('.form-horizontal')).show();
                    },
                    highlight: function (element) { // hightlight error inputs
                        $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
                    },
                    onfocusout: function(element) {
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
                        customerForgotPassword();
                        //$('.form-horizontal').submit();
                        //form.submit(); // form validation success, call ajax form submit
                    }
                });
                $('#reset_password_form').validate({
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    rules: {
                        token: {
                            required: true,
                        },
                        new_password:{
                            required: true,
                            minlength:6,
                        },
                        new_password_confirm:{
                            required:true,
                            equalTo: "#new_password"
                        }
                    },
                    messages: {
                        token:
                            {
                                required: "<?=  Yii::app()->params->msg['_VERIFICATION_CODE_REQ_'];?>",
                            },
                        new_password:
                            {
                                required: "<?= Yii::app()->params->msg['_PASSWORD_REQ_'];?>",
                                minlength:"<?= Yii::app()->params->msg['_PASSWORD_MIN_LENGTH_'];?>",
                            },
                        new_password_confirm:
                            {
                                required: "<?= Yii::app()->params->msg['_PASSWORD_REQ_'];?>",
                                equalTo: "<?= Yii::app()->params->msg['_PROVIDER_CONFIRM_PASSWORD_'];?>"
                            }

                    },
                    invalidHandler: function (event, validator) { //display error alert on form submit
                        $('.alert-danger', $('.form-horizontal')).show();
                    },
                    highlight: function (element) { // hightlight error inputs
                        $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
                    },
                    onfocusout: function(element) {
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
                        customerResetPassword();
                        //$('.form-horizontal').submit();
                        //form.submit(); // form validation success, call ajax form submit
                    }
                });
                $('#register_form').validate({
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    rules: {
                        first_name: {
                            required: true,
                        },
                        last_name: {
                            required: true,
                        },
                        email: {
                            required: true,
                            email: true,
                        },
                        username: {
                            required: true,
                        },
                        password:{
                            required: true,
                        },
                        mobile_number:{
                            required: true,
                            number: true,
                            minlength:10,
                            maxlength:10
                        },
                        terms_condition: {
                            required: true,
                        }
                    },
                    messages: {
                        first_name:{
                            required: "<?=  Yii::app()->params->msg['_FIRST_NAME_REQ_'];?>",
                        },
                        last_name:{
                            required: "<?=  Yii::app()->params->msg['_LAST_NAME_REQ_'];?>",
                        },
                        email:{
                            required: "<?=  Yii::app()->params->msg['_EMAIL_REQ_'];?>",
                        },
                        username:{
                                //required: "<?=  Yii::app()->params->msg['_REQ_USERNAME_'];?>",
                            required: "<?=  Yii::app()->params->msg['_USERNAME_REQ_'];?>",
                        },
                        password:{
                            required: "<?=  Yii::app()->params->msg['_PASSWORD_REQ_'];?>",
                        },
                        mobile_number:{
                            required: "<?=  Yii::app()->params->msg['_MOBILE_NUMBER_REQ_'];?>",
                        },
                        terms_condition:{
                            required: "<?=  Yii::app()->params->msg['_TERMS_AND_CONDITION_REQ_'];?>",
                        }
                    },
                    invalidHandler: function (event, validator) { //display error alert on form submit
                        $('.alert-danger', $('.form-horizontal')).show();
                    },
                    highlight: function (element) { // hightlight error inputs
                        $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
                    },
                    onfocusout: function(element) {
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
                        customerRegister();
                        //$('.form-horizontal').submit();
                        //form.submit(); // form validation success, call ajax form submit
                    }
                });



            });
        </script>
</body>
</html>