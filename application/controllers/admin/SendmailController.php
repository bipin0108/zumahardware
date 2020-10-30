<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SendmailController extends MY_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
		$data['page'] = 'mail/sendmail';
		$this->load->view('admin/template',$data);
	}

	public function compose(){
		$this->adminmodel->CSRFVerify();
		$type = $_POST['type'];
 		$this->form_validation->set_rules('subject','Subject','required');  
		$this->form_validation->set_rules('message', 'Message','required');  
		if(!empty($type) && $type == 'single'){
			$this->form_validation->set_rules('to', 'To','required');  
		}
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  		
			//Error
		}
		else
		{
			$subject = $_POST['subject'];
			$message = $_POST['message'];
			if(!empty($type) && $type == 'single'){
				$address = explode(',', $_POST['to']);
				if($this->sendemailMiltipe($address, $subject, $message)){
					$this->session->set_flashdata('success', 'Mail has been sent Successfully.');
					redirect('admin/sendmail');
				}else{
					$this->session->set_flashdata('erro', 'Mail has been not sent Successfully.');
					redirect('admin/sendmail');
				}
			}else{
				$sql = "SELECT GROUP_CONCAT(email) address FROM `users` WHERE 1";
				$query = $this->db->query($sql);
				if($query->num_rows() > 0){
					$result = $query->row();
				}
				$address = explode(',', $result->address);
				if($this->sendemailMiltipe($address, $subject, $message)){
					$this->session->set_flashdata('success', 'Mail has been sent Successfully.');
					redirect('admin/sendmail');
				}else{
					$this->session->set_flashdata('erro', 'Mail has been not sent Successfully.');
					redirect('admin/sendmail');
				}
			}

		}
		$data['page'] = 'mail/sendmail';
		$this->load->view('admin/template',$data);
	}

}

