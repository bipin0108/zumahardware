<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ReportModel extends CI_Model
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
   		if($user_type != 'distributor'){
			$search = ' INNER JOIN users as u ON o.user_id = u.user_id WHERE u.user_id ='.$id;
		}else{
			$search = ' INNER JOIN distributor as d ON o.user_id = d.id WHERE d.id ='.$id;
		}

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
}
