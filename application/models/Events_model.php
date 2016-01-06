<?php 

/**
* 
*/
class Events_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_events_list()
	{
		$sql2 = 'SELECT * 
				FROM posts
				WHERE post_type_fk = 3
				ORDER BY post_id';
				
				$events =  $this->db->query($sql2)->result_array();
	
		if(!empty($events))
		{
			$response["data"] = $events;
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
		$this->db->insert('posts', $recordData);
		$post_id = $this->db->insert_id();
		$data['post_id'] = $post_id;
	
		$response['rc'] = TRUE;
		$response['data'] = $post_id;
	
		return $post_id;
	}
}