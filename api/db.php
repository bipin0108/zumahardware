<?php
$proj_dir="";	////Write here directory name if hosting under some subdirectory: e.g. directory/
$baseURL="http://{$_SERVER['HTTP_HOST']}/{$proj_dir}";
define("APP_NAME","Zuma Corporation");

define("MODE_PRODUCTION",1);
define("MODE_DEVLOPMENT",0);

$APP_MODE=MODE_DEVLOPMENT;	////Change project mode to show/hide error messages.

$con;
function db_connect(){
	global $con;

	//$dbhost     = "localhost";	////Database Host
	//$dbuser     = "zuma007";		////Database User Name
	//$dbpassword = "3wBGxBx(FGG(";	        ////Database Password
	//$database   = "com.zuma.hardware";
	
	$dbhost     = "localhost";	////Database Host
	$dbuser     = "root";		////Database User Name
	$dbpassword = "";	        ////Database Password
	$database   = "zuma007";
	
	$con = new PDO ( "mysql:host=$dbhost;dbname=$database;charset=utf8", "$dbuser", "$dbpassword" ) or die ( 'error' );
	$con->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}

date_default_timezone_set('Asia/Kolkata');	////TimeZone

///----------------------------------------------------------------------///
///Configuration finished////
///----------------------------------------------------------------------///
if(empty($_SESSION)){
	session_start();
}

function phpNow(){
	return date("Y-m-d H:i:s",time());
}

if($APP_MODE==MODE_PRODUCTION){
	error_reporting(0);
	ini_set('display_errors', 0);
}else{
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}

/*PDO FUNCTIONS*/
function getRows($sql,$params=false){
	global $con;
	$query=$con->prepare($sql);
	if($params){
		foreach($params as $k=>$v){
			$query->bindValue(":$k",$v."");
		}
	}
	$query->execute();
	if($query->rowCount()==0){
		return array();
	}else{
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
}
function getRow($sql,$params=false){
	global $con;
	$query=$con->prepare($sql);
	if($params){
		foreach($params as $k=>$v){
			$query->bindValue(":$k",$v."");
		}
	}
	$query->execute();
	if($query->rowCount()==0){
		return false;
	}else{
		return $query->fetch(PDO::FETCH_ASSOC);
	}
}
function insertRow($table,$data){
	global $con;
	$columns=array_keys($data);
	$cols=implode(",",$columns);
	$params=":".implode(",:",$columns);
	$sql="insert into $table ($cols) values($params) ";
	$query=$con->prepare($sql);
	foreach($data as $k=>$v){
		$query->bindParam(":$k",$data[$k]);
	}
	$query->execute();
	return $con->lastInsertId();
}
function updateRow($table,$data,$where=false){
	global $con;
	$sql="update $table set ";
	$first=true;
	foreach($data as $k=>$v){
		if($first){
			$sql.=" $k=:$k ";
			$first=false;
		}else{
			$sql.=", $k=:$k ";
		}
	}
	if($where){
		$sql.=" where 1 ";
		foreach($where as $w=>$wv){
			if($where[$w]==null){
				$sql.=" and $w is null ";
			}else{
				$sql.=" and $w=:$w ";
			}
		}
	}
	$query=$con->prepare($sql);
	foreach($data as $k=>$v){
		$query->bindParam(":$k",$data[$k]);
	}
	if($where){
		foreach($where as $k=>$v){
			if($where[$k]==null){
				//$query->bindValue(":$k",null);
			}else{
				$query->bindParam(":$k",$where[$k]);
			}
		}
	}
	$query->execute();
	return $query->rowCount();
}
function deleteRows($table,$where=false){
	global $con;
	$sql="delete from $table ";
	if($where){
		$sql.=" where 1 ";
		foreach($where as $w=>$wv){
			$sql.=" and $w=:$w ";
		}
	}
	$query=$con->prepare($sql);
	if($where){
		foreach($where as $k=>$v){
			$query->bindParam(":$k",$where[$k]);
		}
	}
	$query->execute();
	return $query->rowCount();
}
///END PDO

