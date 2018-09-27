<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- MDBootstrap Datatables  -->

<div class="an-content-body">
      <div class="an-body-topbar wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
        <div class="an-page-title">
          <h2>Partners</h2>
        </div>
      </div>
      <!-- end AN-BODY-TOPBAR -->
      <form method="post" action="" id="add_partner_form">
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

            <div class="an-profile-section full-w">
              <div class="row">
                <div class="col-md-6">
                  <div class="info-single">
                    <p class="light required">Name <span style="color:red" id="name_error" class="error_cls"></span></p>
                    <p>
                      <input type="text" class="an-form-control" placeholder="Enter Name" id="name" name="name" >
                    </p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="info-single">
                    <p class="light">Email <span style="color:red" id="email_error" class="error_cls"></span></p>
                    <p>
                      <input type="email" class="an-form-control" placeholder="Enter email" id="email" name="email">
                    </p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="info-single">
                    <p class="light required">Phone Number <span style="color:red" id="phone_error" class="error_cls"></span></p>
                    <p>
                      <input type="text" class="an-form-control" placeholder="0-999-999-9999" id="phone" name="phone" maxlength="14">
                    </p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="info-single">
                    <p class="light required">Partner Type <span style="color:red" id="partner_type_error" class="error_cls"></span></p>
                    <p>
                      <select class="an-form-control" id="partner_type" name="partner_type">
                        <option value="">Select partner type</option>
                        <option value="radiology">Radiology</option>
                        <option value="pharmacy">Pharmacy</option>
                        <option value="laboratory">Laboratory</option>
                      </select>
                    </p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="info-single">
                    <p class="light">Address</p>
                    <p>
                      <textarea class="an-form-control" rows="2" cols="2" placeholder="" id="address" name="address" placeholder="Enter address"></textarea>
                    </p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="info-single pull-right">
                    <p class="light"></p>
                    <p>
                      <button class="an-btn an-btn-primary rounded" onclick="return submit_partner();">Add</button>
                    </p>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
            <!-- and profile section --> 
            
            <!-- end an-profile-section --> 
          </div>

        </div>
        <div class="an-doc-block default with-shadow mob-scrollbar">
        <h4>Partner List</h4>
        <table id="example" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Name</th>
              <th>Partner Type</th>
              <th>Phone</th>
              <th>Email</th>              
              <th>Address</th>
              <th>Added Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if(count($partner_list) > 0)
            {
              foreach($partner_list as $partners)
              {
            ?>

            <tr>
              <td><?=$partners['name']?></td>
              <td><center><?=ucfirst($partners['partner_type'])?></center></td>
              <td><center><?=$partners['phone']?></center></td>
              <td>
                <?php
                if($partners['email'] == '')
                {
                  echo "<center>Undefined</center>";
                }
                else
                {
                  echo "<center>".$partners['email']."</center>";
                }
                ?>
              </td>
              <td><?=$partners['address']?></td>
              <td><?php echo date("d/m/Y h:i A", strtotime($partners['add_date'])); ?></td>
              <td>
                <center>
                  <a href="<?=base_url('doctor-delete-partner/'.$partners['id'])?>" onclick="return confirm('Are you sure you want to delete this partner?'); return false;">
                  <i class="fa fa-trash-o small muted danger"></i></a></center></td>
            </tr>

            <?php
               }
            }
            ?>
            

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
      </div>
    </form>
    </div>
    
    
    

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

  // partner submit start
  function submit_partner()
  {
    $(".error_cls").text("");


    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var email_check = validateEmail(email);
    var phone = document.getElementById("phone").value;
    var partner_type = document.getElementById("partner_type").value;    
    

      if (name == '' ) {
        $('#name').focus();
        $("#name_error").text("Required");
      }     
       else if(phone == ''){
        $('#phone').focus();
        $("#phone_error").text("Required");
      }   
        else if(phone.length < 14){
        $('#phone').focus();
        $("#phone_error").text("Invalid number");
      }   
      else if(partner_type == ''){
        $('#partner_type').focus();
        $("#partner_type_error").text("Required");
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

        $( "#add_partner_form" ).submit();      
    }

    return false;
  }
  // partner submit end

  </script>