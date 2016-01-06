<?php if(!defined('BASEPATH')) exit("No direct access allowed");

class User_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function create_new_user($data)
	{
		$fullname = $data["fullname"];
		$email = $data["email"];
		$password = $data["password"];
		
		$sql = 'SELECT usr_id
				FROM users
				WHERE usr_email = "'.$email.'"';
		$user =  $this->db->query($sql)->result_array();
		
		if($user)
		{
			return null;
		}
		else 
		{
			$date = date('Y-m-d H:i:s');
			$array = array();
			$array["usr_email"] = $email;
			$array["usr_password"] = $password;
			$array["usr_crd"] = $date;
			
			$user = $this->db->insert("users",$array);
			$userId = $this->db->insert_id();
			
			if($user)
			{
				$date = date('Y-m-d H:i:s');
				$array = array();
				$array["usrd_full_name"] = $fullname;
				$array["usrd_usr_fk"] = $userId;
				$array["usrd_crd"] = $date;
					
				$user_detail = $this->db->insert("user_details",$array);
			}
			
			return $userId;
		}
	}
	
	function validate_user_password($email, $password)
	{
		$sql = 'SELECT usr_id
				FROM users
				WHERE usr_email = "'.$email.'" 
				AND usr_password = "'.$password.'"'
				;
		$user =  $this->db->query($sql)->result_array();
		
		if($user)
		{
			$response = array(
					'status' => TRUE,
					'msg' => 'Valid user',
					'data' => $user
			);
		}
		else
		{
			$response = array(
					'status' => FALSE,
					'msg' => 'Invalid user name or password.',
					'data' => ''
			);
		}
		
		return $response;
	}
	
	function check_email($email)
    {
        $this->db->select('*');
        $this->db->From('users');
        $this->db->where('email', $email);
        $user = $this->db->get()->row_array();

        if($user)
        {
            $response = array(
                'rc' => TRUE,
                'msg' => 'User Detail listing',
                'data' => $user
            );
        }
        else
        {
            $response = array(
                'rc' => FALSE,
                'msg' => 'No detail for the user',
                'data' => ''
            );
        }
        return $response;
    }

    function add_user_from_social_login($user_data)
    {
    	$date = date('Y-m-d H:i:s');
	    	$array = array(
	    	'usr_email'=> $user_data['email'],
	    	'usr_password'=> $user_data['password'],
	    	'usr_crd'=> $date
    	);

		$this->db->insert('users', $array);
		$user_id = $this->db->insert_id();
			
		if($user)
		{
			$date = date('Y-m-d H:i:s');
			$array = array(
				'usrd_full_name'=>$user_data['name'],
				'usrd_usr_fk'=>$user_id,
				'usrd_crd'=>$date
			);
				
			$user_detail = $this->db->insert("user_details",$array);
		}
		
		$data['user_id'] = $user_id;

        $response['rc'] = TRUE;
		$response['data'] = $user_id;
        
		return $response;
    }

    function get_user_by_user_id($user_id)
	{
		$sql = 'SELECT user_details.*, usr_id, usr_email 
				FROM user_details
				JOIN users on usr_id = usrd_usr_fk
				WHERE usrd_usr_fk = "'.$user_id.'"';
		
		$user =  $this->db->query($sql)->result_array();
        
        if($user)
        {
            $response = array(
                'status' => TRUE,
                'msg' => 'User Detail listing',
                'data' => $user
            );
        }
        else
        {
            $response = array(
                'status' => FALSE,
                'msg' => 'No detail for the user',
                'data' => ''
            );
        }
        return $response;
	}
	
	function get_posts_by_user_id($user_id)
	{
// 		$sql = 'SELECT user_details.*, usr_id, usr_email
// 				FROM user_details
// 				JOIN users on usr_id = usrd_usr_fk
// 				WHERE usrd_usr_fk = "'.$user_id.'"';
		
		$sql = 'SELECT posts.*, usr_id
				FROM posts
				JOIN users on usr_id = post_usr_fk
				WHERE post_usr_fk = "'.$user_id.'"
				ORDER BY post_id';
	
		$user =  $this->db->query($sql)->result_array();
	
		if($user)
		{
			$response = array(
					'status' => TRUE,
					'msg' => 'User Detail listing',
					'data' => $user
			);
		}
		else
		{
			$response = array(
					'status' => FALSE,
					'msg' => 'No detail for the user',
					'data' => ''
			);
		}
		return $response;
	}

    function insert_area_of_interest($array)
    {
        $i = 0;
        foreach($array['topics'] as $key => $selected_topics)
        {

            
                $data[$i]["category_id"] = 1;
                $data[$i]["user_id"] = $array["user_id"];
                $data[$i]["topic_id"] = $selected_topics;
                $i++;
           
        }
        $result = $this->db->insert_batch("user_has_interests",$data);
       /* if ($result) {
           redirect('dashboard');
        }*/
        return $result;
    }

    function insert_area_of_expertise($array)
    {
        $i = 0;
       // var_dump($array);
        foreach($array['topics'] as $key => $selected_topics)
        {

            
                $data[$i]["category_id"] = 1;
                $data[$i]["user_id"] = $array["user_id"];
                $data[$i]["topic_id"] = $selected_topics;
                $i++;
           
        }

        $result = $this->db->insert_batch("user_has_expertise",$data);
        return $result;

    }
    function add_area_of_interest($array)
    {
        $this->db->where("user_id", $array["user_id"]);
        $check_interest = $this->db->delete("user_has_interests");

        $i = 0;
        foreach($array['topics'] as $key => $topics)
        {

            foreach($topics as $topic)
            {

                $data[$i]["category_id"] = $key;
                $data[$i]["user_id"] = $array["user_id"];
                $data[$i]["topic_id"] = $topic;
                $i++;
            }
        }
        
        $result = $this->db->insert_batch("user_has_interests",$data);
        
        if($result)
        {
            $response["rc"] = TRUE;
            $response["msg"] = "Your interest has been updated.";
        }
        else
        {
            $response["rc"] = TRUE;
            $response["msg"] = "Error while updating interest, please try again later.";
        }

        return $response;
    }

    function add_area_of_expertise($array)
    {
        $this->db->where("user_id", $array["user_id"]);
        $check_interest = $this->db->delete("user_has_expertise");

        $i = 0;
        if(empty($array["topics"]))
        {
            $this->db->where("user_id",$array["user_id"]);
            $result = $this->db->delete("user_has_expertise");
        }
        else
        {
            foreach($array['topics'] as $key => $topics)
            {

                foreach($topics as $topic)
                {

                    $data[$i]["category_id"] = $key;
                    $data[$i]["user_id"] = $array["user_id"];
                    $data[$i]["topic_id"] = $topic;
                    $i++;
                }

            }
            $result = $this->db->insert_batch("user_has_expertise",$data);
        }

        
        if($result)
        {
            $response["rc"] = TRUE;
            $response["msg"] = "Your expertise has been updated.";
        }
        else
        {
            $response["rc"] = TRUE;
            $response["msg"] = "Error while updating expertise, please try again later.";
        }

        return $response;
    }

    function update_gravatar_url($user_data, $user_id)
    {
        $this->db->where('id',$user_id);
        $response = $this->db->update('users',$user_data);
        return $response;
    }

    function update($user_id, $user_data)
    {
        if($this->db->update('users', $user_data, array("usr_id" => $user_id)))
        {
            $response["rc"] = TRUE;
            $response["msg"] = "User updated!";
        }
        else
        {
            $response["rc"] = TRUE;
            $response["msg"] = "Error while updating user, please try again later.";
        }

        return $response;
    }

    function save_user_picture($user_id, $picture_filepath, $filename = '')
    {
       
        $image = 'profile_image';
        $folder = 'profile_images';

        $dir = FCPATH . "uploads/profile_images/" . $user_id . "/";

        if(!is_dir($dir))
            @mkdir($dir, 0777,true);

        $offset = strpos($filename, '.');
        $filename = substr_replace($filename, time(), $offset).".jpg";
        $image_200_200 = substr_replace($filename, time()."200_200", $offset).".jpg";

        if(file_exists($picture_filepath))
            $upload = rename( $picture_filepath, $dir.$filename );
        else
            $upload = move_uploaded_file( $picture_filepath, $dir.$filename );

        if( $upload )
        {
            $user_details = $this->db->get_where('users',array('id' => $user_id))->row_array();
            if( $user_details[$image] != "" )
            {
                $delete_file_path = FCPATH."uploads/".$folder."/".$user_id."/".$user_details[$image];
                unlink($delete_file_path);
            }

            $data["profile_image"] = $filename;
            $this->db->update('users', $data, array('id' => $user_id));

            $response['rc'] = TRUE;
            $response['msg'] = 'Picture uploaded successfully';
        }
        else
        {
            $response['rc'] = FALSE;
            $response['msg'] = 'Error occurred while uploading the user image';
        }

        return $response;
    }

    function get_all_conversation_by_user_id($user_id)
    {
        $query = "  SELECT 
                        users.name, users.id 
                    from 
                        users, 
                        msg_messages,
                        msg_participants m1,
                        msg_participants m2,
                        msg_threads,
                        msg_status 
                    where 
                        m1.user_id = users.id AND 
                        (msg_messages.sender_id = '".$user_id."' or m2.user_id = '".$user_id."') AND 
                        m1.user_id != '".$user_id."' AND 
                        msg_messages.thread_id = m1.thread_id AND
                        m1.thread_id = m2.thread_id
                        
                    group by id
                ";
                // echo $query;exit;
        $result = $this->db->query($query)->result_array();

        if(!empty($result))
        {
            $response["data"] = $result;
            $response["rc"] = TRUE;
        }
        else
        {
            $response["rc"] = FALSE;
            $response["msg"] = "inbox is empty";
        }

        return $response;

    }

    function get_conversation_by_id($id, $user_id)
    {
        $query = "SELECT 
                        msg_messages.*,(select name from users where msg_messages.sender_id = users.id) as name
                    from
                        users, msg_messages,msg_participants,msg_threads,msg_status
                    where 
                        (msg_messages.sender_id = '".$id."' OR msg_messages.sender_id = '".$user_id."')AND
                        (msg_participants.user_id = '".$user_id."' OR msg_participants.user_id = '".$id."') AND 
                        msg_messages.thread_id in(select m1.thread_id from msg_participants m1, msg_participants m2 where m1.user_id = '".$user_id."' AND m2.user_id = '".$id."' and m1.thread_id = m2.thread_id)
    
                    group by id
                ";
                // echo $query;exit;
        $result = $this->db->query($query)->result_array();

        if(!empty($result))
        {
            $response["data"] = $result;
            $response["rc"] = TRUE;
        }
        else
        {
            $response["rc"] = FALSE;
            $response["msg"] = "inbox is empty";
        }

        return $response;

    }

}

