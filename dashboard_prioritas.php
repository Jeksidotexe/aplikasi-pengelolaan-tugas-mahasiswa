<?php
session_start();
include 'db.php';
include 'Models/Prioritas.php';
include 'Models/Tugas.php';
include 'Models/User.php';

$db = new Database();
$prioritas = new Prioritas($db);
$user = new User($db);
// Asumsikan ini ada di Controller ketika menangani request
$limit = 10; // Contoh: ambil 10 data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;



// Mengambil data tugas dengan pagination
$dataPrioritas = $prioritas->getAllPrioritas($limit, $offset);
$totalPrioritas = $prioritas->getTotalPrioritasCount();
$totalPages = ceil($totalPrioritas / $limit);

// Pastikan bahwa pengguna sudah login
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Ambil ID pengguna dari sesi
    // Mengambil data pengguna berdasarkan ID
    $dataUser = $user->getUserById($userId);
} else {
    // Tangani jika pengguna tidak login
    die("Anda harus login untuk mengakses halaman ini.");
}

$searchPrioritas = $_GET['search_prioritas'] ?? '';
if ($searchPrioritas) {
    $dataPrioritas = $prioritas->searchPrioritas($searchPrioritas);
}

// Tentukan foto default
$defaultFoto = 'default-profile.jpg'; // Nama file foto default
$defaultFotoPath = "Assets/Images/$defaultFoto";
$userFoto = !empty($dataUser['foto']) ? $dataUser['foto'] : $defaultFoto;

include 'Views/prioritas_view.php';
