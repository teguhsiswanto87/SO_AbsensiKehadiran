<?php

class Absensi
{
// get data from Absensi
    function getListAbsensi()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM absensi";
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
    function getItemAbsensi($id_absensi)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM absensi WHERE id_absensi='$id_absensi'";
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

// input data absensi DATANG
    function insertDatangAbsensi($id_rfid, $tgl_kehadiran, $waktu_datang)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO absensi(id_rfid, tgl_kehadiran, waktu_datang, status)
                    VALUES('$id_rfid', '$tgl_kehadiran','$waktu_datang','datang') ";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

// input data absensi PULANG
    function updatePulangAbsensi($id_rfid, $tgl_kehadiran, $waktu_pulang)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE absensi SET waktu_pulang='$waktu_pulang',
                                        status='selesai'
                                    WHERE id_rfid='$id_rfid' AND tgl_kehadiran='$tgl_kehadiran' AND status='datang' ";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

// update data absensi
    function updateAbsensi($id_absensi, $id_rfid, $tgl_kehadiran, $waktu_datang, $waktu_pulang, $status)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE absensi SET id_rfid='$id_rfid',
                                        tgl_kehadiran='$tgl_kehadiran',
                                        waktu_datang='$waktu_datang',
                                        waktu_pulang='$waktu_pulang',
                                        status='$status'
                        WHERE id_absensi='$id_absensi'";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

//delete 1 data absensi
    function deleteAbsensi($id_absensi)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM absensi WHERE id_absensi='$id_absensi'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }

}

?>