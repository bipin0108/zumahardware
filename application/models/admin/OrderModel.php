<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderModel extends CI_Model {

  	public function __construct()
    {
        parent::__construct();
    } 
	
	public $Order = 'orders';
	public $Orderitems = 'order_items';
	public $Users = 'users';
	
	public function get_all_order()
	{
		$this->db->select('*');
		$this->db->from($this->Order);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
 		if ($query){
			 return $query->result();
		 } else {
			 return array();
		 }
	}

	public function get_all_distributor_order()
	{
		$this->db->select('*');
		$this->db->from($this->Order);
		$this->db->where('user_type','distributor');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
 		if ($query){
			 return $query->result();
		 } else {
			 return array();
		 }
	}

	public function get_OrderItem($order_id)
	{
		$this->db->select('order_items.*,products.name as product_name');
		$this->db->from($this->Orderitems);
		$this->db->join('products','products.id=order_items.product_id');
		$this->db->where('order_items.order_id',$order_id);

		$query = $this->db->get();

		$this->db->select('delivered_by,lr_number,date,salesman_id');
		$this->db->from($this->Order);
		$this->db->where('id',$order_id);
		$query1 = $this->db->get();
		$order_detail = $query1->row();
		if($query->num_rows() > 0)
		{
			$data['items'] = $query->result();
			$data['delivered_by'] = $order_detail->delivered_by;
			$data['lr_number'] = $order_detail->lr_number;
			if($order_detail->salesman_id != 0){
				$data['salesman_name'] = $this->get_salesman_name($order_detail->salesman_id);
			}
			else
			{
				$data['salesman_name'] = 'none';
			}
			$data['date'] = $order_detail->date;
			return $data;
		} else {
			return array();
		}
	}

	public function get_salesman_name($user_id)
	{
		$this->db->select('first_name,last_name');
		$this->db->from($this->Users);
		$this->db->where("user_id",$user_id);
		$query = $this->db->get();
 		if ($query){
			 return $query->row()->first_name." ".$query->row()->last_name;
		 } else {
			 return array();
		 }
	}

	public function get_order_by_usertype($user_type,$f_name,$l_name)
	{
		$this->db->select('orders.*,if(orders.user_type != "distributor",CONCAT("users.first_name"," ","users.last_name"),CONCAT("distributor.first_name"," ","distributor.last_name")) as username');
		$this->db->from($this->Order);
		if($user_type != 'distributor'){
			$this->db->join('users','orders.user_id = users.user_id','inner');
			$this->db->where("users.first_name",$f_name);
			$this->db->where("users.last_name",$l_name);
		}else{
			$this->db->join('distributor','orders.user_id = distributor.id','inner');
			$this->db->where("distributor.first_name",$f_name);
			$this->db->where("distributor.last_name",$l_name);
		}
		$this->db->where("orders.user_type",$user_type);
		$this->db->order_by('orders.id','desc');
		$query = $this->db->get();
 		if ($query){
			 return $query->result();
		 } else {
			 return array();
		 }
	}

	public function get_order_by_userid($user_id)
	{
		$this->db->select('*');
		$this->db->from($this->Order);
		$this->db->where("user_id",$user_id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
 		if ($query){
			 return $query->result();
		 } else {
			 return array();
		 }
	}

	public function pending_order_list()
	{
		$sql = "SELECT * FROM `orders` WHERE order_status='pending' and user_type='distributor' ORDER BY id DESC";
		$query = $this->db->query($sql);
		if ($query) {
			 return $query->result();
		 } else {
			 return false;
		 }
	}

	public function confirm_order_list()
	{
		$sql = "SELECT * FROM `orders` WHERE order_status='confirmed' and user_type='distributor' ORDER BY id DESC";
		$query = $this->db->query($sql);
		if ($query) {
			 return $query->result();
		 } else {
			 return false;
		 }
	}

	public function delivered_order_list()
	{
		$sql = "SELECT * FROM `orders` WHERE order_status='delivered' and user_type='distributor' ORDER BY id DESC";
		$query = $this->db->query($sql);
		if ($query) {
			 return $query->result();
		 } else {
			 return false;
		 }
	}

	public function compeleted_order_list()
	{
		$sql = "SELECT * FROM `orders` WHERE order_status='completed' and user_type='distributor' ORDER BY id DESC";
		$query = $this->db->query($sql);
		if ($query) {
			 return $query->result();
		 } else {
			 return false;
		 }
	}
	
 	public function get_order_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Order);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
   	}

   	public function get_username_by_id($id)
	{
		$this->db->select('*');
    	$this->db->from($this->Order);
    	$this->db->where('id',$id);
    	$query = $this->db->get();
 		if($query)
 		{
 			$data = $query->row_array();
		}
		else
		{
			return false;
		}
	}
	public function get_order_item_by_order_id($order_id){
		$this->db->select('*');
		$this->db->from('order_items');
		$this->db->where("order_id",$order_id);
		$query = $this->db->get();
		if($query)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	public function change_status($order_id, $params){
		$res = $this->db->update($this->Order, $params, ['order_id' => $order_id ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}
	public function get_items_by_orderid($order_id)
	{

		$this->db->select('order_items.*,products.name as product_name');
		$this->db->from('order_items');
		$this->db->join('products','products.id=order_items.product_id');
		$this->db->where('order_items.order_id',$order_id);
		$query = $this->db->get();
 		if($query->num_rows() > 0)
 		{
			$result = $query->result();
			return $result;
		}
		else
		{
			return false;
		}
	}
	
	public function update_qty_by_order_id($id,$data)
	{
		$res = $this->db->update('order_items', $data ,['id' => $id ] ); 
		
		if($res == 1)
			return true;
		else
			return false;
	} 
}
