<?php
session_start();                                    // Mulai session :contentReference[oaicite:1]{index=1}
// Proteksi: hanya admin yang boleh lihat
if(!isset($_SESSION['admin'])) {
    header("Location: admin-login.php");
    exit;
}

include "config.php";                               // Koneksi DB

// Jalankan query JOIN
$sql = "
SELECT p.id_pendaftaran, s.nis, s.nama_siswa,s.kelas,
       e.nama_ekskul, p.tanggal_daftar, p.status, p.keterangan
FROM pendaftaran_ekskul p
JOIN siswa s ON p.id_siswa = s.id_siswa
JOIN ekstrakurikuler e ON p.id_ekskul = e.id_ekskul
ORDER BY p.tanggal_daftar DESC
";
$result = $conn->query($sql);

?>

<DOCTYPE html>
    <html>
        <head>
            <title>Data Siswa</title>
            <link rel="stylesheet" href="styles/stlye.css">
        </head>
        <body>
            <h1>Data Siswa</h1>
            <table border="1">
                <tr>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
                <?php while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['nis']; ?></td>
                        <td><?php echo $row['nama_siswa']; ?></td>
                        <td><?php echo $row['kelas']; ?></td>
                        <td>
                            <a href="edit-siswa.php?id=<?php echo $row['id_pendaftaran']; ?>">Edit</a>
                            <a href="hapus-siswa.php?id=<?php echo $row['id_pendaftaran']; ?>">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <button><a href="admin.php">Kembali Ke Dashboard</a></button>
        </body>
    </html>