<?php
include_once __DIR__ . '/../db.php';

class Prioritas
{
    private $connection;
    public $id;
    public $id_tugas;
    public $level_prioritas;

    public function __construct($db, $id = null, $tugas = null, $level_prioritas = null)
    {
        $this->connection = $db;
        $this->id = $id;
        $this->id_tugas = $tugas; // Langsung set dari POST
        $this->level_prioritas = $level_prioritas;
    }

    public function searchPrioritas($keyword): array
    {
        // Prepare the SQL statement with placeholders
        $query = "SELECT prioritas.*, tugas.judul AS judul 
              FROM prioritas 
              LEFT JOIN tugas ON prioritas.id_tugas = tugas.id 
              WHERE tugas.judul LIKE ? OR level_prioritas LIKE ?";
        $stmt = $this->connection->prepare($query);

        // Bind the parameter with wildcards
        $keywordParam = '%' . $keyword . '%';
        $stmt->bind_param('ss', $keywordParam, $keywordParam);

        // Execute the statement
        $stmt->execute();

        // Fetch the results
        $result = $stmt->get_result();

        // Return the results as an associative array
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllPrioritas($limit, $offset): array
    {
        $query = "
        SELECT prioritas.*, tugas.judul AS judul
        FROM prioritas
        LEFT JOIN tugas ON prioritas.id_tugas = tugas.id
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

    public function getTotalPrioritasCount(): int
    {
        $query = "SELECT COUNT(*) as total FROM prioritas";
        $result = $this->connection->query($query);
        $total = $result->fetch_assoc();
        return $total['total'];
    }

    // Metode untuk mendapatkan Prioritas berdasarkan ID
    public function getPrioritasById(int $id): array
    {
        // Prepare the SQL statement
        $stmt = $this->connection->prepare("SELECT * FROM prioritas WHERE id = ?");

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

    public function tambahPrioritas(): bool
    {

        // Siapkan statement SQL
        $stmt = $this->connection->prepare("INSERT INTO Prioritas (id_tugas, level_prioritas) VALUES (?, ?)");

        // Bind parameter
        $stmt->bind_param("is", $this->id_tugas, $this->level_prioritas);

        // Eksekusi statement
        $success = $stmt->execute();

        if (!$success) {
            throw new Exception("Query failed: " . $stmt->error);
        }

        $stmt->close(); // Tutup statement
        return true; // Kembalikan true jika berhasil
    }

    public function editPrioritas(int $id, int $newIdTugas, string $newLevel): bool
    {
        // Prepare the SQL statement
        $stmt = $this->connection->prepare("UPDATE prioritas SET id_tugas=?, level_prioritas=? WHERE id=?");

        // Bind the parameters
        $stmt->bind_param("isi", $newIdTugas, $newLevel, $id);

        // Execute the statement
        $success = $stmt->execute();

        if (!$success) {
            throw new Exception("Query failed: " . $stmt->error);
        }

        $stmt->close(); // Close the statement
        return true; // Return true if successful
    }

    public function hapusPrioritas(int $id): bool
    {
        // Prepare the SQL statement
        $stmt = $this->connection->prepare("DELETE FROM prioritas WHERE id = ?");

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
