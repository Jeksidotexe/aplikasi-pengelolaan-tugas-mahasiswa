<?php
session_start();
include 'db.php';
include 'Models/User.php';

$db = new Database();
$user = new User($db);

// Pastikan bahwa pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    die("Anda harus login untuk mengakses halaman ini.");
}

$userId = $_SESSION['user_id']; // Ambil ID pengguna dari sesi
$dataUser = $user->getUserById($userId);

// Tentukan foto default
$defaultFoto = 'default-profile.jpg'; // Nama file foto default
$defaultFotoPath = "Assets/Images/$defaultFoto";
$userFoto = !empty($dataUser['foto']) ? $dataUser['foto'] : $defaultFoto;

// Handle AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = array('success' => false, 'message' => '');

    // Ambil data dari POST
    $newNama = $_POST['nama'];
    $newEmail = $_POST['email'];
    $newPassword = $_POST['password'] ?? null; // Password opsional

    // Handle file upload
    $newFoto = $dataUser['foto'] ?? $defaultFoto;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        // Hapus foto lama jika tidak kosong dan bukan default
        if (!empty($dataUser['foto']) && $dataUser['foto'] != $defaultFoto) {
            $oldFotoPath = "Assets/Images/" . $dataUser['foto'];
            if (file_exists($oldFotoPath)) {
                unlink($oldFotoPath);
            }
        }

        // Mengambil ekstensi file
        $fileExtension = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png']; // Ekstensi yang diperbolehkan

        // Validasi ekstensi file
        if (!in_array($fileExtension, $allowedExtensions)) {
            $response['message'] = "Ekstensi file tidak diperbolehkan. Hanya JPG, JPEG, dan PNG yang diperbolehkan.";
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }

        // Generate nama file baru
        $newFoto = uniqid('foto_', true) . '.' . $fileExtension;

        // Pindahkan file
        move_uploaded_file($_FILES['foto']['tmp_name'], "Assets/Images/" . $newFoto);
    }

    try {
        if ($user->editUser($userId, $newNama, $newEmail, $newPassword, $newFoto)) {
            $response['success'] = true;
            $response['message'] = "Berhasil mengubah profil!";
            $response['newFoto'] = $newFoto; // Kirim nama foto baru ke client
        } else {
            $response['message'] = "Gagal mengubah profil.";
        }
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }

    // Mengembalikan respons JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

// Jika bukan POST request, tampilkan halaman normal
include 'Views/profil_view.php';
