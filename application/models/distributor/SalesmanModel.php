<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SalesmanModel extends CI_Model
{
  	public function __construct()
        {
                parent::__construct();
        } 
	
	private $Users = 'users';

	public function get_all_salesman()
	{	
		$distributor_id = $this->session->userdata[SESSION_USER]['id']; 
		$sql = "SELECT * FROM users WHERE type='salesman' AND distributor_id = '".$distributor_id."' ORDER BY user_id DESC";
	
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return false;
		}
	}

	public function add_salesman($params)
	{  
 		$res = $this->db->insert($this->Users, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}
 	
 	public function get_salesman_by_id($user_id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Users);
		$this->db->where("user_id",$user_id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
   	}

	public function update_salesman_by_id($user_id,$params)
	{
		$res = $this->db->update($this->Users, $params ,['user_id' => $user_id ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}

	public function get_image($user_id)
	{  
 		$this->db->select('image');
		$this->db->from($this->Users);
		$this->db->where("user_id",$user_id);
		$query = $this->db->get();
		if ($query){
			 return $query->row()->image;
		 } else {
			 return false;
		 }
   	} 
}
