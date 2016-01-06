<?php 

/**
* 
*/
class Messages_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_messages_list($userto)
	{
		$sql = 'SELECT * 
				FROM user_messages
				Where msg_messageto = '.$userto.'
				ORDER BY msg_id';
				
				$messages =  $this->db->query($sql)->result_array();
	
		if(!empty($messages))
		{
			$response["data"] = $messages;
			$response["rc"] = TRUE;
		}
		else
		{	
			$response["rc"] = FALSE;
			$response["msg"] = "No post Found";
		}
			return $response;
	}
	
	function get_messages_detail($msgId)
	{
		$sql = 'SELECT * 
				FROM user_messages
				JOIN user_details on usrd_usr_fk = msg_usr_fk
				Where msg_id = '.$msgId;
	
		$messages =  $this->db->query($sql)->result_array();
	
		if(!empty($messages))
		{
			$response["data"] = $messages;
			$response["rc"] = TRUE;
		}
		else
		{
			$response["rc"] = FALSE;
			$response["msg"] = "No post Found";
		}
		return $response;
	}
	
	function add_record($recordData)
	{
		$this->db->insert('user_messages', $recordData);
		$msg_id = $this->db->insert_id();
		$data['msg_id'] = $msg_id;
	
		$response['rc'] = TRUE;
		$response['data'] = $msg_id;
	
		return $msg_id;
	}
}