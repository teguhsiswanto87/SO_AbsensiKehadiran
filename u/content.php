<?php
//if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
//    echo "Anda Harus Login terlebih dahulu, <a href='index.php'>Login</a> ";
//} else {

//include "../config/functions.php";

if ($_GET['m'] == 'beranda') {
    include "module/mod_beranda/beranda.php";
} elseif ($_GET['m'] == 'modul') {
    include "module/mod_modul/modul.php";
} else {
    echo "Modul <b>$_GET[module]</b> sedang dibuat";
}
//}
