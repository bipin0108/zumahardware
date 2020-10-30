<?php 
header("Content-type:application/json");
header('Access-Control-Allow-Origin: *');

include_once 'check_method.php';
include_once 'db.php';

if(empty($_POST['user_id']) ||
   empty($_POST['point']))
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
$user = getRow("SELECT * FROM users WHERE user_id=:user_id",array("user_id"=>$_POST['user_id']));

if(empty($user)){
	$res = array(
		"status"=>"false",
		"message"=>"User is not available."
	);
    echo json_encode($res);
    exit;
}else{
	if($user['type'] == 'carpenter'){
		// MOBILE_NO IS REQUIRED FOR CARPENTER
		if(empty($_POST['mobile_no'])){
			$res = array(
				"status"=>"false",
				"message"=>"Require argument missing.",
			);
		    echo json_encode($res);
		    exit;
		}
		// CHECK DEALER
		$dealer = getRow("SELECT * FROM users 
 		WHERE mobile_no=:mobile_no AND type='dealer'",
 		array("mobile_no"=>$_POST['mobile_no']));
 		if(empty($dealer)){
 			$res = array(
				"status"=>"false",
				"message"=>"Please enter valid dealer mobile no.",
			);
		    echo json_encode($res);
		    exit;
 		}else{
 			if($user['point']>$_POST['point']){
	 			// ADDING DEALER POINTS
	 			$dealer_point = $dealer['point'] + $_POST['point'];
	 			$data['point'] = $dealer_point;
	 			updateRow('users',$data,array("mobile_no"=>$_POST['mobile_no']));

	 			// INSERT TRANSFER HISTORY
	 			$param['from_u'] = $_POST['user_id'];
	 			$param['to_u'] = $dealer['user_id'];
	 			$param['point'] = $_POST['point'];
	 			$param['status'] = 'debit';
	 			$param['transfer_date'] = phpNow();
	 			insertRow('transfer_history',$param);

	 			// DEDUCTING CARPENTER POINTS 
	 			$carpenter_point = $user['point'] - $_POST['point'];
	 			$prm['point'] = $carpenter_point;
	 			updateRow('users',$prm,array("user_id"=>$_POST['user_id']));
 			}else{
 				$res = array(
					"status"=>"false",
					"message"=>"You have not enough points."
				);
				echo json_encode($res);
				exit;
 			}
 		}
	}else if($user['type'] == 'dealer'){
			// CHECK Distributor
			$distributor = getRow("SELECT * FROM distributor 
	 		WHERE id=:distributor_id",
	 		array("distributor_id"=>$user['distributor_id']));
	 		if(empty($distributor)){
	 			$res = array(
					"status"=>"false",
					"message"=>"Distributor is not available.",
				);
			    echo json_encode($res);
			    exit;
			}else{
				if($user['point']>$_POST['point']){
		 			// ADDING Distributor POINTS
		 			$distributor_point = $distributor['point'] + $_POST['point'];
		 			$data['point'] = $distributor_point;
		 			updateRow('distributor',$data,array("id"=>$user['distributor_id']));

		 			// INSERT TRANSFER HISTORY
		 			$param['from_u'] = $_POST['user_id'];
		 			$param['to_u'] = $distributor['id'].'_d';
		 			$param['point'] = $_POST['point'];
		 			$param['status'] = 'debit';
		 			$param['transfer_date'] = phpNow();
		 			insertRow('transfer_history',$param);

		 			// DEDUCTING DEALER POINTS 
		 			$dealer_point = $user['point'] - $_POST['point'];
		 			$prm['point'] = $dealer_point;
		 			updateRow('users',$prm,array("user_id"=>$_POST['user_id']));
				}else{
					$res = array(
					"status"=>"false",
					"message"=>"You have not enough points."
				);
				echo json_encode($res);
				exit;
			}
 		}
	}else{
		$res = array(
		"status"=>"false",
		"message"=>"Salesman can not transfer points."
		);
		echo json_encode($res);
		exit;
	}
}

$check = getRow("SELECT * FROM users WHERE user_id=:user_id",array("user_id"=>$_POST['user_id']));
if(!empty($check)){
 if($check['image']=="")
	{	
		$check['image'] = $baseURL."uploads/user/default_user.png";
		
	}else
	{
		$check['image'] = $baseURL."uploads/user/".$check['image'];		
	}	
}
$res = array(
	"status"=>"true",
	"message"=>"Successful.",
	"response"=>$check
);
echo json_encode($res);
exit;