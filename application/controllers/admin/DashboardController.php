<?php defined('BASEPATH') OR exit('No direct script access allowed');
class DashboardController extends CI_Controller
{
	public function __construct()
    {
            parent::__construct();
			$this->adminmodel->not_logged_in();
    }

	public function index() 
	{
		$data['page'] = 'dashboard/dashboard_template';
		$this->load->view('admin/template', $data);
	}
}
