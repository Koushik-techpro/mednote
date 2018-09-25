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
                      <h1 class="welcome">Reset password</h1>
                      <h5 class="wel-title">Hello, <?=$user_full_name?> (<?=$user_email?>)</h5>
                      
                    </div>
                    <div class="an-component-body b-radius">

                        <input type="hidden" id="user_type" value="<?=$user_type?>">
                        <input type="hidden" id="user_id" value="<?=$user_id?>">

                        <div id="reset_password_div">
                      
                        <div class="form-group m-bottom">
                          <input type="password" class="form-control login-box" placeholder="New Password" id="password" name="password">
                          <span style="color:red" id="password_error" class="error_cls"></span>
                        </div>

                        <div class="form-group m-bottom">
                          <input type="password" class="form-control login-box" placeholder="Confirm Password" id="confirm_password" name="confirm_password">
                          <span style="color:red" id="confirm_password_error" class="error_cls"></span>
                        </div>


                        <button class="an-btn an-btn-default fluid signin" onclick="return reset_password_submit_function();" id="reset_password_btn">Reset</button>

                      </div>
                        <div class="font-s"> <span class="text-muted">Have an account?</span> <a href="<?=base_url('doctor-entry')?>" class="f-w-600 p-l-5 create-one">Sign in here </a> </div>
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


function reset_password_submit_function() {
  
	$(".error_cls").text("");
	var password = document.getElementById("password").value;
	var confirm_password = document.getElementById("confirm_password").value;
  var user_type = document.getElementById("user_type").value;
  var user_id = document.getElementById("user_id").value;

	if(password == ''){
		$('#password').focus();
		$("#password_error").text("Please enter new password");
	}
  else if(password.length < 6)
  {
    $('#password').focus();
    $("#password_error").text("Please enter minimum 6 character password.");
  }
	else if(confirm_password == ''){
		$('#confirm_password').focus();
		$("#confirm_password_error").text("Please enter confirm password");
	}
  else if(password != confirm_password)
  {
      
      $('#confirm_password').focus();
      $("#confirm_password_error").text("Password and confirm password  must be same.");

  }
	else
	{
    $("#reset_password_btn").prop('disabled', true);
       
		var dataString = 'password=' + password + '&user_id=' + user_id +'&user_type=' + user_type;
		// AJAX code to submit form.
		$.ajax({
		type: "POST",
		url: "<?=base_url('Common/ajax_reset_password_submit')?>",
		data: dataString,
		cache: false,
		success: function(html) {
      $("#reset_password_btn").prop('disabled', false);
      if(html == 'success')
      {
          $('#reset_password_div').html('<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Your password successfully updated.</div>');
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
