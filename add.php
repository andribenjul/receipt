<?php

    require 'Function.php';
    // require 'Autoload.php';

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>RECEIPT - Transactions</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/navbar-static/">

    

    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <link href="navbar-top.css" rel="stylesheet">

    <script src="assets/dist/js/jquery-3.7.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  </head>
  <body>
    
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Tanda Terima</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Transactions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="user/index.php">User</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="produk/index.php">Product</a>
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
<div class="bd-example">
        <form action="Function.php?action=tambah_transaksi" method="POST">
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Product Name</label>
            <!-- <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="" required> -->
            <select class="selectProduk form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="nama_produk">
            <?php while ($row = mysqli_fetch_assoc($products)) : ?>
            <option value="<?= $row['id']; ?>"><?= $row['nama']; ?> | <?= $row['warna']; ?> | <?= $row['sn']; ?></option>
            <?php endwhile; ?>
          </select>
          </div>
          <div class="row">
            <div class="col-md-6">
            <label for="user_serah" class="form-label">Receive From</label>
            <!-- <input type="text" class="form-control" id="user_serah" name="user_serah" required> -->
            <select class="selectUserSerah form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="user_serah" id="user_serah">
            <?php while ($row = mysqli_fetch_assoc($users)) : ?>
            <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
            <?php endwhile; ?>
          </select>
          </div>
          <div class="col-md-6">
            <label for="user_terima" class="form-label">Recipient</label>
            <!-- <input type="text" class="form-control" id="user_serah" name="user_serah" required> -->
            <select class="selectUserTerima form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="user_terima" id="user_terima">
            <?php while ($row = mysqli_fetch_assoc($userTerima)) : ?>
            <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
            <?php endwhile; ?>
          </select>
          </div>     
        </div>
          <br>
        <div class="row">
          <div class="col-md-12">
            <label for="remarks" class="form-label">Remarks</label>
            <!-- <input type="text" class="form-control" id="divisi" name="remarks" required> -->
            <textarea class="form-control" name="remarks" id="remarks" rows="3"></textarea>
          </div>
          <div class="col-md-6">
            <label for="remarks" class="form-label">Quantity</label>
            <input type="text" class="form-control" id="remarks" name="quantity" required>
          </div>
          <div class="col-md-6">
            <label for="tanggal" class="form-label">Date</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
          </div>
          </div>
          <br>
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
        </div>

</main>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('.selectProduk').select2({});
        $('.selectUserSerah').select2({});
        $('.selectUserTerima').select2({});
      });
        
    </script>
  </body>
</html>
