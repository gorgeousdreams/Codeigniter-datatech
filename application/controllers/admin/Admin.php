  <?php if(!defined('BASEPATH')) exit('No direct script access allowed');

  class Admin extends AdminController
  {
      function __construct() 
      {
        parent::__construct();
        $this->load->model("Admin_model");
        $this->form_validation->set_error_delimiters("<font color='red'>","</font>");
      }

      function login()
      {

          $this->is_logged_in();
           $this->form_validation->set_rules('username','Username','xss_clean|required|trim');
           $this->form_validation->set_rules('password','Password','xss_clean|required|MD5');

           if($this->form_validation->run() == True)
           {	
             $username = $this->input->post('username');
             $password = $this->input->post('password');

             $response = $this->Admin_model->login($username,$password);
             if($response['rc']==true)
             {
                  redirect('admin/dashboard');
             }
             else
             {
                 $this->session->set_flashdata('error_msg', $response['msg']);
                 $this->load->view("admin/login");
             }
             
           }
           else
           {
              $this->load->view("admin/login");
           }
       }

        function dashboard()
        {
            $this->authenticate();
          
            $data['active'] = 'dashboard';
            $data['header'] = true;
            $data['sidebar'] = true;
            $data['footer'] = true;
            $data['_view'] = 'admin/dashboard';
            $this->load->view('admin/layout/baseTemplate',$data);
        }

        function logout()
        {
           $this->session->sess_destroy();
           redirect('admin');
        }

  } 