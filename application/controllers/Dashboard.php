<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends BaseController {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Post_model');
		$this->load->model('Topic_model');
		$this->load->model('Category_model');
		
	}
	 
	 
	public function index()
	{
		$data = $this->defaultData('home');
		
		$loggedUserId = $this->session->userdata('user_id');
		if(is_null($loggedUserId) || $loggedUserId == "")
		{
			redirect('home');
		}
		else 
		{
			$data["feeds"] = $this->Post_model->get_all_posts();
			$data["topics"] = $this->Topic_model->get_all_topics();
			$data["user_posts"] = $this->Post_model->get_user_posts($loggedUserId);
			$data["categories"] = $this->Category_model->get_all_categories();
			
			$this->load->view('header', $data);
			$this->load->view('dashboard');
			$this->load->view('footer');
		}
	}

	public function get_hint()
	{
		
		// get the q parameter from URL
		//var_dump($_GET);
		$q = $_GET["q"];

		$hint = "";

//		$data["feeds"] = $this->Post_model->get_all_posts();
		//$data["topics"] = $this->Topic_model->get_all_topics();
		if($q){
			$topics = $this->Topic_model->get_all_topics($q);
		// lookup all hints from array if $q is different from "" 
		/*if ($q !== "") {
		    $q = strtolower($q);
		    $len=strlen($q);*/
		  //  var_dump($topics);
			if($topics["rc"]){

				/*foreach ($topics['data'] as $topic)
				    {
				    //	var_dump($topic);
			//		        if (stristr($q, substr($topic['topic_title'], 0, $len))) {
				            if ($hint === "") {
				                $hint = $topic['topic_id'].$topic['topic_img'].$topic['topic_title'];
				            } else {
				               // $hint .=  $topic['topic_title'];
				                $hint .="<br>".$topic['topic_id'].$topic['topic_img'].$topic['topic_title'];;
				            }
			//		        }
				    }	*/
				    $hint = $topics['data'];

			}	

		}
		// Output "no suggestion" if no hint was found or output correct values 
		echo $hint === "" ? json_encode("") : json_encode($hint);
	}
}
