<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

if(empty($_POST['user_id']) ||
   empty($_POST['user_type']) ||
   empty($_POST['device_token']))
{
	$res = array(
		"status"=>"false",
		"message"=>"Require argument missing.",
	);
    echo json_encode($res);
    exit;
}
db_connect();

// CHECK USER
$user = getRow("SELECT * FROM users WHERE user_id=:id AND type=:user_type ",array("id"=>$_POST['user_id'],"user_type"=>$_POST['user_type']));
if (!empty($user)) {

	// UPDATE DEVICE TOKEN
	$data['device_token'] = $_POST['device_token'];
	updateRow("users",$data,array("user_id"=>$_POST['user_id'],"type"=>$_POST['user_type']));

	$result = getRow("SELECT * FROM users WHERE user_id=:id  ",array("id"=>$_POST['user_id']));
	 if($result['image']=="")
		{	
		  $result['image'] = $baseURL."uploads/user/default_user.png";
		}else
		{
		  $result['image'] = $baseURL."uploads/user/".$result['image'];		
		}

	$res = array(
	    "status"=>"true",
	    "message"=>"Update successful.",
	    "response"=>$result
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