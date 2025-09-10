<?php
session_start();
include 'db.php';
include 'Models/Tugas.php';


$db = new Database();
$tugas = new Tugas($db);
$dataTugas = $tugas->getAllTugas(10, 0);


// Mengatur header untuk output yang bisa dicetak
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Tugas</title>
    <style>
        @media print {

            /* Sembunyikan elemen yang tidak diinginkan saat mencetak */
            header,
            footer,
            nav,
            .sidebar,
            .menu {
                display: none;
            }

            body {
                margin: 0;
                padding: 0;
            }
        }

        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Data Tugas</h1>
    <table>
        <tr>
            <th>Kategori</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Deadline</th>
        </tr>
        <?php foreach ($dataTugas as $t): ?>
            <tr>
                <td><?= htmlspecialchars($t['nama_kategori']) ?></td>
                <td><?= htmlspecialchars($t['judul']) ?></td>
                <td><?= htmlspecialchars($t['deskripsi']) ?></td>
                <td><?= htmlspecialchars($t['deadline']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>


    <script type="text/javascript">
        window.print(); // Mencetak halaman
    </script>


</body>

</html>