<?php

class Anggota
{
// get data from Anggota
    function getListAnggota()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM anggota";
            $res = $conn->query($sql);
            if ($res) {
                $data = $res->fetch_all(MYSQLI_ASSOC);
                $res->free();
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

// get 1 data to put in edit form
    function getItemAnggota($id_rfid)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM anggota WHERE id_rfid='$id_rfid'";
            $res = $conn->query($sql);
            $data = $res->fetch_assoc();
            $row_cnt = $res->num_rows;

            if ($row_cnt == 1) {
                return $data;
            }

        } else {
            return false;
        }
    }

// input data anggota
    function insertAnggota($id_rfid, $username, $id_riset, $id_prodi, $nim, $nama_anggota, $tgl_terdaftar, $url_photo)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO anggota(id_rfid, username, id_riset, id_prodi, nim, nama_anggota, tgl_terdaftar, url_photo)
                    VALUES('$id_rfid', '$username', '$id_riset', '$id_prodi', '$nim', '$nama_anggota', '$tgl_terdaftar', '$url_photo') ";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

// update data anggota
    function updateAnggota($id_rfid, $id_riset, $id_prodi, $nama_anggota, $url_photo)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE anggota SET id_riset='$id_riset',
                                        id_prodi='$id_prodi',
                                        nama_anggota='$nama_anggota',
                                        url_photo='$url_photo'
                        WHERE id_rfid='$id_rfid'";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

//delete 1 data anggota
    function deleteAnggota($id_rfid)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM anggota WHERE id_rfid='$id_rfid'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }

}

?>