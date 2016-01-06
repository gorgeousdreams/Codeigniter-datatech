<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stats extends BaseController {

	public function index()
	{
		$data = $this->defaultData('stats');
		$this->load->view('header', $data);
		$this->load->view('stats');
		$this->load->view('footer');
	}
}
