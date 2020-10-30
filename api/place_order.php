<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

if( empty($_POST['user_id']) ||
	empty($_POST['order_items']))
{
	$res = array(
		"status"=>"false",
		"message"=>"Require argument missing.",
	);
    echo json_encode($res);
    exit;
}
db_connect();
$order_items = json_decode($_POST['order_items'], true);
foreach ($order_items as $val) {
	// check product
	$product = getRow("SELECT * FROM products WHERE id=:product_id",
			array("product_id"=>$val['product_id']));
	if(!empty($product)){

		// check product attribute
		$product_att = getRow("SELECT * FROM product_attribute WHERE id=:product_att_id AND product_id=:product_id",array('product_att_id'=>$val['product_att_id'],'product_id'=>$val['product_id']));

		if (empty($product_att)) {
			$res = array(
			    "status"=>"false",
			    "message"=>"Product attributes is not available!."
			);
			echo json_encode($res);
			exit;
		}
	}else{
			$res = array(
			    "status"=>"false",
			    "message"=>"Product is not available!."
			);
			echo json_encode($res);
			exit;
	}
}
// GET USER DETAILS
$user = getRow("SELECT * FROM users WHERE user_id=:user_id AND type != 'carpenter'",array('user_id'=>$_POST['user_id']));

if (!empty($user)) {
	// GET LAST ORDER_ID 
	$order = getRow("SELECT * FROM orders ORDER BY id DESC");

	if(!empty($order['order_id'])){
		$order_id = str_replace("zuma00000", "", $order['order_id']) + 1;
	}else{
		$order_id = 1;
	}

	// INSERT ORDER DETAILS

	if ($user['type'] == "salesman" && $user['distributor_id'] == '0') {
		if(!empty($_POST['distributor_id']) && $_POST['distributor_id'] != '0'){
			$data['order_id'] = "zuma00000".$order_id;
			$data['salesman_id'] = $user['user_id'];

			if(!empty($_POST['dealer_id']) && $_POST['dealer_id'] != '0'){
				$data['user_id'] = $_POST['dealer_id'];
				$data['user_type'] = 'dealer';
			}else{
				$data['user_id'] = $_POST['distributor_id'];
				$data['user_type'] = 'distributor';
			}	
			
			$data['created_at'] = phpNow();
		}else{
			$res = array(
			    "status"=>"false",
			    "message"=>"Please select any one distributor."
			);
			echo json_encode($res);
			exit;
		}
	}
	elseif ($user['type'] == "salesman" && $user['distributor_id'] != '0') {
		if(!empty($_POST['dealer_id']) && $_POST['dealer_id'] != '0'){
			$data['order_id'] = "zuma00000".$order_id;
			$data['salesman_id'] = $user['user_id'];
			$data['user_id'] = $_POST['dealer_id'];
			$data['user_type'] = 'dealer';
			$data['created_at'] = phpNow();
		}else{
			$res = array(
			    "status"=>"false",
			    "message"=>"Please select any one dealer."
			);
			echo json_encode($res);
			exit;
		}
	}
	else{
		$data['order_id'] = "zuma00000".$order_id;
		$data['user_id'] = $user['user_id'];
		$data['user_type'] = $user['type'];
		$data['created_at'] = phpNow();
	}

	$order_id = insertRow('orders',$data);

	foreach ($order_items as $row) {
		// check product
		$product = getRow("SELECT * FROM products WHERE id=:product_id",
				array("product_id"=>$row['product_id']));

		// check product attribute
		$product_att = getRow("SELECT * FROM product_attribute WHERE id=:product_att_id AND product_id=:product_id",array('product_att_id'=>$row['product_att_id'],'product_id'=>$row['product_id']));

		// insert order item 
		$params['order_id'] = $order_id;
		$params['product_id'] = $row['product_id'];
		$params['qty'] = $row['qty'];
		$params['product_att'] = $product_att['att_id'];
		$params['att_val'] = $product_att['att_name'];
		$params['price'] = $product_att['att_value'];
		$params['total'] = $product_att['att_value'] * $row['qty'];
		$id = insertRow('order_items',$params);
	}
	$res = array(
	    "status"=>"true",
	    "message"=>"Successful.",
	);
	echo json_encode($res);
	exit;		
}else{
	$res = array(
	    "status"=>"false",
	    "message"=>"Data Not Found."
	);
	echo json_encode($res);
	exit;
}