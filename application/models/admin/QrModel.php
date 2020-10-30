<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class QrModel extends CI_Model
{
  	public function __construct()
        {
                parent::__construct();
        } 
	
	public $Qrcode = 'qrcode';
	//use
	public function get_all_qr()
	{
		$this->db->order_by("id","desc");
		$query = $this->db->get('Qrcode');
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return false;
		}
	}
	//use
	public function add_qr($data)
	{  
 		$res = $this->db->insert($this->Qrcode,$data); 
		if($res == 1)
			return true;
		else
			return false;

 	}

 	public function get_qrcode_by_product($product_id) 
	{  
 		$this->db->select('*');
		$this->db->from('qrcode');
		$this->db->where("product_id",$product_id);
		$query = $this->db->get();
 		if ($query) {
			 return $query->result_array();
		 } else {
			 return false;
		 }
   	}

 	//use
 	public function get_qr_by_id($product_id) 
	{  
 		$this->db->select('*');
		$this->db->from('qrcode');
		$this->db->where("product_id",$product_id);
  		$query = $this->db->get();
 		if ($query) {
			return $query->result_array();
	 	} else {
			return false;
	 	}
   	}

	public function update_qr_by_id($qrcode_id,$data)
	{
		$res = $this->db->update($this->Qrcode, $data ,['id' => $Qrcode_id ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}

	public function get_qrcode_by_product_id($product_id,$count) 
	{  
 		$this->db->select('*');
		$this->db->from('qrcode');
		$this->db->where("product_id",$product_id);
		$this->db->limit($count);
		$query = $this->db->get();
 		if ($query) {
			 return $query->result_array();
		 } else {
			 return false;
		 }
   	}

   	public function get_qrcode_by_count($id) 
	{  
 		$this->db->select('count');
		$this->db->from('qrcode');
		$this->db->order_by('id','desc');
		$this->db->where('product_id',$id);
		$this->db->limit(1);
		$query = $this->db->get();
 		if ($query) {
			 return $query->row()->count;
		 } else {
			 return false;
		 }
   	}

   	public function get_qrcode_by_point($id) 
	{  
 		$this->db->select('point');
		$this->db->from('qrcode');
		$this->db->order_by('id','desc');
		$this->db->where('product_id',$id);
		$this->db->limit(1);
		$query = $this->db->get();
 		if ($query) {
			 return $query->row()->point;
		 } else {
			 return false;
		 }
   	}
}
