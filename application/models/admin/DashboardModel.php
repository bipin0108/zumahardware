<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardModel extends CI_Model {

  	public function __construct()
    {
            parent::__construct();
    }


	public function pending_orders()
	{
		$sql = "SELECT * FROM `orders` WHERE order_status='pending'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->num_rows();
			return $result;
		}else{
			return 0;
		}
	}

	public function confirm_orders()
	{
		$sql = "SELECT * FROM `orders` WHERE order_status='confirmed'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->num_rows();
			return $result;
		}else{
			return 0;
		}
	}

	public function delivered_orders()
	{
		$sql = "SELECT * FROM `orders` WHERE order_status='delivered'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->num_rows();
			return $result;
		}else{
			return 0;
		}
	}

	public function completed_orders()
	{
		$sql = "SELECT * FROM `orders` WHERE order_status='delivered'";
		$query = $this->db->query($sql);
		if ($query) {
			 return $query->num_rows();
		 } else {
			 return false;
		 }
	}

	public function pending_orders_dis()
	{
		$sql = "SELECT * FROM `orders` WHERE order_status='pending' and user_type='distributor'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->num_rows();
			return $result;
		}else{
			return 0;
		}
	}

	public function confirm_orders_dis()
	{
		$sql = "SELECT * FROM `orders` WHERE order_status='confirmed' and user_type='distributor'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->num_rows();
			return $result;
		}else{
			return 0;
		}
	}

	public function delivered_orders_dis()
	{
		$sql = "SELECT * FROM `orders` WHERE order_status='delivered' and user_type='distributor'";
		$query = $this->db->query($sql,array());
		if($query->num_rows() > 0){
			$result = $query->num_rows();
			return $result;
		}else{
			return 0;
		}
	}

	public function completed_orders_dis()
	{
		$sql = "SELECT * FROM `orders` WHERE order_status='completed' and user_type='distributor'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->num_rows();
			return $result;
		}else{
			return 0;
		}
	}
}
