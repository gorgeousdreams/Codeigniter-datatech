<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserContent extends BaseController {
	
	function __construct()
	{
		parent::__construct();
	
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		$this->load->model('User_model');
	}
	
	public function index()
	{
		$data = $this->defaultData('usercontent');
		$userId = $this->session->userdata('user_id');
		$data["usercontent"] = $this->User_model->get_posts_by_user_id($userId);
		$this->load->view('header', $data);
		$this->load->view('usercontent');
		$this->load->view('footer');
	}
}
