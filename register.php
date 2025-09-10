<?php
session_start();
include 'db.php';
include 'Models/User.php';

$db = new Database();
$user = new User($db);

$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validasi input
    if (empty($nama) || empty($email) || empty($password)) {
        $response['message'] = "Semua field harus diisi!";
    } else {
        // Attempt to register the user
        try {
            if ($user->register($nama, $email, $password)) {
                $response['success'] = true;
                $response['message'] = "Registrasi berhasil!";
            } else {
                $response['message'] = "Registrasi gagal.";
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

// Jika bukan permintaan POST, tampilkan registrasi tanpa JSON
include 'Views/Forms/form_register.php';
