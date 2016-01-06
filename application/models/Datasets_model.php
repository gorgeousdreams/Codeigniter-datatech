<?php 

/**
* 
*/
class Datasets_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_datasets_list()
	{
		$sql2 = 'SELECT * 
				FROM datasets_resources 
				ORDER BY dts_id';
				
				$datasets =  $this->db->query($sql2)->result_array();
	
		if(!empty($datasets))
		{
			$response["data"] = $datasets;
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
		$this->db->insert('datasets_resources', $recordData);
		$dts_id = $this->db->insert_id();
		$data['dts_id'] = $dts_id;
	
		$response['rc'] = TRUE;
		$response['data'] = $dts_id;
	
		return $dts_id;
	}
}