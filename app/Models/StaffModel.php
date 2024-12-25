<?php

namespace App\Models;
use PDO;
use Core\Database;

class StaffModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function fetchData()
    {
        $query = $this->db->query("SELECT * FROM stafftb");
        return $query->fetchAll();
    }

    public function saveData($data)
    {
        $stmt = $this->db->prepare("INSERT INTO stafftb (StaffName,Username,Address,PhoneNo,Email,Password,StaffPicture,RoleID) VALUES (:StaffName,:Username,:Address,:PhoneNo,:Email,:Password,:StaffPicture,:RoleID)");
        $stmt->execute(['StaffName' => $data['StaffName'],'Username' => $data['Username'], 'Address' => $data['Address'], 'PhoneNo' => $data['PhoneNo'],'Email' => $data['Email'], 'Password' => $data['Password'], 'StaffPicture' => $data['StaffPicture'],'RoleID' => $data['RoleID'] ]);

        return [
            'StaffID' => $this->db->lastInsertId(),
            'StaffName' => $data['StaffName'],
            'Username' => $data['Username'],
            'Address' => $data['Address'],
            'PhoneNo' => $data['PhoneNo'],
            'Email' => $data['Email'],
            'Password' => $data['Password'],
            'StaffPicture' => $data['StaffPicture'],
            'RoleID' => $data['RoleID'],
        ];
    }
    public function updateData($id, $data)
    {
        // Example code to update data in the database
        $stmt = $this->db->prepare("UPDATE stafftb SET name = :name WHERE id = :id");
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function deleteData($id)
    {
        $result = false;
        try {
             // Example code to delete data from the database
            $stmt = $this->db->prepare("DELETE FROM stafftb WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $result = $stmt->execute();
        } catch (\Throwable $th) {
            echo json_encode($th->getMessage());
        }
        return $result;
       
    }
}
