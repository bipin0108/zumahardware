<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

if( empty($_POST['user_id']))
{
	$res = array(
		"status"=>"false",
		"message"=>"Require argument missing.",
	);
    echo json_encode($res);
    exit;
}
db_connect();
// GET USER DETAILS
$user = getRow("SELECT * FROM users WHERE user_id=:user_id AND type != 'carpenter'",array('user_id'=>$_POST['user_id']));

if(!empty($user)){
	// PAST ORDER
	if ($user['type'] == 'salesman') {
		$past_order = getRows("SELECT o.*,
			if(o.user_type = 'dealer',
				concat(u.first_name,' ',u.last_name,' Dealer'),
				concat(d.first_name,' ',d.last_name,' Distributor')
			) as reference_name
		FROM orders as o  
		LEFT JOIN users as u ON o.user_id = u.user_id
		LEFT JOIN distributor as d ON o.user_id = d.id	
		WHERE o.salesman_id=:user_id AND o.order_status = 'completed' ORDER BY o.id DESC",array("user_id"=>$_POST['user_id']));
	}else{
		$past_order = getRows("SELECT o.*,concat(u.first_name,' ',u.last_name) as reference_name FROM orders as o  
		LEFT JOIN users as u ON o.salesman_id = u.user_id  
		WHERE o.user_id=:user_id AND o.order_status = 'completed' ORDER BY o.id DESC",array("user_id"=>$_POST['user_id']));
	}

	$pastorder = array();
	foreach ($past_order as $idx => $row) 
	{
		$pastorder[$idx] = $row;
		$past_order_items = getRows("SELECT oi.*,p.name as product_name,p.product_image,a.att_name FROM order_items as oi 
		INNER JOIN products as p ON oi.product_id = p.id
		LEFT JOIN attribute as a ON oi.product_att = a.att_id
		WHERE oi.order_id=:order_id ORDER BY oi.id DESC",array("order_id"=>$pastorder[$idx]['id']));
		$output = array();
		foreach ($past_order_items as $id => $val) 
		{
			$output[$id] = $val;

			$product_image_original = array();
			$product_image_thumbnail = array();
			if(!empty($output[$idx]['product_image']))
			{	
				$pro_images = explode(',', $output[$idx]['product_image']);
				foreach ($pro_images as $v) 
				{
					$original_img = $baseURL."uploads/products/product_images/original/".$v;
					$thumbnail_img = $baseURL."uploads/products/product_images/thumbnail/".$v;
					if(!empty($v))
					{
						array_push($product_image_original, $original_img);
						array_push($product_image_thumbnail, $thumbnail_img);
					}
				}
				$output[$idx]['product_image_original'] = $product_image_original; 
				$output[$idx]['product_image_thumbnail'] = $product_image_thumbnail;
			}else{
				$output[$idx]['product_image_original'] = $product_image_original; 
				$output[$idx]['product_image_thumbnail'] = $product_image_thumbnail;
			}
		$pastorder[$idx]['order_items'] = $output;
		}
	}

	// ONGOING ORDER
	if ($user['type'] == 'salesman') {
		$ongoing_order = getRows("SELECT o.*,
			if(o.user_type = 'dealer',
				concat(u.first_name,' ',u.last_name,' Dealer'),
				concat(d.first_name,' ',d.last_name,' Distributor')
			) as reference_name
		FROM orders as o  
		LEFT JOIN users as u ON o.user_id = u.user_id
		LEFT JOIN distributor as d ON o.user_id = d.id	
		WHERE o.salesman_id=:user_id AND o.order_status != 'completed' ORDER BY o.id DESC",array("user_id"=>$_POST['user_id']));
	}else{
		$ongoing_order = getRows("SELECT o.*,concat(u.first_name,' ',u.last_name) as reference_name FROM orders as o  
		LEFT JOIN users as u ON o.salesman_id = u.user_id  
		WHERE o.user_id=:user_id AND o.order_status != 'completed' ORDER BY o.id DESC",array("user_id"=>$_POST['user_id']));
	}

	$ongoingorder = array();
	foreach ($ongoing_order as $key => $row) 
	{
		$ongoingorder[$key] = $row;
		$ongoing_order_items = getRows("SELECT oi.*,p.name as product_name,p.product_image,a.att_name FROM order_items as oi 
		INNER JOIN products as p ON oi.product_id = p.id
		LEFT JOIN attribute as a ON oi.product_att = a.att_id
		WHERE oi.order_id=:order_id ORDER BY oi.id DESC",array("order_id"=>$ongoingorder[$key]['id']));
		$output2 = array();
		foreach ($ongoing_order_items as $idx => $val) 
		{
			$output2[$idx] = $val;

			$product_image_original2 = array();
			$product_image_thumbnail2 = array();
			if(!empty($output2[$idx]['product_image']))
			{	
				$pro_images = explode(',', $output2[$idx]['product_image']);
				foreach ($pro_images as $v) 
				{
					$original_img2 = $baseURL."uploads/products/product_images/original/".$v;
					$thumbnail_img2 = $baseURL."uploads/products/product_images/thumbnail/".$v;
					if(!empty($v))
					{
						array_push($product_image_original2, $original_img2);
						array_push($product_image_thumbnail2, $thumbnail_img2);
					}
				}
				$output2[$idx]['product_image_original'] = $product_image_original2; 
				$output[$idx]['product_image_thumbnail'] = $product_image_thumbnail2;
			}else{
				$output2[$idx]['product_image_original'] = $product_image_original2; 
				$output2[$idx]['product_image_thumbnail'] = $product_image_thumbnail2;
			}
		$ongoingorder[$key]['order_items'] = $output2;
		}
	}
	$res = array(
	    "status"=>"true",
	    "message"=>"Successful.",
	    "response"=>array("past_order" => $pastorder,"ongoing_order" => $ongoingorder)
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