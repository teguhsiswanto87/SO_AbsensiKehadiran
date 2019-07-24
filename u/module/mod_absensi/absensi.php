<?php
// call Class Anggota
include "../model/Absensi.php";

$m = $_GET['m'];
$aksi = "module/mod_absensi/aksi_absensi.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$absensi = new Absensi();

switch ($act) {
    default:
        $jam = date("H:i");

        echo "<br><br>
        <div class=\"card mb-4 wow fadeIn\">

            <!--Card content-->
            <div class=\"card-body d-sm-flex justify-content-between\">

                <h4 class=\"mb-2 mb-sm-0 pt-1\">
                    <a href=\"\" target=\"_blank\">Absensi</a>
                    <span>/</span>
                    <span>Tampil Absensi $jam</span>
                </h4>

                    <!-- Default input -->
                    <a class=\"btn btn-primary btn-md my-0 p\" onclick=window.location.href='media.php?m=$m&act=tambah' role=\"button\">
                        <i class=\"fas fa-plus\"></i> Tambah Absensi
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
                <th>RFID</th>
                <th>Tanggal Kehadiran</th>
                <th>Waktu Datang</th>
                <th>Waktu Pulang</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>";
        $dataAbsensi = $absensi->getListAbsensi();
        foreach ($dataAbsensi as $data) {
            echo "
            <tr>
                <td>$data[id_absensi]</td>
                <td>$data[id_rfid]</td>
                <td>$data[tgl_kehadiran]</td>
                <td>$data[waktu_datang]</td>
                <td>$data[waktu_pulang]</td>
                <td>$data[status]</td>
                
                <td class='center aligned'>
                    <a href='?m=$m&act=edit&id=$data[id_absensi]'>Edit</a> | ";
            if ($data['id_absensi'] != "") {
                echo "<a href='$aksi?m=$m&act=hapus&id=$data[id_absensi]' id='btn-delete' style='cursor: pointer;'
                        onclick='return confirm(`Anda yakin akan menghapus kehadiran $data[id_rfid] ID=$data[id_absensi] ?`)'
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
                    <a href="" target="_blank">Absensi</a>
                    <span>/</span>
                    <span>Tambah Absensi</span>
                </h4>


            </div>
            <!--Card content-->
        </div>
        <div class="card wow fadeIn">
            <div class="card-body">

                <form class="ui form" method="POST" name="formAbsensi" onsubmit="return anggotaValidation()"
                      action=<?php echo "$aksi?m=$m&act=tambah" ?>>
                    <input type="hidden" value="<?php echo "$_SESSION[username]"; ?>" name="username">
                    <?php
                    $acak = rand(1, 999);
                    $idrfid = "rfid$acak";
                    ?>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="idrfid">ID RFID</label>
                            <input type="text" class="form-control disabled" name="id_rfid" placeholder="ID RFID"
                                   value="<?php echo $idrfid; ?>"
                                   id="idrfid">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="idprodi">Program Studi</label>
                            <select name="id_prodi" id="idprodi" class="form-control"
                                    style='text-transform: capitalize;'>
                                <?php
                                include "../model/Prodi.php";
                                $prodi = new Prodi();
                                $dataProdi = $prodi->getListProdi();
                                foreach ($dataProdi as $rProdi) {
                                    echo "<option value='$rProdi[id_prodi]'>$rProdi[nama_prodi]</option>";
                                }

                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="idriset">Riset</label>
                            <select name="id_riset" id="idriset" class="form-control"
                                    style='text-transform: capitalize;'>
                                <?php
                                include "../model/Riset.php";
                                $riset = new Riset();
                                $dataRiset = $riset->getListRiset();
                                foreach ($dataRiset as $rRiset) {
                                    echo "<option value='$rRiset[id_riset]'>$rRiset[bidang_riset]</option>";
                                }

                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="nim">NIM</label>
                            <input type="text" class="form-control" name="nim" placeholder="NIM"
                                   id="nim" autofocus>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nama_anggota">Nama Absensi</label>
                            <input type="text" class="form-control" name="nama_anggota" placeholder="Nama Absensi"
                                   id="nama_anggota">
                        </div>

                    </div>


                    <button class="btn btn-primary float-sm-right" type="submit">Tambahkan</button>
                </form>

            </div>
        </div>
        <?php
        break;
    case "edit":
        $data = $absensi->getItemAbsensi($_GET['id']); ?>
        <br><br>
        <div class='card mb-4 wow fadeIn'>

            <!--Card content-->
            <div class='card-body d-sm-flex '>
                <a class='btn btn-primary btn-md my-0 p' onclick='self.history.back()'
                   role='button'>
                    <i class='fas fa-chevron-left '></i> Kembali
                </a>

                <h4 class='mb-2 mb-sm-0 pt-1 mx-auto'>
                    <a href='' target='_blank'>Absensi</a>
                    <span>/</span>
                    <span>Edit Absensi</span>
                </h4>


            </div>
        </div>
        <!--Card content-->
        <div class='card wow fadeIn'>
        <div class='card-body'>
            <form class="ui form" method="POST" name="formAbsensi" onsubmit="return anggotaValidation()"
                  action="<?php echo "$aksi?m=$m&act=update" ?>">
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="idrfid">ID RFID</label>
                        <input type="text" class="form-control disabled" name="id_rfid" placeholder="ID RFID"
                               value="<?php echo $data['id_rfid']; ?>"
                               id="idrfid">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="idprodi">Program Studi</label>
                        <select name="id_prodi" id="idprodi" class="form-control"
                                style='text-transform: capitalize;'>
                            <?php
                            include_once "../model/Prodi.php";
                            $prodi = new Prodi();
                            $dataProdi = $prodi->getListProdi();
                            foreach ($dataProdi as $rProdi) {
                                $selected = "";
                                if ($rProdi['id_prodi'] == $data['id_prodi']) {
                                    $selected = "selected";
                                }
                                echo "<option value='$rProdi[id_prodi]' $selected>$rProdi[nama_prodi]</option>";
                            }

                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="idriset">Riset</label>
                        <select name="id_riset" id="idriset" class="form-control"
                                style='text-transform: capitalize;'>
                            <?php
                            include_once "../model/Riset.php";
                            $riset = new Riset();
                            $dataRiset = $riset->getListRiset();
                            foreach ($dataRiset as $rRiset) {
                                $selected = "";
                                if ($rRiset['id_riset'] == $data['id_riset']) {
                                    $selected = "selected";
                                }
                                echo "<option value='$rRiset[id_riset]' $selected>$rRiset[bidang_riset]</option>";
                            }

                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" name="nim" placeholder="<?php echo $data['nim']; ?>"
                               value="<?php echo $data['nim']; ?>"
                               id="nim" autofocus>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama_anggota">Nama Absensi</label>
                        <input type="text" class="form-control" name="nama_anggota"
                               placeholder="<?php echo $data['nama_anggota']; ?>"
                               value="<?php echo $data['nama_anggota']; ?>"
                               id="nama_anggota">
                    </div>

                </div>

                <button class="btn btn-primary float-sm-right" type="submit">Tambahkan</button>
            </form>
        </div>
        <?php break; ?>
    <?php } ?>