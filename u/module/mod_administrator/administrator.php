<?php
// call Class Administrator
include "../model/Administrator.php";

$m = $_GET['m'];
$aksi = "module/mod_administrator/aksi_administrator.php";
$act = isset($_GET['act']) ? $_GET['act'] : '';
$administrator = new Administrator();

switch ($act) {
    default:
        echo "<br><br>
        <div class=\"card mb-4 wow fadeIn\">

            <!--Card content-->
            <div class=\"card-body d-sm-flex justify-content-between\">

                <h4 class=\"mb-2 mb-sm-0 pt-1\">
                    <a href=\"\" target=\"_blank\">Administrator</a>
                    <span>/</span>
                    <span>Tampil Administrator</span>
                </h4>

                    <!-- Default input -->
                    <a class=\"btn btn-primary btn-md my-0 p\" onclick=window.location.href='media.php?m=$m&act=tambah' role=\"button\">
                        <i class=\"fas fa-plus\"></i> Tambah Administrator
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
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Url Photo</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>";
        $dataAdministrator = $administrator->getListAdministrator();
        foreach ($dataAdministrator as $data) {
            echo "
            <tr>
                <td>$data[username]</td>
                <td>$data[nama_lengkap]</td>
                <td>$data[url_photo]</td>
                
                <td class='center aligned'>
                    <a href='?m=$m&act=edit&id=$data[username]'>Edit</a> | ";
            if ($data['username'] != 'daffa' && $data['username'] != 'donny' && $data['username'] != 'teguh' && $data['username'] != 'yusrizal') {
                echo "<a href='$aksi?m=$m&act=hapus&id=$data[username]' id='btn-delete' style='cursor: pointer;'
                        onclick='return confirm(`Anda yakin akan menghapus administrator $data[nama_lengkap] ID=$data[username] ?`)'
                    >Hapus</a>";
            }
//            href='$aksi?m=$m&act=hapus&id=$data[username]'
//                             onclick='return confirm(`Hapus modul $data[nama_lengkap] ID=$data[username]?`);'
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
                    <a href="" target="_blank">Administrator</a>
                    <span>/</span>
                    <span>Tambah Administrator</span>
                </h4>


            </div>
            <!--Card content-->
        </div>
        <div class="card wow fadeIn">
            <div class="card-body">

                <form class="ui form" method="POST" name="formAdministrator" onsubmit="return administratorValidation()"
                      action=<?php echo "$aksi?m=$m&act=tambah" ?>>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username"
                                   id="username" autofocus>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama_administrator">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap"
                                   id="nama_administrator" autofocus>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="url_photo">Url Photo</label>
                            <input type="text" class="form-control" name="url_photo"
                                   placeholder="contoh : https://akademik.unikom.ac.id/foto/10117080.jpg"
                                   id="url_photo" autofocus>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Password" class="form-control"
                                   id="passwordId"
                            >
                            <span id="messageId"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Ulangi Password</label>
                            <input type="password" name="confirmPassword" placeholder="Password" class="form-control"
                                   id="confirmPasswordId"
                            >
                        </div>
                    </div>
                    <button class="btn btn-primary float-sm-right" type="submit">Tambahkan</button>
                </form>

            </div>
        </div>
        <?php
        break;
    case "edit":
        $data = $administrator->getItemAdministrator($_GET['id']);
        $id_session = session_id();
        echo "<br><br>
        <div class=\"card mb-4 wow fadeIn\">

            <!--Card content-->
            <div class=\"card-body d-sm-flex \">
                <a class=\"btn btn-primary btn-md my-0 p\" onclick=\"self.history.back()\"
                   role=\"button\">
                    <i class=\"fas fa-chevron-left \"></i> Kembali
                </a>

                <h4 class=\"mb-2 mb-sm-0 pt-1 mx-auto\">
                    <a href=\"\" target=\"_blank\">Administrator</a>
                    <span>/</span>
                    <span>Edit Administrator</span>
                </h4>


            </div>
            <!--Card content-->
        </div>
        <div class=\"card wow fadeIn\">
            <div class=\"card-body\">
            <form class='ui form' method='POST' name='formAdministrator' onsubmit='return administratorValidation()' action='$aksi?m=$m&act=update' >
            <input type='hidden' name='id_session' value='$id_session'>
            <input type='hidden' name='username' value='$data[username]'>
                    <div class=\"form-row\">
                        <div class=\"form-group col-md-6\">
                            <label for=\"nama_administrator\">Nama Administrator</label>
                            <input type=\"text\" class=\"form-control\" name=\"nama_lengkap\" placeholder='$data[nama_lengkap]' value='$data[nama_lengkap]'
                                   id=\"nama_administrator\" autofocus>
                        </div>
                    </div>

                    <div class=\"form-row\">
                        <div class=\"form-group col-md-6\">
                            <label for=\"url_photo_administrator\">Url Photo</label>
                            <input type=\"text\" class=\"form-control\" name=\"url_photo\" placeholder='$data[url_photo]' value='$data[url_photo]'
                                   id=\"url_photo_administrator\" autofocus>
                        </div>
                    </div>

                    <button class=\"btn btn-primary float-sm-right\" type=\"submit\">Perbarui</button>
                </form>
    </div>";
        break;
} ?>