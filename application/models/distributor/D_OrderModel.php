<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class D_OrderModel extends CI_Model {

  	public function __construct()
    {
        parent::__construct();
    } 
	
	public $Order = 'orders';
	public $Orderitems = 'order_items';
	private $ProductAttribute = 'product_attribute';
	private $Product = 'products';
	public $Users = 'users';
	
	public function get_all_order()
	{
		$dis_id = $this->session->userdata[SESSION_USER]['id'];
		$sql = "SELECT o.* FROM orders AS o 
   				INNER JOIN users AS u 
   				ON o.user_id = u.user_id AND u.distributor_id = ? 
   				AND o.user_id != ? ";
   		$query = $this->db->query($sql,array($dis_id,$dis_id));
 		if ($query){
			 return $query->result();
		 } else {
			 return array();
		 }
	}

	public function get_order_of_distributor()
	{
		
		$this->db->select('*');
		$this->db->from($this->Order);
		$this->db->where('user_id',$this->session->userdata[SESSION_USER]['id']);
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
		$dis_id = $this->session->userdata[SESSION_USER]['id'];
		$sql = "SELECT o.* FROM orders AS o 
   				INNER JOIN users AS u 
   				ON o.user_id = u.user_id AND u.distributor_id = ? 
   				AND o.user_id != ? AND o.order_status='pending' ORDER BY id DESC";

   		$query = $this->db->query($sql,array($dis_id,$dis_id));
		if ($query) {
			 return $query->result();
		 } else {
			 return false;
		 }
	}

	public function confirm_order_list()
	{
		$dis_id = $this->session->userdata[SESSION_USER]['id'];
		$sql = "SELECT o.* FROM orders AS o 
   				INNER JOIN users AS u 
   				ON o.user_id = u.user_id AND u.distributor_id = ? 
   				AND o.user_id != ? AND o.order_status='confirmed' ORDER BY id DESC";
		$query = $this->db->query($sql,array($dis_id,$dis_id));   				
		if ($query) {
			 return $query->result();
		 } else {
			 return false;
		 }
	}

	public function delivered_order_list()
	{
		$dis_id = $this->session->userdata[SESSION_USER]['id'];
		$sql = "SELECT o.* FROM orders AS o 
   				INNER JOIN users AS u 
   				ON o.user_id = u.user_id AND u.distributor_id = ? 
   				AND o.user_id != ? AND o.order_status='delivered' ORDER BY id DESC";
   		$query = $this->db->query($sql,array($dis_id,$dis_id));		
		if ($query) {
			 return $query->result();
		 } else {
			 return false;
		 }
	}
	
	public function completed_order_list()
	{
		$dis_id = $this->session->userdata[SESSION_USER]['id'];
		$sql = "SELECT o.* FROM orders AS o 
   				INNER JOIN users AS u 
   				ON o.user_id = u.user_id AND u.distributor_id = ? 
   				AND o.user_id != ? AND o.order_status='completed' ORDER BY id DESC";
   		$query = $this->db->query($sql,array($dis_id,$dis_id));		
		if ($query) {
			 return $query->result();
		 } else {
			 return false;
		 }
	}

	public function get_Orderitems_by_order_id($order_id)
	{
		$this->db->select('*');
		$this->db->from($this->Orderitems);
		$this->db->where('order_id',$order_id);
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
			$data['date'] = $order_detail->date;
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

   	public function get_order_by_user_id($user_id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Order);
		$this->db->where("user_id",$user_id);
		$this->db->where("user_type NOT LIKE '%distributor%'");
  		$query = $this->db->get();
 		if ($query) {
			 return $query->result();
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
		$this->db->select('*');
    	$this->db->from('order_items');
    	$this->db->where('order_id',$order_id);
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
	public function get_items_by_id($id)
	{
		$this->db->select('*');
    	$this->db->from('order_items');
    	$this->db->where('id',$id);
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

	public function get_user_by_distributor_id($distributor_id) 
	{  
 		$this->db->select('*');
		$this->db->from('users');
		$this->db->where("distributor_id",$distributor_id);
		$query = $this->db->get();
 		if ($query) {
			 return $query->result_array();
		 } else {
			 return false;
		 }
   	}

   	public function get_user_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from('users');
		$this->db->where("user_id",$id);
		$query = $this->db->get();
 		if ($query) {
			 return $query->row();
		 } else {
			 return false;
		 }
   	}
	//create place order
	public function get_pro_att_by_product_id($product_id) 
	{  
		$this->db->select('att_id,att_name,att_value');
		$this->db->from($this->ProductAttribute);
		$this->db->where("product_id",$product_id);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->result_array();
		 } else {
			 return false;
		 }
   	}

   	public function get_productname_by_id($product_id) 
	{  
 		$this->db->select('name');
		$this->db->from($this->Product);
		$this->db->where("id",$product_id);
		$query = $this->db->get();
 		if ($query) {
			 return $query->row()->name;
		 } else {
			 return false;
		 }
   	}

   	public function get_attname_by_id($product_id) 
	{  
 		$this->db->select('products.id,attribute.att_name');
		$this->db->from('products');
		$this->db->join('attribute','attribute.att_id=products.attribute');
		$this->db->where('products.id',$product_id);

		$query = $this->db->get();
 		if ($query) {
			 return $query->row()->att_name;
		 } else {
			 return false;
		 }
   	}

   	public function add_order($data)
	{  
 		$res = $this->db->insert('orders', $data); 
		if($res == 1)
			return $this->db->insert_id();
		else
			return false;
 	}
 	public function get_order() 
	{  
 		$this->db->select('*');
		$this->db->from('orders');
		$this->db->order_by("id", "desc");
		$this->db->limit(1);
		$query = $this->db->get();
 		if ($query) {
			 return $query->row();
		 } else {
			 return false;
		 }
   	}
   	public function add_orderitems($data)
	{  
 		$res = $this->db->insert('order_items', $data);
 		if($res == 2)
			return true;
		else
			return false;
 	}
 	public function update_qty_by_id($id,$data)
	{
		$res = $this->db->update('order_items', $data ,['id' => $id ] ); 
		if($res == 1)
			return true;
		else
			return false;
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

