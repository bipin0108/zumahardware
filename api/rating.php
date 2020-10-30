<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

if( empty($_POST['product_id']) ||
	empty($_POST['rating']) ||
	empty($_POST['name']) ||
	empty($_POST['designation']) ||
	empty($_POST['city']) ||
	empty($_POST['review'])){

	$res = array(
		"status"=>"false",
		"message"=>"Require argument missing.",
	);
    echo json_encode($res);
    exit;
}

db_connect();

// Check Product

$product = getRow("SELECT * FROM products WHERE id = :product_id",array('product_id'=>$_POST['product_id']));
if (!empty($product)) {
	if ($_POST['rating'] > 5) {
		$res = array(
			"status"=>"false",
			"message"=>"Rating must be under 5 stars."
		);
	    echo json_encode($res);
	    exit;
	} else {
		// Insert Rating
		$data['product_id'] = $_POST['product_id'];
		$data['rating'] = $_POST['rating'];
		$data['name'] = $_POST['name'];
		$data['designation'] = $_POST['designation'];
		$data['city'] = $_POST['city'];
		$data['review'] = $_POST['review'];

		if (insertRow('rating',$data)) {
			$res = array(
				"status"=>"true",
				"message"=>"Rating has been sent successfully."
			);
		    echo json_encode($res);
		    exit;
		} else {
			$res = array(
				"status"=>"false",
				"message"=>"Your rating is not sent successfully."
			);
		    echo json_encode($res);
		    exit;
		}
	}
}else{
	$res = array(
		"status"=>"false",
		"message"=>"Product is not available",
	);
    echo json_encode($res);
    exit;
}
