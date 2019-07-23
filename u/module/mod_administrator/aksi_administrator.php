<?php

include "../../../config/functions.php";
include "../../../model/Administrator.php";

$m = $_GET['m'];
$act = $_GET['act'];
$administrator = new Administrator();
$conn = dbConnect();
// input modul
if ($m === 'administrator' && $act == 'tambah') {
    $username = $conn->real_escape_string(my_inputformat(anti_injection($_POST['username']), 0));
    $nama_lengkap = $conn->real_escape_string(my_inputformat(anti_injection($_POST['nama_lengkap']), 1));
    $url_photo = $conn->real_escape_string(my_inputformat(anti_injection($_POST['url_photo']), 0));
    $password = $conn->real_escape_string(my_inputformat(anti_injection($_POST['password']), 0));

    $insert = $administrator->insertAdministrator($username,$nama_lengkap, $url_photo, sha1($password));
    if ($insert) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal Memasukkan data $m ";
    }
} elseif ($m == 'administrator' && $act == 'update') {
    $username = $conn->real_escape_string(my_inputformat(anti_injection($_POST['username']), 0));
    $nama_lengkap = $conn->real_escape_string(my_inputformat(anti_injection($_POST['nama_lengkap']), 1));
    $url_photo = $conn->real_escape_string(my_inputformat(anti_injection($_POST['url_photo']), 0));
    $password = $conn->real_escape_string(my_inputformat(anti_injection($_POST['password']), 0));
    $id_session = $conn->real_escape_string(my_inputformat(anti_injection($_POST['id_session']), 0));

    $update = $administrator->updateAdministrator($username, $nama_lengkap, $url_photo, $id_session);
    if ($update) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal memperbarui data $m";
    }
} elseif ($m == 'administrator' && $act == 'hapus') {
    $delete = $administrator->deleteAdministrator($_GET['id']);
    if ($delete) {
        header("location: ../../media.php?m=" . $m);
    } else {
        echo "Gagal menghapus data $m ID=$_GET[id]";
    }
} else {
    echo "gagal berak_si";
}
