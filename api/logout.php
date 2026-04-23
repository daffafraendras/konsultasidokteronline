<?php
session_start();
session_destroy(); // Menghapus semua sesi login
header("Location: index.php"); // Kembali ke depan
exit;
?>