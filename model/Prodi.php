<?php

class Prodi
{
// get data from Prodi
    function getListProdi()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM prodi";
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
    function getItemProdi($id_prodi)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM prodi WHERE id_prodi='$id_prodi'";
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

// input data prodi
    function insertProdi($nama_prodi)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO prodi(nama_prodi)
                    VALUES('$nama_prodi') ";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

// update data prodi
    function updateProdi($id_prodi, $nama_prodi)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE prodi SET nama_prodi='$nama_prodi'
                        WHERE id_prodi='$id_prodi'";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

//delete 1 data prodi
    function deleteProdi($id_prodi)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM prodi WHERE id_prodi='$id_prodi'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }

}

?>