<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

if( empty($_POST['user_id'])){

	$res = array(
		"status"=>"false",
		"message"=>"Require argument missing.",
	);
    echo json_encode($res);
    exit;

}

db_connect();
// CHECK USER
$user = getRow("SELECT * FROM users WHERE user_id=:id  ",array("id"=>$_POST['user_id']));
if (!empty($user)) {
	
	// FILE UPLOAD
	$target_dir = "";
	$target_file = "";
	if(!empty($_FILES["image"]["name"])){
		$target_dir = "../uploads/user/";
		$target_file = time().basename($_FILES["image"]["name"]);
		move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$target_file);
	}

	// UPDATE USER PROFILE
	$data['first_name'] = $_POST['first_name'];
	$data['last_name'] = $_POST['last_name'];
	$data['address'] = $_POST['address'];
	if(!empty($_FILES["image"]["name"])){
		$data['image'] = $target_file;
	}
	updateRow("users",$data,array("user_id"=>$_POST['user_id']));


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



