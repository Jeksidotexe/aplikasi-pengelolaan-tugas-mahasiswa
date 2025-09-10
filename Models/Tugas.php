<?php
include_once __DIR__ . '/../db.php';

class Tugas
{
    private $connection;
    public $id;
    public $id_kategori;
    public $judul;
    public $deskripsi;
    public $deadline;
    public $status;

    public function __construct($db, $id = null, $kategori = null, $judul = null, $deskripsi = null, $deadline = null, $status = null)
    {
        $this->connection = $db;
        $this->id = $id;
        $this->id_kategori = $kategori; // Langsung set dari POST
        $this->judul = $judul;
        $this->deskripsi = $deskripsi;
        $this->deadline = $deadline;
        $this->status = $status;
    }

    public function searchTugas($keyword): array
    {
        // Prepare the SQL statement with placeholders
        $query = "SELECT tugas.*, kategori.nama_kategori AS nama_kategori 
              FROM tugas 
              LEFT JOIN kategori ON tugas.id_kategori = kategori.id 
              WHERE kategori.nama_kategori LIKE ? OR judul LIKE ? OR deskripsi LIKE ? OR deadline LIKE ? OR status LIKE ?";
        $stmt = $this->connection->prepare($query);

        // Bind the parameter with wildcards
        $keywordParam = '%' . $keyword . '%';
        $stmt->bind_param('sssss', $keywordParam, $keywordParam, $keywordParam, $keywordParam, $keywordParam);

        // Execute the statement
        $stmt->execute();

        // Fetch the results
        $result = $stmt->get_result();

        // Return the results as an associative array
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllTugasforPrioritas(): array
    {
        $query = "SELECT * FROM tugas";
        $stmt = $this->connection->prepare($query);

        // Menjalankan perintah
        $stmt->execute();

        $result = $stmt->get_result();

        // Memeriksa apakah query berhasil
        if (!$result) {
            throw new Exception("Query failed: " . $this->connection->error);
        }

        // Mengembalikan hasil sebagai array asosiatif
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllTugasforPengingat(): array
    {
        $query = "SELECT * FROM tugas";
        $stmt = $this->connection->prepare($query);

        // Menjalankan perintah
        $stmt->execute();

        $result = $stmt->get_result();

        // Memeriksa apakah query berhasil
        if (!$result) {
            throw new Exception("Query failed: " . $this->connection->error);
        }

        // Mengembalikan hasil sebagai array asosiatif
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllTugasforKomentar(): array
    {
        $query = "SELECT * FROM tugas";
        $stmt = $this->connection->prepare($query);

        // Menjalankan perintah
        $stmt->execute();

        $result = $stmt->get_result();

        // Memeriksa apakah query berhasil
        if (!$result) {
            throw new Exception("Query failed: " . $this->connection->error);
        }

        // Mengembalikan hasil sebagai array asosiatif
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllTugas($limit, $offset): array
    {
        $query = "
        SELECT tugas.*, kategori.nama_kategori AS nama_kategori
        FROM tugas
        LEFT JOIN kategori ON tugas.id_kategori = kategori.id
        LIMIT ? OFFSET ?";

        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ii", $limit, $offset); // Mengikat parameter limit dan offset
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            throw new Exception("Query failed: " . $this->connection->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotalTugasCount(): int
    {
        $query = "SELECT COUNT(*) as total FROM tugas";
        $result = $this->connection->query($query);
        $total = $result->fetch_assoc();
        return $total['total'];
    }

    // Metode untuk mendapatkan tugas berdasarkan ID
    public function getTugasById(int $id): array
    {
        // Prepare the SQL statement
        $stmt = $this->connection->prepare("SELECT * FROM tugas WHERE id = ?");

        // Bind the parameter
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            throw new Exception("Query failed: " . $this->connection->error);
        }

        // Fetch the data as an associative array
        return $result->fetch_assoc();
    }

    public function tambahTugas(): bool
    {

        // Siapkan statement SQL
        $stmt = $this->connection->prepare("INSERT INTO tugas (id_kategori, judul, deskripsi, deadline, status) VALUES (?, ?, ?, ?, ?, ?)");

        // Bind parameter
        $stmt->bind_param("issss", $this->id_kategori, $this->judul, $this->deskripsi, $this->deadline, $this->status);

        // Eksekusi statement
        $success = $stmt->execute();

        if (!$success) {
            throw new Exception("Query failed: " . $stmt->error);
        }

        $stmt->close(); // Tutup statement
        return true; // Kembalikan true jika berhasil
    }

    public function editTugas(int $id, int $newIdKategori, string $newJudul, string $newDeskripsi, string $newDeadline, string $newStatus): bool
    {
        // Prepare the SQL statement
        $stmt = $this->connection->prepare("UPDATE tugas SET id_kategori=?, judul=?, deskripsi=?, deadline=?, status=? WHERE id=?");

        // Bind the parameters
        $stmt->bind_param("issssi", $newIdKategori, $newJudul, $newDeskripsi, $newDeadline, $newStatus, $id);

        // Execute the statement
        $success = $stmt->execute();

        if (!$success) {
            throw new Exception("Query failed: " . $stmt->error);
        }

        $stmt->close(); // Close the statement
        return true; // Return true if successful
    }

    public function hapusTugas(int $id): bool
    {
        // Prepare the SQL statement
        $stmt = $this->connection->prepare("DELETE FROM tugas WHERE id = ?");

        // Bind the parameter
        $stmt->bind_param("i", $id);

        // Execute the statement
        $success = $stmt->execute();

        if (!$success) {
            throw new Exception("Query gagal: " . $stmt->error);
        }

        $stmt->close(); // Tutup statement
        return true; // Kembalikan true jika berhasil
    }

    public function cetakTugas(): void
    {
        // Mengatur header untuk output yang bisa dicetak
        header('Content-Type: text/html; charset=utf-8');
        echo "<h1>Data Tugas</h1>";
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr><th>Kategori</th><th>Judul</th><th>Deskripsi</th><th>Deadline</th></tr>";


        // Ambil semua data tugas
        $tugasList = $this->getAllTugas(10, 0);
        foreach ($tugasList as $tugas) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($tugas['kategori']) . "</td>";
            echo "<td>" . htmlspecialchars($tugas['judul']) . "</td>";
            echo "<td>" . htmlspecialchars($tugas['deskripsi']) . "</td>";
            echo "<td>" . htmlspecialchars($tugas['deadline']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";


        // Menambahkan tombol untuk mencetak
        echo '<script type="text/javascript">window.print();</script>';
    }
}
