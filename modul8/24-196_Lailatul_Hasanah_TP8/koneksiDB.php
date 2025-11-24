<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "penjualan";

$conn = mysqli_connect($hostname, $username, $password, $database);

if ($conn) {
    // echo "koneksi sukses";   
}else{
    echo "Koneksi gagal: " . mysqli_connect_error();
}

?>