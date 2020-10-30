<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class HomeModel extends CI_Model
{
  	public function product_menu()
  	{
		$query = $this->db->get('category');
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
		}
	}

	public function all_product()
	{
		$this->db->select('*');
		$this->db->from('products');
		$query = $this->db->get();
 		if ($query) {
			 return $query->result();
		 } else {
			 return array();
		 }
	}

	public function get_product_by_id($product_id) 
	{  
 		$this->db->select('*');
		$this->db->from('products');
		$this->db->where("id",$product_id);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
   	}

   	public function get_att_by_productid($product_id)
   	{
   		$this->db->select('att_name,att_id');
		$this->db->from('product_attribute');
		$this->db->where("product_id",$product_id);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->result();
		 } else {
			 return false;
		 }
   	}

   	public function get_attribute_title($att_id)
   	{
   		$this->db->select('att_name');
		$this->db->from('attribute');
		$this->db->where("att_id",$att_id);
		$query = $this->db->get();
		if ($query) {
			return $query->row()->att_name;
		} else {
			return false;
		}
   	}

   	public function get_productid_by_slug($product_slug) 
	{ 
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where("slug",$product_slug);
		$query = $this->db->get();
		if ($query) {
			return $query->row('id');
		} else {
			return false;
		}
	}

	public function get_all_pro()
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->limit(8);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		if ($query) {
			 return $query->result();
		 } else {
			 return array();
		 }
	}

	public function get_all_hot_products() 
	{  
 		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('is_hot',1);
		$query = $this->db->get();
		if($query){
			 return $query->result();
		 } else {
			 return false;
		 }	
   	}

	public function get_product_by_name($name) 
	{  
 		$this->db->select('id');
		$this->db->from('products');
		$this->db->where('name',$name);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			 return $query->row()->id;
		 } else {
			 return false;
		 }	
   	}

	public function products_by_cat($cat_name)
	{
		$cat_id = $this->get_category_id($cat_name);
		$this->db->select('id,name,product_image');
		$this->db->from('products');
		$this->db->where("category",$cat_id);
		$query = $this->db->get();
 		if($query->num_rows() > 0){
			 return $query->result();
		 } else {
			 return array();
		 }	
	}

	public function get_category_id($cat_name)
	{
		$this->db->select('id');
		$this->db->from('category');
		$this->db->where('name',$cat_name);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			 return $query->row()->id;
		 } else {
			 return false;
		 }	
	}

	public function add_contact($data)
	{  
 		$res = $this->db->insert('contact_details', $data); 
		if($res == 1)
			return true;
		else
			return false;
 	}
	

	public function all_category()
	{
		$sql = "SELECT c.* FROM category c WHERE c.id IN ( SELECT s.subcat_parentid FROM subcategory s WHERE s.subcat_id IN ( SELECT p.subcategory  FROM products p WHERE p.subcategory = s.subcat_id) AND s.subcat_parentid = c.id  ) ORDER BY c.id ASC";
		$query = $this->db->query($sql);
 		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return false;
		}
	}

	public function all_slider()
	{
		$this->db->select('slider_id,slider_image');
		$this->db->from('slider');
		$query = $this->db->get();
 		if($query->num_rows() > 0){
			 return $query->result_array();
		 } else {
			 return array();
		 }
	}
	public function all_brand()
	{
		$this->db->select('*');
		$this->db->from('brand_slider');
		$query = $this->db->get();
 		if($query->num_rows() > 0){
			 return $query->result_array();
		 } else {
			 return array();
		 }
	}

	public function getCategoryId($subcate_id){
		$this->db->select('subcat_parentid');
		$this->db->from('subcategory');
		$this->db->where("subcat_id",$subcate_id);
		$query = $this->db->get();
 		if($query->num_rows() > 0){
			 return $query->row()->subcat_parentid;
		 } else {
			 return 0;
		 }
	}
	
	public function get_products_by_subcategory($subcate_id)
	{
	    $this->db->where('subcate_id', $subcate_id);
	    $query = $this->db->get('products');
	    if($query->num_rows() > 0){
			 return $query->result_array();
		 } else {
			 return array();
		 }
	}
	
	public function subcat_products($subcate_id)
	{
	    $this->db->where('subcate_id', $subcate_id);
	    $query = $this->db->get('products');
	    if($query->num_rows() > 0){
			 return $query->result_array();
		 } else {
			 return array();
		 }
	}
	
	public function get_products_by_id($subcat_parentid)
	{
		$this->db->select('*');
		$this->db->from('subcategory');
		$this->db->where("subcat_parentid",$subcat_parentid);
		$query = $this->db->get();
		$subcategory = $query->result();
		$data = array();
		foreach ($subcategory as $row) { 
			$param = array(
			'sub_id'=>$row->subcat_id,	
			'sub_cat_name'=>$row->subcat_name,
			'slug'=>$row->slug,
			'product'=>$this->get_product_by_subcatID($row->subcat_id)
			);
			array_push($data, $param);
		}
		return $data;
	}

	public function get_product_by_subcatID($subcategory)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where("subcategory",$subcategory);
		$this->db->limit(3);
		$query = $this->db->get();
		if ($query) {
			return $query->result();
		} else {
			return array();
		}
	}

	public function get_product_by_subcat_id($subcategory)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where("subcategory",$subcategory);
		$query = $this->db->get();
		if ($query) {
			return $query->result();
		} else {
			return array();
		}
	}

	public function get_catid_by_slug($slug)
	{
		$this->db->select('id');
		$this->db->from('category');
		$this->db->where('slug',$slug);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			 return $query->row()->id;
		 } else {
			 return false;
		 }	
	}
	// get_catname_by_slug
	public function get_catname_by_slug($slug)
	{
		$this->db->select('*');
		$this->db->from('category');
		$this->db->where('slug',$slug);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			 return $query->row()->slug;
		 } else {
			 return false;
		 }	
	}

	public function get_catname_slug($slug)
	{
		$this->db->select('name');
		$this->db->from('category');
		$this->db->where('slug',$slug);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			 return $query->row()->name;
		 } else {
			 return false;
		 }	
	}

	public function get_subcatname_slug($slug)
	{
		$this->db->select('subcat_name');
		$this->db->from('subcategory');
		$this->db->where('slug',$slug);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			 return $query->row()->subcat_name;
		 } else {
			 return false;
		 }	
	}

	public function get_subcatid_by_name($subcat_name)
	{
		$this->db->select('subcat_id');
		$this->db->from('subcategory');
		$this->db->where('slug',$subcat_name);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			 return $query->row()->subcat_id;
		 } else {
			 return false;
		 }	
	}

	public function get_productid_by_name($product_name)
	{
		$this->db->select('id');
		$this->db->from('products');
		$this->db->where('name',$product_name);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			 return $query->row()->id;
		 } else {
			 return false;
		 }	
	}

	public function get_category_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from('category');
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
   	}

   	public function get_subcategory_by_id($subcat_id) 
	{  
 		$this->db->select('*');
		$this->db->from('subcategory');
		$this->db->where("subcat_id",$subcat_id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row();
		 } else {
			 return false;
		 }
   	}

   	public function get_all_cat_tree()
	{	
		$sql = "SELECT c.id, c.name, c.slug
				FROM category c
				WHERE 
					c.id
				IN (
					SELECT s.subcat_parentid
					FROM subcategory s
					WHERE s.subcat_parentid = c.id
					AND (

						SELECT COUNT( p.subcategory ) 
						FROM products p
						WHERE s.subcat_id = p.subcategory
					) > 0
				)";
	    $query = $this->db->query($sql);
	    $return = array();

	    foreach ($query->result() as $category)
	    {
	        $return[$category->id] = $category;
	        $return[$category->id]->subs = $this->get_sub_categories($category->id);
		}
		return $return;
	}

	public function get_sub_categories($category_id)
	{
		$sql = "SELECT s.subcat_id, s.subcat_name, s.subcat_parentid, s.slug FROM subcategory s WHERE s.subcat_id IN ( SELECT p.subcategory FROM products p WHERE s.subcat_id = p.subcategory  )
			AND s.subcat_parentid = ?";
			    $query = $this->db->query($sql,array($category_id));
			    if($query->num_rows() > 0){
					 return $query->result_array();
				} else {
					 return array();
		 		}
	}

	public function add_rating($data)
	{  
 		$res = $this->db->insert('rating', $data); 
		if($res == 1)
			return true;
		else
			return false;
 	}

//end
}


