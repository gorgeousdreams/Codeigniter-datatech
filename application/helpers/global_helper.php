<?php

function pr($array)
{
    echo "<pre>";
    $data = print_r($array);
    echo "</pre>";

    return $data; 
}

/* to create seo friendly URL */

function clean($string){
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
    return strtolower(trim($string, '-'));
}

function ago($time)
{    
    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths = array("60","60","24","7","4.35","12","10");

    $now = time();

    $difference     = $now - $time;
    $tense         = "ago";

    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if($difference != 1) {
        $periods[$j].= "s";
    }

    return "$difference $periods[$j]";
}

function check_post_belongs_to_topic($topic_url,$post_url)
{
    $CI =& get_instance();

    $get_topic_id = $CI->db->get_where("topics",array("url" => $topic_url))->row_array();
    $get_post_id = $CI->db->get_where("posts",array("url" => $post_url))->row_array();
    if(!empty($get_topic_id) && !empty($get_post_id))
    {
        $check_post_belongs_to_topic = $CI->db->get_where("post_belongs_to_topics",array("topic_id" => $get_topic_id["id"], "post_id" => $get_post_id["id"]))->row_array();
        
        if(!empty($check_post_belongs_to_topic))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    else
    {
        return FALSE;
    }
}

function is_valid_category($id)
{
    $CI =& get_instance();

    $get_category_id = $CI->db->get_where("categories",array("id" => $id))->row_array();
    
    if(!empty($get_category_id))
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

function is_valid_post($url)
{
    $CI =& get_instance();

    $get_category_id = $CI->db->get_where("posts",array("url" => $url))->row_array();
    
    if(!empty($get_category_id))
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

function is_valid_topic($id)
{
    $CI =& get_instance();

    $get_topic_id = $CI->db->get_where("topics",array("id" => $id))->row_array();
    
    if(!empty($get_topic_id))
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

function get_area_of_interest()
{
    $CI =& get_instance();

    $categories = $CI->db->get("categories")->result_array();

    foreach($categories as $key => $category)
    {
        $query = "
                    SELECT 
                        t.*
                    FROM 
                        topics t ,
                        topics_belongs_to_category tbc, 
                        categories c 
                    WHERE 
                        t.id = tbc.topic_id AND 
                        tbc.category_id = ".$category['id']." 
                    GROUP BY t.id 
            ";

        $categories[$key]["topics"] = $CI->db->query($query)->result_array();
    }

    if(!empty($categories))
    {
        $response["rc"] = TRUE;
        $response["data"] = $categories;
    }
    else
    {
        $response["rc"] = FALSE;
    }

    return $response;
}

function get_area_of_interest_by_user_id($user_id)
{
    $CI =& get_instance();

    $CI->db->where("user_id",$user_id);
    $areas_of_interest = $CI->db->get("user_has_interests")->result_array();

    foreach($areas_of_interest as $key => $topic)
    {
       $ids[$topic["category_id"]][] = $topic["topic_id"];
    }

    if(!empty($ids))
    {
        $response["rc"] = TRUE;
        $response["data"] = $ids;
    }
    else
    {
        $response["rc"] = FALSE;
    }
    return $response;

}

function get_area_of_expertise_by_user_id($user_id)
{
    $CI =& get_instance();

    $CI->db->where("user_id",$user_id);
    $areas_of_interest = $CI->db->get("user_has_expertise")->result_array();

    foreach($areas_of_interest as $key => $topic)
    {
       $ids[$topic["category_id"]][] = $topic["topic_id"];
    }

    if(!empty($ids))
    {
        $response["rc"] = TRUE;
        $response["data"] = $ids;
    }
    else
    {
        $response["rc"] = FALSE;
    }
    return $response;

}

function check_number_of_areas_of_interest($user_id)
{
     $CI =& get_instance();

    $CI->db->where("user_id",$user_id);
    $CI->db->select("count(*) as count");
    $areas_of_interest = $CI->db->get("user_has_interests")->row_array();

    if(!empty($areas_of_interest))
    {
        $response["rc"] = TRUE;
        $response["data"] = $areas_of_interest;
    }
    else
    {
        $response["rc"] = FALSE;
    }
    return $response;
}

function get_all_users()
{
     $CI =& get_instance();
     $current_user = $CI->session->userdata("user_id");
     $CI->db->where("id != ", $current_user);
    $users = $CI->db->get("users")->result_array();

    if(!empty($users))
    {
        $response["rc"] = TRUE;
        $response["data"] = $users;
    }
    else
    {
        $response["rc"] = FALSE;
    }
    return $response;

}

function limit_text($text, $limit) 
{
  if (str_word_count($text, 0) > $limit) {
      $words = str_word_count($text, 2);
      $pos = array_keys($words);
      $text = substr($text, 0, $pos[$limit]) . '...';
  }
  return $text;
}

function is_valid_post_by_id($id)
{
    $CI =& get_instance();

    $get_category_id = $CI->db->get_where("posts",array("id" => $id))->row_array();
    
    if(!empty($get_category_id))
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

function is_valid_conversation_id($id)
{
    $CI =& get_instance();

    $conversation_id = $CI->db->get_where("users",array("id" => $id))->row_array();
    
    if(!empty($conversation_id))
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

function is_valid_user($id)
{
    $CI =& get_instance();

    $user_id = $CI->db->get_where("users",array("id" => $id))->row_array();
    
    if(!empty($user_id))
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

function is_valid_conversation($recipient,$sender_id)
{
    $CI =& get_instance();

    $check = $CI->db->query("
                SELECT 
                    * 
                FROM 
                    msg_messages m1, msg_participants m2 
                WHERE 
                    m1.thread_id = m2.thread_id AND 
                    m1.sender_id = '".$recipient."' and m2.user_id = '".$sender_id."'
        ")->result_array();
    
    if(!empty($check))
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}