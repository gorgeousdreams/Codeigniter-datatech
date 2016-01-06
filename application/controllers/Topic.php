<?php 

/**
* 
*/
class Topic extends BaseController
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model("Category_model");
		$this->load->model("Topic_model");
	}

	function index()
	{

	}

	// function topic_url()
	// {
	// 	$topics = $this->db->get("topics")->result_array();
	// 	foreach ($topics as $key => $value) {
	// 		$url = clean($value["topic"]);
	// 		$data["url"] = $url;

	// 		$this->db->where("id",$value["id"]); 
	// 		$this->db->update("topics",$data);
	// 	}
	// }

	function add()
	{
		$this->authentication();
		
		$this->form_validation->set_rules("topic","Topic","trim|required|is_unique[topics.topic]");
		$this->form_validation->set_rules("categories","categories","trim|callback_required_category");

		if($this->form_validation->run() == TRUE)
		{

        	$params["user_id"] = $this->session->userdata("user_id") ? $this->session->userdata("user_id") : 0 ;
        	$params["topic"] = $this->input->post("topic");
        	$params["url"] = clean($params["topic"]);
        	$params["categories"] = $this->input->post("categories");
        	$result = $this->Topic_model->add_topic($params);
        	
        	if($result["rc"])
        	{
        		$this->session->set_flashdata("success",$result["msg"]);
        		redirect("user/dashboard");
        	}
		}
		else
		{
			$data["categories"]	=	$this->Category_model->get_all_categories();
			$data["_view"]	=	"topic/add";
			$data["header"]	=	true;
			$data["footer"]	=	true;
			$this->load->view("layout/baseTemplate", $data);
		}
	}

	function topics_by_category_url()
	{
		$category_id = 0;
		
		if($this->input->get("category_id"))
		{
			$category_id = $this->input->get("category_id");
		}
		if(!is_valid_category($category_id))
        {
            redirect("categories");exit;
        }

    	if($category_id != 0)
    	{
    		$data["category_id"] = $category_id;
			$data["topics"] = $this->Topic_model->get_all_topics($category_id);
    		$data["header"] = true;
    		$data["_view"] = "topic/listing";
    		$data["footer"] = true;
    		$this->load->view("layout/baseTemplate",$data);
    	}
    	else
    	{
    		redirect("categories");
    	}
	}

function required_category()
{
	if(isset($_POST["categories"]) && !empty($_POST["categories"]))
	{
		return TRUE;
	}
	else
	{
		$this->form_validation->set_message("required_category","Select atleast one category");
		return false;
	}
}
	function ajax_get_topics_by_category_id()
	{
		$category_id = $this->input->post("category_id");

		$result = $this->Topic_model->get_topics_by_category_id($category_id);

		if($result["rc"])
		{
			$response["success"] = TRUE;
			$response["data"] = $result["data"];
		}
		else
		{
			$response["success"] = FALSE;
		}

		echo json_encode($response);
	}
}