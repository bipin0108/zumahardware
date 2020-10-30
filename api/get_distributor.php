<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

db_connect();

$distributor = getRows("SELECT id , concat(first_name,' ',last_name) as distributor_name FROM distributor ORDER BY id ASC");

if (!empty($distributor)) {
	$res = array(
		"status"=>"true",
		"message"=>"Successful.",
		"response"=> $distributor
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