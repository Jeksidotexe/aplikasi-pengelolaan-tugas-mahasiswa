<?php
include_once __DIR__ . '/../db.php';  // Sesuaikan path jika perlu

class User
{
    private $connection;
    public $id;
    public $nama;
    public $email;
    public $password;
    public $foto;

    public function __construct($db, $id = null, $nama = null, $email = null, $password = null, $foto = null)
    {
        $this->connection = $db->connection;
        $this->id = $id;
        $this->nama = $nama;
        $this->email = $email;
        $this->password = $password;
        $this->foto = $foto;
    }

    public function register(string $nama, string $email, string $password): bool
    {
        // Hash password sebelum disimpan ke database
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Query untuk insert data
        $stmt = $this->connection->prepare("INSERT INTO user (nama, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $email, $hashedPassword);

        // Jalankan query
        if (!$stmt->execute()) {
            throw new Exception("Registrasi gagal: " . $stmt->error); // Tangani error
        }

        return $stmt->affected_rows > 0; // Registrasi berhasil
    }

    public function login(string $email, string $password): ?array
    {
        $stmt = $this->connection->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                return $user; // Kembalikan data user jika login berhasil
            }
        }
        return null; // Login gagal
    }

    public function getAllUserforDashboard(): array
    {
        $query = "SELECT * FROM user";
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

    public function getAllUserforProfil(): array
    {
        $query = "SELECT * FROM user";
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

    public function getAllUser($limit, $offset): array
    {
        $query = "SELECT * FROM user LIMIT ? OFFSET ?";
        $stmt = $this->connection->prepare($query);

        $stmt->bind_param("ii", $limit, $offset); // Mengikat parameter limit dan offset
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            throw new Exception("Query failed: " . $this->connection->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotalUserCount(): int
    {
        $query = "SELECT COUNT(*) as total FROM user";
        $result = $this->connection->query($query);
        $total = $result->fetch_assoc();
        return $total['total'];
    }

    public function getUserById(int $id): ?array
    {
        $stmt = $this->connection->prepare("SELECT * FROM user WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    private function getPasswordFromDatabase(int $id): string
    {
        $stmt = $this->connection->prepare("SELECT password FROM user WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc()['password'];
        }
        throw new Exception("User tidak ada");
    }

    public function editUser(int $id, string $newNama, string $newEmail, string $newPassword, string $newFoto = ''): bool
    {
        // Hash password jika ada password baru
        $hashedPassword = !empty($newPassword) ? password_hash($newPassword, PASSWORD_BCRYPT) : $this->getPasswordFromDatabase($id);

        // Prepare the SQL statement
        $stmt = $this->connection->prepare("UPDATE user SET nama=?, email=?, password=?, foto=? WHERE id=?");

        // Bind the parameters
        $stmt->bind_param("ssssi", $newNama, $newEmail, $hashedPassword, $newFoto, $id);

        // Execute the statement
        if (!$stmt->execute()) {
            throw new Exception("Query failed: " . $stmt->error);
        }

        return true; // Return true if successful
    }
}
