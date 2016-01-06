<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User extends BaseController
{
    function __construct() 
    {
        parent::__construct();
        $this->load->model(array('User_model','Post_model', 'Category_model', 'Topic_model', 'Mahana_model'));

        // $msg = $this->mahana_messaging->get_message($msg_id, $sender_id);
  	}

  	function Login()
  	{  
      if($this->session->userdata("user_id"))
      { 
        redirect("user/dashboard");exit;
      }

  		$this->load->view('user/login');
  	}

    function logout()
    {
      $this->session->sess_destroy();
      redirect("home");
    }

  	function dashboard()
    {
      $null_param = "";
      
      if(isset($_GET["category"]) ||isset($_GET["topic"]) ||isset($_GET["tag"]) ||isset($_GET["extra_param"]))
      {
        $data["posts"] = $this->Post_model->get_all_posts($_GET);
      }
      else
      {
        $data["posts"] = $this->Post_model->get_all_posts($null_param);
      }
      
      $user_id = $this->session->userdata('user_id');

      $data["categories"] = $this->Category_model->get_all_categories();

      if(($_GET) && (isset($_GET["category"]) && $_GET["category"] != ""))
      {
        $data["topics"] = $this->Topic_model->get_topics_by_category_id($_GET["category"]);
        
      }
      $data["tags"] = $this->Post_model->get_all_tags();
      $data["header"] = true;
      $data["_view"]  = 'user/dashboard';
      $data["footer"] = true;

      if($this->session->userdata('user_id'))
      {
        $data['user_details'] = $this->User_model->get_user_by_user_id($user_id);
      }

      $this->load->view('layout/baseTemplate', $data);
    }

    function post_interest()
    {
      if(!$this->input->post("topics"))
      {
        redirect("user/dashboard");exit;
      }

      $array = array(
          "user_id" => $this->session->userdata("user_id"),
          "topics"  => $this->input->post("topics")
        );

      $result = $this->User_model->add_area_of_interest($array);

      if($result['rc'])
      {
        $this->session->set_flashdata("success_i",$result["msg"]);
        redirect("user/dashboard?status=updated");exit;
      }
      else
      {
        $this->session->set_flashdata("error_i",$result["msg"]);
        redirect("user/dashboard?status=error");exit;
      }
    }


     function insert_interest()
     {
      /*if(!$this->input->post("topics"))
      {
        redirect("user/dashboard");exit;
      }*/
      $array = array(
          "user_id" => $this->session->userdata("user_id"),
          "topics"  => $this->input->post("selected_topics")
        );
      $result = $this->User_model->insert_area_of_interest($array);
      if($result)
      {
        redirect('dashboard');
      }

      /*if($result['rc'])
      {
        $this->session->set_flashdata("success_i",$result["msg"]);
        redirect("user/dashboard?status=updated");exit;
      }
      else
      {
        $this->session->set_flashdata("error_i",$result["msg"]);
        redirect("user/dashboard?status=error");exit;
      }*/
    }

    function insert_expertise()
     {
   
      $array = array(
          "user_id" => $this->session->userdata("user_id"),
          "topics"  => $this->input->post("selected_topics")
        );
      var_dump($array);
      if($array["topics"]){          
          $result = $this->User_model->insert_area_of_expertise($array);
      }
      if($result)
      {
        redirect('dashboard');
      }

     }

    function post_expertise()
    {
      $array = array(
          "user_id" => $this->session->userdata("user_id"),
          "topics"  => $this->input->post("topics")
        );
      $result = $this->User_model->add_area_of_expertise($array);

      if($result['rc'])
      {
        $this->session->set_flashdata("success_e",$result["msg"]);
        redirect("user/dashboard?status=updated_expertise");exit;
      }
      else
      {
        $this->session->set_flashdata("error_e",$result["msg"]);
        redirect("user/dashboard?status=error_expertise");exit;
      }
    }

    function send_message()
    {
        $recipient = $this->input->post("user_id");
        $sender_id = $this->session->userdata("user_id");
        // pr($_POST);exit;
        if(!$this->input->post("new_message") && $this->input->post("new_message") == "1")
        {
          if(!is_valid_conversation($recipient,$sender_id))
          {
            $this->session->set_flashdata("error","Invalid Conversation");
            redirect("user/conversations");exit;
          }
        }

        if($recipient == "0" || !is_valid_user($recipient))
        {
          $this->session->set_flashdata("error","Invalid recipient");
          redirect("user/conversations");exit;
        }

        $this->form_validation->set_rules("message","Message","xss_clean|required");
        
        if($this->form_validation->run())
        {

          $message = $this->input->post("message");
          $subject = "";
          $priority = 1;

          $success = $this->Mahana_model->send_new_message($sender_id, $recipient, $subject, $message, $priority);
          
          if($success)
          {
              $this->session->set_flashdata("success","Your message has been sent.");
              redirect("user/conversations?conversation_id=".$recipient);
          }
        }
        else
        {
          $this->session->set_flashdata("error","Message can not be blank.");
          redirect("user/conversations?conversation_id=".$recipient);
        }
    }

    function conversations()
    {
      $this->authentication();

      $id = $this->input->get("conversation_id") ? $this->input->get("conversation_id") : 0;

      if($id != 0)
      {
        if(!is_valid_conversation_id($id) || ($id == $this->session->userdata("user_id")))
        {
          $this->session->set_flashdata("error","Invalid Conversation ID");
          redirect("user/conversations");exit;
        }

        $user_id = $this->session->userdata("user_id");
        $data["user_id"] = $user_id;
        $data["messages"] = $this->User_model->get_conversation_by_id($id, $user_id);
        $data["header"] = TRUE;
        $data["_view"] = "user/conversation";
        $data["footer"] = TRUE;
        $this->load->view("layout/baseTemplate",$data);
      }
      else
      {
        $user_id = $this->session->userdata("user_id");

        $data["conversations"] = $this->User_model->get_all_conversation_by_user_id($user_id);
        $data["header"] = TRUE;
        $data["_view"] = "user/inbox";
        $data["footer"] = TRUE;
        $this->load->view("layout/baseTemplate",$data);
      }
    }

}