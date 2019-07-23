<?php
// call Class Riset
include "../model/Riset.php";

$m = $_GET['m'];
$aksi = "module/mod_riset/aksi_riset.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$riset = new Riset();

switch ($act) {
    default:
        echo "<br><br>
        <div class=\"card mb-4 wow fadeIn\">

            <!--Card content-->
            <div class=\"card-body d-sm-flex justify-content-between\">

                <h4 class=\"mb-2 mb-sm-0 pt-1\">
                    <a href=\"\" target=\"_blank\">Riset</a>
                    <span>/</span>
                    <span>Tampil Riset</span>
                </h4>

                    <!-- Default input -->
                    <a class=\"btn btn-primary btn-md my-0 p\" onclick=window.location.href='media.php?m=$m&act=tambah' role=\"button\">
                        <i class=\"fas fa-plus\"></i> Tambah Riset
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
                <th>Nama Bidang Riset</th>
                <th>Waktu Riset</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>";
        $dataRiset = $riset->getListRiset();
        foreach ($dataRiset as $data) {
            echo "
            <tr>
                <td>$data[id_riset]</td>
                <td style='text-transform: capitalize;'>$data[bidang_riset]</td>
                <td>$data[waktu_riset] Jam</td>
                
                <td class='center aligned'>
                    <a href='?m=$m&act=edit&id=$data[id_riset]'>Edit</a> | ";
            if ($data['id_riset'] > 7) {
                echo "<a href='$aksi?m=$m&act=hapus&id=$data[id_riset]' id='btn-delete' style='cursor: pointer;'
                        onclick='return confirm(`Anda yakin akan menghapus prodi $data[bidang_riset] ID=$data[id_riset] ?`)'
                    >Hapus</a>";
            }
//            href='$aksi?m=$m&act=hapus&id=$data[id_riset]'
//                             onclick='return confirm(`Hapus modul $data[module_name] ID=$data[id_riset]?`);'
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
                    <a href="" target="_blank">Riset</a>
                    <span>/</span>
                    <span>Tambah Riset</span>
                </h4>


            </div>
            <!--Card content-->
        </div>
        <div class="card wow fadeIn">
            <div class="card-body">

                <form class="ui form" method="POST" name="formRiset" onsubmit="return moduleValidation()"
                      action=<?php echo "$aksi?m=$m&act=tambah" ?>>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama_module">Nama Bidang Riset</label>
                            <input type="text" class="form-control" name="bidang_riset" placeholder="Nama Bidang Riset"
                                   id="nama_module" autofocus>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="nama_module">Waktu Riset (Jam)</label>
                            <input type="number" class="form-control" name="waktu_riset" placeholder="Jam"
                                   id="nama_module" min="2" max="12" required>
                        </div>
                    </div>
                    <button class="btn btn-primary float-sm-right" type="submit">Tambahkan</button>
                </form>

            </div>
        </div>
        <?php
        break;
    case "edit":
        $data = $riset->getItemRiset($_GET['id']);
        echo "<br><br>
        <div class=\"card mb-4 wow fadeIn\">

            <!--Card content-->
            <div class=\"card-body d-sm-flex \">
                <a class=\"btn btn-primary btn-md my-0 p\" onclick=\"self.history.back()\"
                   role=\"button\">
                    <i class=\"fas fa-chevron-left \"></i> Kembali
                </a>

                <h4 class=\"mb-2 mb-sm-0 pt-1 mx-auto\">
                    <a href=\"\" target=\"_blank\">Riset</a>
                    <span>/</span>
                    <span>Edit Riset</span>
                </h4>


            </div>
            <!--Card content-->
        </div>
        <div class=\"card wow fadeIn\">
            <div class=\"card-body\">
            <form class='ui form' method='POST' name='formRiset' onsubmit='return moduleValidation()' action='$aksi?m=$m&act=update' >
            <input type='hidden' name='id' value='$data[id_riset]'>
                    <div class=\"form-row\">
                        <div class=\"form-group col-md-6\">
                            <label for=\"nama_module\">Nama Program Studi</label>
                            <input type=\"text\" class=\"form-control\" name=\"bidang_riset\" placeholder='$data[bidang_riset]' value='$data[bidang_riset]'
                                   id=\"nama_module\" >
                        </div>
                    </div>
                    <button class=\"btn btn-primary float-sm-right\" type=\"submit\">Perbarui</button>
                </form>
    </div>";
        break;
} ?>