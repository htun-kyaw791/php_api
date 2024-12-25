<?php

namespace App\Models;
use PDO;
use Core\Database;

class StaffRoleModel
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function fetchData()
    {
        $query = $this->db->query("SELECT * FROM staffrole");
        return $query->fetchAll();
    }

    public function saveData($data)
    {
        $stmt = $this->db->prepare("INSERT INTO staffrole (Rolename) VALUES (:Rolename)");
        $stmt->execute(['Rolename' => $data['Rolename']]);

        return [
            'RoleID' => $this->db->lastInsertRoleID(),
            'Rolename' => $data['Rolename'],
        ];
    }
    public function updateData($RoleID, $data)
    {
        // Example code to update data in the database
        $stmt = $this->db->prepare("UPDATE staffrole SET name = :name WHERE RoleID = :RoleID");
        $stmt->bindParam(':Rolename', $data['Rolename']);
        $stmt->bindParam(':RoleID', $RoleID, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function deleteData($RoleID)
    {
        $result = false;
        try {
             // Example code to delete data from the database
            $stmt = $this->db->prepare("DELETE FROM staffrole WHERE RoleID = :RoleID");
            $stmt->bindParam(':RoleID', $RoleID, PDO::PARAM_INT);
            $result = $stmt->execute();
        } catch (\Throwable $th) {
            echo json_encode($th->getMessage());
        }
        return $result;
       
    }
}
