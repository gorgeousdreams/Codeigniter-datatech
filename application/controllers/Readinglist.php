<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Readinglist extends BaseController {

	public function index()
	{
		$data = $this->defaultData('readinglist');
		$this->load->view('header', $data);
		$this->load->view('readinglist');
		$this->load->view('footer');
	}
}
