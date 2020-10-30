<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ProductModel extends CI_Model
{
  	public function __construct()
        {
                parent::__construct();
        } 
	
	public $Product = 'products';
	public $qr_history = 'qr_history';
	//use
	public function get_all_product()
	{	
		$sql = "
			SELECT p.id, p.name, p.description,p.code, p.product_image,p.is_hot, p.installation_guide_images, p.installation_guide_videos,c.name category,sc.subcat_name subcategory
			FROM  products p
			LEFT JOIN category c ON p.category = c.id
			LEFT JOIN subcategory sc ON p.subcategory = sc.subcat_id 
			WHERE 1 ORDER BY id DESC";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return false;
		}
	}
	//use
	public function add_product($data)
	{  
 		$res = $this->db->insert($this->Product, $data);
 		$insert_id = $this->db->insert_id(); 
		if($res == 1)
			return $insert_id;
		else
			return false;
 	}

 	//use
 	public function get_product_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Product);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
   	}

   	public function get_product_by_subcategory($subcategory) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Product);
		$this->db->where("subcategory",$id);
		$query = $this->db->get();
 		if ($query) {
			 return $query->row();
		 } else {
			 return false;
		 }
   	}

    public function get_product_by_slug($slug) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Product);
		$this->db->where("slug",$slug);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
   	}
	public function update_product_by_id($id,$data)
	{
		$res = $this->db->update($this->Product, $data ,['id' => $id ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}
	//get product installation guide image image
	public function get_pro_installimg_by_id($product_id) 
	{  
 		$this->db->select('installation_guide_images');
		$this->db->from($this->Product);
		$this->db->where("id",$product_id);
		$query = $this->db->get();
 		if ($query) {
			 return $query->row()->installation_guide_images;
		 } else {
			 return false;
		 }
   	}
   	//get product  image
	public function get_productimg_by_id($product_id) 
	{  
 		$this->db->select('product_image');
		$this->db->from($this->Product);
		$this->db->where("id",$product_id);
		$query = $this->db->get();
 		if ($query) {
			 return $query->row()->product_image;
		 } else {
			 return false;
		 }
   	}

   		//get product  image
	public function get_about_product_by_id($product_id) 
	{  
 		$this->db->select('about_product');
		$this->db->from($this->Product);
		$this->db->where("id",$product_id);
		$query = $this->db->get();
 		if ($query) {
			 return $query->row()->about_product;
		 } else {
			 return false;
		 }
   	}

   	public function get_row_by_id($product_id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Product);
		$this->db->where("id",$product_id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
   	}

   		public function get_qr_history($product_id)
		{
			$this->db->select('qr_history.*,products.name as product_name,users.first_name,users.last_name');
			$this->db->from($this->qr_history);
			$this->db->join('products','products.id=qr_history.product_id','inner');
			$this->db->join('users','users.user_id=qr_history.user_id','inner');
			$this->db->where('qr_history.product_id',$product_id);

			$query = $this->db->get();
			if ($query->num_rows() > 0)
			{
				return $query->result();
			} else {
				return array();
			}
		}

}
