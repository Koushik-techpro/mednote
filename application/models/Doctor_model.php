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
   


}
