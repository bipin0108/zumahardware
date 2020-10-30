<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BrandModel extends CI_Model
{
  	public function __construct()
    {
        parent::__construct();
    } 
	
	private $Brand = 'brand_slider';
	//use
	public function get_all_brand()
	{
		$this->db->order_by("brand_id", "desc");
		$query = $this->db->get('brand_slider');
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return false;
		}
	}
	//use
	public function add_brand($data)
	{  
		$res = $this->db->insert($this->Brand, $data); 
		if($res == 1)
			return true;
		else
			return false;
	}

	public function get_image($id)
	{  
 		$this->db->select('brand_img');
		$this->db->from($this->Brand);
		$this->db->where("brand_id",$id);
		$query = $this->db->get();
		if ($query){
			 return $query->row()->brand_img;
		 } else {
			 return false;
		 }
   	} 
 }
