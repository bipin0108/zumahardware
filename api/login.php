<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

if( empty($_POST['mobile_no']) || empty($_POST['password']) ){

	$res = array(
		"status"=>"false",
		"message"=>"Require argument missing.",
	);
    echo json_encode($res);
    exit;

}

db_connect();

$mobile_no = $_POST['mobile_no'];
$password = $_POST["password"];
// user login
$check = getRow("SELECT * FROM users 
	WHERE mobile_no=:mobile_no AND password=:password ",array("mobile_no"=>$mobile_no,"password"=>$password));
if(!empty($check)){
 if($check['image']=="")
	{	
		$check['image'] = $baseURL."uploads/user/default_user.png";
		
	}else
	{
		$check['image'] = $baseURL."uploads/user/".$check['image'];		
	}
		$res = array(
		"status"=>"true",
		"message"=>"Login successful.",
		"response"=>$check
	);
	echo json_encode($res);
	exit;
}else{
	$res = array(
		"status"=>"false",
		"message"=>"Invalid phone/password.",
	);
    echo json_encode($res);
    exit;

}	