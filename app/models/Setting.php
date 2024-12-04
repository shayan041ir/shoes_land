<?php

class Setting
{
    private $db;

    public function __construct()
    {
        require_once __DIR__ . '/../config/database.php';
        $this->db = Database::getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM settings";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByKey($key)
    {
        $query = "SELECT * FROM settings WHERE key_name = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$key]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($key, $value)
    {
        $query = "UPDATE settings SET value = ? WHERE key_name = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$value, $key]);
    }

    public function create($key, $value)
    {
        $query = "INSERT INTO settings (key_name, value) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$key, $value]);
    }
}
