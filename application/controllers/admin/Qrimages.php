<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Code written by TangleSkills

class Qrimages extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		  $this->load->helper('url');
    }
	
	public function index()
	{
		$data=array();
	
		for ($i=0; $i < $count=$this->input->post('count'); $i++)
		{ 
			$this->load->library('ciqrcode');
			$uniqueid = time().rand();
			$qr_image=$uniqueid.'.png';
			$params['data'] = json_encode(array('uniqueid'=>$uniqueid,'product_id' => $this->input->post('qr_id'), 'point' => $this->input->post('point')));
			$params['level'] = 'H';
			$params['size'] = 8;
			$params['savename'] ="uploads/qr_image/".$qr_image;

			if($this->ciqrcode->generate($params))
			{
				$data['img_url'.$i]=$qr_image;	
			}

			$data = array(
				'uniqueid'=>$uniqueid,
				'product_id'=>$this->input->post('qr_id'),
				'count'=>$this->input->post('count'),
				'point'=>$this->input->post('point'),
				'qr_image'=>$qr_image,
			);
			$check = $this->qrmodel->add_qr($data);		
		}
		$id = $this->input->post('qr_id');
		echo $id;
	}
	//end
}
