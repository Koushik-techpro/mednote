<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_model extends CI_Model {
 
    function __construct()
    {
        parent::__construct();
    }

    function check_login_status()
    {
           $login_status = "false";
           $user_type = $this->session->userdata('user_type');
           $user_id = $this->session->userdata('user_id');

           if(!empty($user_type))
           {
                if($user_type == 'doctor' && !empty($user_id))
                {
                    $login_status = "true";
                }
                else
                {
                    // do nothing
                }

           }else{
                // do nothing
           } 
           return $login_status;
           

    }

    function get_doctor_details()
    {
        $doctor_details = array();
        $doctor_id = $this->session->userdata('user_id');   
        $this->db->select('id, doctor_id, first_name, last_name, profile_image, email, phone, gender, create_date, last_update_date, experience_year, summary, verified_status');
        $this->db->from('tbl_doctor');
        $this->db->where('doctor_id', $doctor_id);
        $query = $this->db->get();     
        if($query->num_rows() > 0)
        {
            $query_row = $query->row();
            $doctor_details = json_decode(json_encode($query_row), True);
        } 
       return $doctor_details;

    }

    function get_doctor_degree()
    {
        $doctor_degree = array();
        $doctor_id = $this->session->userdata('user_id');   
        $this->db->select('*');
        $this->db->from('tbl_doctor_degree');
        $this->db->where('doctor_id', $doctor_id);
        $query = $this->db->get();     
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $result)
            {
                $doctor_degree[] = array("degree" => $result->degree, "passing_year" => $result->passing_year);
            }
            
        } 
       return $doctor_degree;

    }

    function get_doctor_details_by_id($doctor_id)
    {
        $doctor_details = array();
        $this->db->select('id, doctor_id, first_name, last_name, profile_image, email, gender, create_date, last_update_date, verified_status');
        $this->db->from('tbl_doctor');
        $this->db->where('doctor_id', $doctor_id);
        $query = $this->db->get();     
        if($query->num_rows() > 0)
        {
            $query_row = $query->row();
            $doctor_details = json_decode(json_encode($query_row), True);
        } 
       return $doctor_details;

    }

    

    function doctor_registration($data)
    {
    	// check email before insert 
    	$this->db->select('email');
    	$this->db->from('tbl_doctor');
    	$this->db->where('email', $data['email']);
    	$check_query = $this->db->get();
    	if($check_query->num_rows() > 0)
    	{
    		$return_message = "This email already registred.";
    	}
    	else
    	{
    		$this->db->insert('tbl_doctor',$data);
    		$id = $this->db->insert_id();

    		// update doctor id
    		$update_data = array('doctor_id' => "DOC-".$id);
			$this->db->where('id', $id);
			$this->db->update('tbl_doctor', $update_data);

    		$return_message = "Success";
    	}

    	echo $return_message;
    }

    public function doctor_login($data)
    {
        $return_message = "";
        $email = $data['email'];
        $password = md5($data['password']);
        $remember_me = $data['remember_me'];

        // set remember_me cookie
        if($remember_me == '1')
        {
            $name   = 'doctor_remember_me';
            $value  = '1';
            $expire = time()+1000;
            $path  = '/';
            $secure = TRUE;
            setcookie($name,$value,$expire,$path); 

            $name   = 'doctor_email';
            $value  = $email;
            $expire = time()+1000;
            $path  = '/';
            $secure = TRUE;
            setcookie($name,$value,$expire,$path); 

            $name   = 'doctor_password';
            $value  = $data['password'];
            $expire = time()+1000;
            $path  = '/';
            $secure = TRUE;
            setcookie($name,$value,$expire,$path); 
        }
        else
        {
            delete_cookie("doctor_remember_me");
            delete_cookie("doctor_email");            
            delete_cookie("doctor_password");

        }

        $login_data = array("email" => $email, "password" => $password);

        $this->db->select('*');
        $this->db->from('tbl_doctor');
        $this->db->where($login_data);
        $check_query = $this->db->get();

        if($check_query->num_rows() > 0)
        {
            $doctor_row = $check_query->row();
            if($doctor_row->verified_status == '1')
            {
                // login success.
                $return_message = "Success";
                $this->session->set_userdata('user_type', "doctor");
                $this->session->set_userdata('user_id', $doctor_row->doctor_id);

            }
            else
            {
                // doctor is not verified.
                $return_message = "Your account is not verified by admin.";
            }
        }
        else
        {
            // invalid login.
            $return_message = "Invalid username or password.";
        }

        return $return_message;

    }

    function get_doctor_id_by_email($email)
    {
        $this->db->select('doctor_id');
        $this->db->from('tbl_doctor');
        $this->db->where('email', $email);
        $check_query = $this->db->get();
        if($check_query->num_rows() > 0)
        {
            $doctor_id = $check_query->row()->doctor_id;
        }
        else
        {
            $doctor_id = "0";
        }
        return $doctor_id;
    }

    function update_forget_password_unique_id($doctor_id)
    {
        $unique_id = time()."".rand(1111, 9999);
        $data = array("user_type" => "doctor", "user_id" => $doctor_id, "unique_id" => $unique_id, "is_expired" => '0');
        $this->db->insert('tbl_forget_password',$data);
        return $unique_id;
    }

    function update_profile($data)
    {
        $doctor_id = $this->session->userdata('user_id'); 

        // update profile basic info
        $update_data = array("first_name" => $data['first_name'], "last_name" => $data['last_name'], "gender" => $data['gender'], "experience_year" => $data['experience_year'], "summary" => $data['summary'], "phone" => $data['phone']);

        $this->db->where('doctor_id', $doctor_id);
        $this->db->update('tbl_doctor', $update_data);

        // check email and update
        $this->db->select('doctor_id');
        $this->db->from('tbl_doctor');
        $this->db->where('email', $data['email']);
        $this->db->where('doctor_id !=', $doctor_id);
        $email_check_query = $this->db->get();
        if($email_check_query->num_rows() > 0)
        {
            // email already exist..
            $this->session->set_flashdata('error_message', 'Email already registred with another account. Please use different email.');
        }
        else
        {
            // update email
            $email_update_data = array('email' => $data['email']);
            $this->db->where('doctor_id', $doctor_id);
            $this->db->update('tbl_doctor', $email_update_data);
        }

        // update password
        if($data['password'] != '')
        {
             $password_update_data = array('password' => md5($data['email']));
             $this->db->where('doctor_id', $doctor_id);
             $this->db->update('tbl_doctor', $password_update_data);
              $this->session->set_flashdata('success_message', 'Profile information and password successfully updated.');
        }
        else
        {
            $this->session->set_flashdata('success_message', 'Profile information successfully updated.');
        }

        // update degree
        // delete previous data for this doctor
        $this->db->where('doctor_id', $doctor_id);
        $this->db->delete('tbl_doctor_degree'); 

        $count_degree = count($data['degree']);
        for($dg = 0; $dg < $count_degree; $dg++)
        {
            $degree_is = strtoupper($data['degree'][$dg]);
            $passing_year_is = $data['passing_year'][$dg];
            if($degree_is != '' && $passing_year_is != '')
            {
                $degree_data = array("doctor_id" => $doctor_id, "degree" => $degree_is, "passing_year" => $passing_year_is);    
                $this->db->insert('tbl_doctor_degree',$degree_data);
            }
        }

        return "success";
    }

    // add partner start

    function add_partner($data)
    {
        $doctor_id = $this->session->userdata('user_id'); 
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $partner_type = $data['partner_type'];
        $address = $data['address'];

        // check partner exist or not by phone start

        $this->db->select('partner_id');
        $this->db->from('tbl_partner');
        $this->db->where('phone', $phone);
        $this->db->where('is_deleted', '0');
        $check_query = $this->db->get();
        if($check_query->num_rows() > 0)
        {
            $partner_exist = "true";
            $partner_id = $check_query->row()->partner_id;
        }
        else
        {
            $partner_exist = "false";
        }


        // check partner exist or not by phone end
        if($partner_exist == 'false')
        {
            // partner are not registred

            // check email are exist or not 
            if($email != '')
            {
                $this->db->select('id');
                $this->db->from('tbl_partner');
                $this->db->where('email', $email);
                $this->db->where('is_deleted', '0');
                $partner_email_check_query = $this->db->get();

                if($partner_email_check_query->num_rows() > 0)
                {
                    $this->session->set_flashdata('error_message', 'Opps! '.$email.' already registred with another partner account.');
                    $create_account_now = "false";
                }
                else
                {
                    $create_account_now = "true";   

                }
            }
            else
            {
                $create_account_now = "true";
            }


            
            if($create_account_now == 'true'){

                $add_data = array('name' => $name, 'email' => $email, 'phone' => $phone, 'partner_type' => $partner_type);

                $this->db->insert('tbl_partner',$data);
                if($id = $this->db->insert_id())
                {
                    $partner_id = "P-".$id;
                    $update_data = array('partner_id' => $partner_id);
                    $this->db->where('id', $id);
                    $this->db->update('tbl_partner', $update_data);

                    $assigned_data = array("user_type" => 'partner', "user_id" => $partner_id, "doctor_id" => $doctor_id);
                    $this->db->insert('tbl_doctor_assigned_list',$assigned_data);


                    $this->session->set_flashdata('success_message', 'Partner successfully added.');
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Opps! Something was wrong. Please try again.');
                }
            }


        }
        else
        {
            // partner are already registred

            // check already added or not 
            $this->db->select('id');
            $this->db->from('tbl_doctor_assigned_list');
            $this->db->where('doctor_id', $doctor_id);
            $this->db->where('user_type', 'partner');
            $this->db->where('user_id', $partner_id);
            $partner_check_query = $this->db->get();
            if($partner_check_query->num_rows() > 0)
            {
                $this->session->set_flashdata('error_message', 'Opps! This partner already exist in your partner list.');
            }
            else
            {
                $add_data = array('doctor_id' => $doctor_id, 'user_type' => 'partner', 'user_id' => $partner_id);
                $this->db->insert('tbl_doctor_assigned_list',$add_data);
                if($this->db->insert_id())
                {
                    $this->session->set_flashdata('success_message', 'Partner successfully added.');
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Opps! Something was wrong, please try again.');
                }

            }



        }

        return true;

    }

    // add partner end

    // get partner list start
    function get_partner_list()
    {
        $partner_list = array();
        $doctor_id = $this->session->userdata('user_id'); 
        if($doctor_id != '')
        {
            $this->db->select('*');
            $this->db->from('tbl_doctor_assigned_list');
            $this->db->where('doctor_id', $doctor_id);
            $this->db->where('user_type', 'partner');
            $partner_get_query = $this->db->get();
            if($partner_get_query->num_rows() > 0)
            {
                foreach($partner_get_query->result() as $partner_result)
                {
                    $row_id = $partner_result->id;
                    $partner_id = $partner_result->user_id;
                    // get partner details

                    $partner_details = $this->get_partner_details($partner_id);
                    if(!empty($partner_details))
                    {
                        $partner_list[] = array("id" => $row_id, "partner_id" => $partner_id, "name" => $partner_details['name'], "email" => $partner_details['email'], "phone" => $partner_details['phone'], "partner_type" => $partner_details['partner_type'], "address" => $partner_details['address'], "add_date" => $partner_result->create_date);
                    }


                }
            }
        }
        return $partner_list;
    }
    // get partner list end

    // get partner details start
    function get_partner_details($partner_id = null)
    {
        $partner_details = array();
        $this->db->select('*');
        $this->db->from('tbl_partner');
        $this->db->where('partner_id', $partner_id);
        $this->db->where('is_deleted', '0');
        $partner_details_query = $this->db->get();
        if($partner_details_query->num_rows() > 0)
        {
            $partner_details_is = $partner_details_query->row();
            $partner_details = json_decode(json_encode($partner_details_is), True);

        }

        return $partner_details;
    }
    // get partner details end

    // delete partner start
    function delete_partner($id)
    {
        $doctor_id = $this->session->userdata('user_id'); 
        $this->db->where('id', $id);
        $this->db->where('doctor_id', $doctor_id);
        $this->db->delete('tbl_doctor_assigned_list'); 

        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('success_message', 'Partner successfully deleted');
        }
        else
        {
            $this->session->set_flashdata('success_message', 'Opps! This partner already deleted or not exist.');
        }
        return true;

    }
    // delete partner end

    // check staff username part start
    function check_staff_username($username)
    {
        $return_message = "true";
        $this->db->select('id');
        $this->db->from('tbl_staff');
        $this->db->where('username', $username);
        $this->db->where('is_deleted', '0');
        $check_query = $this->db->get();
        if($check_query->num_rows() > 0)
        {
            $return_message = "false";
        }
        return $return_message;
    }
    // check staff username part end

    function add_staff($data)
    {
        $doctor_id = $this->session->userdata('user_id'); 
        $username = $data['username'];
        $password = $data['password'];
        $name = $data['name'];
        $gender = $data['gender'];
        $degree = $data['degree'];
        $phone = $data['phone'];
        $governorate = $data['governorate'];
        $town = $data['town'];
        $address = $data['address'];
        $email = $data['email'];

        // check before create staff
        $this->db->select('id');
        $this->db->from('tbl_staff');
        $this->db->where('phone', $phone);
        $this->db->where('is_deleted', '0');
        $check_query = $this->db->get();
        if($check_query->num_rows() > 0)
        {
            // staf already exist
            $this->session->set_flashdata('error_message', $phone.' already registred. Please try with different phone number.');
        }
        else
        {
            // allow for register staff
            $add_data = array("username" => $username, "password" => md5($password), "name" => $name, "gender" => $gender, "degree" => $degree, "phone" => $phone, "governorate" => $governorate, "town" => $town, "address" => $address, "email" => $address);
            $this->db->insert('tbl_staff',$add_data);
            if($id = $this->db->insert_id())
            {
                $staff_id = 'S-'.$id;
                $update_data = array("staff_id" => $staff_id);
                $this->db->where('id', $id);
                $this->db->update('tbl_staff', $update_data);

                $assigned_data = array("user_type" => 'staff', "user_id" => $staff_id, "doctor_id" => $doctor_id);
                $this->db->insert('tbl_doctor_assigned_list',$assigned_data);

                $this->session->set_flashdata('success_message', 'Staff successfully added.');
            }
            else
            {
                 $this->session->set_flashdata('error_message', 'Opps! Something was wrong. Please try again.');
            }


        }


        return true;

    } 
   


}
