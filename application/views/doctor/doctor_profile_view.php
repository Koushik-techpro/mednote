<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="an-content-body">
      <div class="an-body-topbar wow fadeIn">
        <div class="an-page-title full-width">
          <h2 class="f-left">Profile</h2>
          <h5 class="f-right time-shedule"><strong>Time left to renew:</strong> <strong>Days:</strong> 20 | <strong>Time:</strong> 23:59 </h5>
          <div class="clearfix"></div>
        </div>
      </div>
      <!-- end AN-BODY-TOPBAR -->

      <form method="post" action="" id="profile_update_form">
      
      <div class="an-doc-block default with-shadow">
        <div class="an-banner-content">

          <?php 
          $error_message = $this->session->flashdata('error_message');
          if($error_message != '')
          {
            ?>
            <div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Opps!</strong>  <?=$error_message?></div>
            <?php
          }
          ?>

          <?php 
          $success_message = $this->session->flashdata('success_message');
          if($success_message != '')
          {
            ?>
            <div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong>  <?=$success_message?></div>
            <?php
          }
          ?>

          

          <div class="an-profile-details">
            <div class="an-profile-section">


              <div class="user-information pad-left">
                

                <div class="col-md-6 pad-left">
                  <div class="info-single">
                    <p class="light required">First Name <span style="color:red" id="first_name_error" class="error_cls"></span></p>
                    <p>
                      <input type="text" class="an-form-control" id="first_name" name="first_name" placeholder="First Name"  value="<?=$doctor_details['first_name']?>">
                    </p>

                  </div>
                </div>
                <div class="col-md-6 pad-right">
                  <div class="info-single">
                    <p class="light required">Last Name <span style="color:red" id="last_name_error" class="error_cls"></span></p>
                    <p>
                      <input type="text" class="an-form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?=$doctor_details['last_name']?>">
                    </p>
                  </div>
                </div>


                <div class="col-md-6 pad-left">
                  <div class="info-single">
                    <p class="light required">Gender</p>
                    <p>
                      <select class="an-form-control" id="gender" name="gender">
                        <option value="male" <?php if($doctor_details['gender'] == 'male') { echo 'selected="selected"'; } ?> >Male</option>
                        <option value="female" <?php if($doctor_details['gender'] == 'female') { echo 'selected="selected"'; } ?> >Female</option>
                      </select>
                    </p>
                  </div>
                </div>
                <div class="col-md-6 pad-right">
                  <div class="info-single">
                    <p class="light required">Years of Experience <span style="color:red" id="experience_year_error" class="error_cls"></span></p>
                    <p>
                      <input type="number" class="an-form-control" placeholder="Total Year" value="<?=$doctor_details['experience_year']?>" name="experience_year" id="experience_year">
                    </p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="info-single">
                  <p class="light">Summary</p>
                  <p>
                    <textarea class="an-form-control" rows="2" cols="2" placeholder="Please enter summary" id="summary" name="summary"><?=$doctor_details['summary']?></textarea>
                  </p>
                </div>

                <?php
                if(count($doctor_degree) > 0)
                {
                    foreach($doctor_degree as $degree)
                    {
                      $div_id = "div_".rand(111, 999999);
                      ?>
                      <div id="<?=$div_id?>">
                        <div class="col-md-6 pad-left">
                        <div class="info-single">
                          <p class="light">Degree </p>
                          <p>
                            <input type="text" class="an-form-control" placeholder="" name="degree[]" value="<?=$degree['degree']?>">
                          </p>
                        </div>
                      </div>
                      <div class="col-md-6 pad-right">
                        <div class="info-single">
                          <p class="light">Year</p>
                          <p>
                            <select class="an-form-control" name="passing_year[]">
                              <option value="">Select year</option>
                              <?php
                              $current_year = date("Y");
                              for($yr = 0; $yr < 60; $yr++)
                              {
                                ?>
                                <option value="<?=$current_year?>" <?php if($current_year == $degree['passing_year']) { ?> selected = "selected" <?php } ?> ><?=$current_year?></option>
                                <?php 
                                $current_year--;
                              }
                              ?>
                            </select>
                            <a href="javascript:void(0)" onclick="remove_degree('<?=$div_id?>')" style="color:red; text-align:right">Delete</a>
                          </p>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                      <?php
                    }
                }
                else
                {
                ?>


                <div class="col-md-6 pad-left">
                  <div class="info-single">
                    <p class="light">Degree </p>
                    <p>
                      <input type="text" class="an-form-control" placeholder="" name="degree[]">
                    </p>
                  </div>
                </div>
                <div class="col-md-6 pad-right">
                  <div class="info-single">
                    <p class="light">Year</p>
                    <p>
                      <select class="an-form-control" id="" name="passing_yaer[]">
                        <option value="">Select year</option>
                        <?php
                        $current_year = date("Y");
                        for($yr = 0; $yr < 60; $yr++)
                        {
                          ?>
                          <option><?=$current_year?></option>
                          <?php 
                          $current_year--;
                        }
                        ?>
                      </select>
                    </p>
                  </div>
                </div>
                <div class="clearfix"></div>

                <?php
                }
                ?>

                <div id="add_degree_div"></div>

                <input type="hidden" name="degree[]" value="">
                <input type="hidden" name="passing_year[]" value="">


                <div class="info-single pull-right">
                  <p class="light"></p>
                  <p>
                    <button class="an-btn an-btn-primary rounded" id="add_degree">Add More</button>
                  </p>
                </div>
              </div>
            </div>
            <!-- and profile section -->
            
            <div class="an-profile-section border-left">
              <div class="user-information"> 
                <!--<h5>Personal information</h5>-->
                <div class="info-single">
                  <p class="light required">Email <span style="color:red" id="email_error" class="error_cls"></span></p>
                  <p>
                    <input type="email" class="an-form-control" placeholder="Enter your email" id="email" name="email" value="<?=$doctor_details['email']?>" >
                  </p>
                </div>
                <div class="info-single">
                  <p class="light required">User Name</p>
                  <p>
                    <input type="text" class="an-form-control" placeholder="">
                  </p>
                </div>
                <div class="info-single">
                  <p class="light">Password <span style="color:red" id="password_error" class="error_cls"></span></p>
                  <p>
                    <input type="password" class="an-form-control" placeholder="Please enter new password" id="password" name="password">
                  </p>
                </div>
                <div class="info-single">
                  <p class="light required">Phone <span style="color:red" id="phone_error" class="error_cls"></span></p>
                  <p>
                    <input type="text" class="an-form-control" placeholder="0-999-999-9999" id="phone" name="phone" maxlength="14" value="<?=$doctor_details['phone']?>">
                  </p>
                </div>
                <div class="info-single pull-right">
                  <p class="light"></p>
                  <p>
                    <button class="an-btn an-btn-primary rounded" id="submit_btn" onclick="return profile_update_submit();">Save</button>
                  </p>
                </div>
              </div>
            </div>
            <!-- end an-profile-section --> 
          </div>
        </div>
      </div>
    </form>
    </div>
    <!-- end .AN-PAGE-CONTENT-BODY --> 
  </div>
  <!-- end .AN-PAGE-CONTENT -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script>

    // email check function start
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
    // email check function end

    $("#add_degree").click(function(){
      var div_id = randomNumberFromRange(111111, 99999999);
      var div_id_is = "'degree_"+div_id+"'";
    $("#add_degree_div").append('<div id="degree_'+div_id+'"><div class="col-md-6 pad-left"><div class="info-single"><p class="light">Degree </p><p> <input type="text" class="an-form-control" placeholder="" name="degree[]"></p> </div></div><div class="col-md-6 pad-right"><div class="info-single"><p class="light">Year</p><p><select class="an-form-control" name="passing_year[]"><option value="">Select year</option><?php
                        $current_year = date("Y");
                        for($yr = 0; $yr < 60; $yr++)
                        {
                          ?><option><?=$current_year?></option><?php 
                          $current_year--;
                        }
                        ?></select><a href="javascript:void(0)" onclick="remove_degree('+div_id_is+')" style="color:red; text-align:right">Remove</a></p></div></div><div class="clearfix"></div></div>');
    return false;
    });


    function randomNumberFromRange(min,max)
    {
        return Math.floor(Math.random()*(max-min+1)+min);
    }


    function remove_degree(id)
    {
        //alert("#"+id);
        $("#"+id).remove();
    }

    function profile_update_submit()
    {


    $(".error_cls").text("");
    

    var first_name = document.getElementById("first_name").value;
    var last_name = document.getElementById("last_name").value;
    var experience_year = document.getElementById("experience_year").value;
    var password = document.getElementById("password").value;
    var email = document.getElementById("email").value;
    var email_check = validateEmail(email);
    var phone = document.getElementById("phone").value;



    if (first_name == '' ) {
      $('#first_name').focus();
      $("#first_name_error").text("Required");
    } 
    else if (last_name == '' ) {
      $('#last_name').focus();
      $("#last_name_error").text("Required");
    }

    else if (experience_year == '' ) {
      $('#experience_year').focus();
      $("#experience_year_error").text("Required");
    }

    else if(email == ''){
      $('#email').focus();
      $("#email_error").text("Required");
    }
    else if(email_check == false){
      $('#email').focus();
      $("#email_error").text("Invalid Email");
    }    
        else if(phone.length < 14){
        $('#phone').focus();
        $("#phone_error").text("Invalid number");
      }  
      else if(password != ''){
        if(password.length < 6){
        $('#password').focus();
        $("#password_error").text("6 character required");
      }
      else
      {
          $( "#profile_update_form" ).submit();     
      }
    }    
    else {
      $( "#profile_update_form" ).submit();      
    }
    return false;
    }



    // phone number format function start
    function normalize(phone) {
    //normalize string and remove all unnecessary characters
    phone = phone.replace(/[^\d]/g, "");

    //check if number length equals to 10
    if (phone.length == 10) {
        //reformat and return phone number
        return phone.replace(/(\d{3})(\d{3})(\d{4})/, "0-$1-$2-$3");
    }

    return null;
  }
  // phone number format function end

  // check phone number function start
  $('#phone').on("input", function() {
      var dInput = this.value;
      if(dInput.length == 10)
      {
        phone = normalize(dInput);
        $('#phone').val(phone);
      }
      
      
  });
  // check phone number function end

 

//var phone = '(123)4567890';
//phone = normalize(phone); //(123) 456-7890
//alert(phone);
  </script>