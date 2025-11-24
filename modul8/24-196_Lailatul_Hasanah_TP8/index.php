<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
}

$level = $_SESSION['level'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .navbar {
            background: #ff7fd6ff;
            padding: 20px;
            font-size: 20px;
            color: white;
            display: flex;
            justify-content: space-between;
        }
        .menu a {
            margin-right: 15px;
            color: white;
            text-decoration: none;
        }
        .kotak {
            background: #a3006cff;
            padding: 5px;
            border-radius: 15px;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="menu">
        <a href="index.php">Home</a>

        <?php if($level == 1){ ?>
            <a href="data_master.php">Data Master</a>
        <?php } ?>

        <a href="transaksi.php">Transaksi</a>
        <a href="laporan.php">Laporan</a>
    </div>

    <div class="kotak">
        <?= $_SESSION['username']; ?> |
        <a href="logout.php" style="color:yellow">Logout</a>
    </div>
</div>

<?php if (basename($_SERVER['PHP_SELF']) == 'index.php'): ?>
    <h2 style="margin-left: 20px;">Selamat datang, <?= $_SESSION['nama']; ?></h2>
<?php endif; ?>

</body>
</html>