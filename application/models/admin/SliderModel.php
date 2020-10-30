<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SliderModel extends CI_Model
{
  	public function __construct()
    {
        parent::__construct();
    } 
	
	private $Slider = 'slider';
	//use
	public function get_all_slider()
	{
		$this->db->order_by("slider_id", "desc");
		$query = $this->db->get('slider');
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return false;
		}
	}
	//use
	public function add_slider($data)
	{  
		$res = $this->db->insert($this->Slider, $data); 
		if($res == 1)
			return true;
		else
			return false;
	}

	public function get_image($id)
	{  
 		$this->db->select('slider_image');
		$this->db->from($this->Slider);
		$this->db->where("slider_id",$id);
		$query = $this->db->get();
		if ($query){
			 return $query->row()->slider_image;
		 } else {
			 return false;
		 }
   	} 
 }
