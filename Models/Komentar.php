<?php
include_once __DIR__ . '/../db.php';

class Komentar
{
    private $connection;
    public $id;
    private $id_tugas;
    private $isi;

    public function __construct($db, $id = null, $tugas = null, $isi = null)
    {
        $this->connection = $db;
        $this->id = $id;
        $this->id_tugas = $tugas;
        $this->isi = $isi;
    }

    public function searchKomentar($keyword): array
    {
        // Prepare the SQL statement with placeholders
        $query = "SELECT komentar.*, tugas.judul AS judul 
              FROM komentar 
              LEFT JOIN tugas ON komentar.id_tugas = tugas.id 
              WHERE tugas.judul LIKE ? OR isi LIKE ? OR waktu LIKE ?";
        $stmt = $this->connection->prepare($query);

        // Bind the parameter with wildcards
        $keywordParam = '%' . $keyword . '%';
        $stmt->bind_param('sss', $keywordParam, $keywordParam, $keywordParam);

        // Execute the statement
        $stmt->execute();

        // Fetch the resultss
        $result = $stmt->get_result();

        // Return the results as an associative array
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllKomentar($limit, $offset): array
    {
        // No changes needed here
        $query = "
        SELECT komentar.*, tugas.judul AS judul
        FROM komentar
        JOIN tugas ON komentar.id_tugas = tugas.id
        LIMIT ? OFFSET ?";

        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            throw new Exception("Query failed: " . $this->connection->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotalKomentarCount(): int
    {
        // No changes needed here
        $query = "SELECT COUNT(*) as total FROM komentar";
        $result = $this->connection->query($query);
        $total = $result->fetch_assoc();
        return $total['total'];
    }

    public function getKomentarById(int $id): array
    {
        // Prepare the SQL statement
        $stmt = $this->connection->prepare("SELECT * FROM komentar WHERE id = ?");

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

    public function tambahKomentar(): bool
    {

        // Ambil waktu saat ini dalam zona waktu Asia/Jakarta
        $dateTime = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $waktu = $dateTime->format('Y-m-d H:i:s');

        // Siapkan statement SQL
        $stmt = $this->connection->prepare("INSERT INTO komentar (id_tugas, isi, waktu) VALUES (?, ?, ?)");

        // Bind parameter
        $stmt->bind_param("iss", $this->id_tugas, $this->isi, $waktu);

        // Eksekusi statement
        $success = $stmt->execute();

        if (!$success) {
            throw new Exception("Query failed: " . $stmt->error);
        }

        $stmt->close();
        return true;
    }

    public function editKomentar(int $id, int $newIdTugas, string $newIsi): bool
    {
        // Setel waktu ke waktu saat ini dalam zona waktu Asia/Jakarta
        $dateTime = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $newWaktu = $dateTime->format('Y-m-d H:i:s');

        // Prepare the SQL statement
        $stmt = $this->connection->prepare("UPDATE komentar SET id_tugas=?, isi=?, waktu=? WHERE id=?");

        // Bind the parameters
        $stmt->bind_param("issi", $newIdTugas, $newIsi, $newWaktu, $id);

        // Execute the statement
        $success = $stmt->execute();

        if (!$success) {
            throw new Exception("Query failed: " . $stmt->error);
        }

        $stmt->close(); // Close the statement
        return true; // Return true if successful
    }

    public function hapusKomentar(int $id): bool
    {
        // Prepare the SQL statement
        $stmt = $this->connection->prepare("DELETE FROM komentar WHERE id = ?");

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
}
