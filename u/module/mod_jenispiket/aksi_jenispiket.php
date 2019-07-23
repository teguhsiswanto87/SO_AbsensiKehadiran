<?php

include "../../../config/functions.php";
include "../../../model/JenisPiket.php";

$m = $_GET['m'];
$act = $_GET['act'];
$jenisPiket = new JenisPiket();
$conn = dbConnect();
// input modul
if ($m === 'jenispiket' && $act == 'tambah') {
    $jenis_piket = $conn->real_escape_string(my_inputformat(anti_injection($_POST['jenis_piket']), 1));

    $insert = $jenisPiket->insertJenisPiket($jenis_piket);
    if ($insert) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal Memasukkan data $m ";
    }
} elseif ($m == 'jenispiket' && $act == 'update') {
    $id_jenis_piket = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id']), 0));
    $jenis_piket = $conn->real_escape_string(my_inputformat(anti_injection($_POST['jenis_piket']), 1));

    $update = $jenisPiket->updateJenisPiket($id_jenis_piket, $jenis_piket);
    if ($update) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal memperbarui data $m";
    }
} elseif ($m == 'jenispiket' && $act == 'hapus') {
    $delete = $jenisPiket->deleteJenisPiket($_GET['id']);
    if ($delete) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal menghapus data $m ID=$_GET[id]";
    }
} else {
    echo "gagal berak_si";
}
