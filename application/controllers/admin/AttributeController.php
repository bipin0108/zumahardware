<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AttributeController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'attribute/list_attribute';
		$this->load->view('admin/template',$data);
	}

	public function create_attribute()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'attribute/add_attribute';
		$this->load->view('admin/template',$data);
	}

 	public function add_attribute()
 	{
 		$this->adminmodel->CSRFVerify();
 		$this->form_validation->set_rules('att_name','Attribute Name','required|is_unique[attribute.att_name]'); 
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  		
			//Error
		}
		else
		{
			$data = array(
				'att_name'=>trim($_REQUEST['att_name']),
			);
			$check = $this->attributemodel->add_attribute($data);
			if($check)
			{
				$this->session->set_flashdata('add_success', 'Attribute has been added Successfully.');
				redirect('admin/attribute-list');
			}
		}
		$data['page'] = 'attribute/add_attribute';
		$this->load->view('admin/template',$data);
  	}

	public function edit_attribute()
	{
		$this->adminmodel->CSRFVerify();
		$att_id = $this->uri->segment(3);
		$data['page'] = 'attribute/edit_attribute';
		$data['attribute'] = $this->attributemodel->get_attribute_by_id($att_id); 
		$this->load->view('admin/template',$data);
  	}
  	
  	public function update_attribute()
  	{
  		$att_id = $_REQUEST['att_id'];

  		$original_value = $this->db->query("SELECT att_name FROM attribute WHERE att_id = ".$att_id)->row()->att_name ;
	    if($_REQUEST['att_name'] != $original_value) {
	       $is_unique =  '|is_unique[attribute.att_name]';
	    } else {
	       $is_unique =  '';
	    }
		
		$this->form_validation->set_rules('att_name','Attribute Name','required|trim'.$is_unique);  
  		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{
			$data = array(
						'att_name'=>trim($_REQUEST['att_name'])
						);
			$check = $this->attributemodel->update_attribute_by_id($att_id,$data);
			if($check)
			{
				$this->session->set_flashdata('update_success', 'Attribute has been successfully Updated.');
				redirect('admin/attribute-list',$data);
			}
		}
		$data['page'] = 'attribute/edit_attribute';
		$data['attribute'] = $this->attributemodel->get_attribute_by_id($att_id); 
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_attribute()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['att_id']))
		{
			$att_id = $_REQUEST['att_id'];
			$this->db->where('att_id', $att_id);
			$this->db->delete("attribute");
			$this->session->set_flashdata('del_success', 'Attribute has been Successfully Deleted.');
			redirect('admin/attribute-list');
		}
	}

}

