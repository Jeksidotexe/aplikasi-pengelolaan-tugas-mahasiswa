<?php
include_once __DIR__ . '/db.php';
include_once 'Models/Pengingat.php';
include_once 'Models/Tugas.php';

$db = new Database();

$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $pengingat = new Pengingat($db);

        try {
            if ($pengingat->hapusPengingat($id)) {
                $response['success'] = true;
                $response['message'] = "Berhasil menghapus pengingat!";
            } else {
                $response['message'] = "Gagal menghapus pengingat.";
            }
        } catch (Exception $e) {
            $response['message'] = $e->getMessage(); // Tangani error
        }
        // Mengembalikan respons JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        exit(); // Pastikan untuk menghentikan script setelah mengembalikan respons
    } else {
        echo "ID pengingat tidak diberikan.";
    }
}

include 'Views/pengingat_view.php';
