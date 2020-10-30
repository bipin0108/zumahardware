<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

if( empty($_POST['user_id']) ||
	empty($_POST['product_id']) ||
	empty($_POST['unique_id']))
{
	$res = array(
		"status"=>"false",
		"message"=>"Require argument missing.",
	);
    echo json_encode($res);
    exit;
}

db_connect();
// CHECK USER
$user = getRow("SELECT * FROM users 
	WHERE user_id=:user_id AND type='carpenter'",
	array("user_id"=>$_POST['user_id']));

if (empty($user)) {
	$res = array(
		"status"=>"false",
		"message"=>"User is not available.",
	);
    echo json_encode($res);
    exit;
}

// CHECK QR HISTORY
$qr_history = getRow("SELECT * FROM qr_history 
	WHERE uniqueid=:unique_id AND product_id=:product_id ",
	array("unique_id"=>$_POST['unique_id'],"product_id"=>$_POST['product_id']));

if (!empty($qr_history)) {
	$res = array(
		"status"=>"false",
		"message"=>"QR Code is not available.",
	);
    echo json_encode($res);
    exit;
}

// CHECK QRCODE
$qrcode = getRow("SELECT * FROM qrcode 
	WHERE uniqueid=:unique_id AND product_id=:product_id ",
	array("unique_id"=>$_POST['unique_id'],"product_id"=>$_POST['product_id']));

if(!empty($qrcode)){
	// INSERT QR HISTORY
	$data['user_id'] = $_POST['user_id'];
	$data['product_id'] = $_POST['product_id'];
	$data['uniqueid'] = $qrcode['uniqueid'];
	$data['point'] = $qrcode['point'];
	$data['qr_image'] = $qrcode['qr_image'];
	$data['status'] = 'Success';
	$data['scan_date'] = phpNow();
	insertRow('qr_history',$data);

	$prm['from_u'] = 0;
	$prm['to_u'] = $_POST['user_id'];
	$prm['point'] = $qrcode['point'];
	$prm['status'] = 'debit';
	$prm['transfer_date'] = phpNow();
	insertRow('transfer_history',$prm);

	// UPDATE USER POINTS
	$point = $user['point'] + $qrcode['point'];
	$param['point'] = $point;
	updateRow('users',$param,array('user_id'=>$_POST['user_id']));

	// DELETE QR CODE
	deleteRows('qrcode',array("uniqueid"=>$_POST['unique_id'],"product_id"=>$_POST['product_id']));

	$check = getRow("SELECT * FROM users 
	WHERE user_id=:user_id AND type='carpenter'",
	array("user_id"=>$_POST['user_id']));
	if(!empty($check)){
	 if($check['image']=="")
		{	
			$check['image'] = $baseURL."uploads/user/default_user.png";
		}else
		{
			$check['image'] = $baseURL."uploads/user/".$check['image'];		
		}

	$product = getRow("SELECT p.id,p.name as product_name,c.name category,s.subcat_name subcategory,p.product_image
	FROM products as p
	LEFT JOIN category as c ON p.category = c.id
	LEFT JOIN subcategory as s ON p.subcategory = s.subcat_id
	WHERE p.id=:product_id ",array("product_id"=>$_POST['product_id']));
	if(!empty($product)){
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
	}
		$res = array(
			"status"=>"true",
			"message"=>"Successful.",
			"response"=>array("user"=>$check,"product"=>$product,"qrcode_point"=>$qrcode['point'])
		);
		echo json_encode($res);
		exit;
	}

}else{
	$res = array(
		"status"=>"false",
		"message"=>"Data not found.",
	);
    echo json_encode($res);
    exit;
}