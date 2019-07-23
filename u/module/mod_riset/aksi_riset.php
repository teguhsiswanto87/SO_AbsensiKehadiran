<?php

include "../../../config/functions.php";
include "../../../model/Riset.php";

$m = $_GET['m'];
$act = $_GET['act'];
$riset = new Riset();
$conn = dbConnect();
// input modul
if ($m === 'riset' && $act == 'tambah') {
    $bidang_riset = $conn->real_escape_string(my_inputformat(anti_injection($_POST['bidang_riset']), 1));
    $waktu_riset = $conn->real_escape_string(my_inputformat(anti_injection($_POST['waktu_riset']), 1));

    $insert = $riset->insertRiset($bidang_riset,$waktu_riset);
    if ($insert) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal Memasukkan data $m ";
    }
} elseif ($m == 'riset' && $act == 'update') {
    $id_riset = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id']), 0));
    $bidang_riset = $conn->real_escape_string(my_inputformat(anti_injection($_POST['bidang_riset']), 1));
    $waktu_riset = $conn->real_escape_string(my_inputformat(anti_injection($_POST['waktu_riset']), 1));

    $update = $riset->updateRiset($id_riset, $bidang_riset,$waktu_riset);
    if ($update) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal memperbarui data $m";
    }
} elseif ($m == 'riset' && $act == 'hapus') {
    $delete = $riset->deleteRiset($_GET['id']);
    if ($delete) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal menghapus data $m ID=$_GET[id]";
    }
} else {
    echo "gagal berak_si";
}
