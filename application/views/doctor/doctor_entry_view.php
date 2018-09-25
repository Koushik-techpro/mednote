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
          <div class="white-logo"><a href="index.html"><img src="<?=base_url()?>assets/img/logo-white.png" alt="Mednote" title="Mednote" width="220"></a></div>
        </div>
        <div class="col-md-7 pad-t10"> 
          <!-- required for floating --> 
          <!-- Nav tabs -->
          <div class="tab-m">
            <ul class="nav nav-tabs tabs-left sideways tab-bg">
              <li class="active"><a href="#login-v" data-toggle="tab"> <span><img src="<?=base_url()?>assets/img/login.png"></span>
                <p>Login</p>
                </a></li>
              <li><a href="#signup-v" data-toggle="tab"><span><img src="<?=base_url()?>assets/img/signup.png"></span>
                <p>Sign up</p>
                </a></li>
            </ul>
          </div>
          <div class="col-xs-9 no-pad"> 
            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane active" id="login-v">
                <div class="an-login-container">
                  <div class="an-single-component with-shadow">
                    <div class="an-component-header2 b-radius">
                      <h1 class="welcome">Welcome !</h1>
                      <h5 class="wel-title">Sign In by entering the information below</h5>
                    </div>
                    <div class="an-component-body b-radius">
                    	<div id="login_message"></div>
                      
                        <div class="form-group m-bottom">
                          <input type="email" class="form-control login-box" placeholder="Email" id="login_email" name="login_email" value="<?=$doctor_email?>">
                          <span style="color:red" id="login_email_error" class="error_cls"></span>
                        </div>
                        <div class="form-group m-bottom">
                          <input type="password" class="form-control login-box" placeholder="Password" id="login_password" name="login_password" value="<?=$doctor_password?>">
                          <span style="color:red" id="login_password_error" class="error_cls"></span>
                        </div>
                        <div class="remembered-section"> <span class="an-custom-checkbox">
                          <input type="checkbox" id="check-1" value="1" <?php if($doctor_remember_me == '1') { ?> checked="checked" <?php } ?> >
                          <label for="check-1">Remember me</label>
                          </span> <a href="<?=base_url('doctor-forget-password')?>">Forgot password?</a> </div>

                        <button class="an-btn an-btn-default fluid signin" onclick="return login_submit_function();" id="login_btn">Sign in</button>
                        <div class="font-s"> <span class="text-muted">Don't have an account?</span> <a href="#signup-v" data-toggle="tab" class="f-w-600 p-l-5 create-one">Create one here </a> </div>
                        <div class="clearfix"></div>
                     
                    </div>
                    <!-- end .AN-COMPONENT-BODY --> 
                  </div>
                  <!-- end .AN-SINGLE-COMPONENT --> 
                </div>
              </div>
              <div class="tab-pane" id="signup-v">
                <div class="an-login-container">
                  <div class="an-single-component with-shadow">
                    <div class="an-component-header2 b-radius">
                      <h1 class="welcome">Create an account</h1>
                      <h5 class="wel-title">Sign up by entering the information below</h5>
                      <div id="success_msg"></div>
                    </div>
                    <div class="an-component-body b-radius">
                      
                        <div class="form-group m-bottom">
                          <input type="text" class="form-control login-box" placeholder="First Name" id="first_name" name="first_name">
                          <span style="color:red" id="first_name_error" class="error_cls"></span>
                        </div>
                        <div class="form-group m-bottom">
                          <input type="text" class="form-control login-box" placeholder="Last Name" id="last_name" name="last_name">
                          <span style="color:red" id="last_name_error" class="error_cls"></span>
                        </div>
                        <div class="form-group m-bottom">
                          <input type="email" class="form-control login-box" placeholder="Email" id="email" name="email">
                          <span style="color:red" id="email_error" class="error_cls"></span>
                        </div>
                        <div class="form-group m-bottom">
                          <input type="password" class="form-control login-box" placeholder="Password" id="password" name="password">
                          <span style="color:red" id="password_error" class="error_cls"></span>
                        </div>
                        <div class="remembered-section login-radio"> <span class="an-custom-radiobox blocked">
                          <input type="radio" name="gender" id="male" value="male" checked="checked">
                          <label for="male"><img src="<?=base_url()?>assets/img/man.png"> Male</label>
                          </span> 
                          <span class="an-custom-radiobox blocked">
                          <input type="radio" name="gender" id="female" value="female">
                          <label for="female"><img src="<?=base_url()?>assets/img/girl.png"> Female</label>
                          </span> </div>    
                        <button class="an-btn an-btn-default fluid signin" onclick="return registration_submit_function();" id="sign_out_btn">Sign Up</button>
                        <div class="font-s"> <span class="text-muted">Already have an account?</span> <a href="#login-v" data-toggle="tab" class="f-w-600 p-l-5 create-one">Sign in here </a> </div>
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



// registration submit function start
function registration_submit_function() {

$(".error_cls").text("");
$('#success_msg').html('');

var first_name = document.getElementById("first_name").value;
var last_name = document.getElementById("last_name").value;
var email = document.getElementById("email").value;
var password = document.getElementById("password").value;
var gender = document.querySelector('input[name="gender"]:checked').value;
var email_check = validateEmail(email);



if (first_name == '' ) {
	$('#first_name').focus();
	$("#first_name_error").text("First name is required.");
} 
else if (last_name == '' ) {
	$('#last_name').focus();
	$("#last_name_error").text("Last name is required.");
}
else if(email == ''){
	$('#email').focus();
	$("#email_error").text("Email is required.");
}
else if(email_check == false){
	$('#email').focus();
	$("#email_error").text("Please enter valid Email");
}
else if(password == ''){
	$('#password').focus();
	$("#password_error").text("Please enter password");
}
else if(password.length < 6){
	$('#password').focus();
	$("#password_error").text("Please enter password minimum 6 character");
}
else {

	$("#sign_out_btn").prop('disabled', true);


var dataString = 'first_name=' + first_name + '&last_name=' + last_name + '&email=' + email + '&password=' + password + '&gender=' + gender;

// AJAX code to submit form.
$.ajax({
type: "POST",
url: "<?=base_url('Doctor/ajax_registration_submit')?>",
data: dataString,
cache: false,
success: function(html) {
if(html == 'Success')
{
	$('.login-box').val('');
	$("#sign_out_btn").prop('disabled', false);
	$('#success_msg').html('<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong>You have successfully registred as doctor. Please wait for admin approval.</div>');
	
}
else
{

	$('#email').focus();
	$("#email_error").text("This email already registred with us.");
	$("#sign_out_btn").prop('disabled', false);
}
}
});
}
return false;
}
// registration submit function end

// login submit function start

function login_submit_function() {

$(".error_cls").text("");
$('#login_message').html('');

var login_email = document.getElementById("login_email").value;
var login_password = document.getElementById("login_password").value;
var email_check = validateEmail(login_email);

// check Remember me
if($("#check-1").prop('checked') == true){
    var remember_me = '1';
}
else
{
    var remember_me = '0';
}



if(login_email == ''){
	$('#login_email').focus();
	$("#login_email_error").text("Please enter your Email.");
}
else if(email_check == false){
	$('#login_email').focus();
	$("#login_email_error").text("Please enter valid Email.");
}
else if(login_password == ''){
	$('#login_password').focus();
	$("#login_password_error").text("Please enter password.");
}
else if(login_password.length < 6){
	$('#login_password').focus();
	$("#login_password_error").text("Please enter password minimum 6 character");
}
else {

	$("#login_btn").prop('disabled', true);


var dataString = 'email=' + login_email + '&password=' + login_password + '&remember_me=' + remember_me;

// AJAX code to submit form.
$.ajax({
type: "POST",
url: "<?=base_url('Doctor/ajax_login_submit')?>",
data: dataString,
cache: false,
success: function(html) {
if(html == 'Success')
{
	$('.login-box').val('');
	$("#login_btn").prop('disabled', false);
	window.location = "<?=base_url('doctor-dashboard')?>";
	
	
}
else
{
	
	$("#login_btn").prop('disabled', false);
	$('#login_message').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Opps!</strong> '+ html +'</div>');
}
}
});
}
return false;
}

// login submit function end
</script>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="<?=base_url()?>assets/js-plugins/jquery-3.1.1.min.js" type="text/javascript"></script> 
<script src="<?=base_url()?>assets/js-plugins/bootstrap.min.js" type="text/javascript"></script> 
<script src="<?=base_url()?>assets/js-plugins/perfect-scrollbar.jquery.min.js" type="text/javascript"></script> 
<script src="<?=base_url()?>assets/js-plugins/wow.min.js" type="text/javascript"></script> 

<!--  MAIN SCRIPTS START FROM HERE  above scripts from plugin   --> 
<script src="<?=base_url()?>assets/js/scripts.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/js/notify.min.js" type="text/javascript"></script>
</body>
</html>
