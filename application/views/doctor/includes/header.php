<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
if(!empty($doctor_details))
{
	$doctor_name = $doctor_details['first_name']." ".$doctor_details['last_name'];
	$doctor_email = $doctor_details['email'];
	$doctor_profile_image = $doctor_details['profile_image'];
}
else
{
	$doctor_name = "";
	$doctor_email = "";
	$doctor_profile_image = "assets/img/users/user4.jpeg";
}
if(isset($navigation))
{
  if($navigation == 'profile')
  {
    $profile_page_status = "1";
  }
  else
  {
    $profile_page_status = "0";
  }
}
else
{
  $profile_page_status = "0";
}

?>
<!DOCTYPE html>
<html lang="zxx">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?=$title?></title>
<link rel="icon" href="<?=base_url()?>assets/img/favicon.png" type="image/x-icon"/>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,600,600i,700,800,800i" rel="stylesheet">
<link href="<?=base_url()?>assets/css/animate.min.css" rel="stylesheet">
<link href="<?=base_url()?>assets/css/vendor-styles.css" rel="stylesheet">
<link rel="stylesheet" href="<?=base_url()?>assets/css/styles.css">
<link rel="stylesheet" href="<?=base_url()?>assets/css/custom.css">
<link rel="stylesheet" href="<?=base_url()?>assets/css/font-awesome.min.css">
<link href="<?=base_url()?>assets/css/bootstrap-datatables.min.css" rel="stylesheet">

<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="main-wrapper">
  <div class="an-loader-container"> <img src="<?=base_url($doctor_profile_image)?>" alt=""> </div>
  <header class="an-header wow fadeInDown">
    <div class="an-topbar-left-part">
      <h3 class="an-logo-heading"> <a class="an-logo-link" href="<?=base_url()?>"> <img src="<?=base_url()?>assets/img/logo-orginal.png" alt="" width="180"> </a> </h3>
      <button class="an-btn an-btn-icon toggle-button js-toggle-sidebar"> <i class="icon-list"></i> </button>
    </div>
    <!-- end .AN-TOPBAR-LEFT-PART -->
    
    <div class="an-topbar-right-part"> 
      <!-- end .AN-MESSAGE -->
      
      <div class="an-profile-settings">
        <div class="btn-group an-notifications-dropown  profile">
          <button type="button" class="an-btn an-btn-icon dropdown-toggle"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="an-profile-img" style="background-image: url('<?=base_url()?>assets/img/users/user4.jpeg');"></span> <span class="an-user-name"><?php echo $doctor_name; ?></span> <span class="an-arrow-nav"><i class="icon-arrow-down"></i></span> </button>
          <div class="dropdown-menu">
            <p class="an-info-count">Profile Settings</p>
            <ul class="an-profile-list">
              <li><a href="<?=base_url('doctor-profile')?>" <?php if($profile_page_status == "1") { ?> class="active" <?php } ?>><i class="icon-user"></i>My profile</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="<?=base_url('doctor-logout')?>"><i class="icon-download-left"></i>Log out</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- end .AN-PROFILE-SETTINGS --> 
    </div>
    <!-- end .AN-TOPBAR-RIGHT-PART --> 
  </header>
  <!-- end .AN-HEADER -->
<div class="an-page-content">