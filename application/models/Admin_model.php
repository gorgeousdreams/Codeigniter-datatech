<?php

class Admin_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function login($username,$password)
    {   
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $user = $this->db->get()->row_array();
        
        if(isset($user['id']))
        {
            $user_data = array(
                'admin_id' => $user['id'],
                'username' => 'admin'
            );

            $this->set_user_login_session($user_data);
            $this->get_details_by_id($user_data);
          
            $response['rc'] = TRUE;         
            $response['msg'] = 'Successful login';
        }
        else
        {
            $response['rc'] = FALSE;         
            $response['msg'] = 'Invalid username and password';
        }
        
        return $response;
    }
    function set_user_login_session($user_data)
    {
        foreach($user_data as $key=>$data)
        {
            $this->session->set_userdata($key,$data);
        }    
    }
    function get_details_by_id()
    {      
      $id = $this->user['id'];

        $query = "SELECT *
                FROM admin
                WHERE id = '".$id."'";
        $result = $this->db->query($query)->row_array();
        return $result;

    }
   

}