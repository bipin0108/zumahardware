<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class OrderController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'order/list_order';
		$this->load->view('admin/template',$data);
	}

	public function create_order()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'order/add_order';
		$this->load->view('admin/template',$data);
	}

	public function distributor_order()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'order/distributor_order';
		$this->load->view('admin/template',$data);
	}

	public function pending_order()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'order/pending_order';
		$this->load->view('admin/template',$data);
	}

	public function confirm_order()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'order/confirm_order';
		$this->load->view('admin/template',$data);
	}

	public function delivered_order()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'order/delivered_order';
		$this->load->view('admin/template',$data);
	}

	public function completed_order()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'order/completed_order';
		$this->load->view('admin/template',$data);
	}

	public function change_status($order_id)
	{
		
		if(!empty($_POST['change_status'])){
		       $params = array(
        			"order_status"=>$_POST['order_status'],
        			"delivered_by"=>$_POST['change_status'],
        			"lr_number"=>$_POST['lr'],
        			"date"=>$_POST['date'],
        		);
		   }else{
	            $params = array(
			        "order_status"=>$_POST['order_status'], 
		        );
		   }
		
		$check = $this->ordermodel->change_status($order_id, $params);
		
		if($check)
		{
			if($_POST['order_status'] == 'Cancelled' || $_POST['order_status'] == 'Returned' ){
				$items = $this->ordermodel->get_order_item_by_order_id($order_id);
			}
			$this->session->set_flashdata('update_success', 'Status has been change Successfully..');
			// redirect('admin/distributor-order');	
			if ($_POST['order_status']=='pending') {
				redirect('admin/pending-order');	
			}elseif ($_POST['order_status']=='confirmed') {
				redirect('admin/confirm-order');	
			}elseif ($_POST['order_status']=='delivered') {
				redirect('admin/delivered-order');
			}elseif ($_POST['order_status']=='completed') {
				redirect('admin/completed-order');
			}
		}
	}
	
	public function change_delivered_status($order_id)
	{
		
		$params = array(
			"order_status"=>$_POST['order_status']
		);
		$check = $this->ordermodel->change_status($order_id, $params);
		
		if($check)
		{
			if($_POST['order_status'] == 'Cancelled' || $_POST['order_status'] == 'Returned' ){
				$items = $this->ordermodel->get_order_item_by_order_id($order_id);
			}
			$this->session->set_flashdata('update_success', 'Status has been change Successfully..');
			if ($_POST['order_status']=='completed') {
				redirect('admin/completed-order');
			}else{
				redirect('admin/delivered-order');
			}		
		}
	}

	public function view_orderitem($order_id)
	{
		$res=$this->ordermodel->get_items_by_orderid($order_id);
		echo json_encode($res);
	}

	public function update_qty()
	{	
		$order_item_id = explode(',',$_POST['order_item_str']);
		$qty = explode(',',$_POST['qty_str']);
		$count = count($order_item_id);
		for($i=0;$i<= $count;$i++)
		{
			$param = array('qty'=>@$qty[$i]);
			$this->ordermodel->update_qty_by_order_id(@$order_item_id[$i],$param);
		}
		$this->session->set_flashdata('update_success', 'Quantity has been udated Successfully..');
	}

	public function get_Item_byOrderId_ajax()
	{
		$order_id = $_REQUEST['order_id'];
		$res= $this->ordermodel->get_OrderItem($order_id);
		echo json_encode($res);
	}
}

