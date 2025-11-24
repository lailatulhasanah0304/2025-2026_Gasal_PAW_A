<?php
require "koneksiDB.php";

// Ambil tanggal
$from = $_GET['from'] ?? '';
$to   = $_GET['to'] ?? '';

// Query data harian
$query = "SELECT waktu_transaksi, SUM(total) AS total_harian 
          FROM transaksi 
          WHERE waktu_transaksi BETWEEN '$from' AND '$to' 
          GROUP BY waktu_transaksi 
          ORDER BY waktu_transaksi ASC";

$execute = mysqli_query($conn, $query);
$result = mysqli_fetch_all($execute, MYSQLI_ASSOC);

// Siapkan data chart
$tanggal = array_column($result, 'waktu_transaksi');
$total_harga = array_column($result, 'total_harian');

// Query ringkasan data
$totalQuery = "SELECT COUNT(DISTINCT pelanggan_id) AS total_pelanggan, SUM(total) AS total_pendapatan
               FROM transaksi 
               WHERE waktu_transaksi BETWEEN '$from' AND '$to'";

$execTotal = mysqli_query($conn, $totalQuery);
$summary = mysqli_fetch_assoc($execTotal);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <style>
        body { 
            font-family: Arial;
            margin: 0;                /* penting biar navbar full */
            padding-top: 70px;        /* biar konten tidak ketutupan navbar */
        }

        .container {
            margin: auto;
            padding: 20px;
        }

        .card { 
            border: 1px solid #ddd; 
            padding: 20px; 
            border-radius: 8px; 
            width: 420px; 
            margin-bottom: 25px;
            background: #fee6f8ff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th {
            background: #fccbf9ff;
            padding: 10px;
            border: 1px solid #aaa;
            text-align: left;
        }

        td {
            padding: 8px;
            border: 1px solid #aaa;
        }

        .total-box {
            margin-top: 25px;
            width: 350px;
            padding: 15px;
            background: #f9ddf5ff;
            border: 1px solid #f8cff8ff;
            border-radius: 8px;
        }

        .btn {
            padding: 8px 12px;
            background: #e17110;
            border-radius: 10px;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-right: 8px;
        }

        .btn:hover {
            opacity: .85;
        }

        canvas {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <?php include 'index.php'; ?>

    <div class="container">

        <!-- FILTER CARD -->
        <div class="card">
            <form method="GET" action="laporan.php">
                <input type="date" name="from" value="<?= $_GET['from'] ?? '' ?>" required>
                <input type="date" name="to" value="<?= $_GET['to'] ?? '' ?>" required>
                <button type="submit" style="background: #df55b1ff">Tampilkan</button>
            </form>
        </div>

        <h2>Rekap Laporan Penjualan</h2>
        <h3><?= date("Y-m-d", strtotime($from)) ?> sampai <?= date("Y-m-d", strtotime($to)) ?></h3>

        <!-- Tombol aksi -->
        <button onclick="window.print()" class="btn">🖨️ Cetak</button>
        <button onclick="window.location='export_excel.php'" class="btn">🖨️ Excel</button>

        <!-- Chart -->
        <canvas id="chart" style="max-width:800px;"></canvas>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            new Chart("chart", {
                type: "bar",
                data: {
                    labels: <?= json_encode($tanggal) ?>,
                    datasets: [{
                        label: 'Total',
                        data: <?= json_encode($total_harga) ?>,
                        backgroundColor: 'rgba(249, 69, 204, 0.4)',
                        borderColor: 'gray',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: { y: { beginAtZero: true } }
                }
            });
        </script>

        <!-- Tabel Laporan -->
        <table>
            <tr>
                <th>No</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>

            <?php 
            $no = 1;
            foreach ($result as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>Rp <?= number_format($row['total_harian'], 0, ',', '.') ?></td>
                    <td><?= date("d M Y", strtotime($row['waktu_transaksi'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Summary Box -->
        <div class="total-box">
            <table>
                <tr>
                    <th>Jumlah Pelanggan</th>
                    <th>Jumlah Pendapatan</th>
                </tr>
                <tr>
                    <td><h3><?= $summary['total_pelanggan'] ?> Orang</h3></td>
                    <td><h3>Rp <?= number_format($summary['total_pendapatan'], 0, ',', '.') ?></h3></td>
                </tr>
            </table>
        </div>

    </div> <!-- end container -->

</body>
</html>