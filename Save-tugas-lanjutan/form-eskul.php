<?php
include "config.php";                // sambungkan ke MySQL :contentReference[oaicite:2]{index=2}

$err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Ambil & sanitize input
    $nama       = $conn->real_escape_string($_POST['nama_ekskul']);       // :contentReference[oaicite:3]{index=3}
    $deskripsi  = $conn->real_escape_string($_POST['deskripsi']);         // :contentReference[oaicite:4]{index=4}
    $pembina    = $conn->real_escape_string($_POST['pembina']);
    $hari       = $conn->real_escape_string($_POST['hari_kegiatan']);
    $jam_mulai  = $conn->real_escape_string($_POST['jam_mulai']);
    $jam_selesai= $conn->real_escape_string($_POST['jam_selesai']);
    $lokasi     = $conn->real_escape_string($_POST['lokasi']);
    $kuota      = (int) $_POST['kuota'];                                  // numeric, cast int :contentReference[oaicite:5]{index=5}

    // Query INSERT
    $sql = "INSERT INTO ekstrakurikuler
            (nama_ekskul, deskripsi, pembina, hari_kegiatan, jam_mulai, jam_selesai, lokasi, kuota)
            VALUES
            ('$nama','$deskripsi','$pembina','$hari','$jam_mulai','$jam_selesai','$lokasi',$kuota)";  // :contentReference[oaicite:6]{index=6}

    if($conn->query($sql)){
        $msg = "Data berhasil disimpan.";  
    } else {
        $err = "Error: " . $conn->error;    // tampilkan error jika gagal
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Form Input Ekskul</title>
  <link rel="stylesheet" href="styles/stlye.css">
</head>
<body>
  <h1>Form Input Ekstrakurikuler</h1>
  <?php if($err) echo "<p style='color:red;'>$err</p>"; 
        if(isset($msg)) echo "<p style='color:green;'>$msg</p>"; ?>
  <form method="post">
    <label>Nama Ekskul:</label><input name="nama_ekskul" required><br>  
    <label>Deskripsi:</label><textarea name="deskripsi" required></textarea><br>  
    <label>Pembina:</label><input name="pembina" required><br>  
    <label>Hari Kegiatan:</label><input name="hari_kegiatan" required><br>  
    <label>Jam Mulai:</label><input type="time" name="jam_mulai" required><br>  
    <label>Jam Selesai:</label><input type="time" name="jam_selesai" required><br>  
    <label>Lokasi:</label><input name="lokasi" required><br>  
    <label>Kuota:</label><input type="number" name="kuota" min="1"><br>  
    <button type="submit">Simpan</button>                               
  </form>
  <p><a href="admin-ekskul.html">← Kembali ke Data Ekskul</a></p>
</body>
</html>
