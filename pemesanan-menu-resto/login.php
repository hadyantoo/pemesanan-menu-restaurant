<?php
session_start();

require_once('koneksi.php');
require('fungsi.php');

$objeck = new login;


if (isset($_POST['submit'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $data = $objeck->cek($user, $pass);
    if ($data == 0) {
?>
        <script>
            alert("username dan password salah !");
            window.location.href = "index.php";
        </script>
<?php
    } else {

        $datas = mysqli_fetch_array($data);
        if ($datas['level'] == 1) {
            $_SESSION['id'] = $datas['id'];
            header('location:admin/index.php');
        } else {
            $_SESSION['id'] = $datas['id'];
            header('location:home.php');
        }
    }
}

if (isset($_POST['logout'])) {
    $_SESSION['id'] = 0;
    header('location:index.php');
}

if (isset($_POST['regis'])) {
    $regis = $objeck->regis($_POST['username'], $_POST['password']);
    if ($regis == 1) : echo "username telah digunakan !";
    else : header('location:index.php');
    endif;
}
