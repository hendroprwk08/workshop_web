<?php
include "database.php";
session_start();

$action = null;

if (!isset($_REQUEST['act'])){
   $action = null; 
}else{
   $action = $_REQUEST['act'];  
}

$d = new Database();
$d->open();

$resArr = array();

if ($action == null){
	$resArr[] = array("result" => "0");
	print json_encode($resArr);
}elseif($action == "1"){
    $sql = "select * from pengguna where username = '". $_REQUEST['username'] ."' and "
            ."password = '". md5($_REQUEST['password'])."'";
			
	$res = $d->get($sql);
	
	//apakah ada data?
	if(!empty($res)){
		//daftarkan session pada sisi server (PHP)
		$_SESSION["usr"] = $res[0]['username'];
		$_SESSION["nm"] = $res[0]['nama'];	
		
		//arahkan ke mahasiswa.php
		//header("location: mahasiswa.php");
	}
	
	$resArr[] = array("result" => $res);
	print json_encode($resArr);
}
?>
