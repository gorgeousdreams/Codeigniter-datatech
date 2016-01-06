<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coolstuff extends BaseController {

	public function index()
	{
		$data = $this->defaultData('coolstuff');
		$this->load->view('header', $data);
		$this->load->view('coolstuff');
		$this->load->view('footer');
	}
}
