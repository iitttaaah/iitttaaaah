<?php
// Aktifkan session
session_start();

// Panggil koneksi database
include "koneksi.php";

// Ambil data dari form dan lakukan sanitasi
@$pass = ($_POST['password']);
$username = mysqli_escape_string($koneksi, $_POST['Username']);
$password = mysqli_escape_string($koneksi, $pass);

// Lakukan query untuk mencari user yang sesuai
$login = mysqli_query($koneksi, "SELECT * FROM tuser WHERE username = '$username' and password = '$password' and status = 'aktif'");
$data = mysqli_fetch_array($login);

// Uji jika username dan password sesuai
if ($data) {
    // Simpan data user di session
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['Password'] = $data['Password'];
    $_SESSION['nama_pengguna'] = $data['nama_pengguna'];

    // Arahkan ke halaman admin
    header('location: admin.php');
} else {
    // Tampilkan pesan kesalahan jika login gagal
    echo "<script>
        alert('Maaf, Login Gagal. Pastikan Username dan password Anda Benar...!');
        document.location='index.php';
        </script>";
}
?>
