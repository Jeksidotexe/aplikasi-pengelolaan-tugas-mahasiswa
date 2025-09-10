<?php
include_once __DIR__ . '/db.php';
include_once 'Models/Komentar.php';

$db = new Database();

$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $komentar = new Komentar($db);

        try {
            if ($komentar->hapusKomentar($id)) {
                $response['success'] = true;
                $response['message'] = "Berhasil menghapus komentar!";
            } else {
                $response['message'] = "Gagal menghapus komentar.";
            }
        } catch (Exception $e) {
            $response['message'] = $e->getMessage(); // Tangani error
        }
        // Mengembalikan respons JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        exit(); // Pastikan untuk menghentikan script setelah mengembalikan respons
    } else {
        echo "ID komentar tidak diberikan.";
    }
}

include 'Views/komentar_view.php';
