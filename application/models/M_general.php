<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_general extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function count($table,$params=array()){
		$this->db->select("*");
		$this->db->from($table);
		foreach($params as $k=>$v){
			$this->db->where($k,$v);
		}
		$query=$this->db->get();
		
		return $query->num_rows();
	}

    function getSetting($key){

        $this->db->select("s_value");
        $this->db->from("settings");
        $this->db->where("s_key",$key);
    	$query = $this->db->get();

		if($query->num_rows() > 0){
			$result = $query->row();
			return $result->s_value;
		}else{
			return false;
		}
    }
     function setSetting($key,$val){
        $this->db->where("s_key",$key);
   		$this->db->update("settings",array("s_value"=>$val));
		return true;
    }

}
?>
