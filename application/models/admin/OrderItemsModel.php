<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderItemsModel extends CI_Model {

  	public function __construct()
    {
        parent::__construct();
    } 
	
	public $Order_items = 'order_items';
	
	public function get_all_orderitems()
	{
		$this->db->select('*');
		$this->db->from($this->Order_items);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
 		if ($query){
			 return $query->result();
		 } else {
			 return array();
		 }
	}

	
 	public function get_orderitems_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Order_items);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
   	}
	
}
