<?php
$servername = "localhost";
$username = "root"; // Default username Laragon
$password = ""; // Default password kosong
$dbname = "ecommerce_simple";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
