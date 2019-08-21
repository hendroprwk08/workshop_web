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
	
	$resArr[] = array("result" => $d->get($sql));
	print json_encode($resArr);
}
?>
