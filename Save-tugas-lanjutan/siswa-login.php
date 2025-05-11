<?php
session_start();
include "config.php";            // koneksi database

$error = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nis = $conn->real_escape_string($_POST['nis']);  // sanitasi

    // Cek apakah NIS ada di tabel siswa
    $res = $conn->query("SELECT * FROM siswa WHERE nis='$nis'");
    if($res->num_rows === 1){
        $_SESSION['nis'] = $nis;          // set session
        header("Location: index.html");  
        exit;
    } else {
        $error = "NIS tidak ditemukan. Silakan periksa kembali.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login Siswa</title>
  <link rel="stylesheet" href="styles/stlye.css">
  <style>
    button {
      background-color: #4a6de5;
      color: white;
      padding: 14px 20px;
      border-radius: 12px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      opacity: 0.8;
     color: whitesmoke;
    }

    .error {
      color: red;
    }

    p{
      text-align: center;
    }
  </style>
</head>
<body>
  <header>
    <h1>Login Siswa</h1>
  </header>
  <main>
    <?php if($error) echo "<p class='error'>$error</p>"; ?>
    <form action="siswa-login.php" method="post">
      <label for="nis">NIS:</label>
      <input type="text" id="nis" name="nis" required><br><br>
      <button type="submit">Login</button>
    </form>
    <p><a href="registrasi.php">← Belum ada akun? Registrasi</a></p>
  </main>
</body>
</html>
