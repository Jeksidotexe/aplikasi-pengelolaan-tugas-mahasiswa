<?php
session_start();
include_once __DIR__ . '/db.php';
include_once 'Models/Tugas.php';
include 'Models/Kategori.php';
include 'Models/User.php';


$db = new Database();
$kategori = new Kategori($db);
$dataKategori = $kategori->getAllKategoriforTugas();

$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_SESSION['user_id'];
    $id_kategori = $_POST['id_kategori'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];

    // Validasi input
    if (empty($id_kategori) || empty($judul) || empty($deskripsi) || empty($deadline) || empty($status)) {
        $response['message'] = "Semua field harus diisi!";
    } else {
        // Jika validasi berhasil, lanjutkan untuk menambah tugas
        $tugas = new Tugas($db, null, $id_user, $id_kategori, $judul, $deskripsi, $deadline, $status);

        try {
            if ($tugas->tambahTugas()) { // Pastikan metode ini tidak memerlukan argumen
                $response['success'] = true;
                $response['message'] = "Berhasil menambahkan tugas!";
            } else {
                $response['message'] = "Gagal menambahkan tugas.";
            }
        } catch (Exception $e) {
            $response['message'] = $e->getMessage(); // Tangani error
        }
    }

    // Mengembalikan respons JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit(); // Pastikan untuk menghentikan script setelah mengembalikan respons
}

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

// Tentukan foto default
$defaultFoto = 'default-profile.jpg'; // Nama file foto default
$defaultFotoPath = "Assets/Images/$defaultFoto";
$userFoto = !empty($dataUser['foto']) ? $dataUser['foto'] : $defaultFoto;

include 'Views/Forms/form_tambahTugas.php';
