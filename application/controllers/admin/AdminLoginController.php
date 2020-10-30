<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminLoginController extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
    }

	public function index() 
	{
		$this->adminmodel->is_logged_in();
		$this->load->view('admin/login/Login_template');
	}
	//login
	public function authlogincheck()
	{
		$this->adminmodel->is_logged_in();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');  
		$this->form_validation->set_rules('password', 'Password', 'required'); 
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == FALSE)  
		{  
			$this->load->view('admin/login/Login_template');
		}  
		else  
		{  
			$username = $this->input->post('username');  
			$password = $this->input->post('password');  
			$user = $this->adminmodel->can_login($username, $password);
			if($user == TRUE)  
			{    

				$userdata = [
						'id'  => $user['id'],
						'username'  => $user['username'],
						'email'     => $user['email'],
						'name'     => $user['first_name']." ".$user['last_name'],
						'is_admin'     => $user['is_admin'],
						'logged_in' => 'TRUE'
				];
				$this->session->set_userdata(SESSION_ADMIN,$userdata);
				redirect('admin/dashboard');  
					
			}  
			else  
			{  
				$this->session->set_flashdata('error', 'Invalid Username and Password');  
				$this->load->view('admin/login/Login_template');
			}  
		}
	}
	//logout
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/login');
	}

	public function randomPassword() {
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 6; $i++) {
		    $n = rand(0, $alphaLength);
		    $pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}

	public function i_forgot_my_password(){
		$this->adminmodel->is_logged_in();
		if(!empty($_POST)){
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
			$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
			if($this->form_validation->run() == false)  
			{  
				//Error
			}
			else
			{
				$date = date('Y-m-d H:i:s',time());
				$time = date("H:i:s",strtotime($date));
				$min15 = strtotime("+15 minutes",strtotime($time));
				$temp_expiry = date('H:i:s', $min15);

				$temp_password = $this->randomPassword();
				$email = $_POST['email'];
				$check = $this->adminmodel->IfExistEmail($email);
				if(!$check){
					$this->session->set_flashdata('error', '<h4><i class="icon fa fa-ban"></i> Error! You enter a Wrong email ID.</h4>Please try again or later.');
				}else{

					$subject = "Zuma Corporation Reset Password";
					$key = $this->encrypt_decrypt('encrypt', $email);
					$link = "<a style='padding: 8px 12px; background-color: #3c8dbc; border-color: #367fa9; border-radius: 2px; font-size: 14px; color:#FFFFFF;text-decoration: none;display: inline-block;' class='btn btn-primary' href='".base_url()."admin/reset-password/".$key."'>Click To Reset password</a>";
					$description = "Your password will be expire in 15 Minutes. <br/>Your temp password is :- $temp_password" ;
					$message = "Welcome to Zuma Corporation,<br/>" .
					"You have requested for password reset. $description<br/>" .
					"<p>$link</p>" .  
					"Click On This Link to Reset Password <br/>" .
					base_url() . "admin/reset-password/" . $key . "<br/>" .
					"Thank you,<br/>";

					if($this->sendemail($email, $subject, $message, $key)){
						$this->adminmodel->updateData($email,array("temp_password"=>$temp_password,"temp_expiry"=>$temp_expiry ));
						$this->session->set_flashdata('success', '<h4><i class="icon fa fa-check"></i> Success! A Reset password has been sent to your email account.</h4>Please check your mailbox and click to link reset new password.');
						redirect('admin/login/');
					}else{
						$this->session->set_flashdata('error', '<h4><i class="icon fa fa-ban"></i> Error! Email not sent successfully.</h4>Please try again or later.');	
					}
				}
			}
		}
		$this->load->view('admin/login/forgot_password_template');
	}

	public function reset_password($key){
		$this->adminmodel->is_logged_in();
		$email = $this->encrypt_decrypt('decrypt',$key);
		if(!empty($_POST)){
			$this->form_validation->set_rules('temp_password', 'Tepm Password', 'required'); 
			$this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]'); 
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]'); 
			$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
			if($this->form_validation->run() == false)  
			{  
				//Error
			}
			else
			{
				$result = $this->adminmodel->_checkResetPassword($email, $_POST['temp_password']);
				if($result){
					if($result->is_expiry == 1){
						$this->session->set_flashdata('error', '<h4><i class="icon fa fa-ban"></i> Error! Your temp password has been expire.</h4>Please try again or later.');
					}else{
						$this->adminmodel->updateData($email, array('password'=>$_POST['new_password'],'temp_password'=>''));
						$this->session->set_flashdata('success', '<h4><i class="icon fa fa-check"></i> Success! Your password is reset successfully.</h4>Please you can login now.');
						redirect('admin/login/');
					}
					
				}else{
					$this->session->set_flashdata('error', '<h4><i class="icon fa fa-ban"></i> Error! Something went wrong.</h4>Please try again or later.');
				}
			}
		}
		$this->load->view('admin/login/reset_password_template');
	}

	public function user_profile()
	{
 		$this->load->view('admin/login/user_profile');
 	}

	public function change_photo()
	{
		$config['upload_path']   = './uploads/profiles/'; 
		$config['allowed_types'] = 'jpg|png|jpeg'; 
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('avatar_img')) 
		{
			$error = array('error' => $this->upload->display_errors());
	    	$this->session->set_flashdata('img_error',$error['error']);
			$this->load->view('admin/login/user_profile');
		}
		else
		{ 
			$img_file = $this->upload->data(); 
			$data = array('profile_image'=>$img_file['file_name']);
			$id = $_REQUEST['id'];
			$this->db->where('id', $id);
        	$this->db->update('admin', $data);
			$this->session->set_flashdata('img_success', 'Profile image has been updated Successfully.');
			$this->load->view('admin/login/user_profile');
		} 	
	}

 	public function user_update_profile_data()
	{ 
		$this->form_validation->set_rules('first_name', 'First Name', 'required');  
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');  
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');  
		$this->form_validation->set_rules('gender', 'Gender', 'required');  
		$this->form_validation->set_rules('dob', 'Date of Birth', 'required');
		$this->form_validation->set_rules('mobile_no', 'Mobile Number','required');
		$this->form_validation->set_rules('address', 'Adress', 'required');  
		$this->form_validation->set_rules('pincode', 'Pincode', 'required');  
		$this->form_validation->set_rules('city','City','required');  
		$this->form_validation->set_rules('state', 'State', 'required');  
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  
			$this->load->view('admin/login/user_profile');

		}
		else
		{
			$id = $_REQUEST['id'];
			$this->adminmodel->update_profile_data($id);
			$check = $this->adminmodel->update_profile_data($id);
			if($check)
			{
				$this->session->set_flashdata('success', 'Profile has been updated Successfully.');
				$this->load->view('admin/login/user_profile');
			}
		}  
		
 	}

 	//encrypt/decrypt
	public function encrypt_decrypt($action, $string) {
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'DrislingSecretKeyForResetPasswordkey';
		$secret_iv = 'DrislingSecretKeyForResetPasswordiv';
		// hash
		$key = hash('sha256', $secret_key);
		
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		if ( $action == 'encrypt' ) {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		} else if( $action == 'decrypt' ) {
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}
		return $output;
	}

	//send mail
	function sendemail($to, $subject, $message, $key)
	{
		$this->load->library('_phpmailer');
		$this->_phpmailer->_load();
	    $emailusername = $this->m_general->getSetting('smtp_email');//bips309@gmail.com
	    $emailpassword = $this->m_general->getSetting('smtp_pass'); //k@8000366136
	    $mail = new PHPMailer;
	    $mail->isSMTP();
	    $mail->Host = $this->m_general->getSetting('smtp_host');//smtp.gmail.com
	    $mail->SMTPAuth = true;
	    $mail->Username = $emailusername; 
	    $mail->Password = $emailpassword; 
	    $mail->SMTPSecure = 'tls';
	    $mail->Port = $this->m_general->getSetting('smtp_port');//587
	    $mail->SetFrom($this->m_general->getSetting('smtp_email'),$this->m_general->getSetting('name'));//bips309@gmail.com
	    //$mail->AddReplyTo("nakrani0108@gmail.com", "Try");
	    $mail->Subject = $subject;
	    $data['message'] = $message;
        $data['key'] = $key;
	    $mailContent = $this->load->view('frontend/email_template', $data, true);
	    $mail->MsgHTML($mailContent);
	    //$mail->addAttachment(__DIR__ ."//".$filename.".csv");
	    $mail->isHTML(true);   
	    $mail->addAddress($to);
	    //$mail->addAddress("another@gmail.com");
	    $result = $mail->Send();
	    return $message = $result ? true : false;
	    //echo $message = $result ? 'Successfully Sent!' : 'Sending Failed!';

	}

	public function change_admin_profile_password_update()
	{
		$this->load->library('form_validation');  
		$this->form_validation->set_rules('old_pwd', 'Current Password', 'required');  
		$this->form_validation->set_rules('new_pwd', 'New Password', 'required|min_length[8]|alpha_numeric');  
		$this->form_validation->set_rules('confirm_pwd', 'Confirm Password', 'required|matches[new_pwd]');  
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  
			$this->load->view('admin/login/user_profile');
		}
		else
		{
			$old_pwd = $this->input->post('old_pwd');
			$id = $this->input->post('id');
			$this->db->where('id',$id);
			$q = $this->db->get('users');
			$get_user = $q->row();
			if($old_pwd == $get_user->password)
			{
				$update_data = array('password'=>$this->input->post('new_pwd'));
				$this->db->where('id', $id);
	        	$this->db->update('users', $update_data);
				$this->session->set_flashdata('pwd_success', 'Your password has been Successfully updated.');
				$this->load->view('admin/login/user_profile');
			}
			else
			{
				$this->session->set_flashdata('pwd_error', 'Old password is wrong. Please try again.');
				$this->load->view('admin/login/user_profile');
			}	
		}  
  	}
  	public function translation_history()
  	{
  		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'transaction/transaction_history';
		$this->load->view('admin/template',$data);
  	}
}

