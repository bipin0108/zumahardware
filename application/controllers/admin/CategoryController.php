<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CategoryController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$config['image_library'] = 'gd2';
		$this->load->library('image_lib');
		$this->image_lib->resize();
		$this->image_lib->watermark();
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'category/list_category';
		$this->load->view('admin/template',$data);
	}

	public function create_category()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'category/add_category';
		$this->load->view('admin/template',$data);
	}

 	public function add_category()
 	{
 		$this->adminmodel->CSRFVerify();
 		$this->form_validation->set_rules('name','Category Name','required|is_unique[category.name]'); 
		if (empty($_FILES['image']['name']))
		{
		    $this->form_validation->set_rules('image', 'Category Image', 'required');
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
				'slug' => trim(str_replace(' ', '-',strtolower($_REQUEST['name'])))
			);
			if (!empty($_FILES['image']['name']))
			{
			    $config['upload_path']   = './uploads/categories/';
				$config['allowed_types'] = 'jpg|png|jpeg'; 
				$config['file_name'] = time().uniqid(rand());
				$this->load->library('upload', $config);
				
				if (!$this->upload->do_upload('image')) 
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('img_error',$error['error']);
				}
				else
				{ 
					$data['image'] = time().uniqid(rand());
					$img_file = $this->upload->data();

				 	$configer =  array(
		              'image_library'   => 'gd2',
		              'source_image'    =>  './uploads/categories/'.$data['image'],
		              'maintain_ratio'  =>  false,
		              'width'           =>  468 ,
		              'height'          =>  364 ,
		          	);
	                $this->load->library('image_lib', $configer); 
		            $this->image_lib->clear();
		            $this->image_lib->initialize($configer);
		            $this->image_lib->resize();

				}
			}
			else{
				$data['image'] = "default_profile.png";
			}
			$check = $this->categorymodel->add_category($data);
			if($check)
			{
				$this->session->set_flashdata('add_success', 'Category has been added Successfully.');
				redirect('admin/category-list');
			}
		}
		$data['page'] = 'category/add_category';
		$this->load->view('admin/template',$data);
  	}

	public function edit_category()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'category/edit_category';
		$data['category'] = $this->categorymodel->get_category_by_id($id); 
		$this->load->view('admin/template',$data);
  	}
  	
  	public function update_category()
  	{
  		$cat_id = $_REQUEST['cat_id'];
  		$original_value = $this->db->query("SELECT name FROM category WHERE id = ".$cat_id)->row()->name ;
	    if($_REQUEST['name'] != $original_value) {
	       $is_unique =  '|is_unique[category.name]';
	    } else {
	       $is_unique =  '';
	    }
		
		$this->form_validation->set_rules('name','Category Name','required|trim'.$is_unique);  
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{
			$data = array(
				'name'=>trim(ucfirst($_REQUEST['name'])),
				'slug' => trim(str_replace(' ', '-',strtolower($_REQUEST['name'])))
			);
			if (!empty($_FILES['image']['name']))
			{
			    $config['upload_path']   = './uploads/categories/';
				$config['allowed_types'] = 'jpg|png|jpeg'; 
				$config['file_name'] = time().uniqid(rand());
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('image')) 
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('img_error',$error['error']);
				}
				else
				{ 
					$image_name = $this->categorymodel->get_image($cat_id);
					if($image_name != 'default_profile.png')
					{
						$path = './uploads/categories/'.$image_name;
						unlink($path);
					}
					$data['image'] = time().uniqid(rand());
					$img_file = $this->upload->data(); 
					$data['image'] = $img_file['file_name'];

					$configer =  array(
		              'image_library'   => 'gd2',
		              'source_image'    =>  './uploads/categories/'.$data['image'],
		              'maintain_ratio'  =>  false,
		              'width'           =>  468 ,
		              'height'          =>  364 ,
		          	);
	                $this->load->library('image_lib', $configer); 
		            $this->image_lib->clear();
		            $this->image_lib->initialize($configer);
		            $this->image_lib->resize();

				}
			}

			$check = $this->categorymodel->update_category_by_id($cat_id,$data);
			if($check)
			{
				$this->session->set_flashdata('update_success', 'Category has been successfully Updated.');
				redirect('admin/category-list',$data);
			}
		}
		$data['page'] = 'category/edit_category';
		$data['category'] = $this->categorymodel->get_category_by_id($cat_id); 
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_category()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			$image = $this->categorymodel->get_image($id);
			if($image != 'default_profile.png')
			{
				$path = './uploads/categories/'.$image;
				unlink($path);
			}
			$this->db->where('id', $id);
			$this->db->delete("category");
			$this->session->set_flashdata('del_success', 'Category has been Successfully Deleted.');
			redirect('admin/category-list');
		}
	}
}

