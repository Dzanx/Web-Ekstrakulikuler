<?php
include "config.php";

$err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil dan bersihkan input
    $nis    = $conn->real_escape_string($_POST['nis']);
    $nama   = $conn->real_escape_string($_POST['nama']);
    $kelas  = $conn->real_escape_string($_POST['kelas']);
    $jk     = $conn->real_escape_string($_POST['jenis_kelamin']);
    $tl     = $conn->real_escape_string($_POST['tanggal_lahir']);
    $alamat = $conn->real_escape_string($_POST['alamat']);
    $telp   = $conn->real_escape_string($_POST['no_telp']);
    $email  = $conn->real_escape_string($_POST['email']);

    // Cek duplikasi NIS
    $q = $conn->query("SELECT * FROM siswa WHERE nis='$nis'");
    if ($q->num_rows > 0) {
        $err = "NIS sudah terdaftar.";
    } else {
        // Simpan
        $sql = "INSERT INTO siswa (nis,nama_siswa,kelas,jenis_kelamin,tanggal_lahir,alamat,no_telp,email)
                VALUES ('$nis','$nama','$kelas','$jk','$tl','$alamat','$telp','$email')";
        if ($conn->query($sql)) {
            header("Location: sukses-register.php");
            exit;
        } else {
            $err = "Error: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register Siswa</title>
  <link rel="stylesheet" href="styles/stlye.css">
  <stlye>
    
  </stlye>
</head>
<body>
  <h1>Form Register Siswa</h1>
  <?php if($err) echo "<p style='color:red;'>$err</p>"; ?>
  <form method="post">
    <label>NIS:</label><input name="nis" require style="  width: 100%;
  padding: 12px 15px;
  border: 1px solid #ddd;
  border-radius: var(--border-radius);
  font-size: 1rem;
  transition: border 0.3s, box-shadow 0.3s;
  background-color: #fafafa;"><br>
    <label>Nama:</label><input type="text" name="nama" required><br>
    <label>Kelas:</label>
      <select name="kelas" required>
        <option value="">Pilih</option>
        <option>X RPL 1</option><option>X RPL 2</option>
      </select><br>
    <label>JK:</label>
      <select name="jenis_kelamin"><option value="L">L</option><option value="P">P</option></select><br>
    <label>Tgl Lahir:</label><input type="date" name="tanggal_lahir"><br>
    <label>Alamat:</label><textarea name="alamat"></textarea><br>
    <label>Telp:</label><input  name="no_telp" require style="  width: 100%;
  padding: 12px 15px;
  border: 1px solid #ddd;
  border-radius: var(--border-radius);
  font-size: 1rem;
  transition: border 0.3s, box-shadow 0.3s;
  background-color: #fafafa;"><br>
    <label>Email:</label><input type="email" name="email"><br>
    <button require style="      background-color: #4a6de5;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
      ">Daftar</button>
  </form>
  <p><a href="siswa-login.php">← ada Akun?Login</a></p>
  <p><a href="index.html">← Kembali Ke Beranda</a></p>
</body>
</html>
