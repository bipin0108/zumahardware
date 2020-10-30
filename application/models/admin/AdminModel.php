<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {

  	public function __construct()
        {
                parent::__construct();
        }
	
	private $User = 'admin';
	
	public function is_logged_in()
	{  
 		if(isset($this->session->userdata[SESSION_ADMIN]['logged_in']) == 'TRUE' ){
			redirect(base_url('admin/dashboard'));
		} 
  	}
 	public function not_logged_in()
	{  
 		if($this->session->userdata[SESSION_ADMIN]['logged_in'] != 'TRUE' ){
			redirect('admin/login');
		} 
  	}
  	
	//use
  	public function GetUserData()
	{  
 		$this->db->select('id,username,first_name,last_name,email,dob,gender,mobile_no,address,profile_image,city,state,pincode');
		$this->db->from($this->User);
		$this->db->where("id",$this->session->userdata[SESSION_ADMIN]['id']);
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
	function can_login($username, $password)  
	{  
		$this->db->select("*");
		$this->db->from($this->User);
		$this->db->where("username",$username);
		$this->db->where("password",$password);
		$this->db->where("status",1);
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
		$gender = $_REQUEST['gender'];
		$dob = $_REQUEST['dob'];
		$mobile_no = $_REQUEST['mobile_no'];
		$address = $_REQUEST['address'];
		$pincode = $_REQUEST['pincode'];
		$city = ucfirst($_REQUEST['city']);
		$state = ucfirst($_REQUEST['state']);
		$data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'gender' => $gender,
            'dob' => $dob,
            'mobile_no' => $mobile_no,
            'address' => $address,
            'pincode' => $pincode,
            'city' => $city,
            'state' => $state
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
		$res = $this->db->update('admin', $data ,['email' => $email ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}

	public function _checkResetPassword($email, $temp_password){
		$time = date('H:i:s');

		$sql = 'SELECT *, if( temp_expiry > ? , 0 , 1 ) is_expiry FROM admin WHERE email=? AND temp_password=?';
		$query = $this->db->query($sql,array($time,$email,$temp_password));
 		if($query->num_rows() > 0){
			return $query->row();
		} else {
			return false;
		}
	}
	
	public function transaction_history()
	{
		$sql="SELECT t.id, REPLACE(t.from_u,'_d','') from_u, 
			if(t.from_u = 0,
				'Zuma Corporation',
				if( t.from_u = concat(REPLACE(t.from_u,'_d',''),'_d'),
					concat(fd.first_name,' ',fd.last_name,' (Distributor)'),
					concat(fu.first_name,' ',fu.last_name,' (',fu.type,')')
				)
			) from_name, 
			REPLACE(t.to_u,'_d','') to_u, 
			if(t.to_u = 0,
				'Zuma Corporation',
				if( t.to_u = concat(REPLACE(t.to_u,'_d',''),'_d'),
					concat(td.first_name,' ',td.last_name,' (Distributor)'),
					concat(tu.first_name,' ',tu.last_name,' (',tu.type,')')
				)
			) to_name, 
			t.point, t.transfer_date,if(t.to_u=0,'credit','debit') AS status 
	FROM transfer_history as t
	LEFT JOIN users as fu ON t.from_u = fu.user_id
	LEFT JOIN users as tu ON t.to_u = tu.user_id
	LEFT JOIN distributor as fd ON REPLACE(t.from_u,'_d','') = fd.id
	LEFT JOIN distributor as td ON REPLACE(t.to_u,'_d','') = td.id
	WHERE t.from_u=0 
	OR t.to_u=0 ORDER BY t.id DESC";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0){
				$result = $query->result();
				return $result;
			}else{
				return false;
			}
	}

 
 }