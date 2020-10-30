<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

if( empty($_POST['product_id']))
{

	$res = array(
		"status"=>"false",
		"message"=>"Require argument missing.",
	);
    echo json_encode($res);
    exit;

}

db_connect();

// PRODUCT DETAILS
$product = getRow("
	SELECT p.*,c.name category,s.subcat_name subcategory,(SELECT a.att_name FROM attribute as a WHERE pa.att_id = a.att_id) as main_attribute_name
	FROM products as p
	LEFT JOIN category as c ON p.category = c.id
	LEFT JOIN subcategory as s ON p.subcategory = s.subcat_id
	LEFT JOIN product_attribute as pa ON pa.product_id = p.id
	WHERE p.id=:product_id",array("product_id"=>$_POST['product_id']));
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

	$arr_original = array();
	$arr_thumbnail = array();
	if(!empty($product['installation_guide_images']))
	{
		$images = explode(',', $product['installation_guide_images']);
		foreach ($images as $idx => $v) 
		{
			$original_img = $baseURL."uploads/products/products_multiple/original/".$v;
			$thumbnail_img = $baseURL."uploads/products/products_multiple/thumbnail/".$v;
			if(!empty($v))
			{
				$arr_original[$idx]['source']['uri']  = $original_img;
				$arr_thumbnail[$idx]['source']['uri']  = $thumbnail_img;
			}
		}
		$product['installation_guide_images_original'] = $arr_original;
		$product['installation_guide_images_thumbnail'] = $arr_thumbnail; 
	}else{
		$product['installation_guide_images_original'] = $arr_original; 
		$product['installation_guide_images_thumbnail'] = $arr_thumbnail;
	}
	if(!empty($product['installation_guide_videos']))
	{	
		$product['installation_guide_videos'] = $baseURL."uploads/products/product_video/".$product['installation_guide_videos'];
	}

	$product_att = getRows("SELECT p.* ,a.att_name as attribute_name
		FROM product_attribute as p 
		LEFT JOIN attribute as a ON p.att_id = a.att_id
		WHERE product_id = :product_id ORDER BY id DESC",
		array("product_id"=>$_POST['product_id']));
	if(!empty($product_att))
	{
		$product['product_attribute'] = $product_att;
	}else{
		$product['product_attribute'] = array();
	}
}
if(!empty($product)){
	$res = array(
		"status"=>"true",
		"message"=>"Successful.",
		"response"=>$product
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