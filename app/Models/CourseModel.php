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
            SELECT courses.*,
            users.name AS teacher_name
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
           SELECT courses.*, 
            users.name AS teacher_name
            FROM courses
            INNER JOIN users ON courses.teacher_id = users.id
            WHERE courses.id = ?";
        return $this->db->selectOne($sql, [$id]);
    }
            
    public function findByTeacherId($teacher_id)
    {
        $sql = "
           SELECT co.id,co.name,
           GROUP_CONCAT(JSON_OBJECT('id', sub.id, 'name', sub.name)) AS sub_objects
            FROM courses co
            WHERE co.teacher_id = ?
            GROUP BY co.id, co.name";
            // Cast result to an object
$result = (object) $this->db->selectOne($sql, [$teacher_id]);

// Decode sub_objects and assign it to the object
$result->sub_objects = json_decode($result->sub_objects);

return $result;

    }
    public function findByName($name)
    {
        $sql = "SELECT * FROM courses WHERE name = ?";
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
            INSERT INTO courses (name,image, description, teacher_id) 
            VALUES (:name, :image, :description, :teacher_id)";
        return $this->db->insert($sql, $data);
    }

    public function update($id, $data)
    {
        $sql = "
            UPDATE courses 
            SET id = :id,
                name = :name,
                image= :image, 
                description = :description, 
                teacher_id = :teacher_id, 
                updated_at = CURRENT_TIMESTAMP 
            WHERE id = :id";
        $data['id'] = $id;
        return $this->db->update($sql, $data);
    }

   

    public function delete($id)
    {
        $sql = "DELETE FROM courses WHERE id = ?";
        return $this->db->delete($sql, [$id]);
    }

    public function getPopularCourses()
    {
        $sql = "
            SELECT 
                c.id, 
                c.name, 
                COUNT(e.id) AS enrollment_count
            FROM courses c
            LEFT JOIN sections s ON JSON_CONTAINS(s.course_ids, JSON_QUOTE(c.id))
            LEFT JOIN enrollments e ON s.id = e.section_id
            GROUP BY c.id
            ORDER BY enrollment_count DESC
            LIMIT 5
        ";
        return $this->db->select($sql);
    }

}
