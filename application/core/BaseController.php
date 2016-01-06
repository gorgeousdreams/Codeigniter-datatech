<?php

/**
* 
*/
class BaseController extends CI_Controller
{
	public $user_id;

	function __construct()
	{
		parent::__construct();
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		$this->load->model('User_model');
	}

	function defaultData($viewpage)
	{
		$userId = $this->session->userdata('user_id');
		$loggedUserId = 0;
		if(!is_null($userId) && $userId > 0)
			$loggedUserId = 1;
		
		$fullName = $this->session->userdata('fullname');
		$nickName = $this->session->userdata('nickname');
		if(is_null($nickName) && !is_null($fullName))
		{
			$nameparts = explode(" ", $fullName);
			$nickName = $nameparts[0];
		}
		
		$data = array('current_page' => $viewpage, 'loggedin'=>$loggedUserId, 'fullName'=>$fullName, 'nickName'=>$nickName, 'userId'=>$userId);
		
		return $data;
	}

	function authentication() {

		if(!$this->session->userdata("user_id"))
		{
			redirect("user/login");exit;
		}

		$user_functions = array(
				"post/add",
				"post/share",
				"category/add",
				"topic/add",
				"user/conversations",
			);
		
		$controller = $this->uri->segment(1);
		$function = $this->uri->segment(2);

		if($function != NULL){
			$accetable_functions = $controller.'/'.$function;
		}else{
			$accetable_functions = $controller;
		}


		$id = $this->user_id;

		if(!in_array($accetable_functions, $user_functions)){
			$this->session->set_flashdata('error','You are not authorized');					
			redirect('user/dashboard');
		}

	}

    function set_login_session_data($data)
    {
        foreach($data as $key => $d)
        {
            $this->session->set_userdata($key, $d);
            $this->user_id = $this->session->userdata("user_id");
        }
    }
}
include(dirname(__FILE__)."/AdminController.php");