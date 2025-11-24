<?php
session_start();
include 'koneksiDB.php';

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $query = mysqli_query($conn, 
        "SELECT * FROM user WHERE username='$username' AND password='$password'"
    );

    $cek = mysqli_fetch_assoc($query);

    if ($cek) {
        $_SESSION['username'] = $cek['username'];
        $_SESSION['level']    = $cek['level'];
        header("location:index.php");
        exit;
    } else {
        echo "<script>alert('Username atau Password salah'); window.location.href='login.php';</script>";
    }

} else {
    echo "<script>alert('Akses ditolak'); window.location.href='login.php';</script>";
}
?>