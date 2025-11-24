<?php
session_start();
require 'koneksiDB.php';

if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $query = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        if($password == md5($row['password'])){
            $_SESSION['username']=$row['username'];
            $_SESSION['nama'] = $row['nama']; 
            $_SESSION['login']=true;
            $_SESSION['level']=$row['level'];
            $_SESSION['id_user']=$row['id_user'];
            echo "<script>alert('login berhasil selamat datang ". $row['nama'] ."'); window.location.href='index.php';</script>";
        }else{
            echo "<script>alert('Password salah'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan'); window.location.href='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-box {
            background: white;
            width: 350px;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="password"] {
            width: 92%;
            padding: 12px;
            margin: 8px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: 0.2s;
        }

        input[type="text"]:focus, 
        input[type="password"]:focus {
            border-color: #5b9bd5;
            box-shadow: 0 0 5px rgba(91,155,213,0.5);
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background: #5b9bd5;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.2s;
        }

        input[type="submit"]:hover {
            background: #4a89c7;
        }

    </style>
</head>

<body>

<div class="login-box">
    <h3>Login</h3>

    <form action="" method="post">
        <input type="text" name="username" placeholder="username" required>
        <input type="password" name="password" placeholder="password" required>
        <input type="submit" name="submit" value="Login">
    </form>
</div>

</body>
</html>