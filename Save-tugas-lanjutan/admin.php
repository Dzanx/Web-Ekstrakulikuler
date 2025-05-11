<?php
session_start();                                    // Mulai session
// Proteksi: hanya admin yang boleh lihat
if(!isset($_SESSION['admin'])) {
    header("Location: admin-login.php");
    exit;
}

include "config.php";                               // Koneksi DB

// Jalankan query JOIN
$sql = "
SELECT p.id_pendaftaran, s.nis, s.nama_siswa,
       e.nama_ekskul, p.tanggal_daftar, p.status, p.keterangan
FROM pendaftaran_ekskul p
JOIN siswa s ON p.id_siswa = s.id_siswa
JOIN ekstrakurikuler e ON p.id_ekskul = e.id_ekskul
ORDER BY p.tanggal_daftar DESC
";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="styles/stlye.css">
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
    </header>
    <main>
        <h2>Menu Admin</h2>
        <ul>
            <li><a href="admin.php">Dashboard</a></li>
            <li><a href="admin-siswa.php">Data Siswa</a></li>
            <li><a href="admin-ekskul.php">Data Ekstrakurikuler</a></li>
            <li><a href="list-pendaftaran.php">Kelola Pendaftaran</a></li>
            <li><a href="index.html">Logout</a></li>
        </ul>

        <h3>Statistik</h3>
       
        <h3>Pendaftaran Terbaru</h3>
        <table>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Ekstrakurikuler</th>
                <th>Tanggal Daftar</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
            <?php
    if($result && $result->num_rows > 0){
        $no = 1;
        while($row = $result->fetch_assoc()){        // fetch_assoc untuk tiap baris :contentReference[oaicite:2]{index=2}
            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>{$row['nis']}</td>";
            echo "<td>{$row['nama_siswa']}</td>";
            echo "<td>{$row['nama_ekskul']}</td>";
            echo "<td>{$row['tanggal_daftar']}</td>";
            echo "<td>{$row['status']}</td>";
            echo "<td>{$row['keterangan']}</td>";
            echo "</tr>";
            $no++;
        }
    } else {
        echo "<tr><td colspan='7'>Belum ada data pendaftaran.</td></tr>";
    }
    ?>
        </table>
    </main>
</body>
</html>
