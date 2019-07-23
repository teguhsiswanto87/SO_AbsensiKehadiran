<?php

include "../../../config/functions.php";
include "../../../model/Absensi.php";

$m = $_GET['m'];
$act = $_GET['act'];
$absensi = new Absensi();
$conn = dbConnect();
// input modul
if ($m === 'absensi' && $act == 'datang') {
    $id_rfid = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id_rfid']), 1));

    $datang = $absensi->insertDatangAbsensi($id_rfid, date("Y-m-d"), date("h:i"));
    if ($datang) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal Memasukkan data $m ";
    }
} elseif ($m == 'absensi' && $act == 'update') {
    $id_rfid = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id_rfid']), 0));
    $id_prodi = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id_prodi']), 0));
    $id_riset = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id_riset']), 0));
    $nama_anggota = $conn->real_escape_string(my_inputformat(anti_injection($_POST['nama_anggota']), 1));
    $nim = $conn->real_escape_string(my_inputformat(anti_injection($_POST['nim']), 0));
    $linkGambar = "https://akademik.unikom.ac.id/foto/$nim.jpg";

    $update = $absensi->updateAnggota($id_rfid, $id_riset, $id_prodi, $nim, $nama_anggota, $linkGambar);
    if ($update) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal memperbarui data $m";
    }
} elseif ($m == 'absensi' && $act == 'hapus') {
    $delete = $absensi->deleteAnggota($_GET['id']);
    if ($delete) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal menghapus data $m ID=$_GET[id]";
    }
} else {
    echo "gagal berak_si";
}
