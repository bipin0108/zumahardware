<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class D_DashboardModel extends CI_Model {

  	public function __construct()
    {
            parent::__construct();
    }


    public function pending_orders()
	{
		$dis_id = $this->session->userdata[SESSION_USER]['id'];
		$sql = "SELECT o.* FROM orders AS o 
   				INNER JOIN users AS u 
   				ON o.user_id = u.user_id AND u.distributor_id = ? 
   				AND o.user_id != ? AND o.order_status='pending'";
		$query = $this->db->query($sql,array($dis_id,$dis_id));
		if($query->num_rows() > 0){
			$result = $query->num_rows();
			return $result;
		}else{
			return 0;
		}
	}

	public function confirmed_orders()
	{
		$dis_id = $this->session->userdata[SESSION_USER]['id'];
		$sql = "SELECT o.* FROM orders AS o 
   				INNER JOIN users AS u 
   				ON o.user_id = u.user_id AND u.distributor_id = ? 
   				AND o.user_id != ? AND o.order_status='confirmed'";
		$query = $this->db->query($sql,array($dis_id,$dis_id));
		if($query->num_rows() > 0){
			$result = $query->num_rows();
			return $result;
		}else{
			return 0;
		}
	}

	public function delivered_orders()
	{
		$dis_id = $this->session->userdata[SESSION_USER]['id'];
		$sql = "SELECT o.* FROM orders AS o 
   				INNER JOIN users AS u 
   				ON o.user_id = u.user_id AND u.distributor_id = ? 
   				AND o.user_id != ? AND o.order_status='delivered'";
		$query = $this->db->query($sql,array($dis_id,$dis_id));
		if($query->num_rows() > 0){
			$result = $query->num_rows();
			return $result;
		}else{
			return 0;
		}
	}

	public function completed_orders()
	{
		$dis_id = $this->session->userdata[SESSION_USER]['id'];
		$sql = "SELECT o.* FROM orders AS o 
   				INNER JOIN users AS u 
   				ON o.user_id = u.user_id AND u.distributor_id = ? 
   				AND o.user_id != ? AND o.order_status='completed'";
		$query = $this->db->query($sql,array($dis_id,$dis_id));
		if($query->num_rows() > 0){
			$result = $query->num_rows();
			return $result;
		}else{
			return 0;
		}
	}
//end
 }


