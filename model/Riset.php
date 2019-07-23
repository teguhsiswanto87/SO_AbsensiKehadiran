<?php

class Riset
{
// get data from Riset
    function getListRiset()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM riset";
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
    function getItemRiset($id_riset)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM riset WHERE id_riset='$id_riset'";
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

// input data riset
    function insertRiset($bidang_riset,$waktu_reset)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO riset(bidang_riset,waktu_riset)
                    VALUES('$bidang_riset','$waktu_reset') ";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

// update data riset
    function updateRiset($id_riset, $bidang_riset, $waktu_riset)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE riset SET bidang_riset='$bidang_riset', waktu_riset='$waktu_riset'
                        WHERE id_riset='$id_riset'";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

//delete 1 data riset
    function deleteRiset($id_riset)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM riset WHERE id_riset='$id_riset'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }

}

?>