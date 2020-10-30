<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

if( empty($_POST['user_id']) ||
	empty($_POST['product_id']) ||
	empty($_POST['mobile_no']) ||
	empty($_POST['address'])){

	$res = array(
		"status"=>"false",
		"message"=>"Require argument missing.",
	);
    echo json_encode($res);
    exit;
}

db_connect();

// Check User

$user = getRow("SELECT * FROM users WHERE user_id = :user_id AND type!='carpenter'",array('user_id'=>$_POST['user_id']));
if (!empty($user)) {
	// Check Product

	$product = getRow("SELECT * FROM products WHERE id = :product_id",array('product_id'=>$_POST['product_id']));
	if (!empty($product)) {

		// Insert Complain
		$data['user_id'] = $_POST['user_id'];
		$data['product_id'] = $_POST['product_id'];
		$data['mobile_no'] = $_POST['mobile_no'];
		$data['address'] = $_POST['address'];
		$data['message'] = $_POST['message'];
		$data['type'] = $user['type'];
		$data['created_at'] = phpNow();
		$data['updated_at'] = phpNow();
		if (insertRow('complaints',$data)) {
			$res = array(
				"status"=>"true",
				"message"=>"Complaint has been sent successfully."
			);
		    echo json_encode($res);
		    exit;
		} else {
			$res = array(
				"status"=>"false",
				"message"=>"Your complaint is not sent successfully."
			);
		    echo json_encode($res);
		    exit;
		}

	}else{
		$res = array(
			"status"=>"false",
			"message"=>"Product is not available",
		);
	    echo json_encode($res);
	    exit;
	}
}else{
	$res = array(
		"status"=>"false",
		"message"=>"User is not available",
	);
    echo json_encode($res);
    exit;
}