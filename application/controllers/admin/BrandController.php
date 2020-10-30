<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BrandController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'brand/list_brand';
		$this->load->view('admin/template',$data);
	}

	public function create_brand()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'brand/add_brand';
		$this->load->view('admin/template',$data);
	}
	
	public function add_brand()
 	{
 		
 		$this->adminmodel->CSRFVerify();
		$config['upload_path']   = './uploads/brand/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_width']     = 132; 	
		$config['max_height']    = 84;  
		$config['min_width']     = 68; 	
		$config['min_height']    = 82;   
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('slider_image')) 
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('img_error',$error['error']);
			$data['page'] = 'brand/add_brand';
			$this->load->view('admin/template',$data);
		}
		else
		{ 
			$img_file = $this->upload->data(); 
			$params = array(
				'brand_img' => $img_file['file_name']
			);
			$check = $this->brandmodel->add_brand($params);
			if($check)
			{
				$this->session->set_flashdata('add_success', 'Brand has been added Successfully..');
				redirect('admin/brand-list');
			}
		} 
	}
	
	public function trash_brand()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['brand_id']))
		{
			$brand_id = $_REQUEST['brand_id'];
			$image = $this->brandmodel->get_image($brand_id);
			$path = './uploads/brand/'.$image;
		
			unlink($path);
			$this->db->where('brand_id', $brand_id);
			$this->db->delete("brand_slider");
			$this->session->set_flashdata('del_success', 'Brand has been Successfully Deleted.');
			redirect('admin/brand-list');
		}
	}

}

