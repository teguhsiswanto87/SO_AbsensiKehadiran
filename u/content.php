<?php
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "Anda Harus Login terlebih dahulu, <a href='index.php'>Login</a> ";
} else {

//include "../config/functions.php";

    if ($_GET['m'] == 'beranda') {
        include "module/mod_beranda/beranda.php";
    } elseif ($_GET['m'] == 'module') {
        include "module/mod_module/module.php";
    } elseif ($_GET['m'] == 'prodi') {
        include "module/mod_prodi/prodi.php";
    } elseif ($_GET['m'] == 'administrator') {
        include "module/mod_administrator/administrator.php";
    } elseif ($_GET['m'] == 'anggota') {
        include "module/mod_anggota/anggota.php";
    } elseif ($_GET['m'] == 'jenispiket') {
        include "module/mod_jenispiket/jenispiket.php";
    } elseif ($_GET['m'] == 'riset') {
        include "module/mod_riset/riset.php";
    } elseif ($_GET['m'] == 'absensi') {
        include "module/mod_absensi/absensi.php";
    } else {
        echo "<br><br>Modul <b>$_GET[m]</b> sedang dibuat";
    }
}
