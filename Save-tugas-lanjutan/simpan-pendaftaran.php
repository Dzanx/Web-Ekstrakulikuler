<?php
// Mulai session untuk ambil NIS siswa yang login
session_start();                                              //:contentReference[oaicite:0]{index=0}

// Jika belum login (NIS tidak ada di session), kembalikan ke login siswa
if(!isset($_SESSION['nis'])){
    header("Location: siswa-login.php");                     //:contentReference[oaicite:1]{index=1}
    exit;
}

// Sertakan koneksi database
include "config.php";                                        //:contentReference[oaicite:2]{index=2}

// Tangkap NIS dari session, lalu cari id_siswa
$nis = $conn->real_escape_string($_SESSION['nis']);          //:contentReference[oaicite:3]{index=3}
$res = $conn->query("SELECT id_siswa FROM siswa WHERE nis='$nis'");
$row = $res->fetch_assoc();
$id_siswa = (int)$row['id_siswa'];

// Tangkap data dari form pendaftaran
$id_ekskul   = (int) $_POST['id_ekskul'];                    //:contentReference[oaicite:4]{index=4}
$keterangan  = $conn->real_escape_string($_POST['alasan']); //:contentReference[oaicite:5]{index=5}
// Tetapkan tanggal daftar hari ini format YYYY-MM-DD
$tanggal     = date("Y-m-d");                                //:contentReference[oaicite:6]{index=6}

// Susun dan jalankan INSERT query
$sql = "INSERT INTO pendaftaran_ekskul 
        (id_siswa, id_ekskul, tanggal_daftar, keterangan)
        VALUES
        ($id_siswa, $id_ekskul, '$tanggal', '$keterangan')"; //:contentReference[oaicite:7]{index=7}

if($conn->query($sql)){
    // Jika berhasil, redirect ke halaman sukses
    header("Location: sukses-pendaftaran.php");              //:contentReference[oaicite:8]{index=8}
    exit;
} else {
    // Jika error, tampilkan pesan
    echo "Error saat menyimpan: " . $conn->error;
}
?>
<head>
    <title>Simpan Pendaftaran</title>
    <link rel="stylesheet" href="styles/stlye.css">
</head>
