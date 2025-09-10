<?php
include_once __DIR__ . '/../db.php';

class Kategori
{
    private $connection;
    public $id;
    public $nama_kategori;

    public function __construct($db, $id = null, $nama_kategori = null)
    {
        $this->connection = $db;
        $this->id = $id;
        $this->nama_kategori = $nama_kategori;
    }

    public function searchKategori($keyword): array
    {
        // Prepare the SQL statement with a placeholder
        $query = "SELECT * FROM kategori WHERE nama_kategori LIKE ?";
        $stmt = $this->connection->prepare($query);

        // Bind the parameter with wildcards
        $keywordParam = '%' . $keyword . '%';
        $stmt->bind_param('s', $keywordParam);

        // Execute the statement
        $stmt->execute();

        // Fetch the results
        $result = $stmt->get_result();

        // Return the results as an associative array
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllKategoriforTugas(): array
    {
        $query = "SELECT * FROM kategori";
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

    public function getAllKategori($limit, $offset): array
    {
        // Menambahkan LIMIT dan OFFSET ke query dengan placeholder
        $query = "SELECT * FROM kategori LIMIT ? OFFSET ?";

        // Mempersiapkan query
        $stmt = $this->connection->prepare($query);

        // Mengikat parameter limit dan offset
        $stmt->bind_param("ii", $limit, $offset);

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

    public function getTotalKategoriCount(): int
    {
        $query = "SELECT COUNT(*) as total FROM kategori";
        $result = $this->connection->query($query);
        $total = $result->fetch_assoc();
        return $total['total'];
    }

    // Metode untuk mendapatkan kategori berdasarkan ID
    public function getKategoriById(int $id): array
    {

        // Prepare the SQL statement
        $stmt = $this->connection->prepare("SELECT * FROM kategori WHERE id = ?");

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

    public function tambahKategori(): bool
    {

        // Siapkan statement SQL
        $stmt = $this->connection->prepare("INSERT INTO kategori (nama_kategori) VALUES (?)");

        // Bind parameter
        $stmt->bind_param("s", $this->nama_kategori);

        // Eksekusi statement
        $success = $stmt->execute();

        if (!$success) {
            throw new Exception("Query failed: " . $stmt->error);
        }

        $stmt->close(); // Tutup statement
        return true; // Kembalikan true jika berhasil
    }

    public function editKategori(int $id, string $newNamaKategori): bool
    {
        // Prepare the SQL statement
        $stmt = $this->connection->prepare("UPDATE kategori SET nama_kategori=? WHERE id=?");

        // Bind the parameters
        $stmt->bind_param("si", $newNamaKategori, $id);

        // Execute the statement
        $success = $stmt->execute();

        if (!$success) {
            throw new Exception("Query failed: " . $stmt->error);
        }

        $stmt->close(); // Close the statement
        return true; // Return true if successful
    }

    public function hapusKategori(int $id): bool
    {
        // Prepare the SQL statement
        $stmt = $this->connection->prepare("DELETE FROM kategori WHERE id = ?");

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
