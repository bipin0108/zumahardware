<?php 
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

if(empty($_POST['user_id']))
{
	$res = array(
		"status"=>"false",
		"message"=>"Require argument missing.",
	);
    echo json_encode($res);
    exit;
}

db_connect();

$history = getRows("
	SELECT t.id, REPLACE(t.from_u,'_d','') from_u, 
			if(t.from_u = 0,
				'Zuma Corporation',
				if( t.from_u = concat(REPLACE(t.from_u,'_d',''),'_d'),
					concat(fd.first_name,' ',fd.last_name,' Distributor'),
					concat(fu.first_name,' ',fu.last_name)
				)
			) from_name, 
			REPLACE(t.to_u,'_d','') to_u, 
			if(t.to_u = 0,
				'Zuma Corporation',
				if( t.to_u = concat(REPLACE(t.to_u,'_d',''),'_d'),
					concat(td.first_name,' ',td.last_name,' Distributor'),
					concat(tu.first_name,' ',tu.last_name)
				)
			) to_name, 
			t.point, t.transfer_date,if(t.to_u=:user_id,'credit','debit') AS status 
	FROM transfer_history as t
	LEFT JOIN users as fu ON t.from_u = fu.user_id
	LEFT JOIN users as tu ON t.to_u = tu.user_id
	LEFT JOIN distributor as fd ON REPLACE(t.from_u,'_d','') = fd.id
	LEFT JOIN distributor as td ON REPLACE(t.to_u,'_d','') = td.id
	WHERE t.from_u=:user_id 
	OR t.to_u=:user_id ORDER BY t.id DESC",
	array("user_id"=>$_POST['user_id'])
);

if(!empty($history)){

	$res = array(
		"status"=>"true",
		"message"=>"Successful.",
		"response"=>$history
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