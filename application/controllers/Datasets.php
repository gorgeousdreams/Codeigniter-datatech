<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datasets extends BaseController {
	
	function __construct()
	{
		parent::__construct();
	
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		$this->load->model('Datasets_model');
		$this->load->model('User_model');
	}

	public function index()
	{
		$data = $this->defaultData('datasets');
		$data["datasets"] = $this->Datasets_model->get_datasets_list();
		$this->load->view('header', $data);
		$this->load->view('datasets');
		$this->load->view('footer');
	}
	
	public function add_record()
	{
		$recordData = array('dts_category'=>$this->input->post("category"),
				'dts_name'=>$this->input->post("name"),
				'dts_description'=>$this->input->post("description"),
				'dts_link'=>$this->input->post("link"),
				'dts_size'=>$this->input->post("size"),
				'dts_crd'=>date('Y-m-d H:i:s')
		);
	
		$data = $this->defaultData('datasets');
		$data["datasets"] = $this->Datasets_model->add_record($recordData);
	
		echo $data["datasets"];
	}
	
}