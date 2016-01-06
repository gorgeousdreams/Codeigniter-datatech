<?php 

/**
* 
*/
class Jobs_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_jobs_list()
	{
		$query = 'SELECT * 
				FROM jobs_resources 
				ORDER BY job_crd DESC';
				
				$datasets =  $this->db->query($query)->result_array();
	
		if(!empty($datasets))
		{
			$response["data"] = $datasets;
			$response["rc"] = TRUE;
		}
		else
		{	
			$response["rc"] = FALSE;
			$response["msg"] = "No Job Found";
		}
			return $response;
	}
	
	function add_record($recordData)
	{
		$this->db->insert('jobs_resources', $recordData);
		$dts_id = $this->db->insert_id();
		$data['dts_id'] = $dts_id;
	
		$response['rc'] = TRUE;
		$response['data'] = $dts_id;
	
		return $dts_id;
	}
}