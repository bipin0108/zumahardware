<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class OrderController extends CI_Controller
{
 	public function __construct()
    {
        parent::__construct();
    }

 	public function index()
 	{
 		$this->d_distributormodel->CSRFVerify();
 		$data['page'] = 'order/list_order';
		$this->load->view('distributor/template',$data);
	}

	public function my_order()
 	{
 		$this->d_distributormodel->CSRFVerify();
 		$data['page'] = 'order/my_order';
		$this->load->view('distributor/template',$data);
	}

	public function pending_order()
 	{
 		$this->d_distributormodel->CSRFVerify();
 		$data['page'] = 'order/pending_order';
		$this->load->view('distributor/template',$data);
	}

	public function confirm_order()
 	{
 		$this->d_distributormodel->CSRFVerify();
 		$data['page'] = 'order/confirm_order';
		$this->load->view('distributor/template',$data);
	}

	public function delivered_order()
 	{
 		$this->d_distributormodel->CSRFVerify();
 		$data['page'] = 'order/delivered_order';
		$this->load->view('distributor/template',$data);
	}

	public function completed_order()
 	{
 		$this->d_distributormodel->CSRFVerify();
 		$data['page'] = 'order/completed_order';
		$this->load->view('distributor/template',$data);
	}


	public function create_order()
	{
		$this->d_distributormodel->CSRFVerify();
		$data['page'] = 'order/add_order';
		$this->load->view('distributor/template',$data);
	}
	
	public function view_order($order_id)
	{
		$res=$this->ordermodel->get_items_by_orderid($order_id);
		echo json_encode($res);
	}

	public function view_orderitem($order_id)
	{
		$res=$this->ordermodel->get_items_by_orderid($order_id);
		echo json_encode($res);
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
		
		

		$check = $this->d_ordermodel->change_status($order_id, $params);
		
		if($check)
		{
			
			if($_POST['order_status'] == 'Cancelled' || $_POST['order_status'] == 'Returned' ){
				$items = $this->d_ordermodel->get_order_item_by_order_id($order_id);
			}
			$this->session->set_flashdata('update_success', 'Status has been change Successfully..');
			if ($_POST['order_status']=='pending') {
				redirect('distributor/pending-order');	
			}elseif ($_POST['order_status']=='confirmed') {
				redirect('distributor/confirm-order');	
			}elseif ($_POST['order_status']=='delivered' && $_POST['order_status']=='delivered') {
				redirect('distributor/delivered-order');
			}elseif ($_POST['order_status']=='completed') {
				redirect('distributor/completed-order');
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
				redirect('distributor/completed-order');
			}else{
				redirect('distributor/delivered-order');
			}	
		}
	}
	
	public function create_placeorder()
	{
		$this->d_distributormodel->CSRFVerify();
		$data['page'] = 'order/add_placeorder';
		$this->load->view('distributor/template',$data);
	}

	public function get_product_attribute_ajax()
	{
		$product_arr = explode(',',$_REQUEST['product_arr']);
		$my_arr = array();
		foreach ($product_arr as $pro_id) {
			$pro_attribute=$this->d_ordermodel->get_pro_att_by_product_id($pro_id);
			$new_arr['product_id'] = $pro_id;
			$new_arr['att_name'] = $this->d_ordermodel->get_attname_by_id($pro_id);
			$new_arr['product_name'] = $this->d_ordermodel->get_productname_by_id($pro_id);

			$new_arr['item'] = $pro_attribute;
			array_push($my_arr,$new_arr);
		}
		echo json_encode($my_arr);
	}

	public function place_order_ajax()
	{

		$res =  json_decode($_REQUEST['res']);

		$order = $this->d_ordermodel->get_order();
		
			if (!empty($order)) 
			{
				$order_r=str_replace("zuma00000", "", $order->order_id);
				$order_id = $order_r + 1;
			}else{
				$order_id = 1;
			}
			$param = array(
				'order_id'=> 'zuma00000'.$order_id,
				'user_id' =>  $_REQUEST['id'],
				'user_type' => 'distributor',
				'order_status' => 'pending',
				
			);

			$addorder_id = $this->d_ordermodel->add_order($param);
			
			foreach($res as $row) {
				foreach ($row->attr as $attr) {

					$data = array(
						'order_id'=> $addorder_id,
						'product_id' => $attr->product_id,
						'qty' => $attr->qty,
						'product_att' => $attr->pro_att,
						'att_val' => $attr->att_name,
						'price' => $attr->att_value,
					);
					$this->d_ordermodel->add_orderitems($data);
				}
			}
		
		$this->session->set_flashdata('add_success', 'Order has been placed Successfully..');
	}

	public function update_qty()
	{
		
		$order_item_id = explode(',',$_POST['order_item_str']);

		$qty = explode(',',$_POST['qty_str']);
		
		$count = count($order_item_id);
		for($i=0;$i<$count;$i++)
		{	
			$param = array('qty'=>@$qty[$i]);
			$this->d_ordermodel->update_qty_by_order_id(@$order_item_id[$i],$param);
		}
	    $this->session->set_flashdata('update_success', 'Quantity has been udated Successfully..');
	}

	public function get_Item_byOrderId_ajax()
	{
		$order_id = $_REQUEST['order_id'];
		$res= $this->d_ordermodel->get_OrderItem($order_id);
		echo json_encode($res);
	}
}

