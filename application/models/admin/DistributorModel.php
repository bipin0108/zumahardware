<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DistributorModel extends CI_Model
{
  	public function __construct()
        {
                parent::__construct();
        } 
	
	private $Distributor = 'distributor';

	public function get_all_distributor()
	{	
		$this->db->order_by("id", "desc");
		$query = $this->db->get('distributor');
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return false;
		}
	}

	

	public function add_distributor($params)
	{  
 		$res = $this->db->insert($this->Distributor, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}
 	
 	public function get_distributor_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Distributor);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
   	}

	public function update_distributor_by_id($id,$params)
	{
		$res = $this->db->update($this->Distributor, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}

	public function get_image($id)
	{  
 		$this->db->select('image');
		$this->db->from($this->Distributor);
		$this->db->where("id",$id);
		$query = $this->db->get();
		if ($query){
			 return $query->row()->image;
		 } else {
			 return false;
		 }
   	} 

   	public function get_distributorname_by_id($id)
	{  
 		$this->db->select('first_name,last_name');
		$this->db->from($this->Distributor);
		$this->db->where("id",$id);
		$query = $this->db->get();
		if ($query){
			 return $query->row()->first_name." ".$query->row()->last_name;
		 } else {
			 return false;
		 }
   	} 

   	public function get_dealer($id)
   	{
		$sql = "SELECT * FROM users WHERE type='dealer' AND distributor_id = '".$id."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return false;
		}
   	}

   	public function get_carpenter($id)
   	{
		$sql = "SELECT * FROM users WHERE type='carpenter' AND distributor_id = '".$id."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return false;
		}
   	}

   	public function get_salesman($id)
   	{
		$sql = "SELECT * FROM users WHERE type='salesman' AND distributor_id = '".$id."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return false;
		}
   	}

}
