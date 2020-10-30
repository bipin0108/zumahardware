<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SliderController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'slider/list_slider';
		$this->load->view('admin/template',$data);
	}

	public function create_slider()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'slider/add_slider';
		$this->load->view('admin/template',$data);
	}

	public function add_slider()
 	{
 		
 		$this->adminmodel->CSRFVerify();
		$config['upload_path']   = './uploads/slider/';
		$config['allowed_types'] = 'jpg|png|jpeg'; 
		$config['max_width']     = 1920; 	
		$config['max_height']    = 560;  
		$config['min_width']     = 1920; 	
		$config['min_height']    = 560;  
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('slider_image')) 
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('img_error',$error['error']);

	 		$data['page'] = 'slider/add_slider';
			$this->load->view('admin/template',$data);
		}
		else
		{ 
			$img_file = $this->upload->data(); 
			$params = array(
				'slider_image' => $img_file['file_name']
			);
			$check = $this->slidermodel->add_slider($params);
			if($check)
			{
				$this->session->set_flashdata('add_success', 'Slider has been added Successfully..');
				redirect('admin/slider-list');
			}
		} 
		
  	}

	public function trash_slider()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['slider_id']))
		{
			$slider_id = $_REQUEST['slider_id'];
			$image = $this->slidermodel->get_image($slider_id);
			$path = './uploads/slider/'.$image;
		
			unlink($path);
			$this->db->where('slider_id', $slider_id);
			$this->db->delete("slider");
			$this->session->set_flashdata('del_success', 'Slider has been Successfully Deleted.');
			redirect('admin/slider-list');
		}
	}
}

