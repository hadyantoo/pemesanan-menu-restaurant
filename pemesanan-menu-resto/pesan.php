<?php
session_start();

if ($_SESSION['id'] == 0) {
    echo "anda belum login harap login terlebih dahulu";
} else {
    require_once('koneksi.php');
    require_once('fungsi.php');

    $id_menu = $_GET['id'];
    $id_user = $_SESSION['id'];

    $objek = new crud;
    $data = $objek->insertData($id_user, $id_menu);
    header('location:home.php');
}
