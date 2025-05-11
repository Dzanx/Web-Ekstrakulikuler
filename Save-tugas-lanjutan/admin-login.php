<?php
session_start();
include "config.php";

$err = "";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $user = $conn->real_escape_string($_POST['username']);
    $pass = $_POST['password'];

    $res = $conn->query("SELECT * FROM pengguna WHERE username='$user'");
    if($res->num_rows == 1){
        $row = $res->fetch_assoc();
        if(password_verify($pass, $row['password'])){
            // login sukses
            $_SESSION['admin'] = $row['username'];
            header("Location: admin.php");
            exit;
        } else {
            $err = "Password salah.";
        }
    } else {
        $err = "Username tidak ditemukan.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Login Admin</title>
    <link rel="stylesheet" href="styles/stlye.css">
</head>
<body>
    <header>
        <h1>Login Admin</h1>
    </header>
    <main>
        <?php if($err) echo "<p class='error'>$err</p>"; ?>
        <form action="admin-login.php" method="post">
            <label>Username:</label>
            <input name="username" require style="  width: 100%;
  padding: 12px 15px;
  border: 1px solid #ddd;
  border-radius: var(--border-radius);
  font-size: 1rem;
  transition: border 0.3s, box-shadow 0.3s;
  background-color: #fafafa;"><br>
            <label>Password:</label>
            <input type="password" name="password" required><br>
            <button require style="  background-color: #4a6de5; color: #fff; border: none; padding: 10px 20px; margin-top: 10px; cursor: pointer; border-radius: 12px; ">Login</button>
        </form>
        <p><a href="index.html">← Kembali ke Beranda</a></p>
        <p><a href="admin-register.php">← Register Akun Admin</a></p>
    </main>
</body>
</html>
