<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Glossary extends BaseController {

	public function index()
	{
		$data = $this->defaultData('glossary');
		$this->load->view('header', $data);
		$this->load->view('glossary');
		$this->load->view('footer');
	}
}
