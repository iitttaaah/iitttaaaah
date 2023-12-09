<?php
// session start
session_start();

// hilangkan session yang sudah di set
unset($_SESSION['id_user']);
unset($_SESSION['password']);
unset($_SESSION['username']);
unset($_SESSION['nama_pengguna']);

session_destroy();
  echo "<script>
        alert('Anda telah keluar dari halaman');
        document.location='index.php';
        </script>";



?>