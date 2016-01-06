<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends BaseController {

	public function index()
	{
		$data = $this->defaultData('feedback');
		$this->load->view('header', $data);
		$this->load->view('feedback');
		$this->load->view('footer');
	}
}
