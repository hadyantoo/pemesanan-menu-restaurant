<?php
session_start();
if ($_SESSION['id'] == 0) : header('location:index.php');
endif;
$id = $_SESSION['id'];

require_once('koneksi.php');
require_once('fungsi.php');

$objek = new crud;
$user = new login;
$no = 1;

$profil = $user->cariId($id);
$data = mysqli_fetch_array($profil); // mencari nama dari user setelah login
?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-success-subtle">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#"><?= $data['username']; ?></a>
            <form action="login.php" method="post">
                <div class="navbar-nav">
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                        <ul class="navbar-nav mb-2 mb-lg-0 d-flex">

                            <li class="nav-item">
                                <a class="nav-link mx-2" href="pesanan.php?id=<?= $id; ?>">Pesanan</a>
                            </li>
                            <li class="nav-item">
                                <button class="btn btn-primary" type="submit" name="logout">Logout</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </nav>

    <figure class="text-center mt-4">
        <blockquote class="blockquote">
            <h3>DAFTAR MENU</h3>
        </blockquote>
        <figcaption class="blockquote-footer">
            Restaurant Family Frendly
        </figcaption>
    </figure>


    <div class="container text-center">
        <div class="row row-cols-5">

            <?php
            $makanan = $objek->tampilmenu('makanan');
            while ($row = $makanan->fetch_array()) :
            ?>
                <div class="col">
                    <div class="card" style="width: 12rem;">
                        <img src="img/<?= $row['foto'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['nama']; ?></h5>
                            <p class="card-text">Rp.<?= $row['harga']; ?></p>
                            <a href="pesan.php?id=<?= $row['id']; ?>" class="btn btn-primary">Pesan</a>
                        </div>
                    </div>
                </div>
            <?php $no++;
            endwhile;
            $no = 1; ?>
        </div>
    </div>


    <div class="container text-center mt-4">
        <div class="row row-cols-5">

            <?php
            $makanan = $objek->tampilmenu('minuman');
            while ($row = $makanan->fetch_array()) :
            ?>
                <div class="col">
                    <div class="card" style="width: 12rem;">
                        <img src="img/<?= $row['foto'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['nama']; ?></h5>
                            <p class="card-text">Rp.<?= $row['harga']; ?></p>
                            <a href="pesan.php?id=<?= $row['id']; ?>" class="btn btn-primary">Pesan</a>
                        </div>
                    </div>
                </div>
            <?php $no++;
            endwhile;
            $no = 1; ?>
        </div>
    </div>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>