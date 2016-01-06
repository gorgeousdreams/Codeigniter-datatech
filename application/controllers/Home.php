<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends BaseController {

	function __construct()
	{
		parent::__construct();
	
		$this->load->model('Post_model');
		$this->load->model('Topic_model');
	}
	
	function index()
	{
//		
		$loggedUserId = $this->session->userdata('user_id');
		$data = $this->defaultData('home');
		if(!is_null($loggedUserId) && $loggedUserId != "")
		{
			redirect('dashboard');
		}
		else
		{
			$data["topics"] = $this->Topic_model->get_all_topics(0);
			
			$array["limit"] = 3;
			$data["feeds"] = $this->Post_model->get_featured_posts($array);
			
			$this->load->view('header',$data);
			$this->load->view('home');
			$this->load->view('footer');
		}
	}
}
