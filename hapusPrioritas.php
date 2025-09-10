<?php
include_once __DIR__ . '/db.php';
include_once 'Models/Prioritas.php';

$db = new Database();

$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $prioritas = new Prioritas($db);

        try {
            if ($prioritas->hapusPrioritas($id)) {
                $response['success'] = true;
                $response['message'] = "Berhasil menghapus prioritas!";
            } else {
                $response['message'] = "Gagal menghapus prioritas.";
            }
        } catch (Exception $e) {
            $response['message'] = $e->getMessage(); // Tangani error
        }
        // Mengembalikan respons JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        exit(); // Pastikan untuk menghentikan script setelah mengembalikan respons
    } else {
        echo "ID prioritas tidak diberikan.";
    }
}

include 'Views/prioritas_view.php';
