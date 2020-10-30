<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

if(empty($_POST['user_type'])){

	$res = array(
		"status"=>"false",
		"message"=>"Require argument missing.",
	);
    echo json_encode($res);
    exit;
}

db_connect();

// CHECK NOTIFICATIONS
$notification = getRows("SELECT * FROM notification WHERE find_in_set(:user_type,user_type) ORDER BY id DESC",array("user_type"=>$_POST['user_type']));
$output = array();
if(!empty($notification)){
	foreach ($notification as $idx => $row) 
	{
		$output[$idx] = $row;
		$output[$idx]['created_at'] = date('F j, Y, g:i a',strtotime($output[$idx]['created_at']));
	}
}
if (!empty($output)) {
	$res = array(
		"status"=>"true",
		"message"=>"Successful.",
		"response"=>$output
	);
	echo json_encode($res);
    exit;
}else{
	$res = array(
		"status"=>"false",
		"message"=>"Data not found.",
	);
    echo json_encode($res);
    exit;
}