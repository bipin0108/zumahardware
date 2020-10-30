<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

if( empty($_POST['distributor_id']))
{
	$res = array(
		"status"=>"false",
		"message"=>"Require argument missing.",
	);
    echo json_encode($res);
    exit;
}
db_connect();
db_connect();
// GET DEALER
$dealer = getRows("SELECT u.user_id , concat(u.first_name,' ',u.last_name) as dealer_name 
	FROM distributor as d
	INNER JOIN users as u ON d.id = u.distributor_id
	WHERE d.id = :distributor_id AND u.type = 'dealer'
	ORDER BY u.user_id ASC",array("distributor_id"=>$_POST['distributor_id']));

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
		"message"=>"Data not found."
	);
	echo json_encode($res);
	exit;
}