<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topic extends AdminController 
{
    function __construct()
    {
        parent::__construct();

        $this->load->model(array('Topic_model' , 'Category_model'));

        $this->form_validation->set_error_delimiters('<span class="error">', '</span>');

    }

    function listing_by_category_id($category_id)
    {
        $this->authenticate();

        if(!is_valid_category($category_id))
        {
            show_error('Invalid category');
            exit;
        }
    	$data['topics'] = $this->Topic_model->get_topics_by_category_id($category_id);
        $data['category'] = $this->Category_model->get_category_name_by_category_id($category_id);
        $data['header'] = true;
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['_view'] = 'admin/topic/listing';
        $this->load->view('admin/layout/baseTemplate',$data);
    }

    function edit($topic_id, $category_id)
    {
        $this->authenticate();
        if(!is_valid_category($category_id))
        {
            show_error('Invalid Category');
            exit;
        }

        if(!is_valid_topic($topic_id))
        {
            show_error('Invalid Topic');
            exit;
        }

        $this->form_validation->set_rules('topic_name','topic_name','required|trim|max_length[255]');
        if($this->form_validation->run())
        {   
            $response = $this->Topic_model->update_topics($this->input->post(),$topic_id); 
    
            if($response["rc"])
            {
                $this->session->set_flashdata("success_msg",$response["msg"]);
                redirect("admin/topic/listing_by_category_id/".$category_id);
            }
            else
            {
                $this->session->set_flashdata("error_msg",$response["msg"]);
                redirect("admin/topic/edit/".$topic_id);
            }
        }
        else
        {
            $topic = $this->Topic_model->get_details_by_topic_id($topic_id);
            $data['topic'] = $topic['data'];

            $data['header'] = true;
            $data['sidebar'] = true;
            $data['footer'] = true;
            $data['_view'] = 'admin/topic/edit';
            $this->load->view('admin/layout/baseTemplate',$data);
        }
    }

    function delete($topic_id ,$category_id)
    {   
        $this->authenticate();
        if(!is_valid_category($category_id))
        {
            show_error('Invalid category');
            exit;
        }
        if(!is_valid_topic($topic_id))
        {
            show_error('Invalid Topic');
            exit;
        }
        $response = $this->Topic_model->delete_topics($topic_id); 
    
        if($response["rc"])
        {
            $this->session->set_flashdata("success_msg",$response["msg"]);
            redirect("admin/topic/listing_by_category_id/".$category_id);
        }
        else
        {
            $this->session->set_flashdata("error_msg",$response["msg"]);
            redirect("admin/topic/listing_by_category_id/".$category_id);
        }
    }

}