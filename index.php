<?php

    require 'Function.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>RECEIPT - Transaction</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/navbar-static/">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    

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
          <a class="nav-link active" aria-current="page" href="index.php">Transaction</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="user/index.php">User</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="produk/index.php">Product</a>
        </li>
      </ul>
      <form class="d-flex" action="" method="POST">
        <input type="text" name="keyword" class="form-control me-2" placeholder="Search Data" aria-label="Search">
        <button class="btn btn-outline-primary" type="submit" name="search">Search</button>
      </form>
    </div>
  </div>
</nav>

<main class="container">
<div class="mb-5">
      <a href="add.php" class="btn btn-primary btn-lg px-4">Add Transaction</a>
    </div>

        <table id="transactionsTable" class="display">
          <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Product Name</th>
            <th scope="col">Receive From</th>
            <th scope="col">Recipient</th>
            <th scope="col">Remarks</th>
            <th scope="col">Quantity</th>
            <th scope="col">Date</th>
          </tr>
          </thead>
          <tbody>
          <?php if ($transactions->num_rows === 0) : ?>
                <tr>
                    <td colspan="7">No data found.</td>
                </tr>
            <?php else : ?>
            <?php $i = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($transactions)) : ?>
          <tr>
            <th scope="row"><?= $i++; ?></th>
            <td>
              <a href="produk/view.php?=<?= $row['produk_id'] ?>">
                    <?= $row['produk_nama']; ?>  | <?= $row['produk_sn']; ?>
              </a>
            </td>
            <td><?= $row['serah_nama']; ?></td>
            <td><?= $row['terima_nama']; ?></td>
            <td><?= $row['keterangan']; ?></td>
            <td><?= $row['kuantiti']; ?></td>
            <td><?= (new DateTime($row['tanggal']))->format('d F Y'); ?></td>
          </tr>
          <?php endwhile; ?>
          <?php endif; ?>
          </tbody>
        </table>
        


</main>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#transactionsTable').DataTable();
        });
    </script>
  </body>
</html>
