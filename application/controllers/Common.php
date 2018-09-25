<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {

	function __construct() {
	    parent::__construct();
	    $this->load->model('common_model');
	}

	
	public function index()
	{
		$this->load->view('welcome_message');
	}


	// reset password start
	public function reset_password($user_type = null, $unique_code = null)
	{
		$page_data = array();
		$page_data['title'] = "Reset your Password";
		$check_status = "false";
		if($user_type == 'doctor')
		{
			// check unique code
			$check_status = $this->common_model->check_reset_password_unique_code($user_type, $unique_code);
			
		}
		else
		{
			// other user part goes here 
			
		}

		

		if($check_status['status'] == 'true')
		{
			$user_full_name = "";
			$user_email = "";

			if($user_type == 'doctor')
			{
				$this->load->model('doctor_model');
				$doctor_details = $this->doctor_model->get_doctor_details_by_id($check_status['user_id']);
				$user_full_name = $doctor_details['first_name']." ".$doctor_details['last_name'];
				$page_data['user_full_name'] = $user_full_name;
				$user_email = $doctor_details['email'];
				$page_data['user_email'] = $user_email;
				$page_data['user_type'] = $user_type;
				$page_data['user_id'] = $check_status['user_id'];
			}
			else
			{

				// other user part goes here 
			}

			$this->load->view('reset_password_view', $page_data);
		}
		else
		{
			$this->load->view('reset_password_expired_view', $page_data);
		}

	}


	public function ajax_reset_password_submit()
	{
		$return_string = "Failed";
		$user_type = $this->input->post('user_type');
		$user_id = $this->input->post('user_id');
		$password = $this->input->post('password');

		if($user_type == 'doctor')
		{
			$return_string = $this->common_model->update_doctor_password($user_id, $password);
		}
		else
		{
			// other user part goes here 
		}

		echo $return_string;


	}

	// reset password end

	



}
