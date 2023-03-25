<?php
session_start();

require_once('koneksi.php');
require_once('fungsi.php');

$id = $_GET['id'];

$objek = new crud;

$objek->cancel($_SESSION['id'], $id);
if ($objek) : header('location:pesanan.php');
else : echo "gagal";
endif;
