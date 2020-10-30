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

	// PAST COMPLAINTS
	$past_complaints = getRows("SELECT c.*,p.name as product_name,p.product_image
	FROM complaints as c 
	INNER JOIN products as p ON c.product_id = p.id
	WHERE c.user_id=:user_id AND c.status='completed' ORDER BY c.id DESC",array("user_id"=>$_POST['user_id']));
	$output = array();
	foreach ($past_complaints as $id => $val) 
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
	}
	$past_complaints = $output;

	// ONGOING COMPLAINTS
	$ongoing_complaints = getRows("SELECT c.*,p.name as product_name,p.product_image
	FROM complaints as c 
	INNER JOIN products as p ON c.product_id = p.id
	WHERE c.user_id=:user_id AND c.status='pending' ORDER BY c.id DESC",array("user_id"=>$_POST['user_id']));
	$output2 = array();
	foreach ($ongoing_complaints as $idx => $val) 
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
			$output2[$idx]['product_image_thumbnail'] = $product_image_thumbnail2;
		}else{
			$output2[$idx]['product_image_original'] = $product_image_original2; 
			$output2[$idx]['product_image_thumbnail'] = $product_image_thumbnail2;
		}
	}
	$ongoing_complaints = $output2;
	
	$res = array(
	    "status"=>"true",
	    "message"=>"Successful.",
	    "response"=>array("past_complaints" => $past_complaints,"ongoing_complaints" => $ongoing_complaints)
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