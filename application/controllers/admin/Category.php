<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends AdminController 
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Category_model');

        $this->form_validation->set_error_delimiters('<span class="error">', '</span>');

    }

    function listing()
    {
        $this->authenticate();
    	$data['categories'] = $this->Category_model->get_all_categories();
        
        $data['header'] = true;
        $data['sidebar'] = true;
        $data['footer'] = true;
        $data['_view'] = 'admin/category/listing';
        $this->load->view('admin/layout/baseTemplate',$data);
    }

}