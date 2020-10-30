<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
	public function __construct()
    {
		parent::__construct();
		$this->load->model('HomeModel', 'homemodel');
    }

	public function index()
	{	
		$data['page'] = 'home';
		$this->load->view('frontend/f_template',$data);
	}

	public function about_us()
	{	
		$data['page'] = 'about';
		$this->load->view('frontend/f_template',$data);
	}

	public function privacy_policy()
	{	
		$data['page'] = 'privacy_policy';
		$this->load->view('frontend/f_template',$data);
	}

	public function category()
	{	
		$data['page'] = 'category';
		$this->load->view('frontend/f_template',$data);
	}

	public function subcategory_view()
	{	
		$data['page'] = 'subcategory_view';
		$this->load->view('frontend/f_template',$data);
	}

	public function subcategory_productview()
	{	
		$data['page'] = 'subcategory_productview';
		$this->load->view('frontend/f_template',$data);
	}

	public function search_product()
	{	
	 	$search_str =  $_REQUEST['product'];
		$this->db->like('name', $search_str);
	 	$this->db->or_like('slug', $search_str);
	 	$this->db->or_like('code', $search_str);
       	$query = $this->db->get('products');
        $product = $query->result();
		$data['product'] =$product;		
		$data['page'] = 'search_product';
		$this->load->view('frontend/f_template',$data);
	}
	
	public function products($segment=0)
	{	
		$subcat_id = explode('-', $segment)[1];
		$data=array();
		$this->load->library('pagination');
		$limit=3;
		$config['base_url']=site_url('products/'.$segment);
		$this->db->where('subcategory',$subcat_id);
		$qry=$this->db->get('products');
		$total=$qry->num_rows();
		$config['total_rows']=$total;
		$config['per_page']=$limit;
		$config['full_tag_open']='<div class="pagination">';
		$config['full_tag_close']='</div>';
		$config['cur_tag_open']='<a class="active" >'; 
		$config['cur_tag_close']='</a>';
		$config['prev_link']='Prev';
		$config['next_link']='Next';
		$this->pagination->initialize($config);
		$this->db->where('subcategory',$subcat_id);
		if($this->uri->segment(3)){
			$page = ($this->uri->segment(3));
		}
		else{
			$page = 0;
		}
		$this->db->limit($limit,$page);
		$qry=$this->db->get('products');
		$data['pagination']=$this->pagination->create_links();
		$res=$qry->result_array();
		$data['products']=$res;
		$data['page'] = 'products';
		$this->load->view('frontend/f_template',$data);
		
	}
	public function product_details()
	{	
		$data['page'] = 'product_details';
		$this->load->view('frontend/f_template',$data);
	}
	public function contact_us()
	{	

		if(!empty($_POST)){

			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'name', 'required');  
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
			$this->form_validation->set_rules('message', 'Message', 'required'); 
			$this->form_validation->set_error_delimiters('<div class="error" style="color:red;"><span>','</span></div>');
			
			if($this->form_validation->run() == FALSE)  
			{  
				//Error
			}  
			else  
			{  
				$data['name'] = $_REQUEST['name'];
				$data['email'] = $_REQUEST['email'];
				$data['message'] = $_REQUEST['message'];
				$check = $this->homemodel->add_contact($data);
				if($check)
				{
					$this->session->set_flashdata('success', 'Your message has been sent Successfully!');
					redirect('contact-us');
				}
			}
		}
		$data['page'] = 'contact';
		$this->load->view('frontend/f_template',$data);
	}
	
	public function not_found(){
		$data['page'] = '404';
		$this->load->view('frontend/f_template',$data);
	}

	public function give_rate()
	{	
		
		$category = $_REQUEST['category'];
		$subcategory = $_REQUEST['subcategory'];
		$products = $_REQUEST['products'];
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'required');  
		$this->form_validation->set_rules('designation', 'designation', 'required');  
		$this->form_validation->set_rules('city', 'city', 'required'); 
		$this->form_validation->set_rules('review', 'review', 'required'); 
		$this->form_validation->set_error_delimiters('<div class="error" style="color:red;"><span>','</span></div>');

		if($this->form_validation->run() == FALSE)  
		{  
			$this->session->set_flashdata('error', validation_errors());
			redirect('zuma-product/'.$category.'/'.$subcategory.'/'.$products);
		}  
		else  
		{ 
			$data = array(
				'product_id'=>$_REQUEST['product_id'],
				'rating'=>$_REQUEST['rating'],
				'name' =>$_REQUEST['name'],
				'designation'=>$_REQUEST['designation'],
				'city' => $_REQUEST['city'],
				'review'=>$_REQUEST['review'],
			);
			$check = $this->homemodel->add_rating($data);
			if($check)
			{
				$this->session->set_flashdata('success', 'Your rating has been sent Successfully!');
				redirect('zuma-product/'.$category.'/'.$subcategory.'/'.$products);
			}
		}
		$data['page'] = 'product_details';
		$this->load->view('frontend/f_template',$data);
	}

}
