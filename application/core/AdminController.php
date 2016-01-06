<?php

class AdminController extends CI_Controller {

	function __construct()
    {
    	parent::__construct();
    }

	function authenticate()
	{
		if(!$this->session->userdata('admin_id'))
		{
			redirect("admin");
			exit;
		}
	}

	function is_logged_in()
    {
        if($this->session->userdata('admin_id'))
           {
                redirect('admin/admin/dashboard');
           }
    }

}