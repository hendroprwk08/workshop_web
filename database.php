<?php
class Database{
	var $conn;
	var $host = "localhost";
	var $db = "db_workshop";
	var $usernm = "root";
	var $passwd = "";
	
	//menyambungkan atau open database
	public function open(){
		$this->conn = mysqli_connect(
							$this->host,
							$this->usernm,
							$this->passwd,
							$this->db)
		or die (mysqli_error());
	}
	
	//menutup database
	public function close(){
		mysqli_close($this->conn) or die (mysqli_error());
	}
	
	//menjalankan perintah, spt: select, update, delete
	public function execute($sql){
			mysqli_query($this->conn, $sql) 
			or die (mysqli_error());
	}
	
	//menampilkan data, spt: select 
	public function get($sql){
		$tempArr = array(); //siapkan array kosong
		
		$query = mysqli_query($this->conn, $sql) 
		or die (mysqli_error());
		
		//masukkan kedalam array
		while ($row = mysqli_fetch_assoc($query)){
			$tempArr[] = $row;
		}
		
		return $tempArr;
	}
	
}
?>