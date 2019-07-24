<?php
session_start();
 
// cek apakah user telah login, jika belum login maka di alihkan ke halaman login
if($_SESSION['status'] !="login"){
	header("location:../hd/login/index.php");
}
include 'koneksi.php';

if(isset($_POST['bulan']) && isset($_POST['tahun'])) {
	$tgl = cal_days_in_month(CAL_GREGORIAN, $_POST['bulan'], $_POST['tahun']);
	$minggu = ceil($tgl/7);
}

?>

<html>
	<head>
		<title>Absensi Asisten Laboratorium Hardware</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/bootstrap-theme.min.css"/>
		<link rel="stylesheet" href="css/style.css"/>
		<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</head>
	<script>
		function startTime() {
			var today = new Date();
			var year = today.getYear()
			if (year < 1000)
				year+=1900
			
			$("#bulan").val(("0" + (today.getMonth() + 1)).slice(-2));
		}
		
	</script>
	<body onLoad="startTime()" style="background-color:#E6E6FA">
		<br>
		<form method="post" action="">
			<nav class="navbar navbar-fixed-left navbar-minimal animate" role="navigation">
				<div class="navbar-toggler animate">
					<span class="menu-icon"></span>
				</div>
				<ul class="navbar-menu animate">
					<li>
						<a href="../hd/edit.php" class="animate">
							<span class="desc animate"> Edit Kehadiran </span>
							<span class="glyphicon glyphicon-pencil"></span>
						</a>
					</li>
					<li>
						<a href="../hd/print.php" class="animate">
							<span class="desc animate"> Cetak Laporan </span>
							<span class="glyphicon glyphicon-print"></span>
						</a>
					</li>
					<li>
						<a href="../hd/admin/logout.php" class="animate">
							<span class="desc animate"> Log Out </span>
							<span class="glyphicon glyphicon-log-out"></span>
						</a>
					</li>
				</ul>
			</nav>
			<center>
			<select name="tahun">
				<option value="2019">2019</option>
				<option value="2018">2018</option>
				<option value="2017">2017</option>
			</select>
			<select name="bulan" id="bulan">
				<option value="01">Januari</option>
				<option value="02">Februari</option>
				<option value="03">Maret</option>
				<option value="04">April</option>
				<option value="05">Mei</option>
				<option value="06">Juni</option>
				<option value="07">Juli</option>
				<option value="08">Agustus</option>
				<option value="09">September</option>
				<option value="10">Oktober</option>
				<option value="11">November</option>
				<option value="12">Desember</option>
			</select>
			<button class="btn btn-info" type="submit" value="simpan">
				<span class="glyphicon glyphicon-search"></span> Cari
			</button>
			<?php if(isset($_POST['bulan']) && isset($_POST['tahun'])) { ?>
				<a class="btn btn-success" href="expdf.php?bulan=<?=  $_POST['bulan']?>&tahun=<?= $_POST['tahun']?>">
					<span class="glyphicon glyphicon-print"></span> Cetak
				</a>
			<?php } ?>
			<a href="admin/admin.php" class="btn btn-primary">
				<span class="glyphicon glyphicon-home"></span> Home
			</a>
			</center>
		</form>
			<table border="0">
			<thead>
				<tr>
					<th>Nama</th>
					<?php
						if(isset($_POST['bulan']) && isset($_POST['tahun'])) {
							$tgl = 1;
							$jumtgl = cal_days_in_month(CAL_GREGORIAN, $_POST['bulan'], $_POST['tahun']);
							while($tgl <= $jumtgl) {
								echo '<th>'.$tgl.'</th>';
								$tgl++;
							}
						}
					?>
					<th>H</th>
					<th>T</th>
					<th>I</th>
					<th>A</th>
					<th>X</th>
				</tr>
			<thead>
			<tbody>
			
			<?php
			if(isset($_POST['bulan']) && isset($_POST['tahun'])) {
				$sql = "SELECT anggota.nama,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 1, absen_hd.hadir, NULL)) as d1,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 2, absen_hd.hadir, NULL)) as d2,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 3, absen_hd.hadir, NULL)) as d3,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 4, absen_hd.hadir, NULL)) as d4,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 5, absen_hd.hadir, NULL)) as d5,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 6, absen_hd.hadir, NULL)) as d6,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 7, absen_hd.hadir, NULL)) as d7,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 8, absen_hd.hadir, NULL)) as d8,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 9, absen_hd.hadir, NULL)) as d9,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 10, absen_hd.hadir, NULL)) as d10,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 11, absen_hd.hadir, NULL)) as d11,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 12, absen_hd.hadir, NULL)) as d12,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 13, absen_hd.hadir, NULL)) as d13,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 14, absen_hd.hadir, NULL)) as d14,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 15, absen_hd.hadir, NULL)) as d15,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 16, absen_hd.hadir, NULL)) as d16,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 17, absen_hd.hadir, NULL)) as d17,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 18, absen_hd.hadir, NULL)) as d18,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 19, absen_hd.hadir, NULL)) as d19,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 20, absen_hd.hadir, NULL)) as d20,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 21, absen_hd.hadir, NULL)) as d21,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 22, absen_hd.hadir, NULL)) as d22,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 23, absen_hd.hadir, NULL)) as d23,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 24, absen_hd.hadir, NULL)) as d24,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 25, absen_hd.hadir, NULL)) as d25,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 26, absen_hd.hadir, NULL)) as d26,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 27, absen_hd.hadir, NULL)) as d27,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 28, absen_hd.hadir, NULL)) as d28,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 29, absen_hd.hadir, NULL)) as d29,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 30, absen_hd.hadir, NULL)) as d30,
						GROUP_CONCAT(if(DAY(absen_hd.jam) = 31, absen_hd.hadir, NULL)) as d31,						
						SUM(absen_hd.hadir = '1') AS hadir, 
						SUM(absen_hd.hadir = 'I') AS ijin, 
						SUM(absen_hd.hadir = 'A') AS alpha, 
						SUM(absen_hd.hadir = 'T') AS telat,
						'$minggu' * anggota.hari as Total
						FROM anggota
						LEFT JOIN absen_hd ON anggota.rfid=absen_hd.rfid AND DATE_FORMAT(absen_hd.jam, '%m') = '$_POST[bulan]' AND DATE_FORMAT(absen_hd.jam, '%Y') = '$_POST[tahun]'					
						GROUP BY anggota.nim
						";
				$query = mysqli_query($conn, $sql);
				$no		= 1;
				$a		= 'style="background-color:green"';
				$b		= 'style="background-color:yellow"';
				$c		= 'style="background-color:orange"';
				$d		= 'style="background-color:red"';
				$e		= 'style="background-color:gray"';
				$f		= 'style="background-color:white"';

				while ($row = mysqli_fetch_array($query))
				{
					for ($i = 1; $i <= $jumtgl; $i++) {
						$s[$i] = $row['d'.$i];
						if 		($s[$i] == "1")	{ $s[$i] = $a; } 
						elseif 	($s[$i] == "T")	{ $s[$i] = $b; } 
						elseif 	($s[$i] == "I") { $s[$i] = $c; } 
						elseif 	($s[$i] == "A") { $s[$i] = $d; }
						elseif 	($s[$i] == "2") { $s[$i] = $e; }
						elseif 	($s[$i] == "L") { $s[$i] = $f; }
					} 
					
					echo
					'<tr>
						<td>'.$row['nama'].'</center></td>	
						<td '.$s[1].'>'.$row['d1'].'</td>
						<td '.$s[2].'>'.$row['d2'].'</td>
						<td '.$s[3].'>'.$row['d3'].'</td>
						<td '.$s[4].'>'.$row['d4'].'</td>
						<td '.$s[5].'>'.$row['d5'].'</td>
						<td '.$s[6].'>'.$row['d6'].'</td>
						<td '.$s[7].'>'.$row['d7'].'</td>
						<td '.$s[8].'>'.$row['d8'].'</td>
						<td '.$s[9].'>'.$row['d9'].'</td>
						<td '.$s[10].'>'.$row['d10'].'</td>
						<td '.$s[11].'>'.$row['d11'].'</td>
						<td '.$s[12].'>'.$row['d12'].'</td>
						<td '.$s[13].'>'.$row['d13'].'</td>
						<td '.$s[14].'>'.$row['d14'].'</td>
						<td '.$s[15].'>'.$row['d15'].'</td>
						<td '.$s[16].'>'.$row['d16'].'</td>
						<td '.$s[17].'>'.$row['d17'].'</td>
						<td '.$s[18].'>'.$row['d18'].'</td>
						<td '.$s[19].'>'.$row['d19'].'</td>
						<td '.$s[20].'>'.$row['d20'].'</td>
						<td '.$s[21].'>'.$row['d21'].'</td>
						<td '.$s[22].'>'.$row['d22'].'</td>
						<td '.$s[23].'>'.$row['d23'].'</td>
						<td '.$s[24].'>'.$row['d24'].'</td>
						<td '.$s[25].'>'.$row['d25'].'</td>
						<td '.$s[26].'>'.$row['d26'].'</td>
						<td '.$s[27].'>'.$row['d27'].'</td>
						';
						switch ($jumtgl){
							case 28:
								echo '<td '.$s[28].'>'.$row['d28'].'</td>';
								echo '<td><center>'.$row['hadir'].'</center></td>';
								echo '<td><center>'.$row['telat'].'</center></td>';
								echo '<td><center>'.$row['ijin'].'</center></td>';
								echo '<td><center>'.$row['alpha'].'</center></td>';
								echo '<td><center>'.$row['Total'].'</center></td>';
								break;
							case 29:
								echo '<td '.$s[28].'>'.$row['d28'].'</td>';
								echo '<td '.$s[29].'>'.$row['d29'].'</td>';
								echo '<td><center>'.$row['hadir'].'</center></td>';
								echo '<td><center>'.$row['telat'].'</center></td>';
								echo '<td><center>'.$row['ijin'].'</center></td>';
								echo '<td><center>'.$row['alpha'].'</center></td>';
								echo '<td><center>'.$row['Total'].'</center></td>';
								break;
							case 30:
								echo '<td '.$s[28].'>'.$row['d28'].'</td>';
								echo '<td '.$s[29].'>'.$row['d29'].'</td>';
								echo '<td '.$s[30].'>'.$row['d30'].'</td>';
								echo '<td><center>'.$row['hadir'].'</center></td>';
								echo '<td><center>'.$row['telat'].'</center></td>';
								echo '<td><center>'.$row['ijin'].'</center></td>';
								echo '<td><center>'.$row['alpha'].'</center></td>';
								echo '<td><center>'.$row['Total'].'</center></td>';
								break;
							case 31:
								echo '<td '.$s[28].'>'.$row['d28'].'</td>';
								echo '<td '.$s[29].'>'.$row['d29'].'</td>';
								echo '<td '.$s[30].'>'.$row['d30'].'</td>';
								echo '<td '.$s[31].'>'.$row['d31'].'</td>';
								echo '<td><center>'.$row['hadir'].'</center></td>';
								echo '<td><center>'.$row['telat'].'</center></td>';
								echo '<td><center>'.$row['ijin'].'</center></td>';
								echo '<td><center>'.$row['alpha'].'</center></td>';
								echo '<td><center>'.$row['Total'].'</center></td>';
								break;
							default:
							//nothing
							break;
						};
						'
					</tr>';
					$no++;
				}
			} else {
				
			} 			
			?>
			</tbody>
		</table>
		<br>
		<table style="table-layout:fixed; width:20%; border-style: none;">
			<tr>
				<td colspan="6"><center>Keterangan</center></td>
			</tr>
			<tr>
				<td style="background-color:green"></td>
				<td>1</td>
				<td>Hadir</td>
				<td style="background-color:red"></td>
				<td>A</td>
				<td>Alpha</td>
			</tr>
			<tr>
				<td style="background-color:yellow"></td>
				<td>T</td>
				<td>Telat</td>
				<td style="background-color:grey"></td>
				<td>2</td>
				<td>Tidak Piket</td>
			</tr>
			<tr>
				<td style="background-color:orange"></td>
				<td>I</td>
				<td>Ijin</td>
				<td style="background-color:white"></td>
				<td>L</td>
				<td>Libur</td>
			</tr>

		</table>	
	</body>
</html>