<?php
include_once __DIR__ . '/db.php';
include_once 'Models/Tugas.php';

$db = new Database();

$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $tugas = new Tugas($db);

        try {
            if ($tugas->hapusTugas($id)) {
                $response['success'] = true;
                $response['message'] = "Berhasil menghapus tugas!";
            } else {
                $response['message'] = "Gagal menghapus tugas.";
            }
        } catch (Exception $e) {
            $response['message'] = $e->getMessage(); // Tangani error
        }
        // Mengembalikan respons JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        exit(); // Pastikan untuk menghentikan script setelah mengembalikan respons
    } else {
        echo "ID tugas tidak diberikan.";
    }
}

include 'Views/tugas_view.php';
