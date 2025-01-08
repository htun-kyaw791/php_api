<?php

namespace App\Models;

use Core\Database;

class ChapterModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function fetchAll()
    {
        $sql = "
           SELECT chapters.*,courses.name As course_name,
            users.id AS teacher_id, users.name AS teacher_name
            FROM chapters
            INNER JOIN courses ON courses.id = chapters.course_id
            INNER JOIN users ON courses.teacher_id = users.id";
        return $this->db->select($sql);
    }
    // SELECT courses.*, users.id, users.name AS teacher_name
    // FROM courses
    // INNER JOIN users ON courses.teacher_id = users.id
    public function findById($id)
    {
        $sql = "
            SELECT chapters.*,courses.name As course_name,
            users.id AS teacher_id, users.name AS teacher_name
            FROM chapters
            INNER JOIN courses ON courses.id = chapters.course_id
            INNER JOIN users ON courses.teacher_id = users.id
            WHERE chapters.id = ?";
        return $this->db->selectOne($sql, [$id]);
    }
    public function findByTeacherId($teacher_id)
    {
        $sql = "
            SELECT chapters.*,courses.name As course_name,
            users.id AS teacher_id, users.name AS teacher_name
            FROM chapters
            INNER JOIN courses ON courses.id = chapters.course_id
            INNER JOIN users ON courses.teacher_id = users.id
            WHERE courses.teacher_id = ?";
        return $this->db->selectOne($sql, [$teacher_id]);
    }


    public function findByName($name)
    {
        $sql = "SELECT * FROM chapters WHERE name = ?";
        return $this->db->selectOne($sql, [$name]);
    }

    // public function findByChapterId($course_id)
    // {
    //     $sql = "SELECT * FROM chapters WHERE course_id = ?";
    //     return $this->db->select($sql, [$course_id]);
    // }
    public function create($data)
    {
        
        $sql = "
            INSERT INTO chapters (name, course_id, link) 
            VALUES (:name, :course_id, :link)";
        return $this->db->insert($sql, $data);
    }

    // public function update($id, $data)
    // {
    //     $sql = "
    //         UPDATE chapters 
    //         SET id = :id,
    //             name = :name, 
    //             course_id = :course_id
    //         WHERE id = :id";
    //     $data['id'] = $id;
    //     return $this->db->update($sql, $data);
    // }
    public function update($id, $data)
    {
        $sql = "UPDATE chapters SET ";
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
        if (!empty($data['link'])) {
            $fields[] = "link = :link";
            $params['link'] = $data['link'];
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
        $sql = "DELETE FROM chapters WHERE id = ?";
        return $this->db->delete($sql, [$id]);
    }
}
