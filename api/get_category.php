<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

db_connect();

$category = getRows("SELECT c.* FROM category c WHERE c.id IN ( SELECT s.subcat_parentid FROM subcategory s WHERE s.subcat_id IN ( SELECT p.subcategory  FROM products p WHERE p.subcategory = s.subcat_id) AND s.subcat_parentid = c.id  ) ORDER BY c.id ASC");
$output = array();

if(!empty($category)){
	foreach ($category as $idx => $row) {
		$subcategory = getRows("SELECT s.subcat_id,s.subcat_name,s.subcat_parentid FROM subcategory s WHERE s.subcat_id IN ( SELECT p.subcategory  FROM products p WHERE p.subcategory = s.subcat_id) AND s.subcat_parentid = :cat_id",array("cat_id"=>$row['id']));
		$subcat = array();
		foreach ($subcategory as $k => $val) {
			$subcat[$k] = array(
				"id"=>$val['subcat_id'],
				"name"=>$val['subcat_name']
			);
		}
		if(!empty($row['image']))
		{	
			$img = $baseURL."uploads/categories/".$row['image'];
		}else{
			$img = "";
		}
		$output[$idx] = array(
			"id"=>$row['id'],
			"name"=>$row['name'],
			"image"=>$img,
			"subcategory"=>$subcat
		);
	}
}

$res = array(
	"status"=>"true",
	"message"=>"Successful.",
	"response"=>array("category" => $output)
);
echo json_encode($res);
exit;