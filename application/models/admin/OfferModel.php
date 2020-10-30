<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OfferModel extends CI_Model {

  	public function __construct()
    {
        parent::__construct();
    } 
	
	private $offer = 'offer';
	
	

	public function add_offer($data)
	{  
 		$res = $this->db->insert($this->offer, $data); 
		if($res == 1)
			return true;
		else
			return false;
 	}

	public function get_offer_by_dealer() 
	{  
 		$this->db->select('*');
		$this->db->from($this->offer);
		$this->db->where('type','dealer');
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
 		if ($query) {
			 return $query->result();
		 } else {
			 return false;
		 }
   	}

   	public function get_offer_by_carpenter() 
	{  
 		$this->db->select('*');
		$this->db->from($this->offer);
		$this->db->where('type','carpenter');
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
 		if ($query) {
			 return $query->result();
		 } else {
			 return false;
		 }
   	}

   	public function get_offer_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->offer);
		$this->db->where("id",$id);
		$query = $this->db->get();
 		if ($query) {
			 return $query->row();
		 } else {
			 return false;
		 }
   	}

   	public function update_offer_by_id($id,$data)
	{
		$res = $this->db->update($this->offer, $data ,['id' => $id ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}

	public function get_image($id)
	{  
 		$this->db->select('image');
		$this->db->from($this->offer);
		$this->db->where("id",$id);
		$query = $this->db->get();
		if ($query){
			 return $query->row()->image;
		 } else {
			 return false;
		 }
   	} 
}
