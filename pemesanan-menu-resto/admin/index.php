<?php
session_start();
if ($_SESSION['id'] == 0) {
    header('location:/../index.php');
}
echo $_SESSION['id'];
