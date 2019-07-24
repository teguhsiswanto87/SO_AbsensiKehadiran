<?php
include 'koneksi.php';
$id = $_POST['id'];
$rfid = $_POST['rfid'];
$ket  = $_POST['ket'];

$conn = mysqli_connect($host,$user,$pass,$db) or die ("Koneksi gagal");
$sql = mysqli_query($conn, "UPDATE absen_hd SET hadir = '$ket' WHERE id=$id AND rfid=$rfid");
if ($sql) {
       header("location:edit.php?tahun=$_POST[tahun]&bulan=$_POST[bulan]&tanggal=$_POST[tanggal]");
    } else {
        echo "<script>alert('Oops... $rfid tidak dapat update pada database');
			window.location.href='edit.php?tahun=$_POST[tahun]&bulan=$_POST[bulan]&tanggal=$_POST[tanggal]';
			</script>";
    }

?>