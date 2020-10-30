<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ContactusModel extends CI_Model
{
  	public function __construct()
        {
                parent::__construct();
        } 
	
	private $Contact_us = 'contact_details';

	public function get_all_contactus()
	{
		$query = $this->db->get($this->Contact_us);
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return false;
		}
	}

}
