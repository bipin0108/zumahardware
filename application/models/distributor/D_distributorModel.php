<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class D_distributorModel extends CI_Model {

  	public function __construct()
    {
            parent::__construct();
    }
	
	private $User = 'distributor';
	
	public function is_logged_in()
	{  
 		if(isset($this->session->userdata[SESSION_USER]['logged_in']) == 'TRUE' ){
			redirect(base_url('distributor/dashboard'));
		} 
  	}
 	public function not_logged_in()
	{  
 		if($this->session->userdata[SESSION_USER]['logged_in'] != 'TRUE' ){
			redirect('distributor/login');
		} 
  	}
  	
	//use
  	public function GetUserData()
	{  
 		$this->db->select('*');
		$this->db->from($this->User);
		$this->db->where("id",$this->session->userdata[SESSION_USER]['id']);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
   	}
	public function IfExistEmail($email){
		 
		 $this->db->select('*'); 
		 $this->db->from($this->User);
		 $this->db->where('email', $email);
		 $query = $this->db->get();
		 if ($query->num_rows() != 0) {
			  return $query->row_array();
		 } else {
			 return false;
		 }
	}
	

 	public function SMTP_Config(){
		
		$config = Array(
					'protocol' => 'smtp',
					'smtp_host' => 'mail.yourhost.com',
					'smtp_port' => 587,
					'smtp_user' => 'user@domain.com',
					'smtp_pass' => 'password',
					'mailtype' => 'text/html',
					'newline' => '\r\n',
					'charset' => 'utf-8'
			);
		$this->load->library('email', $config);		
	}

	//use
	function can_login($email, $password)  
	{  
		$this->db->select("*");
		$this->db->from($this->User);
		$this->db->where("email",$email);
		$this->db->where("password",$password);
		$result=$this->db->get();
		if($result->num_rows()>0){
			return $result->row_array();  
		}else{
			return false;
		}
	}
	function update_profile_data($id)
	{
		$first_name = trim(ucfirst($_REQUEST['first_name']));
		$last_name = trim(ucfirst($_REQUEST['last_name']));
		$email = $_REQUEST['email'];
		$mobile_no = $_REQUEST['mobile_no'];
		$address = $_REQUEST['address'];
		$aadhar_no = $_REQUEST['aadhar_no'];
		$data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'mobile_no' => $mobile_no,
            'address' => $address,
            'aadhar_no' => $aadhar_no
        );
		$this->db->where('id', $id);
        return $this->db->update($this->User, $data);
	}

	public function CSRFVerify()
	{ 
		error_reporting(0);
		$headers = apache_request_headers();
 		$csrf_token = $headers['Authkey'];
		 
		if($this->security->get_csrf_hash() === $csrf_token){
			return;
		}else{
			echo json_encode([ 'code' => 400, 'error' => 'Bad request ,Unknown User!' ]);
			die;
		}
 	}

 	public function updateData($email, $data)
	{
		$res = $this->db->update('distributor', $data ,['email' => $email ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}

	public function _checkResetPassword($email, $temp_password){
		$time = date('H:i:s');

		$sql = 'SELECT *, if( temp_expiry > ? , 0 , 1 ) is_expiry FROM distributor WHERE email=? AND temp_password=?';
		$query = $this->db->query($sql,array($time,$email,$temp_password));
 		if($query->num_rows() > 0){
			return $query->row();
		} else {
			return false;
		}
	}

	public function get_distributor_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->User);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
   	}

   	public function get_admin() 
	{  
 		$this->db->select('*');
		$this->db->from('admin');
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
   	}

   	public function update_admin_points($id,$data)
	{
		$res = $this->db->update('admin', $data ,['id' => $id ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}

	public function update_distributor_points($id,$data)
	{
		$res = $this->db->update('distributor', $data ,['id' => $id ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}

	public function add_transfer_history($params)
	{  
 		$res = $this->db->insert('transfer_history', $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}
}
