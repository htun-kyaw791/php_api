<?php

namespace App\Models;
use PDO;
use Core\Database;

class StudentModel
{
    
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function create($studentData)
    {
        $sql = "INSERT INTO students (nrc_id, date_of_birth, gender, phone_number, address, guardian_name, guardian_contact, user_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $params = [
            $studentData['nrc_id'],
            $studentData['date_of_birth'],
            $studentData['gender'],
            $studentData['phone_number'],
            $studentData['address'],
            $studentData['guardian_name'],
            $studentData['guardian_contact'],
            $studentData['user_id']
        ];
        return $this->db->insert($sql, $params);
    }
    
    public function findById($id)
    {
        $sql = "
            SELECT 
                students.id AS student_id, 
                students.nrc_id, 
                students.date_of_birth, 
                students.gender, 
                students.phone_number, 
                students.address, 
                students.guardian_name, 
                students.guardian_contact, 
                students.user_id, 
                students.created_at, 
                students.updated_at,
                students.user_id AS user_id, 
                users.name, 
                users.email, 
                users.role
            FROM students
            INNER JOIN users ON students.user_id = users.id
            WHERE students.id = ?";
            
        return $this->db->selectOne($sql, [$id]);
    }

    public function fetchAll()
    {
        $sql = "
            SELECT 
                students.id AS student_id, 
                students.nrc_id, 
                students.date_of_birth, 
                students.gender, 
                students.phone_number, 
                students.address, 
                students.guardian_name, 
                students.guardian_contact, 
                students.user_id, 
                students.created_at, 
                students.updated_at,
                students.user_id AS user_id, 
                users.name, 
                users.email, 
                users.role
            FROM students
            INNER JOIN users ON students.user_id = users.id";
            
        return $this->db->select($sql);
    }

    
    public function update($id, $studentData)
    {
        $sql = "UPDATE students 
                SET nrc_id = ?, date_of_birth = ?, gender = ?, phone_number = ?, address = ?, guardian_name = ?, guardian_contact = ?, user_id = ? 
                WHERE id = ?";
        $params = [
            $studentData['nrc_id'],
            $studentData['date_of_birth'],
            $studentData['gender'],
            $studentData['phone_number'],
            $studentData['address'],
            $studentData['guardian_name'],
            $studentData['guardian_contact'],
            $studentData['user_id'],
            $id
        ];
        return $this->db->update($sql, $params);
    }
    
    public function delete($id)
    {
        $sql = "DELETE FROM students WHERE id = ?";
        return $this->db->delete($sql, [$id]);
    }
    
}
