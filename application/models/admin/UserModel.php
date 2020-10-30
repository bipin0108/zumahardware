<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserModel extends CI_Model
{
  	public function __construct()
    {
            parent::__construct();
    } 
	
	private $Users = 'users';
	

	public function add_user($params)
	{  
 		$res = $this->db->insert($this->Users, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}
 	
 	public function get_user_by_id($user_id) 
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

   	public function get_user_by_name($name) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Users);
		$this->db->where("first_name",$first_name);
		$this->db->where("last_name",$last_name);
		
  		$query = $this->db->get();
 		if ($query) {
			 return $query->result();
		 } else {
			 return false;
		 }
   	}

	public function update_user_by_id($user_id,$params)
	{
		$res = $this->db->update($this->Users, $params ,['user_id' => $user_id ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}

	public function get_all_user()
	{  
 		$this->db->select('*');
		$this->db->from($this->Users);
		$this->db->where("distributor_id",0);
		$this->db->order_by("user_id", "desc");
		$query = $this->db->get();
		if ($query){
			 return $query->result();
		 } else {
			 return false;
		 }
   	} 

   	public function get_all_user_by_type($type)
	{  
 		$this->db->select('*');
		$this->db->from($this->Users);
		$this->db->where("type",$type);
		$this->db->where("distributor_id",0);
		$this->db->order_by("user_id", "desc");
		$query = $this->db->get();
		if ($query){
			 return $query->result();
		 } else {
			 return false;
		 }
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
   	public function dropdowntypebyname($user_id)
	{  
 		$this->db->select('type');
 		$this->db->where('user_id',$user_id);
		$this->db->from($this->Users);
   		$query = $this->db->get();
 		if ($query->num_rows() > 0) {
			 return $query->result_array();
		 } else {
			 return false;
		 }
   	}

   	public function transfer_history_by_id($user_id)
   	{
   		$sql="SELECT t.id, REPLACE(t.from_u,'_d','') from_u, 
			if(t.from_u = 0,
				'Zuma Corporation',
				if( t.from_u = concat(REPLACE(t.from_u,'_d',''),'_d'),
					concat(fd.first_name,' ',fd.last_name,' Distributor'),
					concat(fu.first_name,' ',fu.last_name)
				)
			) from_name, 
			REPLACE(t.to_u,'_d','') to_u, 
			if(t.to_u = 0,
				'Zuma Corporation',
				if( t.to_u = concat(REPLACE(t.to_u,'_d',''),'_d'),
					concat(td.first_name,' ',td.last_name,' Distributor'),
					concat(tu.first_name,' ',tu.last_name)
				)
			) to_name, 
			t.point, t.transfer_date,if(t.to_u=$user_id,'credit','debit') AS status 
		FROM transfer_history as t
		LEFT JOIN users as fu ON t.from_u = fu.user_id
		LEFT JOIN users as tu ON t.to_u = tu.user_id
		LEFT JOIN distributor as fd ON REPLACE(t.from_u,'_d','') = fd.id
		LEFT JOIN distributor as td ON REPLACE(t.to_u,'_d','') = td.id
		WHERE t.from_u=$user_id 
		OR t.to_u=$user_id ORDER BY t.id DESC";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				$result = $query->result();
				return $result;
			}else{
				return false;
			}
   	}

   	public function qr_history_by_id($user_id)
   	{
   		$sql="SELECT q.*, p.name as product_name, p.product_image
			FROM qr_history as q
			INNER JOIN products as p ON q.product_id = p.id
			WHERE q.user_id=$user_id
			ORDER BY q.id DESC";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return false;
		}
   	}
}