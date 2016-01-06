<?php 

/**
* 
*/
class Topic_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function add_topic($data)
	{
		$array["topic"] = $data["topic"];
		$array["url"] = $data["url"];
		$array["created_on"] = time();

		$add_topic = $this->db->insert("topics",$array);
		$topic_id = $this->db->insert_id();

		if($add_topic)
		{
			if(!empty($data["categories"]))
			{
				foreach ($data["categories"] as $value) 
				{
					$new_array["topic_id"] = $topic_id;
					$new_array["category_id"] = $value;

					$this->db->insert("topics_belongs_to_category",$new_array);

				}
			}
		}

		if($add_topic)
		{
			$response["msg"] = "New topic added successfully";
			$response["rc"] = true;
		}
		else
		{
			$response["msg"] = "Error while adding topic";
			$response["rc"] = false;
		}

		return $response;
	}

	function get_topics_by_category_id($category_id)
	{
		$query = "
				SELECT 
					topics.*, c.title as category_name
				FROM
					topics, topics_belongs_to_category tbc ,categories c
				WHERE
					tbc.category_id = '".$category_id."' AND
					tbc.category_id = c.id AND
					topics.id = tbc.topic_id
		";
		
		$result = $this->db->query($query)->result_array();

		if($result)
		{
			$response["msg"] = "";
			$response["rc"] = true;
			$response["data"] = $result;
		}
		else
		{
			$response["msg"] = "";
			$response["rc"] = false;
		}

		return $response;
	}

	function get_all_topics($keyword="")
	{
		if($keyword=="")
		{
			$query = " SELECT DISTINCT
							*
						FROM 
							topics 
						ORDER BY topic_title
					";

		}
		else
		{
			$query = " SELECT DISTINCT
							*
						FROM 
							topics where topic_title like '%".$keyword."%' 
						ORDER BY topic_title
					";
		}
		
		$topics = $this->db->query($query)->result_array();

		if(!empty($topics))
		{
			$response["msg"] = "";
			$response["rc"]	=	true;
			$response["data"]	=	$topics;
		}
		else
		{
			$response["msg"] = "No topics available";
			$response["rc"]	=	false;
		}

		return $response;
	}
	
	function get_feed_topics()
	{
		$query = "SELECT topic_title, topic_id
				FROM post_belongs_to_topics
				JOIN posts ON post_id = pbt_post_fk
				JOIN topics ON topic_id = pbt_topic_fk
				GROUP BY topic_title";
		
		$topics = $this->db->query($query)->result_array();
		
		if($topics)
		{
			$response["msg"] = "";
			$response["rc"] = true;
			$response["data"] = $topics;
		}
		else
		{
			$response["msg"] = "";
			$response["rc"] = false;
		}
		
		return $response;
	}

	function get_details_by_topic_id($topic_id)
	{
		$query = "
				SELECT 
					topics.*, c.title as category_name
				FROM
					topics, topics_belongs_to_category tbc ,categories c
				WHERE
					topics.id = '".$topic_id."' AND
					tbc.category_id = c.id AND
					topics.id = tbc.topic_id
		";
		
		$topic = $this->db->query($query)->row_array();

		if($topic)
		{
			$response["msg"] = "";
			$response["rc"] = true;
			$response["data"] = $topic;
		}
		else
		{
			$response["msg"] = "";
			$response["rc"] = false;
		}

		return $response;
	}

	function update_topics($data, $topic_id)
	{
		$topic_data = array(
			'topic' => $data['topic_name']
			);
		
		$this->db->where('id',$topic_id);
        $result = $this->db->update('topics',$topic_data);

        if($result)
		{
			$response["msg"] = "Topic Updated Successfully.";
			$response["rc"] = true;
		}
		else
		{
			$response["msg"] = "Error while updating topic.";
			$response["rc"] = false;
		}

		return $response;
	}

	function delete_topics($topic_id)
	{
		$this->db->where('topic_id',$topic_id);
    	$result1 = $this->db->update('post_belongs_to_topics',array('topic_id' => 0));

    	$this->db->where('topic_id',$topic_id);
    	$result1 = $this->db->update('user_has_interests',array('topic_id' => 0));

    	$result2= $this->db->delete('topics_belongs_to_category',array('topic_id'=>$topic_id));	
		
		$result2= $this->db->delete('topics',array('id'=>$topic_id));
		if($result1 && $result2)
		{
			$response["msg"] = "Topic deleted Successfully.";
			$response["rc"] = true;
		}
		else
		{
			$response["msg"] = "Error while deleting topic.";
			$response["rc"] = false;
		}

		return $response;
	}
}