<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AttributeModel extends CI_Model {

  	public function __construct()
    {
        parent::__construct();
    } 
	
	private $Attribute = 'attribute';
	
	function get_all_attribute(){

		$this->db->order_by("att_id", "desc");
		$query = $this->db->get('attribute');
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return false;
		}
	}

	public function add_attribute($data)
	{  
 		$res = $this->db->insert($this->Attribute, $data); 
		if($res == 1)
			return true;
		else
			return false;
 	}

 	public function get_attribute_by_id($att_id) 
	{  
		$this->db->select('*');
		$this->db->from($this->Attribute);
		$this->db->where("att_id",$att_id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row();
		 } else {
			 return false;
		 }
   	}

   	public function get_attribute_by_name($att_name) 
	{  
		$this->db->select('*');
		$this->db->from($this->Attribute);
		$this->db->where("att_name",$att_name);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row();
		 } else {
			 return false;
		 }
   	}
	
	public function update_attribute_by_id($att_id,$data)
	{
		$res = $this->db->update($this->Attribute, $data ,['att_id' => $att_id ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}

	public function get_attributname_by_att_id($att_id) 
	{
		$this->db->select('att_name');
		$this->db->from('attribute');
		$this->db->where("att_id",$att_id);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row();
		 } else {
			 return false;
		 }
	} 
 }
