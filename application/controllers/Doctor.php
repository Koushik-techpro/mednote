<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {

	function __construct() {
    parent::__construct();
    $this->load->model('doctor_model');
	}

	public function index()
	{
		$header_data  = array();
		$left_data = array();
		$page_data = array();
		$footer_data = array();
		$header_data['title'] = "Welcome to your dashboard";
		$left_data['navigation'] = 'dashboard';

		// check login status 
		$login_status = $this->doctor_model->check_login_status(); 
		if($login_status == 'false')
		{
			// redirect to dashboard 
			redirect('doctor-entry');
		}

		// get doctor details
		$doctor_details = $this->doctor_model->get_doctor_details(); 
		$header_data['doctor_details'] = $doctor_details;
		$left_data['doctor_details'] = $doctor_details;


		$this->load->view('doctor/includes/header', $header_data);
		$this->load->view('doctor/includes/left', $left_data);
		$this->load->view('doctor/doctor_dashboard_view', $page_data);
		$this->load->view('doctor/includes/footer', $footer_data);




	}

	
	public function doctor_entry()
	{
		$page_data = array();
		// check user login or not 
		$login_status = $this->doctor_model->check_login_status(); 
		if($login_status == 'true')
		{
			// redirect to dashboard 
			redirect('doctor-dashboard');
		}

		// retrive cookie start
		$page_data['doctor_remember_me'] = $this->input->cookie('doctor_remember_me', TRUE);
		$page_data['doctor_email'] = $this->input->cookie('doctor_email', TRUE);
		$page_data['doctor_password'] = $this->input->cookie('doctor_password', TRUE);
		// retrive cookie end
		
		

		$page_title = "Welcome to MedNote";
		$page_data['title'] = $page_title;
		$this->load->view('doctor/doctor_entry_view', $page_data);
	}

	// ajax function for doctor registration start
	public function ajax_registration_submit()
	{
		$data = array();
		$data['first_name'] = ucwords(strtolower($this->input->post('first_name')));
		$data['last_name'] = ucwords(strtolower($this->input->post('last_name')));
		$data['email'] = strtolower($this->input->post('email'));
		$data['gender'] = $this->input->post('gender');
		$data['password'] = md5($this->input->post('password'));

		echo $this->doctor_model->doctor_registration($data); 

	}
	// ajax function for doctor registration end

	// ajax function for doctor login start
	public function ajax_login_submit()
	{
		$data = array();
		$data['email'] = $this->input->post('email');
		$data['password'] = trim($this->input->post('password'));
		$data['remember_me'] = $this->input->post('remember_me');

		echo $this->doctor_model->doctor_login($data); 

	}
	// ajax function for doctor login end

	// forget password start 

	public function forget_password()
	{
		$page_data = array();
		$page_data['title'] = "Recover your password.";

		// check user login or not 
		$login_status = $this->doctor_model->check_login_status(); 
		if($login_status == 'true')
		{
			// redirect to dashboard 
			redirect('doctor-dashboard');
		}

		$this->load->view('doctor/forget_password_view', $page_data);

	}

	public function ajax_forget_password_submit()
	{
		$return_response = "Invalid Email";
		$this->load->model('common_model');
		$email = $this->input->post('email');

		if($email != '')
		{
			// check doctor email
			$doctor_id = $this->doctor_model->get_doctor_id_by_email($email);

			if($doctor_id != '0')
			{
				$return_response = "Success";
				// update unique id for forget password operation
				$unique_id = $this->doctor_model->update_forget_password_unique_id($doctor_id); 

				// create reset link 
				$reset_link = base_url('reset-password/doctor/'.base64_encode($unique_id));
				$email_subject = "Recover Password - MedNote";
				$email_body = "You have requested for reset your password.<br> Please click on bellow link for reset your password. <a href='".$reset_link."'>Reset Password</a>";

				$this->common_model->email_send($email, $email_subject, $email_body);


			}
		}

		echo $return_response;

	}

	// forget password end

	// doctor profile part start

	public function profile()
	{
		$header_data  = array();
		$left_data = array();
		$page_data = array();
		$footer_data = array();
		$header_data['title'] = "My profile";
		$header_data['navigation'] = 'profile';
		$left_data['navigation'] = 'profile';

		// check login status 
		$login_status = $this->doctor_model->check_login_status(); 
		if($login_status == 'false')
		{
			// redirect to dashboard 
			redirect('doctor-entry');
		}



		if($this->input->post('email'))
		{
			print_r($this->input->post());
			exit;
			
			$form_data = array();
			$form_data['first_name'] = ucwords(strtolower($this->input->post('first_name')));
			$form_data['last_name'] = ucwords(strtolower($this->input->post('last_name')));
			$form_data['gender'] = $this->input->post('gender');
			$form_data['experience_year'] = $this->input->post('experience_year');
			$form_data['summary'] = ucfirst(strtolower($this->input->post('summary')));
			$form_data['degree'] = $this->input->post('degree');
			$form_data['passing_year'] = $this->input->post('passing_year');
			$form_data['email'] = strtolower($this->input->post('email'));
			$form_data['password'] = $this->input->post('password');
			$form_data['phone'] = $this->input->post('phone');

			$update_profile = $this->doctor_model->update_profile($form_data); 

			redirect('doctor-profile');

		}
		


		// get doctor details
		$doctor_details = $this->doctor_model->get_doctor_details(); 
		$header_data['doctor_details'] = $doctor_details;
		$left_data['doctor_details'] = $doctor_details;
		$page_data['doctor_details'] = $doctor_details;
		$page_data['doctor_degree'] = $this->doctor_model->get_doctor_degree(); 




		$this->load->view('doctor/includes/header', $header_data);
		$this->load->view('doctor/includes/left', $left_data);
		$this->load->view('doctor/doctor_profile_view', $page_data);
		$this->load->view('doctor/includes/footer', $footer_data);




	}

	// doctor profile part end



	public function doctor_logout()
	{
		session_destroy();
		redirect('doctor-entry');
	}
}
