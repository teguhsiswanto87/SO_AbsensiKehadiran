<?php
include 'koneksi.php';
$nomor = $_POST[nomor];
$banyak = count($nomor);
$ket  = $_POST['ket'];
$tanggal = date("Y-m-d H:i:s", strtotime($_POST['tanggal']));

$conn = mysqli_connect($host,$user,$pass,$db) or die ("Koneksi gagal");

for($i=0; $i<$banyak; $i++){
	$sql = mysqli_query($conn, "SELECT * FROM absen_hd WHERE rfid='$nomor[$i]'  AND DATE_FORMAT(jam, '%Y-%m-%d') = DATE_FORMAT('$tanggal', '%Y-%m-%d')");
	if (mysqli_num_rows($sql) != 0)
	{
		header("location:admin/admin.php");

	} else {
		$update = mysqli_query($conn, "INSERT INTO absen_hd (rfid,jam,hadir) VALUES ('$nomor[$i]','$tanggal','$ket')");
		header("location:admin/admin.php");
	}
}
?>