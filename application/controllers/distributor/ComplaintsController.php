<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ComplaintsController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->d_distributormodel->not_logged_in();
    }

	public function pending_complaints()
 	{
 		$this->d_distributormodel->CSRFVerify();
 		$data['page'] = 'complaints/pending_complaints';
		$this->load->view('distributor/template',$data);
	}

	public function completed_complaints()
 	{
 		$this->d_distributormodel->CSRFVerify();
 		$data['page'] = 'complaints/completed_complaints';
		$this->load->view('distributor/template',$data);
	}
	
	public function change_complaints_status($id)
	{
		$now = date('Y-m-d H:i:s');
		$params = array(
			"status"=>$_POST['status'],
			"updated_at"=>$now,
		);
		$check = $this->d_complaintsmodel->change_complaints_status($id, $params);
		
		if($check)
		{
			$this->session->set_flashdata('update_success', 'Status has been change Successfully..');
			if ($_POST['status']=='completed') {
				redirect('distributor/completed-complaints');
			}else{
				redirect('distributor/pending-complaints');
			}
		}
	}
}

