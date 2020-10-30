<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class D_ReportModel extends CI_Model
{
  	public function __construct()
    {
            parent::__construct();
    } 
	
	private $Users = 'users';
	public $distributor = 'distributor';
	public $orders = 'orders';
	
 	
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

   	public function get_order_report_data($user_type,$id,$s_date,$e_date)
   	{
   		
		$search = ' INNER JOIN users as u ON o.user_id = u.user_id WHERE u.user_id ='.$id;
	
		

		if($s_date != '' || $e_date != ''){
			$date = " AND DATE(o.created_at)  BETWEEN '".$s_date."' AND '".$e_date."'" ;
		}
		$sql = "SELECT o.*
				FROM orders as o".$search." AND o.user_type = '".$user_type."' ".$date." ORDER BY o.id DESC";
		
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return false;
		}
	}

   	public function get_dealer_or_salesman($user_type)
	{	
		$distributor_id=$this->session->userdata[SESSION_USER]['id'];
		$sql = "SELECT * FROM users WHERE type=? and distributor_id=?";
		$query = $this->db->query($sql,array($user_type,$distributor_id));
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return false;
		}
	}
}
