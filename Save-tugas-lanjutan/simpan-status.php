<?php
session_start();

// Proteksi halaman
if(!isset($_SESSION['admin'])) {
    header("Location: admin-login.php");
    exit;
}

// Koneksi DB
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = htmlspecialchars($_POST["id"]);
    $status = htmlspecialchars($_POST["status"]);
    
    // Update status di database
    $sql = "UPDATE pendaftaran_ekskul SET status = ? WHERE id_pendaftaran = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);
    
    if ($stmt->execute()) {
        header("Location: admin.php");
        exit;
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
    
    $stmt->close();
}

$conn->close();
?>