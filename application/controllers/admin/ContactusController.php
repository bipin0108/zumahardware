<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ContactusController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'contactus/list_contactus';
		$this->load->view('admin/template',$data);
	}

	public function trash_contactus()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			$this->db->where('user_id', $id);
			$this->db->delete("contact_details");
			$this->session->set_flashdata('del_success', 'Contact Message has been Successfully Deleted.');
			redirect('admin/contactus-list');
		}
	}
}

