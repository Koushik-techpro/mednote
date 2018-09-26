<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {
 
    function __construct()
    {
        parent::__construct();
    }


    function  check_reset_password_unique_code($user_type = null, $unique_code = null)
    {
        $return_data = array("status" => "false");
        $check_status = "false";
        $unique_code = $unique_code;

        if($user_type = 'doctor')
        {

            $this->db->select('user_id');
            $this->db->from('tbl_forget_password');
            $this->db->where(array("user_type" => $user_type, 'unique_id' => $unique_code, "is_expired" => "0"));
            $check_query = $this->db->get();
            if($check_query->num_rows() > 0)
            {
                $check_status = "true";
                $user_id = $check_query->row()->user_id;
            }
        
        }
        else
        {

            // other user part goes here 
        }
        if($check_status == "true")
        {
            $return_data = array("status" => "true", "user_id" => $user_id);
        }
        return $return_data;
    }

    function update_doctor_password($doctor_id, $password)
    {
            $password_encoded = md5($password);
            // update doctor password
            $update_data = array('password' => $password_encoded);
            $this->db->where('doctor_id', $doctor_id);
            $this->db->update('tbl_doctor', $update_data);

            if($this->db->affected_rows() > 0)
            {
                $return_string = "success";

                // update in forget password table
                $update_data = array('is_expired' => '1');
                $this->db->where(array('user_id' => $doctor_id, "user_type" => "doctor"));
                $this->db->update('tbl_forget_password', $update_data);

            }
            else
            {
                $return_string = "false";
            }

            return $return_string;
    }  


    function email_send($send_to, $subject, $body)
    {

        $this->load->library('email');  

        $result = $this->email
            ->from('koushik.techpro@gmail.com')
            ->reply_to('koushik.techpro@gmail.com')    // Optional, an account where a human being reads.
            ->to($send_to)
            ->subject($subject)
            ->message($body)
            ->send();

            return $result;
    }


}
