<?php
include "config.php";

// Ambil SEMUA field dari tabel ekstrakurikuler
$sql = "SELECT * FROM ekstrakurikuler ORDER BY nama_ekskul";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Ekstrakurikuler</title>
    <link rel="stylesheet" href="styles/stlye.css">
</head>
<body>
    <h1>Data Ekstrakurikuler</h1>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama Ekskul</th>
            <th>Deskripsi</th>
            <th>Pembina</th>
            <th>Hari Kegiatan</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>
            <th>Lokasi</th>
            <th>Kuota</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $row["nama_ekskul"] . "</td>";
                echo "<td>" . $row["deskripsi"] . "</td>";
                echo "<td>" . $row["pembina"] . "</td>";
                echo "<td>" . $row["hari_kegiatan"] . "</td>";
                echo "<td>" . $row["jam_mulai"] . "</td>";
                echo "<td>" . $row["jam_selesai"] . "</td>";
                echo "<td>" . $row["lokasi"] . "</td>";
                echo "<td>" . $row["kuota"] . "</td>";
                echo "</tr>";
                $no++;
            }
        } else {
            echo "<tr><td colspan='9'>Tidak ada data ekskul.</td></tr>";
        }
        ?>
    </table>
    <p><a href="admin.php">← Kembali ke Dashboard</a></p>
</body>
</html>