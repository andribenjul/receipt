<?php

$servername = "sql209.infinityfree.com";
$username = "if0_34398411";
$password = "W17FB8lsByW04";
$database = "if0_34398411_crudPHP";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data user
    $sql = "SELECT * FROM users";
    $users = $conn->query($sql);
    $userTerima = $conn->query($sql);

// Ambil data produk
    $sql = "SELECT * FROM produk";
    $products = $conn->query($sql);

// Ambil data transaksi
    $sql = "SELECT u_serah.nama AS serah_nama,
                    u_terima.nama AS terima_nama,
                    p.id AS produk_id,
                    p.nama AS produk_nama, p.sn AS produk_sn,
                    t.tanggal, t.kuantiti, t.keterangan FROM transaksi t
                    JOIN users u_serah ON t.id_user_serah = u_serah.id
                    JOIN users u_terima ON t.id_user_terima = u_terima.id
                    JOIN produk p ON t.id_produk = p.id ORDER BY t.tanggal DESC";
    $transactions = $conn->query($sql);

    // Handle search functionality
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["search"])) {
        // Get the keyword from the form input
        $keyword = $_POST["keyword"];

        // Construct the SQL query
        $sql = "SELECT u_serah.nama AS serah_nama,
                        u_terima.nama AS terima_nama,
                        p.id AS produk_id,
                        p.nama AS produk_nama, p.sn AS produk_sn,
                        t.tanggal, t.kuantiti, t.keterangan FROM transaksi t
                        JOIN users u_serah ON t.id_user_serah = u_serah.id
                        JOIN users u_terima ON t.id_user_terima = u_terima.id
                        JOIN produk p ON t.id_produk = p.id";

        // Modify the SQL query to include a WHERE clause for filtering
        $sql .= " WHERE p.nama LIKE '%$keyword%' OR p.sn LIKE '%$keyword%' OR u_serah.nama LIKE '%$keyword%' OR u_terima.nama LIKE '%$keyword%' OR t.keterangan LIKE '%$keyword%'";
        
        // Execute the updated query
        $transactions = $conn->query($sql);
    }


// PROSES INPUT
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'tambah_user') {
            // Tambah pengguna
            $nama = $_POST['nama'];
            $posisi = $_POST['posisi'];
            $divisi = $_POST['divisi'];
            $remarks = $_POST['remarks'];

            $sql = "INSERT INTO users (nama, posisi, divisi, remarks) VALUES ('$nama', '$posisi', '$divisi', '$remarks')";

            if ($conn->query($sql) === true) {
                header("Location: user/index.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } elseif ($_GET['action'] === 'tambah_produk') {
            // Tambah produk
            $nama = $_POST['nama'];
            $kategori = $_POST['kategori'];
            $brand = $_POST['brand'];
            $spesifikasi = $_POST['spesifikasi'];
            $warna = $_POST['warna'];
            $sn = $_POST['sn'];
            $remarks = $_POST['remarks'];

            $sql = "INSERT INTO produk (nama, kategori, brand, spesifikasi, warna, sn, remarks) VALUES ('$nama', '$kategori', '$brand', '$spesifikasi', '$warna', '$sn', '$remarks')";

            if ($conn->query($sql) === true) {
                header("Location: produk/index.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } elseif ($_GET['action'] === 'tambah_transaksi') {
            // Tambah transaksi
            $namaProduk = $_POST['nama_produk'];
            $userSerah = $_POST['user_serah'];
            $userTerima = $_POST['user_terima'];
            $remarks = $_POST['remarks'];
            $quantity = $_POST['quantity'];
            $date = $_POST['tanggal'];

            $sql = "INSERT INTO transaksi (id_produk, id_user_serah, id_user_terima, keterangan, kuantiti, tanggal)
                    VALUES ('$namaProduk', '$userSerah', '$userTerima', '$remarks', '$quantity', '$date')";

            if ($conn->query($sql) === true) {
                header("Location: index.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } 
    }
} // endif $_SERVER

    


?>