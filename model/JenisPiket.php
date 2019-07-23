<?php

class JenisPiket
{
// get data from JenisPiket
    function getListJenisPiket()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM jenis_piket";
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
    function getItemJenisPiket($id_jenis_piket)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM jenis_piket WHERE id_jenis_piket='$id_jenis_piket'";
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

// input data jenis_piket
    function insertJenisPiket($jenis_piket)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO jenis_piket(jenis_piket)
                    VALUES('$jenis_piket') ";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

// update data jenis_piket
    function updateJenisPiket($id_jenis_piket, $jenis_piket)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE jenis_piket SET jenis_piket='$jenis_piket'
                        WHERE id_jenis_piket='$id_jenis_piket'";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

//delete 1 data jenis_piket
    function deleteJenisPiket($id_jenis_piket)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM jenis_piket WHERE id_jenis_piket='$id_jenis_piket'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }

}

?>