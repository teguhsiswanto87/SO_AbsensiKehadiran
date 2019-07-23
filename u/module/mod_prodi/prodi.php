<?php
// call Class Prodi
include "../model/Prodi.php";

$m = $_GET['m'];
$aksi = "module/mod_prodi/aksi_prodi.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$prodi = new Prodi();

switch ($act) {
    default:
        echo "<br><br>
        <div class=\"card mb-4 wow fadeIn\">

            <!--Card content-->
            <div class=\"card-body d-sm-flex justify-content-between\">

                <h4 class=\"mb-2 mb-sm-0 pt-1\">
                    <a href=\"\" target=\"_blank\">Prodi</a>
                    <span>/</span>
                    <span>Tampil Prodi</span>
                </h4>

                    <!-- Default input -->
                    <a class=\"btn btn-primary btn-md my-0 p\" onclick=window.location.href='media.php?m=$m&act=tambah' role=\"button\">
                        <i class=\"fas fa-plus\"></i> Tambah Prodi
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
                <th>Nama Program Studi</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>";
        $dataProdi = $prodi->getListProdi();
        foreach ($dataProdi as $data) {
            echo "
            <tr>
                <td>$data[id_prodi]</td>
                <td style='text-transform: capitalize;'>$data[nama_prodi]</td>
                
                <td class='center aligned'>
                    <a href='?m=$m&act=edit&id=$data[id_prodi]'>Edit</a> | ";
            if ($data['id_prodi'] > 4) {
                echo "<a href='$aksi?m=$m&act=hapus&id=$data[id_prodi]' id='btn-delete' style='cursor: pointer;'
                        onclick='return confirm(`Anda yakin akan menghapus prodi $data[nama_prodi] ID=$data[id_prodi] ?`)'
                    >Hapus</a>";
            }
//            href='$aksi?m=$m&act=hapus&id=$data[id_prodi]'
//                             onclick='return confirm(`Hapus modul $data[module_name] ID=$data[id_prodi]?`);'
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
                    <a href="" target="_blank">Prodi</a>
                    <span>/</span>
                    <span>Tambah Prodi</span>
                </h4>


            </div>
            <!--Card content-->
        </div>
        <div class="card wow fadeIn">
            <div class="card-body">

                <form class="ui form" method="POST" name="formProdi" onsubmit="return moduleValidation()"
                      action=<?php echo "$aksi?m=$m&act=tambah" ?>>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama_module">Nama Program Studi</label>
                            <input type="text" class="form-control" name="nama_prodi" placeholder="Nama Program Studi"
                                   id="nama_module" autofocus>
                        </div>
                    </div>
                    <button class="btn btn-primary float-sm-right" type="submit">Tambahkan</button>
                </form>

            </div>
        </div>
        <?php
        break;
    case "edit":
        $data = $prodi->getItemProdi($_GET['id']);
        echo "<br><br>
        <div class=\"card mb-4 wow fadeIn\">

            <!--Card content-->
            <div class=\"card-body d-sm-flex \">
                <a class=\"btn btn-primary btn-md my-0 p\" onclick=\"self.history.back()\"
                   role=\"button\">
                    <i class=\"fas fa-chevron-left \"></i> Kembali
                </a>

                <h4 class=\"mb-2 mb-sm-0 pt-1 mx-auto\">
                    <a href=\"\" target=\"_blank\">Prodi</a>
                    <span>/</span>
                    <span>Edit Prodi</span>
                </h4>


            </div>
            <!--Card content-->
        </div>
        <div class=\"card wow fadeIn\">
            <div class=\"card-body\">
            <form class='ui form' method='POST' name='formProdi' onsubmit='return moduleValidation()' action='$aksi?m=$m&act=update' >
            <input type='hidden' name='id' value='$data[id_prodi]'>
                    <div class=\"form-row\">
                        <div class=\"form-group col-md-6\">
                            <label for=\"nama_module\">Nama Program Studi</label>
                            <input type=\"text\" class=\"form-control\" name=\"nama_prodi\" placeholder='$data[nama_prodi]' value='$data[nama_prodi]'
                                   id=\"nama_module\" >
                        </div>
                    </div>
                    <button class=\"btn btn-primary float-sm-right\" type=\"submit\">Perbarui</button>
                </form>
    </div>";
        break;
} ?>