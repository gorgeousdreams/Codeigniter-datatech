<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends BaseController {
	
	function __construct()
	{
		parent::__construct();
	
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		$this->load->model('Messages_model');
		$this->load->model('User_model');
	}

	public function index()
	{
		$data = $this->defaultData('messages');
		$data["messages"] = $this->Messages_model->get_messages_list(2);
		$this->load->view('header', $data);
		$this->load->view('messages');
		$this->load->view('footer');
	}
	
	public function content()
	{
		$msgId = $_GET["msgId"];
		echo $msgId;
		$data = $this->defaultData('messages');
		$data["message_content"] = $this->Messages_model->get_messages_detail($msgId);
		$this->load->view('header', $data);
		$this->load->view('messages');
		$this->load->view('footer');
	}
	
	public function add_record()
	{
		$recordData = array('msg_messageto'=>$this->input->post("messageto"),
				'msg_title'=>$this->input->post("messagesubject"),
				'msg_content'=>$this->input->post("message"),
				'msg_crd'=>date('Y-m-d H:i:s')
		);
	
		$data = $this->defaultData('messages');
		$data["messages"] = $this->Messages_model->add_record($recordData);
	
		echo $data["messages"];
	}
}
