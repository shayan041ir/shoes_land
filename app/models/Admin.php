<?php

class Admin
{
    private $db;

    public function __construct()
    {
        require_once __DIR__ . '/../config/database.php';
        $this->db = Database::getConnection();
    }

    public function authenticate($username, $password)
    {
        $query = "SELECT * FROM admins WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($password, $admin['password'])) {
            return true;
        }

        return false;
    }

    public function create($data)
    {
        $query = "INSERT INTO admins (username, password, email) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
        return $stmt->execute([$data['username'], $hashedPassword, $data['email']]);
    }

    public function getAll()
    {
        $query = "SELECT * FROM admins";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $query = "DELETE FROM admins WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);
    }
}
