<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends BaseController 
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Category_model');
    }
    
    /*
     * Listing of categories
     */
    function index()
    {
        $data['categories'] = $this->Category_model->get_all_categories();
        
        $data['header'] = TRUE;
        $data['_view'] = "category/listing";
        $data['footer'] = TRUE;
        $this->load->view("layout/baseTemplate", $data);
    }
    
    /*
     * Adding new categories
     */
    // function add()
    // {   
    //     $this->authentication();
        
    //     $this->load->library('form_validation');         
    //     $this->form_validation->set_rules('title','Title','required|is_unique[categories.title]');        
                
    //     if($this->form_validation->run())
    //     {   
    //     	$user_id = $this->session->userdata("user_id");
    //     	$title = trim($this->input->post("title"));
    //     	$url = clean($title);

    //         $params = array(
				// 'title' => trim($title),
				// 'url' => $url,
				// 'created_by' => $this->session->userdata("user_id"),
				// 'created_on' => time()
    //         );
            
    //         $result = $this->Category_model->add_categories($params);
            
    //         if($result["rc"] = TRUE)
    //     	{
    //     		$this->session->set_flashdata("success",$result["msg"]);
    //         	redirect('categories');            	
    //         }
    //         else
    //         {
    //     		$this->session->set_flashdata("error",$result["msg"]);
    //         	redirect('categories');  
    //         }

    //     }
    //     else
    //     {   
    //     	$data["header"]	=	TRUE;
    //     	$data["_view"]	=	'category/add';
    //     	$data["footer"]	=	TRUE;
    //         $this->load->view('layout/baseTemplate',$data);
    //     }
    // }
    
    /*
     * Editing categories
     */
    function edit($id)
    {   
        $this->load->library('form_validation');         
        $this->form_validation->set_rules('title','Title','required');        
                
        if($this->form_validation->run())
        {   
        	$user_id = $this->session->userdata("user_id");
        	$title = trim($this->input->post("title"));
        	$url = str_replace(" ","-",$title);

            $params = array(
				'title' => trim($title),
				'url' => $url,
				'created_by' => 0, //user_id will go here 
				'created_on' => time()
            );

            $this->Category_model->update_categories($id,$params);            
            redirect('category/edit/'.$id);
        }
        else
        {   
            $data['categories'] = $this->Category_model->get_categories($id);
            $this->load->view('layout/baseTemplate',$data);
        }
    }
    
    /*
     * Deleting categories
     */
    function remove($id)
    {
        $this->Category_model->delete_categories($id);
        redirect('category/index');
    }
}