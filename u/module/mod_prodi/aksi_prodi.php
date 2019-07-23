<?php

include "../../../config/functions.php";
include "../../../model/Prodi.php";

$m = $_GET['m'];
$act = $_GET['act'];
$module = new Prodi();
$conn = dbConnect();
// input modul
if ($m === 'prodi' && $act == 'tambah') {
    $nama_prodi = $conn->real_escape_string(my_inputformat(anti_injection($_POST['nama_prodi']), 1));

    $insert = $module->insertProdi($nama_prodi);
    if ($insert) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal Memasukkan data $m ";
    }
} elseif ($m == 'prodi' && $act == 'update') {
    $module_id = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id']), 0));
    $nama_prodi = $conn->real_escape_string(my_inputformat(anti_injection($_POST['nama_prodi']), 1));

    $update = $module->updateProdi($module_id, $nama_prodi);
    if ($update) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal memperbarui data $m";
    }
} elseif ($m == 'prodi' && $act == 'hapus') {
    $delete = $module->deleteProdi($_GET['id']);
    if ($delete) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal menghapus data $m ID=$_GET[id]";
    }
} else {
    echo "gagal berak_si";
}
