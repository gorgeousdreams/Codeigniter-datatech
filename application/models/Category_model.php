<?php
/* 
 * Generated by CRUDigniter v1.0 Beta
 * www.crudigniter.com
 */
 
class Category_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * get categories by id
     */
    function get_categories($id)
    {
        return $this->db->get_where('categories',array('id'=>$id))->row_array();
    }
    
    /*
     * get all categories
     */
    function get_all_categories()
    {
        /* $query = "SELECT categories.* ,users.name as username
                  FROM categories 
                  LEFT JOIN users ON categories.created_by = users.id"; */
    	
    	$query = "SELECT * FROM categories";
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

    

    function get_all_topics_by_category_id()
    {
        return $this->db->get('categories')->result_array();
    }
    
    /*
     * function to add categories
     */
    function add_categories($params)
    {
        $result = $this->db->insert('categories',$params);

        if($result)
        {
            $response["rc"] =   TRUE;
            $response["msg"] =   "Category added successfully";
        }
        else
        {
            $response["rc"] =   FALSE;
            $response["msg"] =   "Error while adding category";
        }
        return $response;
    }
    
    /*
     * function to update categories
     */
    function update_categories($id,$params)
    {
        $this->db->where('id',$id);
        $this->db->update('categories',$params);
    }
    
    /*
     * function to delete categories
     */
    function delete_categories($id)
    {
        $this->db->delete('categories',array('id'=>$id));
    }

    function get_category_name_by_category_id($category_id)
    {
        $query = "SELECT * FROM categories where id=".$category_id."";
        $category = $this->db->query($query)->row_array();
        return $category;
    }
}