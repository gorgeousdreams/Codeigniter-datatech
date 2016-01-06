<?php 

/**
* 
*/
class Education_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_education_list()
	{
		$sql2 = 'SELECT * 
				FROM education_resources 
				ORDER BY edu_id';
				
				$education =  $this->db->query($sql2)->result_array();
	
		if(!empty($education))
		{
			$response["data"] = $education;
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
		$this->db->insert('education_resources', $recordData);
		$edu_id = $this->db->insert_id();
		$data['edu_id'] = $edu_id;

        $response['rc'] = TRUE;
		$response['data'] = $edu_id;
        
		return $edu_id;
	}
}