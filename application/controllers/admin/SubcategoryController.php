<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SubcategoryController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'subcategory/list_subcategory';
		$this->load->view('admin/template',$data);
	}

	public function create_subcategory($subcat_parentid)
	{
		$this->adminmodel->CSRFVerify();
		$data['subcat_parentid'] = $subcat_parentid;
		$data['page'] = 'subcategory/add_subcategory';
		$this->load->view('admin/template',$data);
	}

 	public function add_subcategory()
 	{
 		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('subcat_name','Subcategory Name','required|is_unique[subcategory.subcat_name]');
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{
			$params = array(
					'subcat_name' => $_REQUEST['subcat_name'], 
					'slug' => trim(str_replace(' ', '-',strtolower($_REQUEST['subcat_name']))),
					'subcat_parentid' => $_REQUEST['subcat_parentid'], 
				);
				$check = $this->subcategorymodel->add_subcategory($params);
				if($check)
				{
					$this->session->set_flashdata('add_success', 'Subcategory has been added Successfully..');
					redirect('admin/subcategory-list/'.$_REQUEST['subcat_parentid']);
				}
				
		}
		$data['subcat_parentid'] =  $_REQUEST['subcat_parentid'];
		$data['page'] = 'subcategory/add_subcategory';
		$this->load->view('admin/template',$data);
  	}

	public function edit_subcategory()
	{
		$this->adminmodel->CSRFVerify();
		$data['cat_id'] = $this->uri->segment(3);
		$subcat_id = $this->uri->segment(4);
		$data['subcat_id'] = $subcat_id;
		$data['page'] = 'subcategory/edit_subcategory';
		$data['subcategory'] = $this->subcategorymodel->get_subcategory_by_id($subcat_id); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_subcategory()
  	{
  		$this->adminmodel->CSRFVerify();
  		$subcat_id = $_REQUEST['subcat_id'];
  		$cat_id = $_REQUEST['cat_id'];

  		$data['subcategory'] = $this->subcategorymodel->get_subcategory_by_id($subcat_id);


  		$original_value = $data['subcategory']->subcat_name;

	    if($_REQUEST['subcat_name'] != $original_value) {
	       $is_unique =  '|is_unique[subcategory.subcat_name]';
	    } else {
	       $is_unique =  '';
	    }
		
		$this->form_validation->set_rules('subcat_name','Subcategory Name','required|trim'.$is_unique);
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)
		{  
			//error
		}
		else
		{
			$params = array(
					'subcat_name' => trim($_REQUEST['subcat_name']), 
					'slug' => trim(str_replace(' ', '-',strtolower($_REQUEST['subcat_name']))),
				);
			$check = $this->subcategorymodel->update_subcategory_by_id($subcat_id ,$params);
			if($check)
			{
				$this->session->set_flashdata('update_success', 'Subcategory has been updated Successfully..');
				redirect('admin/subcategory-list/'.$cat_id);
			}
		}
			
		$data['cat_id'] = $cat_id;
		$data['subcat_id'] = $subcat_id;
		$data['page'] = 'subcategory/edit_subcategory';
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_subcategory()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['subcat_id']))
		{
			$subcat_id = $_REQUEST['subcat_id'];
			$this->db->where('subcat_id', $subcat_id);
			$this->db->delete("subcategory");
			$this->session->set_flashdata('del_success', 'Subcategory has been Successfully Deleted.');
			redirect('admin/subcategory-list/'.$_REQUEST['cat_id']);
		}
	}
	public function subproduct_list()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'subcategory/list_subproduct';
		$this->load->view('admin/template',$data);
	}

}

