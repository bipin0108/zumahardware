<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order_ItemsController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
    }
	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'orderitems/list_orderitems';
		$this->load->view('admin/template',$data);
	}
}

