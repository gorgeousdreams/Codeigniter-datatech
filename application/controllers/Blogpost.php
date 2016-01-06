<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogpost extends BaseController {

	public function index()
	{
		$data = $this->defaultData('blog');
		$this->load->view('header', $data);
		$this->load->view('blogpost');
		$this->load->view('footer');
	}
}
