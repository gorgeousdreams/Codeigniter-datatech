<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends BaseController {

	public function index()
	{
		$data = $this->defaultData('help');
		$this->load->view('header', $data);
		$this->load->view('help');
		$this->load->view('footer');
	}
}
