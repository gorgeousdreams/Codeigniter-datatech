<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends BaseController {

	public function index()
	{
		$data = $this->defaultData('blog');
		$this->load->view('header', $data);
		$this->load->view('blog');
		$this->load->view('footer');
	}
}
