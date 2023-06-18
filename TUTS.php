<!-- CRUD 2 Table -->

CREATE TABLE produk (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    stok INT(6) NOT NULL,
    harga DECIMAL(10, 2) NOT NULL
);

CREATE TABLE transaksi (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_produk INT(6) UNSIGNED,
    tanggal DATE NOT NULL,
    jumlah INT(6) NOT NULL,
    FOREIGN KEY (id_produk) REFERENCES produk(id) ON DELETE CASCADE
);

<?php
$servername = "localhost";
$username = "nama_pengguna";
$password = "kata_sandi";
$database = "nama_database";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi Inventory</title>
</head>
<body>
    <h1>Aplikasi Inventory</h1>
    <?php include 'aksi.php'; ?>

    <h2>Daftar Produk</h2>
    <!-- Tampilkan produk -->
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($produk)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['stok']; ?></td>
                <td><?php echo $row['harga']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="aksi.php?action=hapus_produk&id=<?php echo $row['id']; ?>">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h2>Tambah Produk</h2>
    <!-- Form tambah produk -->
    <form action="aksi.php?action=tambah_produk" method="POST">
        <label>Nama:</label>
        <input type="text" name="nama" required>
        <br>
        <label>Stok:</label>
        <input type="number" name="stok" required>
        <br>
        <label>Harga:</label>
        <input type="number" name="harga" step="0.01" required>
        <br>
        <input type="submit" value="Tambah Produk">
    </form>

    <h2>Transaksi</h2>
    <!-- Form transaksi -->
    <form action="aksi.php?action=tambah_transaksi" method="POST">
        <label>Produk:</label>
        <select name="id_produk" required>
            <?php while ($row = mysqli_fetch_assoc($produk)) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['nama']; ?></option>
            <?php } ?>
        </select>
        <br>
        <label>Tanggal:</label>
        <input type="date" name="tanggal" required>
        <br>
        <label>Jumlah:</label>
        <input type="number" name="jumlah" required>
        <br>
        <input type="submit" value="Tambah Transaksi">
    </form>
</body>
</html>


<?php
include 'koneksi.php';

// Operasi
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_GET['action'] === 'tambah_produk') {
        // Tambah produk
        $nama = $_POST['nama'];
        $stok = $_POST['stok'];
        $harga = $_POST['harga'];
        $sql = "INSERT INTO produk (nama, stok, harga) VALUES ('$nama', '$stok', '$harga')";

        if ($conn->query($sql) === true) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($_GET['action'] === 'tambah_transaksi') {
        // Tambah transaksi
        $id_produk = $_POST['id_produk'];
        $tanggal = $_POST['tanggal'];
        $jumlah = $_POST['jumlah'];
        $sql = "INSERT INTO transaksi (id_produk, tanggal, jumlah) VALUES ('$id_produk', '$tanggal', '$jumlah')";

        if ($conn->query($sql) === true) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Ambil data produk
$sql = "SELECT * FROM produk";
$produk = $conn->query($sql);

// Hapus produk
if ($_GET['action'] === 'hapus_produk') {
    $id = $_GET['id'];
    $sql = "DELETE FROM produk WHERE id = '$id'";

    if ($conn->query($sql) === true) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>




<!-- CRUD 3 TABLE -->

CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    posisi VARCHAR(255) NOT NULL,
    divisi VARCHAR(255) NOT NULL,
);

CREATE TABLE produk (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    kategori VARCHAR(255) NOT NULL,
    brand VARCHAR(255) NOT NULL,
    spesifikasi VARCHAR(255) NOT NULL,
    warna VARCHAR(255) NOT NULL,
    sn VARCHAR(255) NOT NULL
);

CREATE TABLE transaksi (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_user_serah INT(6) UNSIGNED,
    id_user_terima INT(6) UNSIGNED,
    deskripsi VARCHAR(255) NOT NULL,
    tanggal DATE NOT NULL,
    jumlah INT(6) UNSIGNED,
    FOREIGN KEY (id_user_serah) REFERENCES users(id),
    FOREIGN KEY (id_user_terima) REFERENCES users(id)
);

<!-- CONNECTION  -->
<?php
$servername = "localhost";
$username = "nama_pengguna";
$password = "kata_sandi";
$database = "nama_database";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

<!-- INDEX -->
<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi Inventory</title>
</head>
<body>
    <h1>Aplikasi Inventory</h1>
    <?php include 'aksi.php'; ?>

    <h2>Daftar Produk</h2>
    <!-- Tampilkan produk -->
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($produk)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['stok']; ?></td>
                <td><?php echo $row['harga']; ?></td>
                <td>
                    <a href="edit_produk.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="aksi.php?action=hapus_produk&id=<?php echo $row['id']; ?>">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h2>Tambah Produk</h2>
    <!-- Form tambah produk -->
    <form action="aksi.php?action=tambah_produk" method="POST">
        <label>Nama:</label>
        <input type="text" name="nama" required>
        <br>
        <label>Stok:</label>
        <input type="number" name="stok" required>
        <br>
        <label>Harga:</label>
        <input type="number" name="harga" step="0.01" required>
        <br>
        <input type="submit" value="Tambah Produk">
    </form>

    <h2>Daftar Pengguna</h2>
    <!-- Tampilkan pengguna -->
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($users)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <a href="edit_pengguna.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="aksi.php?action=hapus_pengguna&id=<?php echo $row['id']; ?>">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h2>Tambah Pengguna</h2>
    <!-- Form tambah pengguna -->
    <form action="aksi.php?action=tambah_pengguna" method="POST">
        <label>Username:</label>
        <input type="text" name="username" required>
        <br>
        <label>Email:</label>
        <input type="email" name="email" required>
        <br>
        <input type="submit" value="Tambah Pengguna">
    </form>

    <h2>Transaksi</h2>
    <!-- Form transaksi -->
    <form action="aksi.php?action=tambah_transaksi" method="POST">
        <label>Pengguna:</label>
        <select name="id_user" required>
            <?php while ($row = mysqli_fetch_assoc($users)) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['username']; ?></option>
            <?php } ?>
        </select>
        <br>
        <label>Produk:</label>
        <select name="id_produk" required>
            <?php while ($row = mysqli_fetch_assoc($produk)) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['nama']; ?></option>
            <?php } ?>
        </select>
        <br>
        <label>Tanggal:</label>
        <input type="date" name="tanggal" required>
        <br>
        <label>Jumlah:</label>
        <input type="number" name="jumlah" required>
        <br>
        <input type="submit" value="Tambah Transaksi">
    </form>
</body>
</html>



<!-- ACTION  -->
<?php
include 'koneksi.php';

// Operasi
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_GET['action'] === 'tambah_produk') {
        // Tambah produk
        $nama = $_POST['nama'];
        $stok = $_POST['stok'];
        $harga = $_POST['harga'];
        $sql = "INSERT INTO produk (nama, stok, harga) VALUES ('$nama', '$stok', '$harga')";

        if ($conn->query($sql) === true) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($_GET['action'] === 'tambah_pengguna') {
        // Tambah pengguna
        $username = $_POST['username'];
        $email = $_POST['email'];
        $sql = "INSERT INTO users (username, email) VALUES ('$username', '$email')";

        if ($conn->query($sql) === true) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($_GET['action'] === 'tambah_transaksi') {
        // Tambah transaksi
        $id_produk = $_POST['id_produk'];
        $id_user = $_POST['id_user'];
        $tanggal = $_POST['tanggal'];
        $jumlah = $_POST['jumlah'];
        $sql = "INSERT INTO transaksi (id_produk, id_user, tanggal, jumlah) VALUES ('$id_produk', '$id_user', '$tanggal', '$jumlah')";

        if ($conn->query($sql) === true) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Ambil data produk
$sql = "SELECT * FROM produk";
$produk = $conn->query($sql);

// Ambil data pengguna
$sql = "SELECT * FROM users";
$users = $conn->query($sql);

// Hapus produk
if ($_GET['action'] === 'hapus_produk') {
    $id = $_GET['id'];
    $sql = "DELETE FROM produk WHERE id = '$id'";

    if ($conn->query($sql) === true) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Hapus pengguna
if ($_GET['action'] === 'hapus_pengguna') {
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id = '$id'";

    if ($conn->query($sql) === true) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>



Untuk membuat history data dengan PHP dan MySQL, Anda perlu melakukan beberapa langkah berikut:

1. Buat tabel "history" di MySQL:
CREATE TABLE history (
  id INT AUTO_INCREMENT PRIMARY KEY,
  timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  data_id INT,
  action VARCHAR(50),
  old_value TEXT,
  new_value TEXT,
  FOREIGN KEY (data_id) REFERENCES data(id)
);

Pada contoh di atas, kita membuat tabel "history" dengan kolom-kolom berikut:

id: Kolom untuk ID unik setiap entri dalam tabel history.
timestamp: Kolom untuk menyimpan waktu ketika perubahan dilakukan.
data_id: Kolom untuk menghubungkan entri dalam tabel history dengan entri dalam tabel "data" yang berhubungan.
action: Kolom untuk menyimpan tindakan atau jenis perubahan yang terjadi.
old_value: Kolom untuk menyimpan nilai lama dari data yang diubah.
new_value: Kolom untuk menyimpan nilai baru dari data yang diubah.
Pastikan untuk menyesuaikan struktur tabel "history" dengan kebutuhan Anda, termasuk penyesuaian relasi dengan tabel lain jika diperlukan.


2. Di dalam skrip PHP, setelah perubahan data dilakukan, lakukan langkah berikut untuk mencatat perubahan dalam tabel "history":
Ambil nilai lama dan baru dari data yang diubah.
Sisipkan entri baru ke dalam tabel "history" dengan informasi perubahan tersebut.
Berikut adalah contoh fungsi untuk mencatat perubahan dalam tabel "history":
<?
function recordHistory($dataId, $action, $oldValue, $newValue) {
  global $conn;

  $dataId = $conn->real_escape_string($dataId);
  $action = $conn->real_escape_string($action);
  $oldValue = $conn->real_escape_string($oldValue);
  $newValue = $conn->real_escape_string($newValue);

  $sql = "INSERT INTO history (data_id, action, old_value, new_value) VALUES ('$dataId', '$action', '$oldValue', '$newValue')";

  if ($conn->query($sql) === TRUE) {
    echo "Perubahan berhasil dicatat dalam history.";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>

3. Setelah Anda melakukan perubahan data, panggil fungsi recordHistory() untuk mencatat perubahan tersebut:
<?php
$dataId = 1; // ID data yang diubah
$action = "Update"; // Tindakan yang dilakukan (misalnya, "Update", "Insert", "Delete")
$oldValue = "Nilai Lama"; // Nilai lama dari data yang diubah
$newValue = "Nilai Baru"; // Nilai baru dari data yang diubah

recordHistory($dataId, $action, $oldValue, $newValue);
?>

Dalam contoh di atas, kita memanggil fungsi recordHistory() dengan parameter yang sesuai untuk mencatat perubahan pada data dengan ID 1. Anda dapat memanggil fungsi ini setiap kali ada perubahan yang perlu dicatat dalam tabel "history".
Pastikan untuk mengganti nilai $servername, $username, $password, dan $dbname sesuai dengan informasi koneksi database MySQL Anda.
Dengan langkah-langkah di atas, Anda dapat membuat history data menggunakan PHP dan MySQL. Pastikan untuk mengatur pemanggilan fungsi recordHistory() dengan benar setiap kali ada perubahan data yang perlu dicatat.

