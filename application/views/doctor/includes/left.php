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
?>

<div class="an-sidebar-nav js-sidebar-toggle-with-click">
      <div class="profile-con text-center">
        <div class="user-pic"> <img src="<?=base_url($doctor_profile_image)?>" alt=""></div>
        <h2 class="profile-name"><?php echo $doctor_name; ?></h2>
        <p class="email-t"><?php echo $doctor_email; ?></p>
        <a href="#" class="an-btn an-btn-primary-transparent">My Profile</a> </div>
      <!-- end .AN-SIDEBAR-WIDGETS -->
      
      <div class="an-sidebar-nav">
        <ul class="an-main-nav">
          <li class="an-nav-item current active"> <a href="<?=base_url('doctor-dashboard')?>"> <i class="fa fa-bar-chart"></i> <span class="nav-title">Dashboard</span> </a> </li>
          <li class="an-nav-item"> <a class="" href="#"> <i class="ion-calendar"></i> <span class="nav-title">Today's Visits </span> </a> </li>
          <li class="an-nav-item"> <a class="" href="#"> <i class="fa fa-user"></i> <span class="nav-title">Patient Search </span> </a> </li>
          <li class="an-nav-item"> <a class="" href="#"> <i class="ion-podium"></i> <span class="nav-title">Statistics</span> </a> </li>
          <li class="an-nav-item"> <a class="" href="#"> <i class="fa fa-money"></i> <span class="nav-title">Financials </span> </a> </li>
          <li class="an-nav-item"> <a class="" href="#"> <i class="ion-information"></i> <span class="nav-title">Address</span> </a> </li>
          <li class="an-nav-item"> <a class="" href="#"> <i class="ion-android-calendar"></i> <span class="nav-title">Schedule</span> </a> </li>
          <li class="an-nav-item"> <a class="" href="#"> <i class="ion-android-contacts"></i> <span class="nav-title">Partners</span> </a> </li>
          <li class="an-nav-item"> <a class="" href="#"> <i class="ion-briefcase"></i> <span class="nav-title">Staff </span> </a> </li>
        </ul>
        <!-- end .AN-MAIN-NAV --> 
      </div>
      <!-- end .AN-SIDEBAR-NAV --> 
    </div>
    <!-- end .AN-SIDEBAR-NAV -->