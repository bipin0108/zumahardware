<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DistributorController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'distributor/list_distributor';
		$this->load->view('admin/template',$data);
	}

	public function create_distributor()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'distributor/add_distributor';
		$this->load->view('admin/template',$data);
	}

 	public function add_distributor()
 	{
 		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('first_name','First Name','required|trim');
		$this->form_validation->set_rules('last_name','Last Name','required|trim');
		$this->form_validation->set_rules('email','Email','required|trim|is_unique[distributor.email]');
		$this->form_validation->set_rules('password','Password','required|trim');
		$this->form_validation->set_rules('mobile_no','Mobile','required|is_unique[distributor.mobile_no]|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('address','Address','required|trim');
		$this->form_validation->set_rules('aadhar_no','Aadhar Number','required|trim|is_unique[distributor.aadhar_no]|min_length[12]|max_length[12]|numeric|xss_clean');
		
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
				'stamp' => date('Y-m-d H:i:s', time())
			);
			
			if (!empty($_FILES['image']['name']))
			{
			    $config['upload_path']   = './uploads/distributor/';
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
			
			$check = $this->distributormodel->add_distributor($params);
			
			if($check)
			{
				$this->session->set_flashdata('add_success', 'Distributor has been added Successfully..');
				redirect('admin/distributor-list');
			}

		}
		$data['page'] = 'distributor/add_distributor';
		$this->load->view('admin/template',$data);
  	}

	public function edit_distributor()
	{
		$this->adminmodel->CSRFVerify();
		$id = $_REQUEST['id'];
		$data['page'] = 'distributor/edit_distributor';
		$data['distributor'] = $this->distributormodel->get_distributor_by_id($id); 
		$this->load->view('admin/template',$data);
 	}

  	public function update_distributor()
  	{

  		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
		$data['distributor'] = $this->distributormodel->get_distributor_by_id($id); 

		$original_value = $this->db->query("SELECT email FROM distributor WHERE id = ".$id)->
		row()->email;
	    if($_REQUEST['email'] != $original_value) {
	       $is_unique =  '|is_unique[distributor.email]';
	    } else {
	       $is_unique =  '';
	    }
	    $m_original_value = $this->db->query("SELECT mobile_no FROM distributor WHERE id = ".$id)->row()->mobile_no ;
	    if($_REQUEST['mobile_no'] != $m_original_value) {
	       $m_is_unique =  '|is_unique[distributor.mobile_no]';
	    } else {
	       $m_is_unique =  '';
	    }

	    $a_original_value = $this->db->query("SELECT aadhar_no FROM distributor WHERE id = ".$id)->row()->aadhar_no ;
	    if($_REQUEST['aadhar_no'] != $a_original_value) {
	       $a_is_unique =  '|is_unique[distributor.aadhar_no]';
	    } else {
	       $a_is_unique =  '';
	    }
  		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('first_name','First Name','required|trim');
		$this->form_validation->set_rules('last_name','Last Name','required|trim');
		$this->form_validation->set_rules('email','Email','required|trim'.$is_unique);
		$this->form_validation->set_rules('password','Password','required|trim');
		$this->form_validation->set_rules('mobile_no','Mobile','required|trim|regex_match[/^[0-9]{10}$/]'.$m_is_unique);
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
			);
			
			if (!empty($_FILES['image']['name']))
			{
			    $config['upload_path']   = './uploads/distributor/';
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
					
					$image_name = $this->distributormodel->get_image($id);
					if($image_name != 'default_profile.png')
					{
						$path = './uploads/distributor/'.$image_name;
						unlink($path);
					}
					$img_file = $this->upload->data(); 
					$params['image'] = $img_file['file_name'];
				}
			}
			
			$check = $this->distributormodel->update_distributor_by_id($id,$params);
			if($check)
			{
				$this->session->set_flashdata('add_success', 'Distributor has been updated Successfully..');
				redirect('admin/distributor-list');
			}
		}
		$data['page'] = 'distributor/edit_distributor';
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_distributor()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			$image = $this->distributormodel->get_image($id);
			if($image != 'default_profile.png')
			{
				$path = './uploads/distributor/'.$image;
				unlink($path);
			}
			$this->db->where('id', $id);
			$this->db->delete("distributor");
			$this->session->set_flashdata('del_success','Distributor has been Successfully Deleted.');
			redirect('admin/distributor-list');
		}
	}

	public function dealer_list()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'distributor/list_dealer';
		$this->load->view('admin/template',$data);
	}

	public function carpenter_list()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'distributor/list_carpenter';
		$this->load->view('admin/template',$data);
	}

	public function salesman_list()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'distributor/list_salesman';
		$this->load->view('admin/template',$data);
	}
}

