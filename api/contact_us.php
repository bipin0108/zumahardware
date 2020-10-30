<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

if( empty($_POST['user_id']))
{
	$res = array(
		"status"=>"false",
		"message"=>"Require argument missing.",
	);
    echo json_encode($res);
    exit;
}
db_connect();

// GET USER DETAILS
$user = getRow("SELECT * FROM users WHERE user_id=:user_id ",array('user_id'=>$_POST['user_id']));
if (!empty($user)) {
	if ($user['distributor_id'] != '0') {
		// CONTACT DETAILS
		$distributor = getRow("SELECT * FROM distributor WHERE id = :distributor_id ",
			array("distributor_id"=>$user['distributor_id']));
		if (!empty($distributor)) {
			if($distributor['image']=="")
			{	
			  $distributor['image'] = $baseURL."uploads/user/default_user.png";
			}else
			{
			  $distributor['image'] = $baseURL."uploads/distributor/".$distributor['image'];		
			}
			$res = array(
			    "status"=>"true",
			    "message"=>"Successful.",
			    "response"=>$distributor
			);
			echo json_encode($res);
			exit;
		}else{
			$res = array(
			    "status"=>"false",
			    "message"=>"Data not found.",
			    "response"=>array()
			);
			echo json_encode($res);
			exit;
		}
	}else{
		// CONTACT DETAILS
		$admin=getRow("SELECT id,username,first_name,last_name,email,mobile_no,profile_image as image,dob,gender,address,state,city,pincode FROM admin");
		if (!empty($admin)) {
			if($admin['image']=="")
			{	
			  $admin['image'] = $baseURL."uploads/user/default_user.png";
			}else
			{
			  $admin['image'] = $baseURL."uploads/profiles/".$admin['image'];		
			}
			$res = array(
			    "status"=>"true",
			    "message"=>"Successful.",
			    "response"=>$admin
			);
			echo json_encode($res);
			exit;
		}else{
			$res = array(
			    "status"=>"false",
			    "message"=>"Data not found.",
			    "response"=>array()
			);
			echo json_encode($res);
			exit;
		}
	}
}else{
	$res = array(
	    "status"=>"false",
	    "message"=>"Data not found."
	);
	echo json_encode($res);
	exit;
}
