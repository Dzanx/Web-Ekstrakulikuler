<?php
session_start();
if (!isset($_SESSION['nis'])) {
    header("Location: siswa-login.php");
    exit;
}
include "config.php";

// Ambil data siswa berdasarkan NIS
$nis = $conn->real_escape_string($_SESSION['nis']);
$resS = $conn->query("SELECT nama_siswa, kelas FROM siswa WHERE nis='$nis'");
$rowS = $resS->fetch_assoc();

// Ambil daftar ekskul dari database
$resE = $conn->query("SELECT id_ekskul, nama_ekskul FROM ekstrakurikuler ORDER BY nama_ekskul");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Pendaftaran Ekskul</title>
  <link rel="stylesheet" href="styles/stlye.css">
</head>
<body>
  <header>
    <h1>Form Pendaftaran Ekskul</h1>
  </header>
  <main>
    <p require style="    
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
      text-align: center;
      font-size: 18px;
  
      "">Halo, <strong><?php echo htmlspecialchars($rowS['nama_siswa']); ?></strong> 
       (NIS: <?php echo htmlspecialchars($nis); ?>, Kelas: <?php echo htmlspecialchars($rowS['kelas']); ?>)</p>

    <form method="post" action="simpan-pendaftaran.php">
      <label for="id_ekskul">Pilih Ekskul:</label>
      <select id="id_ekskul" name="id_ekskul" required>
        <option value="" disabled selected>-- Pilih Ekskul --</option>
        <?php while ($rowE = $resE->fetch_assoc()): ?>
          <option value="<?php echo $rowE['id_ekskul']; ?>">
            <?php echo htmlspecialchars($rowE['nama_ekskul']); ?>
          </option>
        <?php endwhile; ?>
      </select>
      
      <label for="alasan">Alasan Mendaftar:</label>
      <textarea id="alasan" name="alasan" rows="4" required></textarea>
      
      <button type="submit" require style="      background-color: #4a6de5;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
      ">Daftar Sekarang</button>
    </form>
  </main>
</body>
</html>
