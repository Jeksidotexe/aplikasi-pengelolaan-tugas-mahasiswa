<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}


include 'db.php';
include 'Models/User.php';
include 'Models/Tugas.php';
include 'Models/Kategori.php';
include 'Models/Prioritas.php';
include 'Models/Pengingat.php';
include 'Models/Komentar.php';

$db = new Database();
$user = new User($db);
$tugas = new Tugas($db);
$kategori = new Kategori($db);
$prioritas = new Prioritas($db);
$komentar = new Komentar($db);

$totalUser = $user->getTotalUserCount();
$totalTugas = $tugas->getTotalTugasCount();
$totalKategori = $kategori->getTotalKategoriCount();
$totalPrioritas = $prioritas->getTotalPrioritasCount();
$totalKomentar = $komentar->getTotalKomentarCount();

// Pastikan bahwa pengguna sudah login
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Ambil ID pengguna dari sesi
    // Mengambil data pengguna berdasarkan ID
    $dataUser = $user->getUserById($userId);
} else {
    // Tangani jika pengguna tidak login
    die("Anda harus login untuk mengakses halaman ini.");
}

// Tentukan foto default    
$defaultFoto = 'default-profile.jpg'; // Nama file foto default
$defaultFotoPath = "Assets/Images/$defaultFoto";
$userFoto = !empty($dataUser['foto']) ? $dataUser['foto'] : $defaultFoto;

// Tampilkan tampilan dashboard
include 'Views/dashboard_view.php';
