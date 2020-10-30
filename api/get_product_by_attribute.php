<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

db_connect();

$attributes = getRows("SELECT a.* FROM attribute a WHERE a.att_id IN ( SELECT pa.att_id FROM product_attribute pa WHERE pa.product_id IN ( SELECT p.id  FROM products p WHERE pa.product_id = p.id) AND pa.att_id = a.att_id  ) ORDER BY a.att_id ASC");

$att_details = array();

if (!empty($attributes)) {
	foreach ($attributes as $key => $val) {
		$att_details[$key] = $val;
		$product_att = getRows("SELECT p.* ,a.att_name as attribute_name,pr.name product_name,pr.code,c.name category,s.subcat_name subcategory,pr.description,pr.product_image 
				FROM product_attribute as p 
				LEFT JOIN attribute as a ON p.att_id = a.att_id
				INNER JOIN products as pr ON pr.id = p.product_id
				LEFT JOIN category as c ON pr.category = c.id
				LEFT JOIN subcategory as s ON pr.subcategory = s.subcat_id
				WHERE p.att_id = :att_id ORDER BY p.id ASC",
				array("att_id"=>$val['att_id']));

		$output = array();
		foreach ($product_att as $idx => $row) 
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
		}
		$att_details[$key] = $output;
	}
	$res = array(
		"status"=>"true",
		"message"=>"Successful.",
		"response"=>$att_details
	);
	echo json_encode($res);
	exit;
}else{
	$res = array(
		"status"=>"false",
		"message"=>"NO data found.",
	);
	echo json_encode($res);
	exit;
}
