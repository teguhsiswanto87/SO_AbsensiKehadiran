<?php
// call Class JenisPiket
include "../model/JenisPiket.php";

$m = $_GET['m'];
$aksi = "module/mod_jenispiket/aksi_jenispiket.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$jenis_piket = new JenisPiket();

switch ($act) {
    default:
        echo "<br><br>
        <div class=\"card mb-4 wow fadeIn\">

            <!--Card content-->
            <div class=\"card-body d-sm-flex justify-content-between\">

                <h4 class=\"mb-2 mb-sm-0 pt-1\">
                    <a href=\"\" target=\"_blank\">Jenis Piket</a>
                    <span>/</span>
                    <span>Tampil Jenis Piket</span>
                </h4>

                    <!-- Default input -->
                    <a class=\"btn btn-primary btn-md my-0 p\" onclick=window.location.href='media.php?m=$m&act=tambah' role=\"button\">
                        <i class=\"fas fa-plus\"></i> Tambah Jenis Piket
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
                <th>Jenis Piket</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>";
        $dataJenisPiket = $jenis_piket->getListJenisPiket();
        foreach ($dataJenisPiket as $data) {
            echo "
            <tr>
                <td>$data[id_jenis_piket]</td>
                <td style='text-transform: capitalize;'>$data[jenis_piket]</td>
                
                <td class='center aligned'>
                    <a href='?m=$m&act=edit&id=$data[id_jenis_piket]'>Edit</a> | ";
            if ($data['id_jenis_piket'] > 3) {
                echo "<a href='$aksi?m=$m&act=hapus&id=$data[id_jenis_piket]' id='btn-delete' style='cursor: pointer;'
                        onclick='return confirm(`Anda yakin akan menghapus jenis_piket $data[jenis_piket] ID=$data[id_jenis_piket] ?`)'
                    >Hapus</a>";
            }
//            href='$aksi?m=$m&act=hapus&id=$data[id_jenis_piket]'
//                             onclick='return confirm(`Hapus modul $data[module_name] ID=$data[id_jenis_piket]?`);'
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
                    <a href="" target="_blank">Jenis Piket</a>
                    <span>/</span>
                    <span>Tambah Jenis Piket</span>
                </h4>


            </div>
            <!--Card content-->
        </div>
        <div class="card wow fadeIn">
            <div class="card-body">

                <form class="ui form" method="POST" name="formJenisPiket" onsubmit="return moduleValidation()"
                      action=<?php echo "$aksi?m=$m&act=tambah" ?>>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama_module">Jenis Piket</label>
                            <input type="text" class="form-control" name="jenis_piket"
                                   placeholder="Jenis Piket"
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
        $data = $jenis_piket->getItemJenisPiket($_GET['id']);
        echo "<br><br>
        <div class=\"card mb-4 wow fadeIn\">

            <!--Card content-->
            <div class=\"card-body d-sm-flex \">
                <a class=\"btn btn-primary btn-md my-0 p\" onclick=\"self.history.back()\"
                   role=\"button\">
                    <i class=\"fas fa-chevron-left \"></i> Kembali
                </a>

                <h4 class=\"mb-2 mb-sm-0 pt-1 mx-auto\">
                    <a href=\"\" target=\"_blank\">JenisPiket</a>
                    <span>/</span>
                    <span>Edit JenisPiket</span>
                </h4>


            </div>
            <!--Card content-->
        </div>
        <div class=\"card wow fadeIn\">
            <div class=\"card-body\">
            <form class='ui form' method='POST' name='formJenisPiket' onsubmit='return moduleValidation()' action='$aksi?m=$m&act=update' >
            <input type='hidden' name='id' value='$data[id_jenis_piket]'>
                    <div class=\"form-row\">
                        <div class=\"form-group col-md-6\">
                            <label for=\"jenis_piket\">Jenis Piket</label>
                            <input type=\"text\" class=\"form-control\" name=\"jenis_piket\" placeholder='$data[jenis_piket]' value='$data[jenis_piket]'
                                   id=\"jenis_piket\" >
                        </div>
                    </div>
                    <button class=\"btn btn-primary float-sm-right\" type=\"submit\">Perbarui</button>
                </form>
    </div>";
        break;
} ?>