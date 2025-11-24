<?php
require 'koneksiDB.php';
include 'index.php'; 

$query = "SELECT * FROM transaksi ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Transaksi</title>
    <style>
        body {
            font-family: Arial;
            text-align: center;
        }
        h2 {
            color: #ff22f4ff;
            margin-left: 7px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 1399px; 
            margin: 0 auto;   
            padding: 10px;   
        }
        th, td {
            border: 1px solid;
            padding: 10px;
            background-color: #fedff4ff;
        }
        th {
            background-color: #fdade4ff;
        }
        .kotak {
            padding: 2px 5px;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
        }
        .kotak-edit {
            background-color: #e96310ff; 
        }
        .kotak-hapus {
            background-color: #d40f0fff; 
        }
    </style>
</head>
<body>
    <h2>Data Transaksi </h2>
    <table>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Total</th>
            <th>Pelanggan ID</th>
        </tr>

        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>$no</td>
                    <td>{$row['waktu_transaksi']}</td>
                    <td>{$row['keterangan']}</td>
                    <td>Rp " . number_format($row['total'], 0, ',', '.') . "</td>
                    <td>{$row['pelanggan_id']}</td>
                </tr>";
            $no++;
        }
        ?>
    </table>
</body>
</html>