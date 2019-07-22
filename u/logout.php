<?php
session_start();
session_unset();
session_destroy();
echo "<script>alert('Anda Telah Keluar dari halaman Administrator'); window.location='../u'</script>";
?>