<script src="<?php echo Yii::app()->params->base_path_language; ?>languages/<?php echo Yii::app()->session['prefferd_language'];?>/global.js" type="text/javascript"></script>
<style>
    .navbar-brand img
    {
        max-height:199px;
    }
    .margin-top-20px
    {
        margin-top:25px;
    }
    .login-page{
        background: #fff;
    }
    .logo{
        height: 150px;
    }
    .help-block {
        margin-top: 34px;
        position: absolute;
        color: red;
    }

</style>
<script>
    $(document).ready(function(){
        $('body').addClass('login-page');
    });
</script>
<!-- End Dialog Popup Js -->
<div class="login-box col-lg-12 col-md-12 col-sm-12 col-xs-12" >
    <div class="logo">
        <a href="javascript:void(0);" class=""><img src="<?php Yii::app()->params->base_url; ?>assets/pages/img/login_logo.png" alt="MyMudra" class="" style="width: 150px; height: 90px !important; margin:0px auto; margin-top:15px;"/></a>
        <!-- <a href="javascript:void(0);">Admin<b>BSB</b></a>-->
    </div>

    <div class="row">
        <div class="text" align="center" >
            <strong>Welcome back to MyMudra.</strong><br/>
            <strong>Your password has been reset. </strong><br/>
            <strong>Please login with your new password.</strong>
        </div>
    </div>
</div>