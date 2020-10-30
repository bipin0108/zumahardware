<?php
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

if( empty($_POST['order_id']))
{
	$res = array(
		"status"=>"false",
		"message"=>"Require argument missing.",
	);
    echo json_encode($res);
    exit;
}
db_connect();
// CHECK ORDER

$check =  getRow("SELECT * FROM orders WHERE id=:order_id AND order_status = 'delivered'",array('order_id'=>$_POST['order_id']));
if (!empty($check)) {
	$order = getRow("SELECT * FROM orders WHERE id=:order_id AND order_status = 'completed'",
		 array('order_id'=>$_POST['order_id']));

	if(!empty($order)){
		$res = array(
			"status"=>"false",
			"message"=>"Order has been already completed.",
		);
	    echo json_encode($res);
	    exit;
	}else{
		// CHANGE STATUS
		$data['order_status'] = 'completed';
		updateRow("orders",$data,array("id"=>$_POST['order_id']));
		$res = array(
			"status"=>"true",
			"message"=>"Order has been completed successfully.",
		);
	    echo json_encode($res);
	    exit;
	}
}else{
	$res = array(
	    "status"=>"false",
	    "message"=>"Data Not Found."
	);
	echo json_encode($res);
	exit;
}
