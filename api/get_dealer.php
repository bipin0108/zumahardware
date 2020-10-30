<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

if(empty($_POST['user_id'])){

	$res = array(
		"status"=>"false",
		"message"=>"Require argument missing.",
	);
    echo json_encode($res);
    exit;
}

db_connect();

// CHECK USER
$user = getRow("SELECT * FROM users WHERE user_id=:id AND type = 'salesman'",array("id"=>$_POST['user_id']));
if (!empty($user)) {
	if ($user['distributor_id'] != 0) {
		// GET DEALERS
		$dealer = getRows("SELECT user_id,concat(first_name,' ',last_name) as dealer_name FROM users WHERE distributor_id = :distributor_id AND type = 'dealer' ORDER BY user_id ASC",
			array("distributor_id"=>$user['distributor_id']));
		if (!empty($dealer)) {
			$res = array(
				"status"=>"true",
				"message"=>"Successful.",
				"response"=> $dealer
			);
			echo json_encode($res);
			exit;
		}else{
			$res = array(
				"status"=>"false",
				"message"=>"Dealers are not available.",
				"response"=> array()
			);
			echo json_encode($res);
			exit;
		}
	}else{
		$res = array(
			"status"=>"false",
			"message"=>"Dealers are not available.",
			"response"=> array()
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
