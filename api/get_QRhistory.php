<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

if(empty($_POST['user_id']))
{
	$res = array(
		"status"=>"false",
		"message"=>"Require argument missing.",
	);
    echo json_encode($res);
    exit;
}

db_connect();

$qr_history = getRows("SELECT q.*, p.name as product_name, p.product_image
	FROM qr_history as q
	INNER JOIN products as p ON q.product_id = p.id
	WHERE q.user_id=:user_id
	ORDER BY q.id DESC",array('user_id'=>$_POST['user_id']));
$output = array();
foreach ($qr_history as $idx => $row) 
{
	$output[$idx] = $row;

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
	if(!empty($output[$idx]['qr_image']))
	{	
		$output[$idx]['qr_image'] = $baseURL."uploads/qr_image/".$output[$idx]['qr_image'];
	}
}
if(!empty($output)){
	$res = array(
		"status"=>"true",
		"message"=>"Successful.",
		"response"=>$output
	);
	echo json_encode($res);
	exit;
}else{
	$res = array(
		"status"=>"true",
		"message"=>"Data not found.",
		"response"=>$output
	);
	echo json_encode($res);
	exit;
}