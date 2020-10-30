<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

if(empty($_POST['unique_id']))
{
	$res = array(
		"status"=>"false",
		"message"=>"Require argument missing.",
	);
    echo json_encode($res);
    exit;
}

db_connect();

$Qr_history = getRow("SELECT * FROM qr_history WHERE uniqueid = :unique_id",array('unique_id'=>$_POST['unique_id']));

if(!empty($Qr_history['qr_image']))
{	
	$Qr_history['qr_image'] = $baseURL."uploads/qr_image/".$Qr_history['qr_image'];
}

if(!empty($Qr_history)){

	$user = getRow("SELECT * FROM users WHERE user_id = :user_id",array('user_id'=>$Qr_history['user_id']));
	if (!empty($user)) {
		if($user['image']=="")
		{	
			$user['image'] = $baseURL."uploads/user/default_user.png";
		}else
		{
			$user['image'] = $baseURL."uploads/user/".$user['image'];		
		}
	}else{
		$user = array();
	}
	
	$product = getRow("SELECT p.*,c.name category,s.subcat_name subcategory
	FROM products as p
	LEFT JOIN category as c ON p.category = c.id
	LEFT JOIN subcategory as s ON p.subcategory = s.subcat_id
	WHERE p.id=:product_id ",array("product_id"=>$Qr_history['product_id']));
	if(!empty($product))
	{
		$product_image_original = array();
		$product_image_thumbnail = array();
		if(!empty($product['product_image']))
		{	
			$pro_images = explode(',', $product['product_image']);
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
			$product['product_image_original'] = $product_image_original; 
			$product['product_image_thumbnail'] = $product_image_thumbnail;
		}else{
			$product['product_image_original'] = $product_image_original; 
			$product['product_image_thumbnail'] = $product_image_thumbnail;
		}
	}else{
		$product = array();
	}
}

if (!empty($Qr_history)) {
	$res = array(
		"status"=>"true",
		"message"=>"Successful.",
		"response"=>array("Qr_history"=>$Qr_history,"user"=>$user,"product"=>$product)
	);
	echo json_encode($res);
	exit;
}else{
	$res = array(
		"status"=>"false",
		"message"=>"Data not found."	
	);
	echo json_encode($res);
	exit;
}