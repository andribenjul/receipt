<?php

$servername = "sql209.infinityfree.com";
$username = "if0_34398411";
$password = "W17FB8lsByW04";
$database = "if0_34398411_crudPHP";

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}