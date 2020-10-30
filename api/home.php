<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

db_connect();
// HOME SLIDER
$slide = getRows("SELECT * FROM slider ORDER BY slider_id ASC");
$slider = array();
if(!empty($slide)){
	foreach ($slide as $idx => $row) {
		$slider[] = $baseURL."uploads/slider/".$row['slider_image'];
	}
}else{
	$slider[] = $slider;
}
// HOME PRODUCTS
$products = getRows("
	SELECT p.id,p.name product_name,p.code,p.is_hot,c.name category,s.subcat_name subcategory,p.description,p.product_image 
	FROM products as p
	LEFT JOIN category as c ON p.category = c.id
	LEFT JOIN subcategory as s ON p.subcategory = s.subcat_id
	ORDER BY p.id DESC");

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
	// print_r($output);
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


// HOME NEW ARRIVAL PRODUCTS
$new_arrival = getRows("
	SELECT p.id,p.name product_name,p.code,p.is_hot,c.name category,s.subcat_name subcategory,p.description,p.product_image 
	FROM products as p
	LEFT JOIN category as c ON p.category = c.id
	LEFT JOIN subcategory as s ON p.subcategory = s.subcat_id
	ORDER BY p.id DESC LIMIT 5");

$newarrival = array();
foreach ($new_arrival as $idx => $row) 
{
	$newarrival[$idx] = $row;

	$product_image_original = array();
	$product_image_thumbnail = array();
	if(!empty($newarrival[$idx]['product_image']))
	{	
		$pro_images = explode(',', $newarrival[$idx]['product_image']);
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
		$newarrival[$idx]['product_image_original'] = $product_image_original; 
		$newarrival[$idx]['product_image_thumbnail'] = $product_image_thumbnail;
	}else{
		$newarrival[$idx]['product_image_original'] = $product_image_original; 
		$newarrival[$idx]['product_image_thumbnail'] = $product_image_thumbnail;
	}

	$product_att = getRows("SELECT p.* ,a.att_name as attribute_name
		FROM product_attribute as p 
		LEFT JOIN attribute as a ON p.att_id = a.att_id
		WHERE product_id = :product_id ORDER BY p.id DESC",
		array("product_id"=>$newarrival[$idx]['id']));
	if(!empty($product_att))
	{
		$newarrival[$idx]['product_attribute'] = $product_att;
	}else{
		$newarrival[$idx]['product_attribute'] = array();
	}
}


// HOME HOT PRODUCTS
$hot_products = getRows("
	SELECT p.id,p.name product_name,p.code,p.is_hot,c.name category,s.subcat_name subcategory,p.description,p.product_image 
	FROM products as p
	LEFT JOIN category as c ON p.category = c.id
	LEFT JOIN subcategory as s ON p.subcategory = s.subcat_id
	WHERE p.is_hot = '1' ORDER BY p.id DESC");

$hotproducts = array();
foreach ($hot_products as $idx => $row) 
{
	$hotproducts[$idx] = $row;

	$product_image_original = array();
	$product_image_thumbnail = array();
	if(!empty($hotproducts[$idx]['product_image']))
	{	
		$pro_images = explode(',', $hotproducts[$idx]['product_image']);
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
		$hotproducts[$idx]['product_image_original'] = $product_image_original; 
		$hotproducts[$idx]['product_image_thumbnail'] = $product_image_thumbnail;
	}else{
		$hotproducts[$idx]['product_image_original'] = $product_image_original; 
		$hotproducts[$idx]['product_image_thumbnail'] = $product_image_thumbnail;
	}

	$product_att = getRows("SELECT p.* ,a.att_name as attribute_name
		FROM product_attribute as p 
		LEFT JOIN attribute as a ON p.att_id = a.att_id
		WHERE product_id = :product_id ORDER BY p.id DESC",
		array("product_id"=>$hotproducts[$idx]['id']));
	if(!empty($product_att))
	{
		$hotproducts[$idx]['product_attribute'] = $product_att;
	}else{
		$hotproducts[$idx]['product_attribute'] = array();
	}
}
$res = array(
    "status"=>"true",
    "message"=>"Successful.",
    "response"=>array(
		"slider"=>$slider,
		"products"=>$output,
		"new_arrival"=>$newarrival,
		"hot_products"=>$hotproducts
	)
);

 echo json_encode($res);
 exit;