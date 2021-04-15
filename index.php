<?php

/******************************************
PRAKTIKUM RPL
******************************************/

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

if (isset($_POST['add'])){
	$tname = $_POST['tname'];
	$tdetails = $_POST['tdetails'];
	$tsubject = $_POST['tsubject'];
	$tpriority = $_POST['tpriority'];
	$tdeadline = $_POST['tdeadline'];
	// Memanggil method insertTask di kelas Task
	$otask->insertTask($tname, $tdetails, $tsubject, $tpriority, $tdeadline);
	
}

if (!empty($_GET['id_hapus'])){
	$id = $_GET['id_hapus'];
	// Memanggil method deleteTask di kelas Task
		$otask->deleteTask($id);	
}

if (!empty($_GET['id_status'])){
	$id = $_GET['id_status'];
	// Memanggil method statusTask di kelas Task
		$otask->statusTask($id);	
}
// Memanggil method getTask di kelas Task
$otask->getTask();

if (isset($_POST['reset'])){
	$otask->getTask();
}

if (isset($_POST['sort_subject'])){
	$sortnya = "subject_td";
	$otask->sortTask($sortnya);
}

if (isset($_POST['sort_priority'])){
	$sortnya = "priority_td";
	$otask->sortTask($sortnya);
}

if (isset($_POST['sort_deadline'])){
	$sortnya = "deadline_td";
	$otask->sortTask($sortnya);
}

if (isset($_POST['sort_status'])){
	$sortnya = "status_td";
	$otask->sortTask($sortnya);
}



// Proses mengisi tabel dengan data
$data = null;
$no = 1;

while (list($id, $tname, $tdetails, $tsubject, $tpriority, $tdeadline, $tstatus) = $otask->getResult()) {
	// Tampilan jika status task nya sudah dikerjakan
	if($tstatus == "Sudah"){
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tname . "</td>
		<td>" . $tdetails . "</td>
		<td>" . $tsubject . "</td>
		<td>" . $tpriority . "</td>
		<td>" . $tdeadline . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
		$no++;
	}

	// Tampilan jika status task nya belum dikerjakan
	else{
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tname . "</td>
		<td>" . $tdetails . "</td>
		<td>" . $tsubject . "</td>
		<td>" . $tpriority . "</td>
		<td>" . $tdeadline . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success' ><a href='index.php?id_status=" . $id .  "' style='color: white; font-weight: bold;'>Selesai</a></button>
		</td>
		</tr>";
		$no++;
	}
}

// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("templates/skin.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();