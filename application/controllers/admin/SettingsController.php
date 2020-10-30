<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SettingsController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
		$data['page'] = 'settings/settings';
		$this->load->view('admin/template',$data);
	}
	
	public function update_general_settings()
	{
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('mobile_no','Mobile','required');
		$this->form_validation->set_rules('address','Address','required');
		$this->form_validation->set_rules('embed_map','Embed Map','required');
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)
		{  
			//error
		}
		else
		{
			$this->m_general->setSetting("name",$_REQUEST['name']);
			$this->m_general->setSetting("email",$_REQUEST['email']);
			$this->m_general->setSetting("address",$_REQUEST['address']);
			$this->m_general->setSetting("embed_map",$_REQUEST['embed_map']);
			$this->m_general->setSetting("mobile_no",$_REQUEST['mobile_no']);
		    $this->session->set_flashdata('success', 'Setting has been updated Successfully..');
			redirect('admin/settings');
			
		}
		$data['page'] = 'settings/settings';
		$this->load->view('admin/template',$data);
	}

	public function social_settings(){

		if($_POST){
			$this->m_general->setSetting("social_facebook",$_REQUEST['social_facebook']);
			$this->m_general->setSetting("social_google_plus",$_REQUEST['social_google_plus']);
			$this->m_general->setSetting("social_twitter",$_REQUEST['social_twitter']);
			$this->m_general->setSetting("social_youtube",$_REQUEST['social_youtube']);
			$this->session->set_flashdata('success', 'Social Setting has been updated Successfully..');
			redirect('admin/settings');
		}
			
		$data['page'] = 'settings/settings';
		$this->load->view('admin/template',$data);
	}

	public function privacy_policy(){

		if($_POST){
			$this->m_general->setSetting("privacy_policy",$_REQUEST['privacy_policy']);
			redirect('admin/settings');
		}
			
		$data['page'] = 'settings/settings';
		$this->load->view('admin/template',$data);
	}
}

