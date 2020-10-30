<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SubcategoryModel extends CI_Model
{
  	public function __construct()
    {
            parent::__construct();
    } 
	
	public $Subcategory = 'subcategory';
	//use
	public function get_all_subcategory_by_category($cat_id)
	{
		$this->db->select('*');
		$this->db->from('subcategory');
		$this->db->where("subcat_parentid",$cat_id);
		$this->db->order_by("subcat_id", "desc");
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return false;
		}
	}
	//use
	public function add_subcategory($data)
	{  
 		$res = $this->db->insert($this->Subcategory, $data); 
		if($res == 1)
			return true;
		else
			return false;
 	}
 	//use
 	public function get_subcategory_by_id($subcat_id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Subcategory);
		$this->db->where("subcat_id",$subcat_id);
		$query = $this->db->get();
 		if ($query) {
			 return $query->row();
		 } else {
			 return false;
		 }
   	}

	public function get_subcatname_by_id($subcat_id)
   	{

   		$this->db->select('subcat_name');
		$this->db->from($this->Subcategory);
		$this->db->where("subcat_id",$subcat_id);
		$query = $this->db->get();
 		if ($query) {
			 return $query->row()->subcat_name;
		 } else {
			 return false;
		 }
		
   	}

	public function update_subcategory_by_id($subcat_id,$params)
	{
		$res = $this->db->update($this->Subcategory, $params ,['subcat_id' => $subcat_id ]); 
		if($res == 1)
			return true;
		else
			return false;
	}

	public function get_product_by_subcat_id($subcategory)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('subcategory',$subcategory);
		$query = $this->db->get();
 		if ($query) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function dropdownsubcate()
	{ 
		$this->db->select('*');
		$this->db->from($this->Subcategory);
		$query = $this->db->get();
		if ($query) {
			return $query->result_array();
		} else {
			return false;
		}
	}
 }
