<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ComplaintsModel extends CI_Model {

  	public function __construct()
    {
        parent::__construct();
    } 
	
	public $Complaints = 'complaints';
	
	

	public function pending_complaints_list()
	{
		$sql = "SELECT c.id,c.mobile_no,c.status,c.message,c.created_at,u.first_name,u.last_name,u.address,u.type,p.name
		FROM `complaints` as c 
		LEFT JOIN users as u on c.user_id = u.user_id
		LEFT JOIN products as p on c.product_id = p.id
		
		 WHERE status='pending' and u.distributor_id = 0 ORDER BY id DESC";
		$query = $this->db->query($sql);
		if ($query) {
			 return $query->result();
		 } else {
			 return false;
		 }
	}

	public function compeleted_complaints_list()
	{
		$sql = "SELECT c.id,c.mobile_no,c.status,c.message,c.created_at,u.first_name,u.last_name,u.address,u.type,p.name
		FROM `complaints` as c 
		LEFT JOIN users as u on c.user_id = u.user_id
		LEFT JOIN products as p on c.product_id = p.id
		

		WHERE status='completed' and u.distributor_id = 0 ORDER BY id DESC";
		$query = $this->db->query($sql);
		if ($query) {
			 return $query->result();
		 } else {
			 return false;
		 }
	}

	public function change_complaints_status($id, $params){
		$res = $this->db->update($this->Complaints, $params, ['id' => $id ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}
}
