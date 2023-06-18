<?php

    require '../Function.php';

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>RECEIPT - Produk</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/navbar-static/">

    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="../navbar-top.css" rel="stylesheet">
  </head>
  <body>
    
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">RECEIPT</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="../index.php">Transaction</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../user/index.php">User</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  active" href="#">Product</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<main class="container">
<div class="mb-5">
      <a href="add.php" class="btn btn-primary btn-lg px-4">Tambah Produk</a>
    </div>

    <div class="bd-example">
        <table class="table table-striped">
          <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama</th>
            <th scope="col">Kategori</th>
            <th scope="col">Brand</th>
            <th scope="col">Spesifikasi</th>
            <th scope="col">Warna</th>
            <th scope="col">SN</th>
            <th scope="col">Remarks</th>
          </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($products)) : ?>
          <tr>
            <th scope="row"><?= $i++; ?></th>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['kategori']; ?></td>
            <td><?= $row['brand']; ?></td>
            <td><?= $row['spesifikasi']; ?></td>
            <td><?= $row['warna']; ?></td>
            <td><?= $row['sn']; ?></td>
            <td><?= $row['remarks']; ?></td>
          </tr>
          <?php endwhile; ?>
          </tbody>
        </table>
        </div>


</main>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
