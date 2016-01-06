<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eventsmap extends BaseController {

	public function index()
	{
		$data = $this->defaultData('events');
		$this->load->view('header', $data);
		$this->load->view('events-map');
		$this->load->view('footer');
	}
	
}
