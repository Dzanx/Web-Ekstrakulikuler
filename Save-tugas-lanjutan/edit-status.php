<?php
session_start();                                    // Mulai session :contentReference[oaicite:1]{index=1}
// Proteksi: hanya admin yang boleh lihat
if(!isset($_SESSION['admin'])) {
    header("Location: admin-login.php");
    exit;
}

// Koneksi DB
include "config.php"; 

$id = htmlspecialchars($_GET["id"]);

// Jalankan query JOIN
$sql = "
SELECT p.id_pendaftaran, s.nis, s.nama_siswa, e.nama_ekskul, p.tanggal_daftar, p.status AS status, p.keterangan
FROM pendaftaran_ekskul p
JOIN siswa s ON p.id_siswa = s.id_siswa
JOIN ekstrakurikuler e ON p.id_ekskul = e.id_ekskul
WHERE p.id_pendaftaran = $id
";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Status</title>
        <link rel="stylesheet" href="styles/stlye.css">
    </head>
    <body>
        <h1>Edit Status</h1>
        
        <?php if($result->num_rows > 0): 
            $row = $result->fetch_assoc();
        ?>
        
        <form method="post" action="simpan-status.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
            <label for="status">Edit Status:</label><br>
            <select id="status" name="status" required>
                <option value="tunda" <?php echo ($row['status'] == 'tunda') ? 'selected' : ''; ?>>Tunda</option>
                <option value="diterima" <?php echo ($row['status'] == 'diterima') ? 'selected' : ''; ?>>Diterima</option>
                <option value="ditolak" <?php echo ($row['status'] == 'ditolak') ? 'selected' : ''; ?>>Ditolak</option>
            </select><br><br>
            
            <input type="submit" value="Simpan Perubahan" require style="  background-color: #4a6de5;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;">
        </form>
        
        <?php else: ?>
            <p>Data tidak ditemukan</p>
        <?php endif; ?>
        
        <p><a href="admin.php">Ke Beranda</a></p>
    </body>
</html>
