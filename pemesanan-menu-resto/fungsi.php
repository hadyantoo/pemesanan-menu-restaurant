<?php

class crud extends database
{

    public function tampilmenu($data)
    {
        $sql = $this->koneksi->query("SELECT * FROM menu WHERE jenis = '$data'");
        return $sql;
    }
    public function insertData($id_pengunjung, $id_menu) //insert data pesanan
    {
        $query = $this->koneksi->query("SELECT * FROM pesanan WHERE id_pengunjung = '$id_pengunjung' && id_menu = '$id_menu' && status = 'stand'");
        if (mysqli_num_rows($query) == 0) :
            $sql = $this->koneksi->query("INSERT INTO pesanan (id_pengunjung, id_menu, status, jumlah) VALUES ('$id_pengunjung', '$id_menu', 'stand', '1')");
        else :
            $data = mysqli_fetch_array($query);
            $hasil = $data['jumlah'] + 1;
            $this->koneksi->query("UPDATE `pesanan` SET `jumlah`='$hasil' WHERE id_pengunjung = '$id_pengunjung' && id_menu = '$id_menu' && status = 'stand'");
        endif;
    }
    public function tampilPesanan($id, $status)
    {
        $sql = $this->koneksi->query("SELECT * FROM pesanan WHERE id_pengunjung='$id' && status='$status'");
        $data = mysqli_num_rows($sql);
        if ($data == 0) : return "kosong";
        else : return $sql;
        endif;
    }
    public function tampilmenudipesan($id)
    {
        $sql = $this->koneksi->query("SELECT * FROM menu WHERE id='$id'");
        $data = mysqli_num_rows($sql);
        if ($data == 0) : return "data kosong";
        else : return $sql;
        endif;
    }
    public function pesan($idp)
    {

        $cek = $this->koneksi->query("SELECT * FROM pesanan WHERE id_pengunjung = '$idp' && status = 'stand'");

        if (mysqli_num_rows($cek) == 0) {
            echo "belum melakukan pemesanan";
        } else {
            while ($data = mysqli_fetch_array($cek)) {
                $idmenu = $data['id_menu'];

                $ceklagi = $this->koneksi->query("SELECT * FROM pesanan WHERE id_pengunjung = '$idp' && id_menu = '$idmenu' && status = 'proses'");

                if (mysqli_num_rows($ceklagi) == 0) {
                    $this->koneksi->query("UPDATE pesanan SET status='proses' WHERE id_pengunjung='$idp' && id_menu='$idmenu'");
                } else {
                    $cekcek = $this->koneksi->query("SELECT * FROM pesanan WHERE id_pengunjung = '$idp' && id_menu = '$idmenu' && status = 'stand'");
                    $jumlahstand = mysqli_fetch_array($cekcek);
                    $jumlahproses = mysqli_fetch_array($ceklagi);
                    $jumlah = $jumlahproses['jumlah'] + $jumlahstand['jumlah'];

                    $update = $this->koneksi->query("UPDATE pesanan SET jumlah='$jumlah' WHERE id_pengunjung='$idp' && id_menu='$idmenu' && status='proses'");
                    if ($update) :
                        $this->koneksi->query("DELETE FROM pesanan WHERE id_pengunjung='$idp' && id_menu='$idmenu' && status='stand'");
                    endif;
                }
            }
        }
    }
    public function cancel($idp, $idm)
    {
        $query = $this->koneksi->query("SELECT * FROM pesanan WHERE id_pengunjung='$idp'  && id_menu='$idm' && status='stand'");

        if ($query) : $data = mysqli_fetch_array($query);
            if ($data['jumlah'] == 1) :
                $this->koneksi->query("DELETE FROM pesanan WHERE id_pengunjung = '$idp' && id_menu='$idm' && status='stand'");
            else :
                $jumlah = $data['jumlah'] - 1;
                $this->koneksi->query("UPDATE pesanan SET jumlah='$jumlah' WHERE id_pengunjung='$idp' && id_menu = '$idm' && status='stand'");
            endif;
        endif;
    }
}



class login extends  database
{

    public function cek($user, $pass)
    {
        $sql = mysqli_query($this->koneksi, "SELECT * FROM user WHERE username = '$user' && password = '$pass'");
        $cek = mysqli_num_rows($sql);
        if ($cek == 0) :
            return 0;
        else :
            return $sql;
        endif;
    }
    public function cariId($id)
    {
        $sql = mysqli_query($this->koneksi, "SELECT * FROM user WHERE id='$id'");
        return $sql;
    }
    public function regis($username, $password)
    {
        $sql = $this->koneksi->query("SELECT * FROM user WHERE username='$username'");
        $cek = mysqli_num_rows($sql);
        if ($cek == 0) {
            $regis = $this->koneksi->query("INSERT INTO user (username,password) VALUES ('$username', '$password')");
        } else {
            return 1;
        }
    }
}
