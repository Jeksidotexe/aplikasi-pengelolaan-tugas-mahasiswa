<?php
include_once __DIR__ . '/../db.php';

class Pengingat
{
    private $connection;
    public $id;
    private $id_tugas;
    private $waktu;

    public function __construct($db, $id = null, $tugas = null, $waktu = null)
    {
        $this->connection = $db;
        $this->id = $id;
        $this->id_tugas = $tugas;
        $this->waktu = $waktu;
    }

    public function searchPengingat($keyword): array
    {
        // Prepare the SQL statement with placeholders
        $query = "SELECT pengingat.*, tugas.judul AS judul 
              FROM pengingat 
              LEFT JOIN tugas ON pengingat.id_tugas = tugas.id 
              WHERE tugas.judul LIKE ? OR waktu LIKE ?";
        $stmt = $this->connection->prepare($query);

        // Bind the parameter with wildcards
        $keywordParam = '%' . $keyword . '%';
        $stmt->bind_param('ss', $keywordParam, $keywordParam);

        // Execute the statement
        $stmt->execute();

        // Fetch the resultss
        $result = $stmt->get_result();

        // Return the results as an associative array
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllPengingat($limit, $offset): array
    {
        $query = "
        SELECT pengingat.*, tugas.judul AS judul
        FROM pengingat
        LEFT JOIN tugas ON pengingat.id_tugas = tugas.id
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

    public function getTotalPengingatCount(): int
    {
        $query = "SELECT COUNT(*) as total FROM pengingat";
        $result = $this->connection->query($query);
        $total = $result->fetch_assoc();
        return $total['total'];
    }


    public function getPengingatById(int $id): array
    {
        // Prepare the SQL statement
        $stmt = $this->connection->prepare("SELECT * FROM pengingat WHERE id = ?");

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

    public function tambahPengingat(): bool
    {

        $stmt = $this->connection->prepare("INSERT INTO pengingat (id_tugas, waktu) VALUES (?, ?)");

        // Bind parameter
        $stmt->bind_param("is", $this->id_tugas, $this->waktu);

        // Eksekusi statement
        $success = $stmt->execute();

        if (!$success) {
            throw new Exception("Query failed: " . $stmt->error);
        }

        $stmt->close(); // Tutup statement
        return true; // Kembalikan true jika berhasil
    }

    public function editPengingat(int $id, int $newIdTugas, string $newWaktu): bool
    {
        // Prepare the SQL statement
        $stmt = $this->connection->prepare("UPDATE pengingat SET id_tugas=?, waktu=? WHERE id=?");

        // Bind the parameters
        $stmt->bind_param("isi", $newIdTugas, $newWaktu, $id);

        // Execute the statement
        $success = $stmt->execute();

        if (!$success) {
            throw new Exception("Query failed: " . $stmt->error);
        }

        $stmt->close(); // Close the statement
        return true; // Return true if successful
    }

    public function hapusPengingat(int $id): bool
    {
        // Prepare the SQL statement
        $stmt = $this->connection->prepare("DELETE FROM pengingat WHERE id = ?");

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
