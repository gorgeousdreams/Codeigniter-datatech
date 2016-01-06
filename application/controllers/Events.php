<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends BaseController {

	function __construct()
	{
		parent::__construct();
	
		$this->load->model('Events_model');
	}
	
	public function index()
	{
		$data = $this->defaultData('events');
		$data["events"] = $this->Events_model->get_events_list();
		$this->load->view('header', $data);
		$this->load->view('events');
		$this->load->view('footer');
	}
	
	public function add_record()
	{
		$recordData = array('post_title'=>$this->input->post("eventname"),
				'post_crd'=>$this->input->post("eventdate"),
				'post_location'=>$this->input->post("eventlocation"),
				'post_content'=>$this->input->post("eventdesc"),
				'post_type_fk'=>3
		);
	
		$data = $this->defaultData('events');
		$data["events"] = $this->Events_model->add_record($recordData);
	
		echo $data["events"];
	}
}
