<?php
// call Class Module
include "../model/Module.php";

$m = $_GET['m'];
$aksi = "module/mod_module/aksi_module.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$module = new Module();

switch ($act) {
    default:
        echo "<br><br>
        <div class=\"card mb-4 wow fadeIn\">

            <!--Card content-->
            <div class=\"card-body d-sm-flex justify-content-between\">

                <h4 class=\"mb-2 mb-sm-0 pt-1\">
                    <a href=\"\" target=\"_blank\">Module</a>
                    <span>/</span>
                    <span>Tampil Module</span>
                </h4>

                    <!-- Default input -->
                    <a class=\"btn btn-primary btn-md my-0 p\" onclick=window.location.href='media.php?m=$m&act=tambah' role=\"button\">
                        <i class=\"fas fa-plus\"></i> Tambah Module
                    </a>

            </div>
            <!--Card content-->

        </div>";

        echo "
        <div class=\"card wow fadeIn\">
            <div class=\"card-body\">
        <table class=\"table table-hover\">
            <!-- Table head -->
            <thead class=\"blue-grey lighten-4\">
            <tr>
                <th>ID</th>
                <th>Nama Module</th>
                <th>Link</th>
                <th>Icon</th>
                <th>Aktif</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>";
        $dataModule = $module->getListModule();
        foreach ($dataModule as $data) {
            echo "
            <tr>
                <td>$data[module_id]</td>
                <td>$data[module_name]</td>
                <td>$data[link]</td>
                <td>$data[icon]</td>
                <td>$data[active]</td>
                
                <td class='center aligned'>
                    <a href='?m=$m&act=edit&id=$data[module_id]'>Edit</a> | ";
            if ($data['module_id'] > 8) {
                echo "<a href='$aksi?m=$m&act=hapus&id=$data[module_id]' id='btn-delete' style='cursor: pointer;'
                        onclick='return confirm(`Anda yakin akan menghapus module $data[module_name] ID=$data[module_id] ?`)'
                    >Hapus</a>";
            }
//            href='$aksi?m=$m&act=hapus&id=$data[module_id]'
//                             onclick='return confirm(`Hapus modul $data[module_name] ID=$data[module_id]?`);'
            echo "
                </td>
            </tr>
            ";
        }
        echo "
            </tbody>
        </table>
        </div>
        </div>
        </div>
        </div>
        ";
        break;
    case "tambah": ?>
        <br><br>
        <div class="card mb-4 wow fadeIn">

            <!--Card content-->
            <div class="card-body d-sm-flex ">
                <a class="btn btn-primary btn-md my-0 p" onclick="self.history.back()"
                   role="button">
                    <i class="fas fa-chevron-left "></i> Kembali
                </a>

                <h4 class="mb-2 mb-sm-0 pt-1 mx-auto">
                    <a href="" target="_blank">Module</a>
                    <span>/</span>
                    <span>Tambah Module</span>
                </h4>


            </div>
            <!--Card content-->
        </div>
        <div class="card wow fadeIn">
            <div class="card-body">

                <form class="ui form" method="POST" name="formModule" onsubmit="return moduleValidation()"
                      action=<?php echo "$aksi?m=$m&act=tambah" ?>>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama_module">Nama Module</label>
                            <input type="text" class="form-control" name="module_name" placeholder="Nama Module"
                                   id="nama_module" autofocus>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="link_module">Link (contoh => ?m=namamodule)</label>
                            <input type="text" class="form-control" name="link" placeholder="Link Module"
                                   id="link_module" autofocus>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Ikon</label>
                            <input type="text" name="icon" placeholder="Ikon" class="form-control">
                            <small>Referensi ikon: <a href="https://fontawesome.com/icons?d=gallery" target="_blank">Open
                                    New Tab</a></small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Aktif</label>
                            <div class="ui toggle checkbox">
                                <input type="checkbox" name="active" value="Y" checked>
                                <label>Tampilkan di Menu Admin</label>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary float-sm-right" type="submit">Tambahkan</button>
                </form>

            </div>
        </div>
        <?php
        break;
    case "edit":
        $data = $module->getItemModule($_GET['id']);
        echo "<br><br>
        <div class=\"card mb-4 wow fadeIn\">

            <!--Card content-->
            <div class=\"card-body d-sm-flex \">
                <a class=\"btn btn-primary btn-md my-0 p\" onclick=\"self.history.back()\"
                   role=\"button\">
                    <i class=\"fas fa-chevron-left \"></i> Kembali
                </a>

                <h4 class=\"mb-2 mb-sm-0 pt-1 mx-auto\">
                    <a href=\"\" target=\"_blank\">Module</a>
                    <span>/</span>
                    <span>Edit Module</span>
                </h4>


            </div>
            <!--Card content-->
        </div>
        <div class=\"card wow fadeIn\">
            <div class=\"card-body\">
            <form class='ui form' method='POST' name='formModule' onsubmit='return moduleValidation()' action='$aksi?m=$m&act=update' >
            <input type='hidden' name='id' value='$data[module_id]'>
                    <div class=\"form-row\">
                        <div class=\"form-group col-md-6\">
                            <label for=\"nama_module\">Nama Module</label>
                            <input type=\"text\" class=\"form-control\" name=\"module_name\" placeholder='$data[module_name]' value='$data[module_name]'
                                   id=\"nama_module\" autofocus>
                        </div>
                        <div class=\"form-group col-md-6\">
                            <label for=\"link_module\">Link (contoh => ?m=namamodule)</label>
                            <input type=\"text\" class=\"form-control\" name=\"link\" placeholder='$data[link]' value='$data[link]'
                                   id=\"link_module\" autofocus>
                        </div>
                    </div>

                    <div class=\"form-row\">
                        <div class=\"form-group col-md-6\">
                            <label>Ikon</label>
                            <input type=\"text\" name=\"icon\" placeholder='$data[icon]' value='$data[icon]' class=\"form-control\">
                            <small>Referensi ikon: <a href=\"https://fontawesome.com/icons?d=gallery\" target=\"_blank\">Open
                                    New Tab</a></small>
                        </div>
                    </div>

                    <div class=\"form-row\">
                        <div class=\"form-group col-md-6\">
                            <label>Aktif</label>
                            <div class=\"ui toggle checkbox\">";
        ($data['active'] == 'Y') ? $checked = 'checked' : $checked = '';
        echo "
                                <input type=\"checkbox\" name=\"active\" value=\"Y\" $checked>
                                <label>Tampilkan di Menu Admin</label>
                            </div>
                        </div>
                    </div>
                    <button class=\"btn btn-primary float-sm-right\" type=\"submit\">Perbarui</button>
                </form>
    </div>";
        break;
} ?>