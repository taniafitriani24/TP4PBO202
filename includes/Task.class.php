<?php 

/******************************************
PRAKTIKUM RPL
******************************************/

class Task extends DB{
	
	// Mengambil data
	function getTask(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM tb_to_do";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function insertTask($tname, $tdetails, $tsubject, $tpriority, $tdeadline){
		// Query mysql insert data ke tb_to_do
		$query = "INSERT into tb_to_do values('','$tname', '$tdetails', '$tsubject', '$tpriority', '$tdeadline','Belum')";

		// Mengeksekusi query
		return $this->execute($query);	
	}

	function deleteTask($id){
		// Query mysql select data ke tb_to_do
		$query = "DELETE FROM tb_to_do where id = '$id'";

		// Mengeksekusi query
		return $this->execute($query);
	}
	
	function statusTask($id){
		// Query mysql select data ke tb_to_do
		$query = "UPDATE tb_to_do SET status_td='Sudah' where id = '$id'";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function sortTask($sortnya){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM tb_to_do ORDER BY $sortnya";

		// Mengeksekusi query
		return $this->execute($query);
	}

}



?>
