<?php

namespace App\Models;

use Core\Database;

class SubjectModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function fetchAll()
    {
        $sql = "
           SELECT subjects.*,courses.name As course_name,
            users.id AS teacher_id, users.name AS teacher_name
            FROM subjects
            INNER JOIN courses ON courses.id = subjects.course_id
            INNER JOIN users ON courses.teacher_id = users.id";
        return $this->db->select($sql);
    }
    // SELECT courses.*, users.id, users.name AS teacher_name
    // FROM courses
    // INNER JOIN users ON courses.teacher_id = users.id
    public function findById($id)
    {
        $sql = "
            SELECT subjects.*,courses.name As course_name,
            users.id AS teacher_id, users.name AS teacher_name
            FROM subjects
            INNER JOIN courses ON courses.id = subjects.course_id
            INNER JOIN users ON courses.teacher_id = users.id
            WHERE subjects.id = ?";
        return $this->db->selectOne($sql, [$id]);
    }
    public function findByTeacherId($teacher_id)
    {
        $sql = "
            SELECT subjects.*,courses.name As course_name,
            users.id AS teacher_id, users.name AS teacher_name
            FROM subjects
            INNER JOIN courses ON courses.id = subjects.course_id
            INNER JOIN users ON courses.teacher_id = users.id
            WHERE courses.teacher_id = ?";
        return $this->db->selectOne($sql, [$teacher_id]);
    }


    public function findByName($name)
    {
        $sql = "SELECT * FROM subjects WHERE name = ?";
        return $this->db->selectOne($sql, [$name]);
    }

    // public function findBySubjectId($course_id)
    // {
    //     $sql = "SELECT * FROM subjects WHERE course_id = ?";
    //     return $this->db->select($sql, [$course_id]);
    // }
    public function create($data)
    {
        
        $sql = "
            INSERT INTO subjects (name, course_id) 
            VALUES (:name, :course_id)";
        return $this->db->insert($sql, $data);
    }

    // public function update($id, $data)
    // {
    //     $sql = "
    //         UPDATE subjects 
    //         SET id = :id,
    //             name = :name, 
    //             course_id = :course_id
    //         WHERE id = :id";
    //     $data['id'] = $id;
    //     return $this->db->update($sql, $data);
    // }
    public function update($id, $data)
    {
        $sql = "UPDATE subjects SET ";
        $fields = [];
        $params = [];

        if (!empty($data['name'])) {
            $fields[] = "name = :name";
            $params['name'] = $data['name'];
        }
        if (!empty($data['course_id'])) {
            $fields[] = "course_id = :course_id";
            $params['course_id'] = $data['course_id'];
        }

        $sql .= implode(", ", $fields) . " WHERE id = :id";
        $params['id'] = $id;

        return $this->db->update($sql, $params);
    }

    // public function updateStatus($id, $status)
    // {
    //     $sql = "UPDATE payments SET status = ? WHERE id = ?";
    //     return $this->db->update($sql, [$status, $id]);
    // }

    public function delete($id)
    {
        $sql = "DELETE FROM subjects WHERE id = ?";
        return $this->db->delete($sql, [$id]);
    }
}
