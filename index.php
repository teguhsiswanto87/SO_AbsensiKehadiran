<?php
include 'koneksi.php';
$sql = 'SELECT anggota.nim, anggota.nama, anggota.jurusan, DATE_FORMAT(absen_hd.jam, "%d-%m-%Y") AS tanggal, DATE_FORMAT(absen_hd.jam, "%H:%i:%s") AS masuk
		FROM anggota, absen_hd
		WHERE anggota.rfid=absen_hd.rfid AND DATE_FORMAT(absen_hd.jam,"%Y-%m-%d")=CURDATE() AND hadir IN ("1","T") 
		ORDER BY masuk ASC';

$query = mysqli_query($conn, $sql);
if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}
?>

<html>
	<head>
		<title>Absensi Asisten Laboratorium Hardware</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/bootstrap-theme.min.css"/>
		<link rel="stylesheet" href="css/index.css"/>
		<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</head>
	<script>
		function startTime() {
			var today = new Date();
			var year = today.getYear()
			if (year < 1000)
				year+=1900
			var month=today.getMonth()
			var daym=today.getDate()
			var montharray= new Array("Jan","Feb","Mar","Apr","May","June",
					"July","Aug","Sept","Oct","Nov","Dec")
			var h = today.getHours();
			var m = today.getMinutes();
			var s = today.getSeconds();
			m = checkTime(m);
			s = checkTime(s);
			document.getElementById('jam').innerHTML =
					h + ":" + m + ":" + s;
			document.getElementById('txt').innerHTML = daym+" "+montharray[month]+" "+year;
			
			var t = setTimeout(startTime, 500);
		}
		function checkTime(i) {
			if (i < 10) {i = "0" + i};
			return i;
		}

	</script>
	<body onLoad="startTime()" background="back1.png">
		<form method="post" action="simpan.php">
			<h1 id="jam" class="absolute"></h1>
			<h2 id="txt" class="absolute"></h2>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<nav class="navbar navbar-fixed-left navbar-minimal animate" role="navigation">
				<div class="navbar-toggler animate">
					<span class="menu-icon"></span>
				</div>
				<ul class="navbar-menu animate">
					<li>
						<a href="/hd/index.php" class="animate">
							<span class="desc animate"> Home</span>
							<span class="glyphicon glyphicon-home"></span>
						</a>
					</li>
					<li>
						<a href="/hd/view.php" class="animate">
							<span class="desc animate"> Lihat Rekap</span>
							<span class="glyphicon glyphicon-th-list"></span>
						</a>
					</li>
					<li>
						<a href="/hd/login/" class="animate">
							<span class="desc animate"> Log In Admin Absensi </span>
							<span class="glyphicon glyphicon-log-in"></span>
						</a>
					</li>
				</ul>
			</nav>
			<table>
			<thead>
				<tr>
					<th>No.</th>
					<th>NIM</th>
					<th>Nama</th>
					<th>Jurusan</th>
					<th>Tanggal Absen</th>
					<th>Jam Datang</th>
				</tr>
			<thead>
			<tbody>
			<?php
				$no		= 1;
				$total	= 0;
				
				while ($row = mysqli_fetch_array($query))
				{
					echo
					'<tr>
						<td><center>'.$no.'</center></td>
						<td><center>'.$row['nim'].'</center></td>
						<td>'.$row['nama'].'</td>
						<td>'.$row['jurusan'].'</td>
						<td><center>'.$row['tanggal'].'</center></td>
						<td><center>'.$row['masuk'].'</center></td>
					</tr>';
					$no++;
				}
			?>
			</tbody>
		</table>
		</form>
	</body>
</html>