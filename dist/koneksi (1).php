<?php
$host = "localhost";
$user = "swis7914_sales_inventory";     // Ganti ini
$pass = "Taecyeon123";             // Ganti ini
$db   = "swis7914_sales_inventory";   // Ganti ini

$koneksi = new mysqli($host, $user, $pass, $db);
if ($koneksi->connect_error) {
    die("Koneksi Gagal: " . $koneksi->connect_error);
}
?>
