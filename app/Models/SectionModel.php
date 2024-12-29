<?php

namespace App\Models;
use Core\Database;
defined('BASEPATH') OR exit('No direct script access allowed');
class SectionModel extends CI_Model {
    public function getSectionById($section_id) {
        $query = $this->db->get_where('sections', ['id' => $section_id]);
        return $query->row_array();
    }
}
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
    // SELECT courses.*, users.id, users.name AS teacher_name
    // FROM courses
    // INNER JOIN users ON courses.teacher_id = users.id
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
