<?php

namespace App\Models;
use PDO;
use Core\Database;
class SectionModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function fetchAll()
    {
        $sql = "
            SELECT sections.*, courses.id AS course_id, courses.name AS course_name
            FROM sections
            INNER JOIN courses ON sections.course_ids = courses.id";
        return $this->db->select($sql);
    }
    public function findById($id)
    {
        $sql = "
           SELECT sections.*, courses.id, courses.name AS course_name
            FROM sections
            INNER JOIN courses ON sections.course_ids = courses.id
            WHERE sections.id = ?";
        return $this->db->selectOne($sql, [$id]);
    }

    public function findByName($name)
    {
        $sql = "SELECT * FROM sections WHERE name = ?";
        return $this->db->selectOne($sql, [$name]);
    }
    public function create($data)
    {
        
        $sql = "
            INSERT INTO sections (name, start_date, end_date, cost, course_ids) 
            VALUES (:name, :start_date, :end_date, :cost, :course_ids)";
        return $this->db->insert($sql, $data);
    }

    public function update($id, $data)
    {
        $sql = "
            UPDATE sections 
            SET id = :id,
                name = :name, 
                start_date = :start_date, 
                end_date = :end_date, 
                cost = :cost, 
                course_ids = :course_ids, 
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
        $sql = "DELETE FROM sections WHERE id = ?";
        return $this->db->delete($sql, [$id]);
    }
}
