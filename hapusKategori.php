<?php
include_once __DIR__ . '/db.php';
include_once 'Models/Kategori.php';

$db = new Database();

$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $kategori = new Kategori($db);

        try {
            if ($kategori->hapusKategori($id)) { // Pastikan metode ini ada di model Kategori Anda
                $response['success'] = true;
                $response['message'] = "Berhasil menghapus kategori!";
            } else {
                $response['message'] = "Gagal menghapus kategori.";
            }
        } catch (Exception $e) {
            $response['message'] = $e->getMessage(); // Tangani error
        }
        // Mengembalikan respons JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        exit(); // Pastikan untuk menghentikan script setelah mengembalikan respons
    } else {
        echo "ID kategori tidak diberikan.";
    }
}

include 'Views/kategori_view.php';
