<?php

class Database
{
    private $host;
    private $db;
    private $user;
    private $pass;
    public $connection;

    public function __construct()
    {
        $this->host = getenv('DB_HOST') ?: 'localhost';
        $this->db = getenv('DB_NAME') ?: 'tugas_ku';
        $this->user = getenv('DB_USER') ?: 'root';
        $this->pass = getenv('DB_PASS') ?: '';

        // Buat koneksi mysqli
        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->db);

        // Cek koneksi
        if ($this->connection->connect_error) {
            throw new Exception("Koneksi database gagal: " . $this->connection->connect_error);
        }
    }

    // Metode untuk melakukan query sederhana
    public function query($query)
    {
        return $this->connection->query($query);
    }

    // Metode untuk mempersiapkan statement
    public function prepare($query)
    {
        $stmt = $this->connection->prepare($query);
        if (!$stmt) {
            throw new Exception("Prepare statement gagal: " . $this->connection->error);
        }
        return $stmt;
    }

    // Metode untuk menutup koneksi
    public function close()
    {
        $this->connection->close(); // Tutup koneksi mysqli
    }
}
