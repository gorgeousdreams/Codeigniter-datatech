<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends BaseController {

	function __construct()
	{
		parent::__construct();
	
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		$this->load->model('User_model');
	}
	
	public function index()
	{
		$data = $this->defaultData('profile');
		$userId = $this->session->userdata('user_id');
		$data["profile"] = $this->User_model->get_user_by_user_id($userId);
		$this->load->view('header', $data);
		$this->load->view('profile');
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
	
	public function register_new_password()
	{
		$data = array('usr_password'=>$this->input->post("password"));
	
		$userId = $this->session->userdata('user_id');
		$user_id = $this->User_model->update($userId, $data);
		
		$data = $this->defaultData('profile');
		/*$userId = $this->session->userdata('user_id');
		$data["profile"] = $this->User_model->get_user_by_user_id($userId);
		$this->load->view('header', $data);
		$this->load->view('profile');
		$this->load->view('footer'); */
		
		$data['userId'] = $userId;
		$data['status'] = 'SUCCESS';
		$data['msg'] = 'Change password complete';
		header('Content-Type: application/json');
		echo json_encode( $data );
	}
}
