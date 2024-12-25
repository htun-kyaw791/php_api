<?php

namespace App\Models;
use PDO;
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
    public function updateData($id, $data)
    {
        // Example code to update data in the database
        $stmt = $this->db->prepare("UPDATE items SET name = :name WHERE id = :id");
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function deleteData($id)
    {
        $result = false;
        try {
             // Example code to delete data from the database
            $stmt = $this->db->prepare("DELETE FROM items WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $result = $stmt->execute();
        } catch (\Throwable $th) {
            echo json_encode($th->getMessage());
        }
        return $result;
       
    }
}
