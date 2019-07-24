<?php
include 'koneksi.php';
$id 	= htmlspecialchars($_GET['id']);
$conn 	= mysqli_connect($host,$user,$pass,$db) or die ("Koneksi gagal");
$sql 	= mysqli_query($conn, "SELECT * FROM absen_hd WHERE rfid='$id'  AND DATE_FORMAT(jam, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d')");
$now 	= date ("H:i");
$mulai 	= "10:00";
$mulai1 = "13:30";
$akhir 	= "23:59";
$now1 	= DateTime::createFromFormat('h:i a', $now);


if($now >= $mulai1 && $now <= $akhir) {
	$telat = mysqli_query($conn, "INSERT INTO absen_hd (rfid, jam, hadir) SELECT rfid, NOW(), 'A' FROM anggota WHERE rfid NOT IN (SELECT anggota.rfid FROM anggota, absen_hd WHERE DATE(absen_hd.jam) = DATE(NOW()) AND anggota.rfid = absen_hd.rfid)");
	echo "Tidak Hadir";
} elseif($now >= $mulai && $now < $mulai1) {
	if (mysqli_num_rows($sql) != 0) {
		echo "Sudah Absen Sebelumnya";

	} else {
		$check = mysqli_query($conn, "SELECT * FROM anggota WHERE rfid='$id'");
		if (mysqli_num_rows($check) != 1) {
			echo "ID tidak terdaftar";

		} else {
			$update = mysqli_query($conn, "INSERT INTO absen_hd (rfid,jam,hadir) VALUES ('$id',NOW(),'T')");
			echo "Berhasil Absen status Telat";
		}
	}
} else {
	if (mysqli_num_rows($sql) != 0) {
		echo "Sudah Absen Sebelumnya";

	} else {
		$check = mysqli_query($conn, "SELECT * FROM anggota WHERE rfid='$id'");
		if (mysqli_num_rows($check) != 1) {
			echo "ID tidak terdaftar";

		} else {
			$update = mysqli_query($conn, "INSERT INTO absen_hd (rfid,jam,hadir) VALUES ('$id',NOW(),1)");
			echo "Berhasil Absen status Hadir";
		}
	}
}
?>