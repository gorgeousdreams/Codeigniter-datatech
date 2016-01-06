<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobboard extends BaseController {

	function __construct()
	{
		parent::__construct();
	
		$this->load->model('Jobs_model');
	}
	
	public function index()
	{
		$data = $this->defaultData('jobboard');
		
		$data["jobs"] = $this->Jobs_model->get_jobs_list();
		
		$this->load->view('header', $data);
		$this->load->view('jobboard');
		$this->load->view('footer');
	}
	
	public function add_record()
	{
		$joblocation = $this->input->post("country");
		if($this->input->post("state")!= null && $this->input->post("country") != "")
			$joblocation = $joblocation.', '.$this->input->post("state");
		
		$recordData = array('job_title'=>$this->input->post("title"),
				'job_summary'=>$this->input->post("description"),
				'job_url'=>$this->input->post("url"),
				'job_location'=>$joblocation,
				'job_crd'=>date('Y-m-d H:i:s')
		);
	
		$data = $this->defaultData('jobs');
		$data["jobs"] = $this->Jobs_model->add_record($recordData);
	
		echo $data["jobs"];
	}
}
