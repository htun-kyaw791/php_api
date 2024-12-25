<?php

namespace App\Models;

use Core\Database;

class ApiModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function fetchData()
    {
        $query = $this->db->query("SELECT * FROM items");
        return $query->fetchAll();
    }

    public function saveData($data)
    {
        $stmt = $this->db->prepare("INSERT INTO items (name) VALUES (:name)");
        $stmt->execute(['name' => $data['name']]);

        return [
            'id' => $this->db->lastInsertId(),
            'name' => $data['name'],
        ];
    }
}
