<?php
// call Class Anggota
include "../model/Anggota.php";

$m = $_GET['m'];
$aksi = "module/mod_anggota/aksi_anggota.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$anggota = new Anggota();

switch ($act) {
    default:
        echo "<br><br>
        <div class=\"card mb-4 wow fadeIn\">

            <!--Card content-->
            <div class=\"card-body d-sm-flex justify-content-between\">

                <h4 class=\"mb-2 mb-sm-0 pt-1\">
                    <a href=\"\" target=\"_blank\">Anggota</a>
                    <span>/</span>
                    <span>Tampil Anggota</span>
                </h4>

                    <!-- Default input -->
                    <a class=\"btn btn-primary btn-md my-0 p\" onclick=window.location.href='media.php?m=$m&act=tambah' role=\"button\">
                        <i class=\"fas fa-plus\"></i> Tambah Anggota
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
                <th>Nama Anggota</th>
                <th>Link</th>
                <th>Icon</th>
                <th>Aktif</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>";
        $dataAnggota = $anggota->getListAnggota();
        foreach ($dataAnggota as $data) {
            echo "
            <tr>
                <td>$data[anggota_id]</td>
                <td>$data[anggota_name]</td>
                <td>$data[link]</td>
                <td>$data[icon]</td>
                <td>$data[active]</td>
                
                <td class='center aligned'>
                    <a href='?m=$m&act=edit&id=$data[anggota_id]'>Edit</a> | ";
            if ($data['anggota_id'] > 8) {
                echo "<a href='$aksi?m=$m&act=hapus&id=$data[anggota_id]' id='btn-delete' style='cursor: pointer;'
                        onclick='return confirm(`Anda yakin akan menghapus anggota $data[anggota_name] ID=$data[anggota_id] ?`)'
                    >Hapus</a>";
            }
//            href='$aksi?m=$m&act=hapus&id=$data[anggota_id]'
//                             onclick='return confirm(`Hapus modul $data[anggota_name] ID=$data[anggota_id]?`);'
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
                    <a href="" target="_blank">Anggota</a>
                    <span>/</span>
                    <span>Tambah Anggota</span>
                </h4>


            </div>
            <!--Card content-->
        </div>
        <div class="card wow fadeIn">
            <div class="card-body">

                <form class="ui form" method="POST" name="formAnggota" onsubmit="return anggotaValidation()"
                      action=<?php echo "$aksi?m=$m&act=tambah" ?>>
                    <?php
                    $acak = rand(1, 99);
                    $idrfid = "rfid$acak";
                    ?>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="idrfid">ID RFID</label>
                            <input type="text" class="form-control disabled" name="id_rfid" placeholder="ID RFID"
                                   value="<?php echo $idrfid; ?>"
                                   id="idrfid" autofocus>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="idprodi">Program Studi</label>
                            <select name="id_prodi" id="idprodi" class="form-control">
                                <?php
                                include "../model/Prodi.php";
                                $prodi = new Prodi();
                                $dataProdi = $prodi->getListProdi();
                                foreach ($dataProdi as $rProdi) {
                                    echo "<option value='$rProdi[id_prodi]' style='text-transform: capitalize;'>$rProdi[nama_prodi]</option>";
                                }

                                ?>
                            </select>
                        </div>
                    </div>

                    <!--                    <div class="form-row">-->
                    <!--                        <div class="form-group col-md-6">-->
                    <!--                            <label for="nama_anggota">Nama Anggota</label>-->
                    <!--                            <input type="text" class="form-control" name="anggota_name" placeholder="Nama Anggota"-->
                    <!--                                   id="nama_anggota" autofocus>-->
                    <!--                        </div>-->
                    <!--                    </div>-->

                    <button class="btn btn-primary float-sm-right" type="submit">Tambahkan</button>
                </form>

            </div>
        </div>
        <?php
        break;
    case "edit":
        $data = $anggota->getItemAnggota($_GET['id']);
        echo "<br><br>
        <div class=\"card mb-4 wow fadeIn\">

            <!--Card content-->
            <div class=\"card-body d-sm-flex \">
                <a class=\"btn btn-primary btn-md my-0 p\" onclick=\"self.history.back()\"
                   role=\"button\">
                    <i class=\"fas fa-chevron-left \"></i> Kembali
                </a>

                <h4 class=\"mb-2 mb-sm-0 pt-1 mx-auto\">
                    <a href=\"\" target=\"_blank\">Anggota</a>
                    <span>/</span>
                    <span>Edit Anggota</span>
                </h4>


            </div>
            <!--Card content-->
        </div>
        <div class=\"card wow fadeIn\">
            <div class=\"card-body\">
            <form class='ui form' method='POST' name='formAnggota' onsubmit='return anggotaValidation()' action='$aksi?m=$m&act=update' >
            <input type='hidden' name='id' value='$data[anggota_id]'>
                    <div class=\"form-row\">
                        <div class=\"form-group col-md-6\">
                            <label for=\"nama_anggota\">Nama Anggota</label>
                            <input type=\"text\" class=\"form-control\" name=\"anggota_name\" placeholder='$data[anggota_name]' value='$data[anggota_name]'
                                   id=\"nama_anggota\" autofocus>
                        </div>
                        <div class=\"form-group col-md-6\">
                            <label for=\"link_anggota\">Link (contoh => ?m=namaanggota)</label>
                            <input type=\"text\" class=\"form-control\" name=\"link\" placeholder='$data[link]' value='$data[link]'
                                   id=\"link_anggota\" autofocus>
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