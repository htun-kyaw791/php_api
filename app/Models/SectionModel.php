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
            SELECT sections.id AS section_id, sections.name AS section_name, sections.course_ids, sections.cost, sections.start_date,  sections.end_date,
                   courses.id AS course_id, courses.name AS course_name, courses.image AS course_image, courses.description AS course_descriptiom, courses.teacher_id AS teacher_id
            FROM sections
            LEFT JOIN courses ON JSON_CONTAINS(sections.course_ids, JSON_ARRAY(courses.id))
        ";

        $data = $this->db->select($sql);

        $sections = [];
        foreach ($data as $row) {
            $sectionId = $row['section_id'];

            if (!isset($sections[$sectionId])) {
                $sections[$sectionId] = [
                    'id' => $row['section_id'],
                    'name' => $row['section_name'],
                    'courses' => [],
                    'cost' => $row['cost'],
                    'start_date' => $row['start_date'],
                    'end_date' => $row['end_date'],
                ];
            }

            if ($row['course_id'] !== null) {
                $sections[$sectionId]['courses'][] = [
                    'id' => $row['course_id'],
                    'name' => $row['course_name'],
                    'image' => $row['course_image'],
                    'description' => $row['course_descriptiom'],
                    'teacher_id' => $row['teacher_id'],
                ];
            }
        }

        return array_values($sections);
    }

    public function findById($id)
    {
        $sql = "
            SELECT sections.id AS section_id, sections.name AS section_name, sections.course_ids, sections.cost, sections.start_date,  sections.end_date,
                   courses.id AS course_id, courses.name AS course_name, courses.image AS course_image, courses.description AS course_descriptiom, courses.teacher_id AS teacher_id
            FROM sections
            LEFT JOIN courses ON JSON_CONTAINS(sections.course_ids, JSON_ARRAY(courses.id))
            WHERE sections.id = ?
        ";

        $data = $this->db->select($sql, [$id]);

        if (empty($data)) {
            return null;
        }

        $section = [
            'id' => $data[0]['section_id'],
            'name' => $data[0]['section_name'],
            'cost' => $data[0]['cost'],
            'start_date' => $data[0]['start_date'],
            'end_date' => $data[0]['end_date'],
            'courses' => [],
        ];

        foreach ($data as $row) {
            if ($row['course_id'] !== null) {
                $section['courses'][] = [
                    'id' => $row['course_id'],
                    'name' => $row['course_name'],
                    'image' => $row['course_image'],
                    'description' => $row['course_descriptiom'],
                    'teacher_id' => $row['teacher_id'],
                ];
            }
        }

        return $section;
    }

    public function findByName($name)
    {
        $sql = "
            SELECT sections.id AS section_id, sections.name AS section_name, sections.course_ids, sections.cost, sections.start_date,  sections.end_date,
                   courses.id AS course_id, courses.name AS course_name, courses.image AS course_image, courses.description AS course_descriptiom, courses.teacher_id AS teacher_id
            FROM sections
            LEFT JOIN courses ON JSON_CONTAINS(sections.course_ids, JSON_ARRAY(courses.id))
            WHERE sections.name = ?
        ";

        $data = $this->db->select($sql, [$name]);

        if (empty($data)) {
            return null;
        }

        $section = [
            'id' => $data[0]['section_id'],
            'name' => $data[0]['section_name'],
            'cost' => $data[0]['cost'],
            'start_date' => $data[0]['start_date'],
            'end_date' => $data[0]['end_date'],
            'courses' => [],
        ];

        foreach ($data as $row) {
            if ($row['course_id'] !== null) {
                $section['courses'][] = [
                    'id' => $row['course_id'],
                    'name' => $row['course_name'],
                    'image' => $row['course_image'],
                    'description' => $row['course_descriptiom'],
                    'teacher_id' => $row['teacher_id'],
                ];
            }
        }

        return $section;
    }

    public function create($data)
    {
        $sql = "
            INSERT INTO sections (name, start_date, end_date, cost, course_ids) 
            VALUES (:name, :start_date, :end_date, :cost, :course_ids)
        ";
        return $this->db->insert($sql, $data);
    }

    public function update($id, $data)
    {
        $sql = "
            UPDATE sections 
            SET name = :name, 
                start_date = :start_date, 
                end_date = :end_date, 
                cost = :cost, 
                course_ids = :course_ids, 
                updated_at = CURRENT_TIMESTAMP 
            WHERE id = :id
        ";
        $data['id'] = $id;
        return $this->db->update($sql, $data);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM sections WHERE id = ?";
        return $this->db->delete($sql, [$id]);
    }

    public function withEnrollmentCount()
    {
        $sql = "
            SELECT 
                s.id, 
                s.name, 
                s.start_date, 
                s.end_date, 
                s.cost, 
                COUNT(e.id) AS enrollment_count 
            FROM sections s
            LEFT JOIN enrollments e ON s.id = e.section_id
            GROUP BY s.id
        ";
        return $this->db->select($sql);
    }

    public function sectionWiseRevenue()
    {
        $sql = "
            SELECT 
                s.id, 
                s.name, 
                SUM(e.amount) AS total_revenue 
            FROM sections s
            LEFT JOIN enrollments e ON s.id = e.section_id
            GROUP BY s.id
        ";
        return $this->db->select($sql);
    }

}
