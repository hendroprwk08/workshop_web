<?php
include "database.php"; //sisipkan
session_start();

$action = null;

if (!isset($_REQUEST['act'])){
	$action = null;
}else{
	$action = $_REQUEST['act'];
}

$d = new Database(); //panggil database;
$d->open();

$resArr = array();

if($action == null){
	/* PATH INFO
	$x = pathinfo($_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
	
	if (!isset($_SESSION["usr"]) && !isset($_SESSION["nm"])){
		header("location: login.html");
	}else{
		header("location: mahasiswa.html");
	}
	*/	

	$resArr[] = array("result" => "0");
	print json_encode($resArr);	
}elseif($action == "1"){ //input data
	$sql = "insert into mahasiswa (nim, nama, alamat,
			telepon, jurusan) values ('". $_REQUEST["nim"]."',
			'". $_REQUEST["nama"]."', '". $_REQUEST["alamat"]."',
			'". $_REQUEST["telepon"]."', '". $_REQUEST["jurusan"]."')";
	$d->execute($sql);
	
	$resArr[] = array("result" => "data inserted");
	print json_encode($resArr);
}elseif($action == "2"){ //update data
	$sql = "update mahasiswa set 
			nama = '". $_REQUEST["nama"]."', 
			alamat = '". $_REQUEST["alamat"]."',
			telepon = '". $_REQUEST["telepon"]."',
			jurusan = '". $_REQUEST["jurusan"]."'
			where nim = '". $_REQUEST["nim"]."'";
	$d->execute($sql);
	
	$resArr[] = array("result" => "data updated");
	print json_encode($resArr);
}elseif($action == "3"){ //delete data
	$sql = "delete from mahasiswa where nim = '". $_REQUEST["nim"]."'";
	$d->execute($sql);
	
	$resArr[] = array("result" => "data deleted");
	print json_encode($resArr);
}elseif($action == "4"){ //view data
	$sql = "select * from mahasiswa order by input_date desc";
	
	$resArr[] = array("result" => $d->get($sql));
	print json_encode($resArr);
}elseif($action == "5"){ //find the data
	$sql = "select * from mahasiswa 
			where nama like '%". $_REQUEST["find"]."%' 
			order by input_date desc";
	
	$resArr[] = array("result" => $d->get($sql));
	print json_encode($resArr);
}
?>