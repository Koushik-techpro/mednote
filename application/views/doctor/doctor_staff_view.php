<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- MDBootstrap Datatables  -->


<div class="an-content-body">
      <div class="an-body-topbar wow fadeIn">
        <div class="an-page-title">
          <h2>Staff</h2>
        </div>
      </div>
      <!-- end AN-BODY-TOPBAR -->
      <form method="post" action="" id="add_staff_form">
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
                <div class="info-single">
                  <p class="light required">User Name <span style="color:red" id="username_error" class="error_cls"></span><span style="color:green" id="username_success"></span></p>
                  <p>
                    <input type="text" class="an-form-control" placeholder="Enter Username" id="username" name="username" onblur="return check_username();" maxlength="50">
                    <input type="hidden" id="username_status" value="0">  
                  </p>
                </div>
                <div class="info-single">
                  <p class="light required">Password <span style="color:red" id="password_error" class="error_cls"></span></p>
                  <p>
                    <input type="password" class="an-form-control" placeholder="Enter Password" id="password" name="password">
                  </p>
                </div>
                <div class="info-single">
                  <p class="light required">Person Name <span style="color:red" id="name_error" class="error_cls"></span></p>
                  <p>
                    <input type="text" class="an-form-control" placeholder="Enter Name" id="name" name="name">
                  </p>
                </div>
                <div class="col-md-6 pad-left">
                  <div class="info-single">
                    <p class="light required">Sex</p>
                    <p>
                      <select class="an-form-control" id="gender" name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      </select>
                    </p>
                  </div>
                </div>
                <div class="col-md-6 pad-right">
                  <div class="info-single">
                    <p class="light">Degrees</p>
                    <p>
                      <input type="text" class="an-form-control" placeholder="Enter Degree" id="degree" name="degree" >
                    </p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="info-single">
                  <p class="light required">Phone Number <span style="color:red" id="phone_error" class="error_cls"></span></p>
                  <p>
                    <input type="text" class="an-form-control" placeholder="0-999-999-9999" id="phone" name="phone" maxlength="14">
                  </p>
                </div>
              </div>
            </div>
            <!-- and profile section -->
            
            <div class="an-profile-section border-left">
              <div class="user-information"> 
                <!--<h5>Personal information</h5>-->
                
                <div class="col-md-6 pad-left">
                  <div class="info-single">
                    <p class="light">Governorates</p>
                    <p>
                      <select class="an-form-control" id=governorate" name="governorate">
                        <option value="">Select</option>
                        <?php
                        if(count(governorate_list) > 0)
                        {
                          foreach($governorate_list as $governorate)
                          {
                            ?>
                            <option value="<?=$governorate['id']?>"><?=$governorate['name']?></option>
                            <?php
                          }
                        }
                        ?>
                        
                      </select>
                    </p>
                  </div>
                </div>
                <div class="col-md-6 pad-right">
                  <div class="info-single">
                    <p class="light">Town</p>
                    <p>
                      <input type="text" class="an-form-control" placeholder="Enter Town" id="town" name="town">
                    </p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="info-single">
                  <p class="light">Address</p>
                  <p>
                    <textarea class="an-form-control" rows="2" cols="2" placeholder="Enter Address" id="address" name="address"></textarea>
                  </p>
                </div>
                <div class="info-single">
                  <p class="light">Email <span style="color:red" id="email_error" class="error_cls"></span></p>
                  <p>
                    <input type="email" class="an-form-control" placeholder="Enter Email" id="email" name="email">
                  </p>
                </div>
                <div class="info-single pull-right">
                  <p class="light"></p>
                  <p>
                    <button class="an-btn an-btn-primary rounded" onclick="return submit_staff();">Save</button>
                  </p>
                </div>
              </div>
            </div>
            <!-- end an-profile-section --> 
          </div>
        </div>
      </div>
    </form>
      <div class="an-doc-block default with-shadow mob-scrollbar">
        <h4>Staff List</h4>
        <table id="example" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>User Name</th>
              <th>Password</th>
              <th>Person Name</th>
              <th>Sex</th>
              <th>Person Phone</th>
              <th>Governorates</th>
              <th>Town</th>
              <th>Address</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>AntMan</td>
              <td>1231456</td>
              <td>SupperMan</td>
              <td>Male</td>
              <td>0-999-999-9999</td>
              <td>Baghdad</td>
              <td>Karada</td>
              <td>Near Trafic Light</td>
              <td></td>
              <td><button class="an-btn an-btn-icon small muted pad-right10"><i class="fa fa-pencil-square-o"></i></button>
                <button class="an-btn an-btn-icon small muted danger"><i class="fa fa-trash-o"></i></button></td>
            </tr>
            

          </tbody>
        </table>
        <table border="0" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <td class="gutter"><div class="line number1 index0 alt2" style="display: none;">1</div></td>
              <td class="code"><div class="container" style="display: none;">
                  <div class="line number1 index0 alt2" style="display: none;">&nbsp;</div>
                </div></td>
            </tr>
          </tbody>
        </table>
      </div>

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

  // username check start
  function check_username()
  {
    var username = document.getElementById("username").value;
    if(username.length > 5)
    {
        var dataString = 'username=' + username;        
      
        $.ajax({
        type: "POST",
        url: "<?=base_url('doctor/check_staff_username')?>",
        data: dataString,
        cache: false,
        success: function(html) {
        if(html == 'true')
        {
          $('#username_status').val("1");
          $("#username_error").text("");
          $("#username_success").text("(Username available)");

        }
        else
        {
          $('#username_status').val("0");
          $("#username_success").text("");
          $("#username_error").text("(Not available)");
        }
        }
        });
        return false;
    }
    else
    {
          $('#username_status').val("0");
          $("#username_success").text("");
          $("#username_error").text("");
    }
  }
  // username check end 

  // partner submit start
  function submit_staff()
  {
    $(".error_cls").text("");


    var username = document.getElementById("username").value;
    var username_status = document.getElementById("username_status").value;
    var password = document.getElementById("password").value;
    var name = document.getElementById("name").value;
    var phone = document.getElementById("phone").value;
    var email = document.getElementById("email").value;
    var email_check = validateEmail(email);
       

      if (username == '' ) {
        $('#username').focus();
        $("#username_error").text("Required");
      }  
      if (username.length < 6 ) {
        $('#username').focus();
        $("#username_error").text("6 character required");
      }
      else if(username_status == '0' ) {
        $('#username').focus();
        $("#username_error").text("(Not available)");
      }
      else if(password == '' ) {
        $('#password').focus();
        $("#password_error").text("Required");
      }  
      else if(password.length < 6 ) {
        $('#password').focus();
        $("#password_error").text("6 character required");
      }  
       else if(name == ''){
        $('#name').focus();
        $("#name_error").text("Required");
      }   
        else if(phone.length < 14){
        $('#phone').focus();
        $("#phone_error").text("Invalid number");
      }        
      else {
        if(email != '')
        {
            if(email_check == false){
              $('#email').focus();
              $("#email_error").text("Invalid Email");
              return false;
            }
        }

        $( "#add_staff_form" ).submit();      
    }

    return false;
  }
  // partner submit end

  </script>