<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eventscalendar extends BaseController {

	public function index()
	{
		$data = $this->defaultData('events');
		$this->load->view('header', $data);
		$this->load->view('eventscalendar');
		$this->load->view('footer');
	}
}
