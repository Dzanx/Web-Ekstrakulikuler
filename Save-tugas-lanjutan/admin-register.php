<?php
include "config.php";  // koneksi MySQL

$err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // ambil & sanitize input
    $user = $conn->real_escape_string($_POST['username']);
    $pass = $_POST['password'];
    $nama = $conn->real_escape_string($_POST['nama_lengkap']);
    $role = $conn->real_escape_string($_POST['role']);

    // cek duplikasi username
    $res = $conn->query("SELECT * FROM pengguna WHERE username='$user'");
    if($res->num_rows > 0){
        $err = "Username sudah dipakai.";
    } else {
        // hash password
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        // simpan ke DB
        $sql = "INSERT INTO pengguna (username,password,nama_lengkap,role) 
                VALUES ('$user','$hash','$nama','$role')";
        if($conn->query($sql)){
            header("Location: admin-login.php");
            exit;
        } else {
            $err = "Error: ".$conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Register Admin</title>
    <link rel="stylesheet" href="styles/stlye.css">
</head>
<body>
  <h1>Form Register Admin</h1>
  <?php if($err) echo "<p style='color:red;'>$err</p>"; ?>
  <form method="post">
    <label>Username:</label><input name="username" require style="  width: 100%;
  padding: 12px 15px;
  border: 1px solid #ddd;
  border-radius: var(--border-radius);
  font-size: 1rem;
  transition: border 0.3s, box-shadow 0.3s;
  background-color: #fafafa;"><br>
    <label>Password:</label><input type="password" name="password" required><br>
    <label>Nama Lengkap:</label><input name="nama_lengkap" require style="  width: 100%;
  padding: 12px 15px;
  border: 1px solid #ddd;
  border-radius: var(--border-radius);
  font-size: 1rem;
  transition: border 0.3s, box-shadow 0.3s;
  background-color: #fafafa;"><br>
    <label>Role:</label>
      <select name="role" required>
        <option value="admin">Admin</option>
        <option value="pembina">Pembina</option>
      </select><br>
    <button require style="  background-color: #4a6de5; color: #fff; border: none; padding: 10px 20px; margin-top: 10px; cursor: pointer; border-radius: 12px; ">Register</button>
  </form>
  <p><a href="admin-login.php" require style="margin-top: 10px; ">Ke Login Admin</a></p>
</body>
</html>
