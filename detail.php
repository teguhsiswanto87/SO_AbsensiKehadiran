<?php
	session_start();

	// cek apakah user telah login, jika belum login maka di alihkan ke halaman login
	if($_SESSION['status'] !="login"){
		header("location:../hd/login/index.php");
	}
    include "koneksi.php";
    if($_POST) {
        $id = $_POST['idx'];
        $sql = "SELECT * FROM absen_hd, anggota WHERE id = $id AND anggota.rfid=absen_hd.rfid";
		$query = mysqli_query($conn, $sql);
        while ($result = mysqli_fetch_array($query)){
            $type = $result['hadir'];
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
                $type = "Libut";
            }

		?>
        <form action="update.php" method="post">
            <input type="hidden" name="tanggal" value="<?php echo $_POST['tgl']; ?>">
            <input type="hidden" name="bulan" value="<?php echo $_POST['bln']; ?>">
            <input type="hidden" name="tahun" value="<?php echo $_POST['thn']; ?>">
            <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
			<input type="hidden" name="rfid" value="<?php echo $result['rfid']; ?>">
			<div class="form-group">
                <label>Jam Kehadiran : <?php echo $result['jam']; ?></label> 
            </div>
            <div class="form-group">
                <label>Nama Asisten : <?php echo $result['nama']; ?></label>
            </div>
            <div class="form-group">
                <label>Status Kehadiran : <?php echo $type; ?></label>
            </div>
            <div class="form-group">
                <label>Edit Kehadiran</label>
                <select class="form-control" name="ket" required>
                    <option value=""><?php echo $type; ?></option>
                    <option value="1">Hadir</option>
                    <option value="T">Telat</option>
                    <option value="A">Tidak Hadir (Alpha)</option>
                    <option value="I">Izin</option>
		    <option value="2">Tidak Piket</option>
		    <option value="L">Libur</option>
                </select>
            </div>
              <button class="btn btn-primary" type="submit">Update</button>
        </form>     
        <?php }
    }
?>