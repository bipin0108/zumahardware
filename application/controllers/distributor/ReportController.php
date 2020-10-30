<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ReportController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
	}

    public function compareDate() {
	  $startDate = strtotime($_POST['s_date']);
	  $endDate = strtotime($_POST['e_date']);

	  if ($endDate >= $startDate)
	    return True;
	  else {
	    $this->form_validation->set_message('compareDate', 'End Date should be greater than Contract Start Date.');
	    return False;
	  }
	}

 	public function order_report()
 	{
 		$this->d_distributormodel->CSRFVerify();
 		if($_POST)
 		{
 			if($_REQUEST['user_type'] != ''){
				$this->form_validation->set_rules('dealer_salesman','User','required|trim');
			}
			if($_REQUEST['s_date'] != ''){

				$this->form_validation->set_rules('user_type','User','required|trim');
				$this->form_validation->set_rules('e_date','User','required|trim|callback_compareDate');
			}
			
			$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

			if($this->form_validation->run() == false)  
			{  
				$data['orders'] = 'none';
	 			$data['page'] = 'report/report';
				$this->load->view('distributor/template',$data);
			}
			else
			{
				$orders=$this->d_reportmodel->get_order_report_data($_REQUEST['user_type'],$_REQUEST['dealer_salesman'],$_REQUEST['s_date'],$_REQUEST['e_date']);
		 			$data['orders'] = $orders;
		 			$data['page'] = 'report/report';
		 			
				$this->load->view('distributor/template',$data);	
			}
 
 		}
		else
 		{
 			$data['orders'] = 'none';
 			$data['page'] = 'report/report';
			$this->load->view('distributor/template',$data);	
 		}
 		
	}
	
	public function user_type_dropdown_ajax()
	{

		$user_type=$_REQUEST['user_type'];
		$report=$this->d_reportmodel->get_dealer_or_salesman($user_type);
		$output = '<option value="">Select Name</option>';
		if(isset($_REQUEST['dealer_salesman']))
		{
			$dealer_salesman = $_REQUEST['dealer_salesman'];
			foreach($report as $row)
			{	
				$val_id = $row->user_id;

				if($dealer_salesman == $val_id)
				{
					$selected = 'selected';
				}
				else
				{
					$selected = '';
				}

				$output .= '<option value="'.$val_id.'" '.$selected.'>'.$row->first_name.' '.$row->last_name.'</option>';
			}
		}
		else
		{
			foreach($report as $row)
			{	
				$val_id = $row->user_id;
				$output .= '<option value="'.$val_id.'">'.$row->first_name.' '.$row->last_name.'</option>';
			}
		}
        echo $output;
	}
}
