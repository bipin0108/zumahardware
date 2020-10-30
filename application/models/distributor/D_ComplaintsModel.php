<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class D_ComplaintsModel extends CI_Model {

  	public function __construct()
    {
        parent::__construct();
    } 
	
	public $Complaints = 'complaints';
	
	

	public function pending_complaints_list()
	{
		$dis_id = $this->session->userdata[SESSION_USER]['id'];
		$sql = "SELECT c.id,c.status,c.message,c.created_at,u.first_name,u.last_name,c.mobile_no,u.address,u.type,p.name
		FROM `complaints` as c 
		LEFT JOIN users as u on c.user_id = u.user_id
		LEFT JOIN products as p on c.product_id = p.id
		
		WHERE c.status='pending' AND u.distributor_id = ? ORDER BY c.id DESC";
		$query = $this->db->query($sql,array($dis_id));
		if ($query) {
			 return $query->result();
		 } else {
			 return false;
		 }
	}

	public function compeleted_complaints_list()
	{
		$dis_id = $this->session->userdata[SESSION_USER]['id'];
		$sql = "SELECT c.id,c.status,c.message,c.created_at,u.first_name,u.last_name,c.mobile_no,u.address,u.type,p.name
		FROM `complaints` as c 
		LEFT JOIN users as u on c.user_id = u.user_id
		LEFT JOIN products as p on c.product_id = p.id

		WHERE c.status='completed'  AND u.distributor_id = ? ORDER BY c.id DESC";
		$query = $this->db->query($sql,array($dis_id));
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
