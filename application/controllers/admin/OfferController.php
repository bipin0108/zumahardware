<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class OfferController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
	}

 	public function dealer_offer()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'offer/list_dealer_offer';
		$this->load->view('admin/template',$data);
	}

	public function carpenter_offer()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'offer/list_carpenter_offer';
		$this->load->view('admin/template',$data);
	}

	public function create_dealer_offer()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'offer/add_dealer_offer';
		$this->load->view('admin/template',$data);
	}

	public function create_carpenter_offer()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'offer/add_carpenter_offer';
		$this->load->view('admin/template',$data);
	}

 	public function add_dealer_offer()
 	{
 		$this->adminmodel->CSRFVerify();
 		$this->form_validation->set_rules('name','Offer Name','required|is_unique[offer.name]'); 
		if (empty($_FILES['image']['name']))
		{
		    $this->form_validation->set_rules('image', 'Offer Image', 'required');
		}
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  		
			//Error
		}
		else
		{
			$data = array(
				'name'=>trim(ucfirst($_REQUEST['name'])),
				'type' => 'dealer',
			);
			
			if (!empty($_FILES['image']['name']))
			{
			    $config['upload_path']   = './uploads/offer/dealer_offer/';
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
					$data['image'] = time()."_".$_FILES['image']['name'];
					$img_file = $this->upload->data();
				}
			}
			else{
				$data['image'] = "default_profile.png";
			}
			$check = $this->offermodel->add_offer($data);
			if($check)
			{
				$this->session->set_flashdata('add_success', 'Offer has been added Successfully.');
				redirect('admin/dealer-offer');
			}
		}
		$data['page'] = 'offer/add_dealer_offer';
		$this->load->view('admin/template',$data);
  	}

  	 public function add_carpenter_offer()
 	{
 		$this->adminmodel->CSRFVerify();
 		$this->form_validation->set_rules('name','Offer Name','required|is_unique[offer.name]'); 
		if (empty($_FILES['image']['name']))
		{
		    $this->form_validation->set_rules('image', 'Offer Image', 'required');
		}
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  		
			//Error
		}
		else
		{
			$data = array(
				'name'=>trim(ucfirst($_REQUEST['name'])),
				'type' => 'carpenter',
			);
		
			
			if (!empty($_FILES['image']['name']))
			{
			    $config['upload_path']   = './uploads/offer/carpenter_offer/';
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
					$data['image'] = time()."_".$_FILES['image']['name'];
					$img_file = $this->upload->data();
				}
			}
			else{
				$data['image'] = "default_profile.png";
			}
			$check = $this->offermodel->add_offer($data);
			if($check)
			{
				$this->session->set_flashdata('add_success', 'Offer has been added Successfully.');
				redirect('admin/carpenter-offer');
			}
		}
		$data['page'] = 'offer/add_carpenter_offer';
		$this->load->view('admin/template',$data);
  	}

	public function edit_dealer_offer()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'offer/edit_dealer_offer';
		$data['offer'] = $this->offermodel->get_offer_by_id($id); 
		$this->load->view('admin/template',$data);
  	}

  	public function edit_carpenter_offer()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'offer/edit_carpenter_offer';
		$data['offer'] = $this->offermodel->get_offer_by_id($id); 
		$this->load->view('admin/template',$data);
  	}
  	
  	public function update_dealer_offer()
  	{
  		$id = $_REQUEST['id'];

  		$original_value = $this->db->query("SELECT name FROM offer WHERE id = ".$id)->row()->name ;
	    if($_REQUEST['name'] != $original_value) {
	       $is_unique =  '|is_unique[offer.name]';
	    } else {
	       $is_unique =  '';
	    }
		
		$this->form_validation->set_rules('name','Offer Name','required|trim'.$is_unique);  
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{
			$data = array(
				'name'=>trim(ucfirst($_REQUEST['name'])),
			);
			if (!empty($_FILES['image']['name']))
			{
			    $config['upload_path']   = './uploads/offer/dealer_offer/';
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
					
					$image_name = $this->offermodel->get_image($id);
					if($image_name != 'default_profile.png')
					{
						$path = './uploads/offer/dealer_offer/'.$image_name;
						unlink($path);
					}
					$data['image'] = time()."_".$_FILES['image']['name'];
					$img_file = $this->upload->data(); 
					$data['image'] = $img_file['file_name'];
				}
			}

			$check = $this->offermodel->update_offer_by_id($id,$data);
			if($check)
			{
				$this->session->set_flashdata('update_success', 'Offer has been successfully Updated.');
				redirect('admin/dealer-offer');
			}
		}

		$data['page'] = 'offer/edit_dealer_offer';
		$data['offer'] = $this->offermodel->get_offer_by_id($id); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_carpenter_offer()
  	{
  		$id = $_REQUEST['id'];

  		$original_value = $this->db->query("SELECT name FROM offer WHERE id = ".$id)->row()->name ;
	    if($_REQUEST['name'] != $original_value) {
	       $is_unique =  '|is_unique[offer.name]';
	    } else {
	       $is_unique =  '';
	    }
		
		$this->form_validation->set_rules('name','Offer Name','required|trim'.$is_unique);  
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{
			$data = array(
				'name'=>trim(ucfirst($_REQUEST['name'])),
			);
			if (!empty($_FILES['image']['name']))
			{
			    $config['upload_path']   = './uploads/offer/carpenter_offer/';
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
					
					$image_name = $this->offermodel->get_image($id);
					if($image_name != 'default_profile.png')
					{
						$path = './uploads/offer/carpenter_offer/'.$image_name;
						unlink($path);
					}
					$data['image'] = time()."_".$_FILES['image']['name'];
					$img_file = $this->upload->data(); 
					$data['image'] = $img_file['file_name'];
				}
			}

			$check = $this->offermodel->update_offer_by_id($id,$data);
			if($check)
			{
				$this->session->set_flashdata('update_success', 'Offer has been successfully Updated.');
				redirect('admin/carpenter-offer');
			}
		}

		$data['page'] = 'offer/edit_carpenter_offer';
		$data['offer'] = $this->offermodel->get_offer_by_id($id); 
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_dealer_offer()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			$image = $this->offermodel->get_image($id);
			if($image != 'default_profile.png')
			{
				$path = './uploads/offer/dealer_offer/'.$image;
				unlink($path);
			}
			$this->db->where('id', $id);
			$this->db->delete("offer");
			$this->session->set_flashdata('del_success', 'Offer has been Successfully Deleted.');
			redirect('admin/dealer-offer');
		}
	}

	public function trash_carpenter_offer()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			$image = $this->offermodel->get_image($id);
			if($image != 'default_profile.png')
			{
				$path = './uploads/offer/carpenter_offer/'.$image;
				unlink($path);
			}
			$this->db->where('id', $id);
			$this->db->delete("offer");
			$this->session->set_flashdata('del_success', 'Offer has been Successfully Deleted.');
			redirect('admin/carpenter-offer');
		}
	}
}

