<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // The request is using the POST method
}else{

	$res = array(
		"status"=>"false",
		"message"=>"status method invalid.",
	);
    echo json_encode($res);
    exit;

}