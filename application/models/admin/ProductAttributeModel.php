<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductAttributeModel extends CI_Model {

  	public function __construct()
    {
        parent::__construct();
    } 
	
	private $ProductAttribute = 'product_attribute';
	private $Attribute = 'attribute';
	
	function get_all_productattribute(){

		$query = $this->db->get('product_attribute');
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return false;
		}
	}

	public function add_productattribute($data)
	{  
 		$res = $this->db->insert($this->ProductAttribute, $data); 
		if($res == 1)
			return true;
		else
			return false;
 	}

 	public function get_productattribute_by_id($id) 
	{  
		$this->db->select('*');
		$this->db->from($this->ProductAttribute);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row();
		 } else {
			 return false;
		 }
   	}
	
	public function get_productattribute_by_product_id($product_id) 
	{  
		$this->db->select('*');
		$this->db->from($this->ProductAttribute);
		$this->db->where("product_id",$product_id);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->result();
		 } else {
			 return false;
		 }
   	}

	public function update_productattribute_by_id($id,$data)
	{
		$res = $this->db->update($this->ProductAttribute, $data ,['id' => $id ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}
 }
