<?php
include "database.php";

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
    $sql = "insert into pengguna (nama, username, password) "
			. "values ('". $_REQUEST['nama']."', '". $_REQUEST['username']."', "
			. "'". md5($_REQUEST['password'])."')";

    $d->execute($sql);
    
	$resArr[] = array("result" => "data inserted");
	print json_encode($resArr);
}elseif($action == "2"){
    if ($_REQUEST['password'] == ""){
        $sql = "update pengguna set nama = '". $_REQUEST['nama']."' "
				. "where username = '". $_REQUEST['username']."'";
    }else{
        $sql = "update pengguna set password = '". md5($_REQUEST['password'])."', "
				. "nama = '". $_REQUEST['nama']."' "
				. "where username = '". $_REQUEST['username']."'";
    }
	
	$d->execute($sql);

    $resArr[] = array("result" => "data updated");
	print json_encode($resArr);
}elseif($action == "3"){
    $sql = "delete from pengguna where username ='". $_REQUEST['username'] ."'";
    $d->execute($sql);
	
    $resArr[] = array("result" => "data deleted");
	print json_encode($resArr);
}elseif($action == "4"){
    $sql = "select username, nama from pengguna";
    
	$resArr[] = array("result" => $d->get($sql));
	print json_encode($resArr);
}elseif($action == "5"){
    $sql = "select username, nama from pengguna where username like '%". $_REQUEST['find'] ."%'";
    
	$resArr[] = array("result" => $d->get($sql));
	print json_encode($resArr);
}
?>
