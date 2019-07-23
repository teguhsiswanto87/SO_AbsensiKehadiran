<?php

class Administrator
{
// get data from Administrator
    function getListAdministrator()
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM administrator";
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
    function getItemAdministrator($username)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "SELECT * FROM administrator WHERE username='$username'";
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

// input data administrator
    function insertAdministrator($username, $nama_lengkap, $url_photo, $password)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "INSERT INTO administrator(username,nama_lengkap, url_photo, password)
                    VALUES('$username','$nama_lengkap','$url_photo','$password') ";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        }

    }

// update data administrator
    function updateAdministrator($username, $nama_lengkap, $url_photo, $id_session)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "UPDATE administrator SET nama_lengkap='$nama_lengkap',
                                        url_photo='$url_photo'
                                        
                        WHERE username='$username' AND id_session='$id_session' ";
            $res = $conn->query($sql);

            if ($res) return true; else return false;

        } else {
            return false;
        }
    }

//delete 1 data administrator
    function deleteAdministrator($username)
    {
        $conn = dbConnect();
        if ($conn->connect_errno == 0) {
            $sql = "DELETE FROM administrator WHERE username='$username'";
            $res = $conn->query($sql);
            if ($res) return true; else return false;
        } else {
            return false;
        }
    }

}

?>