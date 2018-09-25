<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?=$title?></title>
<link rel="icon" href="<?=base_url()?>assets/img/favicon.png" type="image/x-icon"/>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
<link href="<?=base_url()?>assets/css/animate.min.css" rel="stylesheet">
<link href="<?=base_url()?>assets/css/vendor-styles.css" rel="stylesheet">
<link rel="stylesheet" href="<?=base_url()?>assets/css/styles.css">

<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="main-wrapper">
  <div class="an-loader-container"> <img src="<?=base_url()?>assets/img/loader.png" alt=""> </div>
  <div class="an-page-content login-bg">
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <div class="white-logo"><a href="<?=base_url()?>"><img src="<?=base_url()?>assets/img/logo-white.png" alt="Mednote" title="Mednote" width="220"></a></div>
        </div>
        <div class="col-md-7 pad-t10">
          <div class="col-md-9 no-pad"> 
            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane active" id="">
                <div class="an-login-container">
                  <div class="an-single-component with-shadow">
                    <div class="an-component-header2 b-radius">
                      <h1 class="welcome">Recover password</h1>
                      <h5 class="wel-title">Enter email to retrieve your password</h5>
                    </div>
                    <div class="an-component-body b-radius">
                    	<div id="forget_password_msg">

                    	</div>	
                      
                        <div class="form-group m-bottom">
                          <input type="email" class="form-control login-box" placeholder="Email" id="email" name="email">
                          <span style="color:red" id="email_error" class="error_cls"></span>
                        </div>
                        <button class="an-btn an-btn-default fluid signin" onclick="return forget_submit_function();" id="forget_btn">Continue</button>
                        <div class="font-s"> <span class="text-muted">Don't have an account?</span> <a href="<?=base_url('doctor-entry')?>" class="f-w-600 p-l-5 create-one">Create one here </a> </div>
                        <div class="clearfix"></div>
                      
                    </div>
                    <!-- end .AN-COMPONENT-BODY --> 
                  </div>
                  <!-- end .AN-SINGLE-COMPONENT --> 
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <!-- end row --> 
    </div>
    <!-- end an-flex-center-center --> 
  </div>
  <!-- end .AN-PAGE-CONTENT --> 
  
</div>
<!-- end .MAIN-WRAPPER --> 

<script>

// email check function start
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
// email check function end


function forget_submit_function() {
	$(".error_cls").text("");
	var email = document.getElementById("email").value;
	var email_check = validateEmail(email);

	if(email == ''){
		$('#email').focus();
		$("#email_error").text("Email is required.");
	}
	else if(email_check == false){
		$('#email').focus();
		$("#email_error").text("Please enter valid Email");
	}
	else
	{
		var dataString = 'email=' + email;
		// AJAX code to submit form.
		$.ajax({
		type: "POST",
		url: "<?=base_url('Doctor/ajax_forget_password_submit')?>",
		data: dataString,
		cache: false,
		success: function(html) {

			if(html == "Success")
			{
					

				$('#forget_password_msg').html('<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> We sent you an email please check your email for recover password.</div>');
			}
			else
			{
				$('#forget_password_msg').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Opps!</strong> '+ html +'</div>');
			}
		}
		});
	}

}
</script>


<script src="<?=base_url()?>assets/js-plugins/jquery-3.1.1.min.js" type="text/javascript"></script> 
<script src="<?=base_url()?>assets/js-plugins/bootstrap.min.js" type="text/javascript"></script> 
<script src="<?=base_url()?>assets/js-plugins/perfect-scrollbar.jquery.min.js" type="text/javascript"></script> 
<script src="<?=base_url()?>assets/js-plugins/wow.min.js" type="text/javascript"></script> 

<!--  MAIN SCRIPTS START FROM HERE  above scripts from plugin   --> 
<script src="<?=base_url()?>assets/js/scripts.js" type="text/javascript"></script>
</body>
</html>
