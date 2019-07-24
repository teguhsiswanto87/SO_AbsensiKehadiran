<?php
session_start();

// cek apakah user telah login, jika belum login maka di alihkan ke halaman login
if($_SESSION['status'] !="login"){
	header("location:../hd/login/index.php");
}
include 'koneksi.php';
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
		var year = today.getYear();
		if (year < 1000)
			year+=1900

		$("#bulan").val(("0" + (today.getMonth() + 1)).slice(-2));
		$("#tanggal").val(("0" + today.getDate()).slice(-2));
	}
</script>
<body onLoad="startTime()" style="background-color:#E6E6FA">
<form method="get" action="">
	<br>
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
		<select name="tanggal" id="tanggal">

			<option value="01">01</option>
			<option value="02">02</option>
			<option value="03">03</option>
			<option value="04">04</option>
			<option value="05">05</option>
			<option value="06">06</option>
			<option value="07">07</option>
			<option value="08">08</option>
			<option value="09">09</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>
			<option value="24">24</option>
			<option value="25">25</option>
			<option value="26">26</option>
			<option value="27">27</option>
			<option value="28">28</option>
			<option value="29">29</option>
			<option value="30">30</option>
			<option value="31">31</option>
		</select>
		<button class="btn btn-info" type="submit" value="simpan">
			<span class="glyphicon glyphicon-search"></span> Cari
		</button>
		<a href="admin/admin.php" class="btn btn-primary">
			<span class="glyphicon glyphicon-home"></span> Home
		</a>
	</center>
</form>
<table>
	<thead>
	<tr>
		<th>No.</th>
		<th>NIM</th>
		<th>Nama</th>
		<th>Status</th>
		<th>Aksi</th>
	</tr>
	<thead>
	<tbody>
	<?php
	if(isset($_GET['bulan']) && isset($_GET['tahun']) && isset($_GET['tanggal'])) {
		$sql = "SELECT anggota.nim, anggota.nama, absen_hd.rfid, absen_hd.id, absen_hd.hadir
				FROM anggota, absen_hd
				WHERE anggota.rfid=absen_hd.rfid AND DATE_FORMAT(absen_hd.jam, '%m') = '$_GET[bulan]' AND DATE_FORMAT(absen_hd.jam, '%Y') = '$_GET[tahun]' AND DATE_FORMAT(absen_hd.jam, '%d') = '$_GET[tanggal]'
				ORDER BY nim ASC";
		$query = mysqli_query($conn, $sql);
		$no		= 1;
		while ($row = mysqli_fetch_array($query))
		{
			$type = $row['hadir'];
           		if ($type == "1"){
                		$type = "Hadir";
            		} elseif ($type == "T"){
                		$type = "Telat";
            		} elseif ($type == "I") {
               			$type = "Izin";
            		} elseif ($type == "A") {
                		$type = "Alpha";
            		} elseif ($type == "2") {
                		$type = "Tidak Piket"; 
			} elseif ($type == "L") {
                		$type = "Libur";
            		}
			echo
					'<tr>
						<td><center>'.$no.'</center></td>
						<td><center>'.$row['nim'].'</center></td>
						<td>'.$row['nama'].'</td>
						<td><center>'.$type.'</center></td>
						<td><center><a href="#edit_modal" class="btn btn-info btn-small" data-toggle="modal" data-id="'.$row['id'].'">
								<span class="glyphicon glyphicon-edit"></span>
							</a></center>
						</td>
					</tr>';
			$no++;
		}
	} else {

	}
	?>
	</tbody>
	<div class="modal fade" id="edit_modal" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Detail Kehadiran</h4>
				</div>
				<div class="modal-body">
					<div class="hasil-data"></div>
				</div>
				<div class="modal-footer">
					Laboratorium Hardware 2017
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
    $(document).ready(function(){
        $('#edit_modal').on('show.bs.modal', function (e) {
            var idx = $(e.relatedTarget).data('id');
			var tgl = '<?php echo $_GET['tanggal'] ?>';
			var bln = '<?php echo $_GET['bulan'] ?>';
			var thn = '<?php echo $_GET['tahun'] ?>';
			var datastring = 'idx='+ idx + '&tgl=' + tgl + '&bln=' + bln + '&thn=' + thn;
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'detail.php',
                data :  datastring,
                success : function(data){
                $('.hasil-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>
</table>

</body>
</html>