<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'user/list_user';
		$this->load->view('admin/template',$data);
	}

	public function create_user()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'user/add_user';
		$this->load->view('admin/template',$data);
	}

 	public function add_user()
 	{
 		
 		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('first_name','First Name','required|trim');
		$this->form_validation->set_rules('last_name','Last Name','required|trim');
		$this->form_validation->set_rules('email','Email','required|trim|is_unique[users.email]');
		$this->form_validation->set_rules('password','Password','required|trim');
		$this->form_validation->set_rules('mobile_no','Mobile','required|is_unique[users.mobile_no]|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('address','Address','required|trim');
		$this->form_validation->set_rules('aadhar_no','Aadhar Number','required|trim|is_unique[users.aadhar_no]|min_length[12]|max_length[12]|numeric|xss_clean');
		
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'first_name' => ucfirst($_REQUEST['first_name']), 
				'last_name' => $_REQUEST['last_name'], 
				'email' => $_REQUEST['email'],
				'password' => $_REQUEST['password'], 
				'mobile_no' => ucfirst($_REQUEST['mobile_no']), 
				'address' => ucfirst($_REQUEST['address']), 
				'aadhar_no' => ucfirst($_REQUEST['aadhar_no']),
				'type' => 'Salesman',
				'stamp' => date('Y-m-d H:i:s', time())
			);
			
			if (!empty($_FILES['image']['name']))
			{
			    $config['upload_path']   = './uploads/user/';
				$config['allowed_types'] = 'jpg|png|jpeg'; 
				$config['file_name'] = time()."_".$_FILES['image']['name'];
				$this->load->library('upload', $config);
				
				if (!$this->upload->do_upload('image')) 
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('img_error',$error['error']);
				}
				else
				{ 
					$img_file = $this->upload->data(); 
					$params['image'] = time()."_".$_FILES['image']['name'];
				}
			}
			else{
				$params['image'] = "default_profile.png";
			}
			
			$check = $this->usermodel->add_user($params);
			
			if($check)
			{
				$this->session->set_flashdata('add_success', 'User has been added Successfully..');
				redirect('admin/user-list/all');
			}

		}
		$data['page'] = 'user/add_user';
		$this->load->view('admin/template',$data);
  	}

	public function edit_user()
	{
		$this->adminmodel->CSRFVerify();
		$user_id = $_REQUEST['user_id'];
		$data['page'] = 'user/edit_user';
		$data['user'] = $this->usermodel->get_user_by_id($user_id); 
		$this->load->view('admin/template',$data);
 	}

  	public function update_user()
  	{
  		$this->adminmodel->CSRFVerify();
  		$user_id = $_REQUEST['user_id'];
		$data['user'] = $this->usermodel->get_user_by_id($user_id); 

		$original_value = $this->db->query("SELECT email FROM users WHERE user_id = ".$user_id)->row()->email ;
	    if($_REQUEST['email'] != $original_value) {
	       $is_unique =  '|is_unique[users.email]';
	    } else {
	       $is_unique =  '';
	    }
	    $u_original_value = $this->db->query("SELECT mobile_no FROM users WHERE user_id = ".$user_id)->row()->mobile_no ;
	    if($_REQUEST['mobile_no'] != $u_original_value) {
	       $u_is_unique =  '|is_unique[users.mobile_no]';
	    } else {
	       $u_is_unique =  '';
	    }

	    $a_original_value = $this->db->query("SELECT aadhar_no FROM users WHERE user_id = ".$user_id)->row()->aadhar_no ;
	    if($_REQUEST['aadhar_no'] != $a_original_value) {
	       $a_is_unique =  '|is_unique[users.aadhar_no]';
	    } else {
	       $a_is_unique =  '';
	    }
  		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('first_name','First Name','required|trim');
		$this->form_validation->set_rules('last_name','Last Name','required|trim');
		$this->form_validation->set_rules('email','Email','required|trim'.$is_unique);
		$this->form_validation->set_rules('password','Password','required|trim');
		$this->form_validation->set_rules('mobile_no','Mobile','required|trim|regex_match[/^[0-9]{10}$/]'.$u_is_unique);
		$this->form_validation->set_rules('address','Address','required|trim');
		$this->form_validation->set_rules('aadhar_no','Aadhar Number','required|trim|min_length[12]|max_length[12]|numeric|xss_clean'.$a_is_unique);
		
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'first_name' => ucfirst($_REQUEST['first_name']), 
				'last_name' => $_REQUEST['last_name'], 
				'email' => $_REQUEST['email'],
				'password' => $_REQUEST['password'], 
				'mobile_no' => ucfirst($_REQUEST['mobile_no']), 
				'address' => ucfirst($_REQUEST['address']), 
				'aadhar_no' => ucfirst($_REQUEST['aadhar_no']),
				'type' => 'Salesman',
			);
			
			if (!empty($_FILES['image']['name']))
			{
			    $config['upload_path']   = './uploads/user/';
				$config['allowed_types'] = 'jpg|png|jpeg'; 
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('image')) 
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('img_error',$error['error']);
				}
				else
				{ 
					$image_name = $this->usermodel->get_image($user_id);
					if($image_name != 'default_profile.png')
					{
						$path = './uploads/user/'.$image_name;
						unlink($path);
					}
					$img_file = $this->upload->data(); 
					$params['image'] = $img_file['file_name'];
				}
			}
			
			$check = $this->usermodel->update_user_by_id($user_id,$params);
			if($check)
			{
				$this->session->set_flashdata('add_success', 'User has been updated Successfully..');
				redirect('admin/user-list/all');
			}
		}
		$data['page'] = 'user/edit_user';
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_user()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['user_id']))
		{
			$user_id = $_REQUEST['user_id'];
			$image = $this->usermodel->get_image($user_id);
			if($image != 'default_profile.png')
			{
				$path = './uploads/user/'.$image;
				unlink($path);
			}
			$this->db->where('user_id', $user_id);
			$this->db->delete("users");
			$this->session->set_flashdata('del_success','User has been Successfully Deleted.');
			redirect('admin/user-list/all');
		}
	}
	public function user_details()
		{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'user/user_details';
		$this->load->view('admin/template',$data);
	}
}

