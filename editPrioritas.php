<?php
session_start();
include_once __DIR__ . '/db.php';
include 'Models/Prioritas.php';
include_once 'Models/Tugas.php';
include 'Models/User.php';


$db = new Database();
$tugas = new Tugas($db);
$dataTugas = $tugas->getAllTugasforPrioritas();


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $prioritas = new Prioritas($db);

    try {

        $dataPrioritas = $prioritas->getPrioritasById($id);
        if (!$dataPrioritas) {
            echo "Prioritas tidak ditemukan.";
            exit;
        }
    } catch (Exception $e) {
        echo "Terjadi kesalahan: " . $e->getMessage();
        exit;
    }
} else {
    echo "ID prioritas tidak diberikan.";
    exit;
}

$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id_tugas = $_POST['id_tugas'];
    $level_prioritas = $_POST['level_prioritas'];

    // Validasi input
    if (empty($id_tugas) || empty($level_prioritas)) {
        $response['message'] = "Semua field harus diisi!";
    } else {
        // Jika validasi berhasil, lanjutkan untuk mengubah prioritas
        $prioritas = new Prioritas($db, null, $id_tugas, $level_prioritas);

        try {
            if ($prioritas->editPrioritas($id, $id_tugas, $level_prioritas)) { // Pastikan metode ini tidak memerlukan argumen
                $response['success'] = true;
                $response['message'] = "Berhasil mengubah prioritas!";
            } else {
                $response['message'] = "Gagal mengubah prioritas.";
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

include 'Views/Forms/form_editPrioritas.php';
