<?php
session_start();
include_once __DIR__ . '/db.php';
include 'Models/Komentar.php';
include_once 'Models/Tugas.php';
include 'Models/User.php';


$db = new Database();
$tugas = new Tugas($db);
$dataTugas = $tugas->getAllTugasforKomentar();

$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_tugas = $_POST['id_tugas'];
    $isi = $_POST['isi'];

    // Validasi input
    if (empty($id_tugas) || empty($isi)) {
        $response['message'] = "Semua field harus diisi!";
    } else {
        // Jika validasi berhasil, lanjutkan untuk menambah komentar
        $komentar = new Komentar($db, null, $id_tugas, $isi);

        try {
            if ($komentar->tambahKomentar()) { // Pastikan metode ini tidak memerlukan argumen
                $response['success'] = true;
                $response['message'] = "Berhasil menambahkan komentar!";
            } else {
                $response['message'] = "Gagal menambahkan komentar.";
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

include 'Views/Forms/form_tambahKomentar.php';
