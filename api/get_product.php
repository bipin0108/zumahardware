<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

if(empty($_POST['cat_id'])){

	$res = array(
		"status"=>"false",
		"message"=>"Require argument missing.",
	);
    echo json_encode($res);
    exit;
}

db_connect();

$category = getRow("SELECT * FROM category WHERE id=:id",array("id"=>$_POST['cat_id']));
if(!empty($category)){
	$subcategory = getRows("SELECT s.subcat_id,s.subcat_name,s.subcat_parentid FROM subcategory s WHERE s.subcat_id IN ( SELECT p.subcategory  FROM products p WHERE p.subcategory = s.subcat_id) AND s.subcat_parentid = :cat_id",array("cat_id"=>$category['id']));
	$products_details = array();
	foreach ($subcategory as $k => $val) {
		$products = getRows("
		SELECT p.id,p.name product_name,p.code,c.name category,s.subcat_name subcategory,p.description,p.product_image 
		FROM products as p
		LEFT JOIN category as c ON p.category = c.id
		LEFT JOIN subcategory as s ON p.subcategory = s.subcat_id
		WHERE p.subcategory = :subcat_id
		ORDER BY p.id DESC",array("subcat_id"=>$val['subcat_id']));
		$output = array();
		foreach ($products as $idx => $row) 
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
			$product_att = getRows("SELECT p.* ,a.att_name as attribute_name
				FROM product_attribute as p 
				LEFT JOIN attribute as a ON p.att_id = a.att_id
				WHERE product_id = :product_id ORDER BY p.id DESC",
				array("product_id"=>$output[$idx]['id']));
			if(!empty($product_att))
			{
				$output[$idx]['product_attribute'] = $product_att;
			}else{
				$output[$idx]['product_attribute'] = array();
			}
		}
		$subcat_name = $val['subcat_name'];
		//$products_details[$subcat_name] = $output;
		//$products_details = array($subcat_name => $output);
		$products_details[$subcat_name] = $output;
	}
	$res = array(
		"status"=>"true",
		"message"=>"Successful.",
		"response"=> $products_details
	);
	echo json_encode($res);
	exit;
}else{
	$res = array(
		"status"=>"false",
		"message"=>"Category not found."
	);
	echo json_encode($res);
	exit;
}


