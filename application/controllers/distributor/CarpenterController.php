<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CarpenterController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->d_distributormodel->not_logged_in();
    }

 	public function index()
 	{
 		$this->d_distributormodel->CSRFVerify();
 		$data['page'] = 'carpenter/list_carpenter';
		$this->load->view('distributor/template',$data);
	}

	public function create_carpenter()
	{
		$this->d_distributormodel->CSRFVerify();
		$data['page'] = 'carpenter/add_carpenter';
		$this->load->view('distributor/template',$data);
	}

 	public function add_carpenter()
 	{
 		$this->d_distributormodel->CSRFVerify();
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
				'distributor_id' => $_REQUEST['distributor_id'],
				'first_name' => ucfirst($_REQUEST['first_name']), 
				'last_name' => $_REQUEST['last_name'], 
				'email' => $_REQUEST['email'],
				'password' => $_REQUEST['password'], 
				'mobile_no' => ucfirst($_REQUEST['mobile_no']), 
				'address' => ucfirst($_REQUEST['address']), 
				'aadhar_no' => ucfirst($_REQUEST['aadhar_no']),
				'type' => 'carpenter',
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
			$check = $this->carpentermodel->add_carpenter($params);
			
			if($check)
			{
				$this->session->set_flashdata('add_success', 'Carpenter has been added Successfully..');
				redirect('distributor/carpenter-list');
			}

		}
		$data['page'] = 'carpenter/add_carpenter';
		$this->load->view('distributor/template',$data);
  	}

	public function edit_carpenter()
	{
		$this->d_distributormodel->CSRFVerify();
		$user_id = $_REQUEST['user_id'];
		$data['page'] = 'carpenter/edit_carpenter';
		$data['user'] = $this->carpentermodel->get_carpenter_by_id($user_id); 
		$this->load->view('distributor/template',$data);
 	}

  	public function update_carpenter()
  	{
  		$this->d_distributormodel->CSRFVerify();
  		$user_id = $_REQUEST['user_id'];
		$data['user'] = $this->carpentermodel->get_carpenter_by_id($user_id); 

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
  		$this->d_distributormodel->CSRFVerify();
		$this->form_validation->set_rules('first_name','First Name','required|trim');
		$this->form_validation->set_rules('last_name','Last Name','required|trim');
		$this->form_validation->set_rules('email','Email','required|trim'.$is_unique);
		$this->form_validation->set_rules('password','Password','required|trim');
		$this->form_validation->set_rules('mobile_no','Mobile','required|trim|regex_match[/^[0-9]{10}$/]'.$u_is_unique);
		$this->form_validation->set_rules('address','Address','required|trim');
		$this->form_validation->set_rules('aadhar_no','Aadhar Number','required|trim|min_length[12]|max_length[12]|numeric|xss_clean');
		
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'distributor_id' => $_REQUEST['distributor_id'],
				'first_name' => ucfirst($_REQUEST['first_name']), 
				'last_name' => $_REQUEST['last_name'], 
				'email' => $_REQUEST['email'],
				'password' => $_REQUEST['password'], 
				'mobile_no' => ucfirst($_REQUEST['mobile_no']), 
				'address' => ucfirst($_REQUEST['address']), 
				'aadhar_no' => ucfirst($_REQUEST['aadhar_no']),
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
					
					$image_name = $this->carpentermodel->get_image($user_id);
					if($image_name != 'default_profile.png')
					{
						$path = './uploads/user/'.$image_name;
						unlink($path);
					}
					$img_file = $this->upload->data(); 
					$params['image'] = $img_file['file_name'];
				}
			}
			
			$check = $this->carpentermodel->update_carpenter_by_id($user_id,$params);
			if($check)
			{
				$this->session->set_flashdata('add_success', 'Carpenter has been updated Successfully..');
				redirect('distributor/carpenter-list');
			}
		}
		$data['page'] = 'carpenter/edit_carpenter';
		$this->load->view('distributor/template',$data);
  	}
  	
	public function trash_carpenter()
	{ 
		$this->d_distributormodel->CSRFVerify();
		if(!empty($_REQUEST['user_id']))
		{
			$user_id = $_REQUEST['user_id'];
			$image = $this->carpentermodel->get_image($user_id);
			if($image != 'default_profile.png')
			{
				$path = './uploads/user/'.$image;
				unlink($path);
			}
			$this->db->where('user_id', $user_id);
			$this->db->delete("users");
			$this->session->set_flashdata('del_success','Carpenter has been Successfully Deleted.');
			redirect('distributor/carpenter-list');
		}
	}
	public function carpenter_translation_history()
  	{
  		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'carpenter/transaction_history';
		$this->load->view('distributor/template',$data);
  	}
}

