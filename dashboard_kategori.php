<?php
session_start();
include 'db.php';
include 'Models/Kategori.php';
include 'Models/User.php';

$db = new Database();
$kategori = new Kategori($db);
// Asumsikan ini ada di Controller ketika menangani request
$limit = 10; // Contoh: ambil 10 data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Mengambil data tugas dengan pagination
$dataKategori = $kategori->getAllKategori($limit, $offset);
$totalKategori = $kategori->getTotalKategoriCount();
$totalPages = ceil($totalKategori / $limit);

$user = new User($db);
// Pastikan bahwa pengguna sudah login
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Ambil ID pengguna dari sesi
    // Mengambil data pengguna berdasarkan ID
    $dataUser = $user->getUserById($userId);
} else {
    // Tangani jika pengguna tidak login
    die("Anda harus login untuk mengakses halaman ini.");
}

$searchKategori = $_GET['search_kategori'] ?? '';
if ($searchKategori) {
    $dataKategori = $kategori->searchKategori($searchKategori);
}

// Tentukan foto default
$defaultFoto = 'default-profile.jpg'; // Nama file foto default
$defaultFotoPath = "Assets/Images/$defaultFoto";
$userFoto = !empty($dataUser['foto']) ? $dataUser['foto'] : $defaultFoto;

include 'Views/kategori_view.php';
