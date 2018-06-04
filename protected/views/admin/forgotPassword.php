<style>
    .navbar-brand img
    {
        max-height:199px;
    }
    .margin-top-20px
    {
        margin-top:20px;
    }
    .login-page{
        background: #ffffff;
    }
    .logo{
        height: 150px;
    }
    .help-block {
        margin-top: 35px;
        position: absolute;
    }
</style>
<div class="login-box col-xs-12">
    <div class="logo">
        <a href="javascript:void(0);" class=""><img src="<?php Yii::app()->params->base_url; ?>assets/img/logo.png" alt="Talaq" class="" style="width: 150px; height: 150px!important; margin: 0px auto; "/></a>
        <!-- <a href="javascript:void(0);">Admin<b>BSB</b></a>-->

    </div>
    <div class="card">
        <div class="body">
           <form name="form_forgotpass" id="form_forgotpass" method="post" action="<?php echo Yii::app()->params->base_path; ?>admin/forgotPassword" class="form-validation">
                <div class="input-group text-center"> <h4> Forgot Password</h4></div>

               <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                   <div class="form-line">
                       <input type="email" placeholder="Email Id" class="form-control" ng-model="user.email" id="email" name="email" value="<?php if(isset($_SESSION['email']) && $_SESSION['email'] != "0") { echo $_SESSION['email']; } ?>" >
                   </div>
               </div>

                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit" ng-click="login()" ng-disabled='form.$invalid'>RESET MY PASSWORD</button>
                    <a class="btn btn-block btn-lg bg-cyan waves-effect" href="<?php echo Yii::app()->params->base_path; ?>admin/adminLogin">Back</a>
                    <div class="line line-dashed"></div>
           </form>

            <div class="text-center" ng-include="'tpl/blocks/page_footer.html'"  style="margin-top: 10px">
                <p>
                    <small class="text-muted">Talaq &copy; <?php echo date('Y');?></small>
                </p>
            </div>


        </div>
    </div>
</div>


<script>
  $(document).ready(function(){
	
	$('#form_forgotpass').validate({
				errorElement: 'span', //default input error message container
				errorClass: 'help-block', // default input error message class
				focusInvalid: false, // do not focus the last invalid input
				rules: {
					email: {
						required: true,
						email:true,
                        remote: {url: "<?php echo Yii::app()->params->base_path; ?>admin/checkAdminEmailId", type: "post"}
					}
				},
				messages: {
					email:
					{
						required: "Please enter email id",
						email: "Please enter valid email id",
                        remote: "Email id not exists"
					}
				},
				invalidHandler: function (event, validator) { //display error alert on form submit   
					$('.alert-danger', $('.form-horizontal')).show();
				},
				highlight: function (element) { // hightlight error inputs
					$(element).closest('.input-group').addClass('has-error'); // set error class to the control group
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
					
					//$('.form-horizontal').submit();
					form.submit(); // form validation success, call ajax form submit
				}
			});
	

	
	});

setTimeout(function() 
{
	$('.alert-success').fadeOut();
}, 6000 );
   
</script>

