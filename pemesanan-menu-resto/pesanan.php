<?php
session_start();
if ($_SESSION['id'] == 0) : header('location:index.php');
endif;

require_once('koneksi.php');
require_once('fungsi.php');

$objek = new crud;
$no = 1;

if (isset($_POST['pesan'])) : $objek->pesan($_SESSION['id']);
    header('location:pesanan.php');
endif;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>



    <div class="container text-center">
        <h2 class="my-4">PESANAN</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Menu</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $data = $objek->tampilPesanan($_SESSION['id'], 'stand');
                if ($data == 'kosong') : echo "<tr>" . "<td>1</td>" . "<td>data kosong</td>" . "</tr>";
                else :
                    while ($row = mysqli_fetch_array($data)) {
                        $menu = $objek->tampilmenudipesan($row['id_menu']);
                        while ($rows = mysqli_fetch_array($menu)) {
                ?>
                            <tr>
                                <th scope="row"><?= $no ?></th>
                                <td><?= $rows['nama']; ?></td>
                                <td><?= $row['jumlah']; ?></td>
                                <td><a href="cancel.php?id=<?= $rows['id']; ?>">cancel</a></td>
                            </tr>
                <?php
                            $no++;
                        }
                    }
                endif;
                $no = 1;
                ?>

            </tbody>
        </table>




        <form action="" method="post" class="my-4">
            <button type="submit" name="pesan" value="pesan" class="btn btn-primary">pesan</button>
        </form>



        <h2 class="my-4">PESANAN YANG SEDANG DI PROSES</h2>


        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Menu</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $dat = $objek->tampilPesanan($_SESSION['id'], 'proses');
                if ($dat == 'kosong') : echo "<tr><td>" . "data kosong" . "</td></tr>";
                else :
                    while ($row = mysqli_fetch_array($dat)) {
                        $menu = $objek->tampilmenudipesan($row['id_menu']);
                        while ($rows = mysqli_fetch_array($menu)) {
                ?>
                            <tr>
                                <th scope="row"><?= $no; ?></th>
                                <td><?= $rows['nama']; ?></td>
                                <td><?= $row['jumlah']; ?></td>
                                <td>Proses</td>
                            </tr>

                <?php
                            $no++;
                        }
                    }
                endif;
                $no = 1;
                ?>
            </tbody>
        </table>
        <a href="home.php"><button type="submit" class="btn btn-primary">Back</button></a>

    </div>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>