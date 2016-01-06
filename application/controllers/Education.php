<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Education extends BaseController {
	
	function __construct()
	{
		parent::__construct();
	
		$this->load->model('Education_model');
	}

	public function index()
	{
		$data = $this->defaultData('education');
		$data["education"] = $this->Education_model->get_education_list();
		$this->load->view('header', $data);
		$this->load->view('education');
		$this->load->view('footer');
	}
	
	public function add_record()
	{
		$recordData = array('edu_name'=>$this->input->post("name"), 
				'edu_institution'=>$this->input->post("institution"), 
				'edu_country'=>$this->input->post("country"),
				'edu_city'=>$this->input->post("city"),
				'edu_duration'=>$this->input->post("duration"),
				'edu_degree'=>$this->input->post("degree"),
				'edu_url'=>$this->input->post("url"),
				'edu_qualification'=>$this->input->post("qualification"),
				'edu_est_cost'=>$this->input->post("estcost"),
				'edu_crd'=>date('Y-m-d H:i:s')
		);
		
		$data = $this->defaultData('education');
		$data["education"] = $this->Education_model->add_record($recordData);
		
		echo $data["education"];
	}
	
}
