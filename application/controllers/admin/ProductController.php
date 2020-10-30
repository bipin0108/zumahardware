<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ProductController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->helper('url');
		$config['image_library'] = 'gd2';
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		$this->image_lib->watermark();
    }


 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'product/list_product';
		$this->load->view('admin/template',$data);
	}

	public function create_product()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'product/add_product';
		$this->load->view('admin/template',$data);
	}

	public function get_dynamic_subcat()
	{
		$cat_id = $_REQUEST['cat_id'];
		
		$this->db->where('subcat_parentid', $cat_id);
		$query = $this->db->get('subcategory');
		$output = '<option value="">Select Subcategory</option>';
		if(isset($_REQUEST['subcat_id']))
		{
			$subcat_id = $_REQUEST['subcat_id'];
			foreach($query->result() as $row)
			{
				if($subcat_id == $row->subcat_id)
				{
					$selected = 'selected';
				}
				else
				{
					$selected = '';
				}
				$output .= '<option value="'.$row->subcat_id.'" '.$selected.'>'.$row->subcat_name.'</option>';
			}
		}
		else
		{
			foreach($query->result() as $row)
			{
			$output .= '<option value="'.$row->subcat_id.'" >'.$row->subcat_name.'</option>';
			}
		}

		echo $output;
	}

 	public function add_product()
 	{
 		
 		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('name','Name','required|is_unique[products.name]');
		$this->form_validation->set_rules('category','Category','required');
		$this->form_validation->set_rules('subcategory','Subcategory','required');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('code','Code','required|is_unique[products.code]');
		$this->form_validation->set_rules('element_name','Product attribute','required',array('required' => 'At least one product attribute is required.'));
		
		if (empty($_FILES['product_image']['name'][0]))
		{
			$this->form_validation->set_rules('product_image', 'Product Image', 'required');
		}
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{
			$params = array(
				'name' => ucfirst(trim($_REQUEST['name'])), 
				'slug' => trim(str_replace(' ', '-',strtolower($_REQUEST['name']))),
				'category' => trim($_REQUEST['category']),
				'subcategory' => trim($_REQUEST['subcategory']), 
				'description' => trim($_REQUEST['description']), 
				'code' => trim($_REQUEST['code']),
			    'attribute' => trim($_REQUEST['attribute']), 
			    'about_product' => $val, 
			);

			if ($_REQUEST['title']) {
				$title = $_REQUEST['title'];
		 		$value = $_REQUEST['value'];
		 		$length = count($title);
		 		for ($i=0; $i <$length; $i++) { 
		 			$data[$title[$i]] = $value[$i];
		 		}
		 		$about_product = json_encode($data);
		 		$params['about_product'] = $about_product;
			}

			$this->load->library('upload');
			
			// Product_image
			if(!empty($_FILES['product_image']['name'][0]))
	 		{
	 			$count = count($_FILES['product_image']['name']);
	            $arr = array();
	            for($i=0;$i<$count;$i++){
	                $_FILES['file']['name'] = $_FILES['product_image']['name'][$i];
	                $_FILES['file']['type'] = $_FILES['product_image']['type'][$i];
	                $_FILES['file']['tmp_name'] = $_FILES['product_image']['tmp_name'][$i];
	                $_FILES['file']['error'] = $_FILES['product_image']['error'][$i];
	                $_FILES['file']['size'] = $_FILES['product_image']['size'][$i];
	  
	                $original_path = './uploads/products/product_images/original/';
	                $thumb_path = './uploads/products/product_images/thumbnail/';
	                $new_file_name = time().uniqid(rand());
	                $this->upload_img_with_thumb($original_path,$thumb_path,'file',$new_file_name);		                
	                array_push($arr,$new_file_name);
	            }
	            $params['product_image'] = implode(',', $arr);
			}

			//product_multiple image
			if(!empty($_FILES['guide_files']['name'][0]))
	 		{
	 			$count = count($_FILES['guide_files']['name']);
	            $arr = array();
	            for($i=0;$i<$count;$i++){
	                $_FILES['file']['name'] = $_FILES['guide_files']['name'][$i];
	                $_FILES['file']['type'] = $_FILES['guide_files']['type'][$i];
	                $_FILES['file']['tmp_name'] = $_FILES['guide_files']['tmp_name'][$i];
	                $_FILES['file']['error'] = $_FILES['guide_files']['error'][$i];
	                $_FILES['file']['size'] = $_FILES['guide_files']['size'][$i];
	  
	                $original_path = './uploads/products/products_multiple/original/';
	                $thumb_path = './uploads/products/products_multiple/thumbnail/';
	                $new_file_name = time().uniqid(rand());
	                $this->upload_img_with_thumb($original_path,$thumb_path,'file',$new_file_name);		                
	                array_push($arr,$new_file_name);
	            }
	            $params['installation_guide_images'] = implode(',', $arr);
	 		}
 		
			//video
			if(!empty($_FILES['guide_video']['name']))
			{
				$video_config['upload_path']   = './uploads/products/product_video/';
				$video_config['allowed_types'] = 'mp4|webm';
				$video_config['max_size'] = '1000000';
				$vid_custom_name = time().uniqid(rand());
				$video_config['file_name'] = $vid_custom_name;
				$this->upload->initialize($video_config);

				if (!$this->upload->do_upload('guide_video')) {
	                    $error = array('error' => $this->upload->display_errors());
						$this->session->set_flashdata('guide_video',$error['error']);
	                } 
	                    $video_data = $this->upload->data();
	                    $params['installation_guide_videos'] = $vid_custom_name;
	                
			}
			//add product data
			$product_id = $this->productmodel->add_product($params);
			if($product_id)
			{
				if($_REQUEST['element_name'] != null && $_REQUEST['element_name'] != ''){
					$element_name = explode(',',$_REQUEST['element_name']);
					$element_price = explode(',',$_REQUEST['element_price']);
					$count = count($element_name);
					
					$element = array();
					for($i=0; $i < $count;) { 
						$data  = array(
						'product_id' => $product_id,
						'att_id' => $_REQUEST['attribute'],
						'att_name' => ucfirst($element_name[$i]),
						'att_value' => $element_price[$i],
						);
					$this->productattributemodel->add_productattribute($data);
					$i++;
					}
				}
				$this->session->set_flashdata('add_success', 'Product has been added Successfully..');
				redirect('admin/product-list');
			}
		} 	
		
		$data['page'] = 'product/add_product';
		$this->load->view('admin/template',$data);
  	}

	public function edit_product()
	{
		$this->adminmodel->CSRFVerify();
		$id = $_REQUEST['id'];
		$data['page'] = 'product/edit_product';
		$data['product'] = $this->productmodel->get_product_by_id($id);
		$this->load->view('admin/template',$data);
  	}

  	public function update_product()
  	{	
  	// 	$title = $_REQUEST['title'];
 		// $value = $_REQUEST['value'];
 		// $about_product = array_combine($title,$value);
 		// $val = http_build_query($about_product,'',',');
 		// $ab_product = trim(str_replace('+', '-',$val)); 


  		$id = $_REQUEST['id'];

  		$original_value = $this->db->query("SELECT name FROM products WHERE id = ".$id)->row()->name ;
	    if($_REQUEST['name'] != $original_value) {
	       $is_unique =  '|is_unique[products.name]';
	    } else {
	       $is_unique =  '';
	    }

	    $original_value2 = $this->db->query("SELECT code FROM products WHERE id = ".$id)->row()->code ;
	    if($_REQUEST['code'] != $original_value2) {
	       $is_unique2 =  '|is_unique[products.code]';
	    } else {
	       $is_unique2 =  '';
	    }

  		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('name','Product Name','required|trim'.$is_unique);
		$this->form_validation->set_rules('category','Product category','required|trim');
		$this->form_validation->set_rules('subcategory','Product Subcategory','required|trim');
		$this->form_validation->set_rules('description','Description','required|trim');
		$this->form_validation->set_rules('code','Code','required|trim'.$is_unique2);
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;font-weight:bold;">','</span>');
		
		if (empty($_FILES['product_image']['name']))
		{
		    
		}
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			// Error
		}
		else
		{	
  			$id = $_REQUEST['id'];
  			
  				$params = array(
				'name' => ucfirst(trim($_REQUEST['name'])), 
				'slug' => trim(str_replace(' ', '-',strtolower($_REQUEST['name']))),
				'category' => trim($_REQUEST['category']),
				'subcategory' => trim($_REQUEST['subcategory']), 
				'description' => trim($_REQUEST['description']), 
				'code' => trim($_REQUEST['code']),
				// 'about_product' => $ab_product, 
			);

  		// 	$title = $_REQUEST['title'];
	 		// $value = $_REQUEST['value'];
	 		// $length = count($title);
	 		// for ($i=0; $i <$length; $i++) { 
	 		// 	$data[$title[$i]] = $value[$i];
	 		// }
	 		// $about_product = json_encode($data);
	 		// $params['about_product'] = $about_product;
	 		
 			if ($_REQUEST['title']) {
				$title = $_REQUEST['title'];
		 		$value = $_REQUEST['value'];
		 		$length = count($title);
		 		for ($i=0; $i <$length; $i++) { 
		 			$data[$title[$i]] = $value[$i];
		 		}
		 		$about_product = json_encode($data);
		 		$params['about_product'] = $about_product;
			}
	 		
	 		
			$new = $this->load->library('upload');
			//product image
			if(!empty($_FILES['product_image']['name'])){
				
				$original_path = './uploads/products/product_images/original/';
	            $thumb_path = './uploads/products/product_images/thumbnail/';
	            $new_file_name = time().uniqid(rand());
	            $this->upload_img_with_thumb($original_path,$thumb_path,'product_image',$new_file_name);
	            $params['product_image'] = $new_file_name;
		}
			// Product video
			if(!empty($_FILES['guide_video']['name']))
			{
				$video_config['upload_path']   = './uploads/products/product_video/';
				$video_config['allowed_types'] = 'mp4|webm';
				$video_config['max_size'] = '1000000';
				$vid_custom_name = time().uniqid(rand());;
				$video_config['file_name'] = $vid_custom_name;
				$this->upload->initialize($video_config);

				if (!$this->upload->do_upload('guide_video')) {
	                    $error = array('error' => $this->upload->display_errors());
						$this->session->set_flashdata('guide_video',$error['error']);
	                } 
	                    $video_data = $this->upload->data();
	                    $params['installation_guide_videos'] = $vid_custom_name;
	        }

			//product_multiple image
			$check = $this->productmodel->update_product_by_id($id ,$params);
		
			if($check)
			{
				$this->session->set_flashdata('update_success', 'Product has been updated Successfully..');
				redirect('admin/product-list');
			}
		 }
		$data['page'] = 'product/edit_product';
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_product()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['product_id']))
		{
			$product_id = $_REQUEST['product_id'];
			$row = $this->productmodel->get_row_by_id($product_id);
			
			unlink('./uploads/products/product_images/original/'.$row['product_image']);
			unlink('./uploads/products/product_images/thumbnail/'.$row['product_image']);
			unlink('./uploads/products/product_video/'.$row['installation_guide_videos']);
			
			$imgs=explode(",",$row['installation_guide_images']);
			foreach ($imgs as $value) {
				unlink('./uploads/products/products_multiple/original/'.$value);	
				unlink('./uploads/products/products_multiple/thumbnail/'.$value);	
			}

			$qrcode = $this->qrmodel->get_qrcode_by_product($product_id);
			foreach ($qrcode as $value) {
				unlink('./uploads/qr_image/'.$value['qr_image']);	
			}

			$this->db->where('product_id', $product_id);	
			$this->db->delete("product_attribute");

			$this->db->where('product_id', $product_id);	
			$this->db->delete("qrcode");

			$this->db->where('id', $product_id);	
			$this->db->delete("products");

			$this->session->set_flashdata('del_success', 'Product has been Successfully Deleted.');
			redirect('admin/product-list');
		}
	}

	public function Qrimages()
	{
		$data['img_url']="";
		if($this->input->post('action') && $this->input->post('action') == "generate_qrcode")
		{
			$this->load->library('ciqrcode');
			$qr_image=rand().'.png';
			$params['data'] = $this->input->post('qr_text');
			$params['level'] = 'H';
			$params['size'] = 8;
			$params['savename'] =FCPATH."uploads/qr_image/".$qr_image;
			if($this->ciqrcode->generate($params))
			{
				$data['img_url']=$qr_image;	
			}
		}
		$this->load->view('qrcode',$data);
	}

	public function product_file()
		{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'product/file_list_template';
		$this->load->view('admin/template',$data);
	}

	public function product_details()
	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'product/product_details';
		$this->load->view('admin/template',$data);
	}

	public function add_image()
	{
		$product_id = $_REQUEST['id'];
 		$multi_imgname = $this->productmodel->get_pro_installimg_by_id($product_id);
 		
 		if($this->input->post('fileSubmit'))
 		{
			$this->load->library('upload');
			if(!empty($_FILES['new_guide_files']['name']))
			{
				
				$original_path = './uploads/products/products_multiple/original/';
	            $thumb_path = './uploads/products/products_multiple/thumbnail/';
	            $new_file_name = time().uniqid(rand());
	            $this->upload_img_with_thumb($original_path,$thumb_path,'new_guide_files',$new_file_name);
				
				$filename = $new_file_name;

				if($multi_imgname != ''){
					$new = $multi_imgname.",".$filename;	
				}
				else
				{
					$new = $filename;
				}
				
			}
 		}
 		
		$param = array('installation_guide_images' => $new);
		$check = $this->productmodel->update_product_by_id($product_id ,$param);
 		if($check)
		{
			$this->session->set_flashdata('add_img_success', 'Product has been added Successfully..');
			redirect('admin/edit-product/'.$product_id);
		}
		$data['page'] = 'product/edit_product';
		$this->load->view('admin/template',$data);
	}

	public function add_product_image()
	{
		$product_id = $_REQUEST['id'];
 		$multi_imgname = $this->productmodel->get_productimg_by_id($product_id);
 		
 		// die;
 		if($this->input->post('fileSubmit'))
 		{
			$this->load->library('upload');
			if(!empty($_FILES['new_product_files']['name']))
			{
			
				$original_path = './uploads/products/product_images/original/';
	            $thumb_path = './uploads/products/product_images/thumbnail/';
	            $new_file_name = time().uniqid(rand());
	            $this->upload_img_with_thumb($original_path,$thumb_path,'new_product_files',$new_file_name);

				$filename = $new_file_name;
				if($multi_imgname != ''){
					$new = $multi_imgname.",".$filename;	
				}
				else
				{
					$new = $filename;
				}
				
			}
 		}
 		
		$param = array('product_image' => $new);
		$check = $this->productmodel->update_product_by_id($product_id ,$param);
 		if($check)
		{
			$this->session->set_flashdata('add_img_success', 'Product has been added Successfully..');
			redirect('admin/edit-product/'.$product_id);
		}
		$data['page'] = 'product/edit_product';
		$this->load->view('admin/template',$data);
	}
	//Delete image

	public function trash_image()
	{
		$img_index = $_REQUEST['img_index'];
		$product_id = $_REQUEST['product_id'];
		$img_name = $_REQUEST['img_name'];
		
		$img_arr = explode(',', $this->productmodel->get_pro_installimg_by_id($product_id));
		unset($img_arr[$img_index]);
		unlink('./uploads/products/products_multiple/original/'.$img_name);	
		unlink('./uploads/products/products_multiple/thumbnail/'.$img_name);	
		
		$param = array('installation_guide_images' => implode(',', $img_arr));
		$check = $this->productmodel->update_product_by_id($product_id ,$param);
		echo $check;
		
	}

	public function trash_product_video()
	{
		$id = $_REQUEST['img_index'];
		$product_id = $_REQUEST['product_id'];
		
		$img_arr = explode(',', $this->productmodel->get_pro_installimg_by_id($product_id));
		unset($img_arr[$img_index]);
		unlink('./uploads/products/products_multiple/original/'.$img_name);	
		unlink('./uploads/products/products_multiple/thumbnail/'.$img_name);
		
		$param = array('installation_guide_images' => implode(',', $img_arr));
		$check = $this->productmodel->update_product_by_id($product_id ,$param);
		echo $check;
		
	}

	public function trash_product_image()
	{
		$productimg_index = $_REQUEST['productimg_index'];
		$product_id = $_REQUEST['product_id'];
		$productimg_name = $_REQUEST['productimg_name'];
		$img_arr = explode(',', $this->productmodel->get_productimg_by_id($product_id));
		unset($img_arr[$productimg_index]);
		unlink('./uploads/products/product_images/original/'.$productimg_name);	
		unlink('./uploads/products/product_images/thumbnail/'.$productimg_name);
		
		$param = array('product_image' => implode(',', $img_arr));
		$check = $this->productmodel->update_product_by_id($product_id ,$param);
		echo $check;
	}
//end	
	

	public function trash_about_product()
	{
		$about_product_index = $_REQUEST['about_product_index'];
		$product_id = $_REQUEST['product_id'];
		$value = $_REQUEST['value'];
		$key = $_REQUEST['key'];
		
		$about_product = $this->productmodel->get_about_product_by_id($product_id);
		$val = json_decode($about_product,true);
		unset($val[$key]);
		if (!empty($val)) {
			$param = array('about_product' => json_encode($val));
		}else{
			$param =  array('about_product' => NULL );
		}
		$check = $this->productmodel->update_product_by_id($product_id ,$param);
		echo $check;
	}

	public function save_pdf()
	{ 
		require_once 'vendor/autoload.php';
		$mpdf = new \Mpdf\Mpdf();
       	$html = $this->load->view('admin/product/qrpdf',[],true);
        $mpdf->WriteHTML($html);
        $mpdf->Output(); // opens in browse
    }

    public function save_all_qr()
	{ 
		require_once 'vendor/autoload.php';
		$mpdf = new \Mpdf\Mpdf();
       	$html = $this->load->view('admin/product/all_qrpdf',[],true);
        $mpdf->WriteHTML($html);
        $mpdf->Output(); // opens in browse
    }
    public function download_pdf($id)
	{ 
		require_once 'vendor/autoload.php';
		$mpdf = new \Mpdf\Mpdf();
       	$html = $this->load->view('admin/product/qrpdf',[],true);
        $mpdf->WriteHTML($html);
        $mpdf->Output(); // opens in browse
    }

	public function add_product_att()
	{

		if($_REQUEST['product_id'])
		{
			// Add product attribute
			$data  = array(
				'product_id' => $_REQUEST['product_id'],
				'att_id' => $_REQUEST['att_id'],
				'att_name' => ucfirst($_REQUEST['attribute_val']),
				'att_value' => $_REQUEST['price_val'],
			);

			$attribute = $this->productattributemodel->add_productattribute($data);
		}
	}
	public function trash_product_attribute()
	{
		$id =$_REQUEST['id'];
		$product_id=$_REQUEST['product_id'];
		if(!empty($product_id))
		{
			$this->db->where('id', $id);
			$this->db->where('product_id', $product_id);	
			$this->db->delete("product_attribute");
		}
	}
	public function update_product_att()
	{
		if($_REQUEST['id'])
		{
			$data  = array(
				'att_name' => $_REQUEST['name'],
				'att_value' => $_REQUEST['price'],
			);

			$attribute = $this->productattributemodel->update_productattribute_by_id($_REQUEST['id'],$data);
		}
	}

	public function get_qr_by_productId_ajax()
	{
		$product_id = $_REQUEST['product_id'];
		$res= $this->productmodel->get_qr_history($product_id);
		$qrcode = $this->qrmodel->get_qr_by_id($product_id);
		$qrcount = count($qrcode);
		echo json_encode(array("res"=>$res,"qrcount"=>$qrcount));
	}

	public function hot_active_deactive_ajax()
	{
		$id = $_REQUEST['id'];
		$is_value = $_REQUEST['is_value'];
		if($is_value == '1')
		{
			$val = '0';
		}
		else
		{
			$val = '1';
		}
		$params = array(
			'is_hot'=>$val,
		);

		$check = $this->productmodel->update_product_by_id($id,$params);
		if($check)
		{
			echo true;
		}
	}

	public function upload_img_with_thumb($original_path,$thumb_path,$file_name,$new_file_name)
    {

        $this->load->library('upload');
        if (!is_dir($original_path)) {
            mkdir($original_path, 0755, TRUE);
        }
        if (!is_dir($thumb_path)) {
            mkdir($thumb_path, 0755, TRUE);
        }
        $config['upload_path'] = $original_path;
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['file_name'] = $new_file_name;
        
        $this->upload->initialize($config);
        if($this->upload->do_upload($file_name)){
            $gbr = $this->upload->data();
            $file_name = $gbr['file_name'];

            $config = array(
                'image_library' => 'GD2',
                'source_image'  => $original_path.$new_file_name,
                'maintain_ratio'=> true,
                'width'         => 468,
                'height'        => 364,
                'new_image'     => $thumb_path.$new_file_name
            );

            $this->load->library('image_lib', $config);
                
            $this->image_lib->initialize($config);
            if(!$this->image_lib->resize()){
                return false;
            }
            $this->image_lib->clear();
        }            
    }
}
