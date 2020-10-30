<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class NotificationModel extends CI_Model
{
  	public function __construct()
    {
            parent::__construct();
    }
    private $User = 'users';
    private $Distributor = 'distributor';
    private $notification = 'notification';

    public function get_selected_user($user_type)
    {
    	$device_token_str = array();
    	foreach ($user_type as $value) {
        
            $dis_token = array();
            $user_token = array();
    		if($value == 'distributor')
    		{
    			$sql = 'SELECT device_token FROM distributor';
    			$query = $this->db->query($sql);
    			$dis_token = $query->result_array();
    		}
    		else
    		{
    			$sql='SELECT device_token FROM users where type=?';
    			$query = $this->db->query($sql,array($value));
    			$user_token = $query->result_array();
    			
			}	
			$device_token_str = array_merge($dis_token,$user_token);
			
    	}
    	//print_r($device_token_str);die;
    	
    	return $device_token_str;
    } 

    public function add_notification($data)
    {  
        $res = $this->db->insert($this->notification, $data); 
        if($res == 1)
            return true;
        else
            return false;
    }
}