<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends BaseController {

	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data = $this->defaultData('account');
		$this->load->view('header', $data);
		$this->load->view('signup');
		$this->load->view('footer');
	}
	
	public function signup_with_email()
	{
		//$data = array('current_page' => 'account', 'loggedin'=>'0', 'status'=>'',);
		$data = $this->defaultData('account');

		$data['status'] = '';
		
		$this->load->view('header', $data);
		$this->load->view('signup_with_email');
		$this->load->view('footer');
	}
	
	public function register_email()
	{
		$data = array('fullname'=>$this->input->post("full_name"), 
				'email'=>$this->input->post("email"), 
				'password'=>$this->input->post("password"),
				'type'=>0
		);
		
		$user_id = $this->User_model->create_new_user($data);
		$this->create_response_view($user_id, $this->input->post("full_name"), $this->input->post("email"), 'signup_with_email');
	}
	
	public function register_with_fb()
	{
		$data = array('fullname'=>$this->input->post("full_name"), 
				'email'=>$this->input->post("email"), 
				'password'=>$this->input->post("password"),
				'type'=>1
		);
		
		$user_id = $this->User_model->create_new_user($data);
		$this->create_response_view($user_id, $this->input->post("full_name"), $this->input->post("email"), 'signup');
	}
	
	private function create_response_view($user_id, $fullName, $email, $failedView)
	{
		if($user_id != null)
		{
			$userData = array('user_id'=>$user_id,
					'fullname'=>$this->input->post("full_name"),
					'email'=>$this->input->post("email"),
					'first_signup'=>2
			);
				
			$this->session->set_userdata($userData);

				
			$data = array('current_page' => 'account',
					'loggedin'=>'1',
					'fullname'=>$this->input->post("full_name")
			);
				
			redirect('dashboard');
			/* $this->load->view('header', $data);
			$this->load->view('dashboard');
			$this->load->view('footer'); */
		}
		else {
				
			$data = array('current_page' => 'account',
					'loggedin'=>'0',
					'status'=>'FAILED',
					'errMsg'=>'Account already exist with this email.',
					'fullname'=>$this->input->post("full_name"),
					'email'=>$this->input->post("email")
			);
				
			$this->load->view('header', $data);
			$this->load->view($failedView);
			$this->load->view('footer');
		}
	}
	
}
