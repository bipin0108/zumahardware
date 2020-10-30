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

if ($_POST['user_type'] != 'carpenter' && $_POST['user_type'] != 'dealer') {
	$res = array(
		"status"=>"false",
		"message"=>"This offer is not valid for ".$_POST['user_type'].".",
	);
    echo json_encode($res);
    exit;
}

// CHECK OFFERS
$offers = getRows("SELECT * FROM offer WHERE type = :user_type",array("user_type"=>$_POST['user_type']));
$output = array();
if (!empty($offers)) {

	foreach ($offers as $idx => $row) 
	{
		$output[$idx] = $row;

		if($output[$idx]['type'] == 'dealer')
		{	if($output[$idx]['image'] != ""){
				$output[$idx]['image'] = $baseURL."uploads/offer/dealer_offer/".$output[$idx]['image'];	 
			}else{
				$output[$idx]['image'] = "";
			}
		}else{
			if($output[$idx]['image'] != ""){
				$output[$idx]['image'] = $baseURL."uploads/offer/carpenter_offer/".$output[$idx]['image'];	 
			}else{
				$output[$idx]['image'] = "";
			}
		}
	}
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