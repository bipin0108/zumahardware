<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryModel extends CI_Model {

  	public function __construct()
    {
        parent::__construct();
    } 
	
	private $Category = 'category';
	
	function get_all_category(){

		$this->db->order_by("id", "desc");
		$query = $this->db->get('category');
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return false;
		}
	}

	public function add_category($data)
	{  
 		$res = $this->db->insert($this->Category, $data); 
		if($res == 1)
			return true;
		else
			return false;
 	}

 	public function get_category_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Category);
		$this->db->where("id",$id);
		$query = $this->db->get();
 		if ($query) {
			 return $query->row();
		 } else {
			 return false;
		 }
   	}

   	public function get_catname_by_id($id)
   	{
   		$this->db->select('name');
		$this->db->from($this->Category);
		$this->db->where("id",$id);
		$query = $this->db->get();
 		if ($query) {
			 return $query->row()->name;
		 } else {
			 return false;
		 }
   	}
	
	public function update_category_by_id($cat_id,$data)
	{
		$res = $this->db->update($this->Category, $data ,['id' => $cat_id ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}
	
	public function dropdowncategory($cat_id)
	{  
 		$this->db->select('*');
 		$this->db->where('id',$cat_id);
		$this->db->from($this->Category);
   		$query = $this->db->get();
 		if ($query) {
			 return $query->row();
		 } else {
			 return false;
		 }
   	}
   	public function dropdowncate()
	{  
 		$this->db->select('*');
 	    $this->db->from($this->Category);
   		$query = $this->db->get();
 		if ($query) {
			 return $query->result_array();
		 } else {
			 return false;
		 }
   	}

   	public function get_image($id)
	{  
 		$this->db->select('image');
		$this->db->from($this->Category);
		$this->db->where("id",$id);
		$query = $this->db->get();
		if ($query){
			 return $query->row()->image;
		 } else {
			 return false;
		 }
   	} 
   	
 }
