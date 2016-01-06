<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends BaseController {

	function __construct()
	{
		parent::__construct();
	
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		$this->load->model('User_model');
	}
	
	public function index()
	{
		$data = $this->defaultData('account');
		$this->load->view('header', $data);
		$this->load->view('login');
		$this->load->view('footer');
	}
	
	public function validate()
	{
		$response = $this->User_model->validate_user_password($this->input->post("email"), $this->input->post("password"));
		
		if($response['status'])
		{
			$data = $response['data'][0];
			$response = $this->User_model->get_user_by_user_id($data['usr_id']);
			
			if($response['status'])
			{
				$data = $response['data'][0];
				$userData = array('user_id'=>$data['usr_id'],
						'fullname'=>$data['usrd_full_name'],
						'email'=>$this->input->post("email")
				);
				
				$this->session->set_userdata($userData);
			}
		}
		
		header('Content-Type: application/json');
    	echo json_encode( $response );
		
		//$user_id = $this->User_model->create_new_user($data);
		//$this->create_response_view($user_id, $this->input->post("full_name"), $this->input->post("email"), 'signup_with_email');
	}
	
}
