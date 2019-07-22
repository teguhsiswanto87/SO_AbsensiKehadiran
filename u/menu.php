<?php
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    header("location:index.php?error=8");
} else {
//    include "../config/functions.php";

    $dataModule = getListModule();
    foreach ($dataModule as $data) {
//        $module_name = str_replace(' ', '', strtolower($data['module_name']));
//        ($_GET['m'] == $module_name) ? $active = "active" : $active = "";
    echo "<a href=\"$data[link]\" class=\"list-group-item waves-effect\">
                <i class=\"$data[icon]\"></i>$data[module_name]
            </a>";
    }
//        echo "<a href='$data[link]' class='item $active' style='text-transform:capitalize;'>
//           <i class='$data[icon] icon'></i> $data[module_name]
//        </a>";
}