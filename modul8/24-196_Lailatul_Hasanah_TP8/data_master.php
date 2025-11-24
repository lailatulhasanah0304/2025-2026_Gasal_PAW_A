<?php
require 'koneksiDB.php';
include 'index.php'; 

// ambil data dari tabel supplier
$query = "SELECT * FROM supplier";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Supplier</title>
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
            max-width: 1399px; /* BATAS LEBAR TABEL */
            margin: 0 auto;   /* BIAR TABEL DI TENGAH */
            padding: 10px;    /* JARAK DARI TEPI */
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
    <h2>Data Master Supplier</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Supplier</th>
            <th>Telepon</th>
            <th>Alamat</th>
        </tr>

        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>$no</td>
                    <td>{$row['nama']}</td>
                    <td>{$row['telp']}</td>
                    <td>{$row['alamat']}</td>
                  </tr>";
            $no++;
        }
        ?>
    </table>
</body>
</html>