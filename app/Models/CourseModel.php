<?php

namespace App\Models;

use Core\Database;

class CourseModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function fetchAll()
    {
        $sql = "
            SELECT courses.*, users.id, users.name AS teacher_name
            FROM courses
            INNER JOIN users ON courses.teacher_id = users.id";
        return $this->db->select($sql);
    }
    // SELECT courses.*, users.id, users.name AS teacher_name
    // FROM courses
    // INNER JOIN users ON courses.teacher_id = users.id
    public function findById($id)
    {
        $sql = "
           SELECT courses.*, users.id, users.name AS teacher_name
            FROM courses
            INNER JOIN users ON courses.teacher_id = users.id
            WHERE courses.id = ?";
        return $this->db->selectOne($sql, [$id]);
    }

    public function findByName($name)
    {
        $sql = "SELECT * FROM courses WHERE name = ?";
        echo json_encode($sql);
        return $this->db->selectOne($sql, [$name]);
    }

    // public function findByTeacherId($Teacher)
    // {
    //     $sql = "SELECT * FROM courses WHERE teacher_id = ?";
    //     return $this->db->select($sql, [$studentId]);
    // }

    public function create($data)
    {
        
        $sql = "
            INSERT INTO courses (name, description, teacher_id) 
            VALUES (:name, :description, :teacher_id)";
        return $this->db->insert($sql, $data);
    }

    public function update($id, $data)
    {
        $sql = "
            UPDATE courses 
            SET id = :id,
                name = :name, 
                description = :description, 
                teacher_id = :teacher_id, 
                updated_at = CURRENT_TIMESTAMP 
            WHERE id = :id";
        $data['id'] = $id;
        return $this->db->update($sql, $data);
    }

    // public function updateStatus($id, $status)
    // {
    //     $sql = "UPDATE payments SET status = ? WHERE id = ?";
    //     return $this->db->update($sql, [$status, $id]);
    // }

    public function delete($id)
    {
        $sql = "DELETE FROM courses WHERE id = ?";
        return $this->db->delete($sql, [$id]);
    }
}
