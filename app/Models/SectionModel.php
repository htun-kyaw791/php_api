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

    public function getTeacherStudentReport($teacherId)
    {
        $sql = "
            SELECT 
                s.id AS section_id, 
                s.name AS section_name,
                s.cost AS section_cost,
                u.id AS student_id,
                u.name AS student_name,
                u.email AS student_email,
                c.id AS course_id,
                c.name AS course_name,
                c.description AS course_description,
                ch.id AS chapter_id,
                ch.name AS chapter_name,
                ch.link AS chapter_content
            FROM sections s
            JOIN enrollments e ON s.id = e.section_id
            JOIN students st ON e.student_id = st.id
            JOIN users u ON st.user_id = u.id
            LEFT JOIN courses c ON JSON_CONTAINS(s.course_ids, JSON_ARRAY(c.id))
            LEFT JOIN chapters ch ON ch.course_id = c.id
            WHERE c.teacher_id = :teacher_id
            AND e.status = 'confirmed'
            ORDER BY s.id, u.id, c.id, ch.id
        ";

        $params = [':teacher_id' => $teacherId];
        $data = $this->db->select($sql, $params);
        

        // Process the raw data into the desired structure
        $sections = [];
        foreach ($data as $row) {
            $sectionId = $row['section_id'];
            $studentId = $row['student_id'];
            $courseId = $row['course_id'];
            $chapterId = $row['chapter_id'];

            // Initialize section if not already present
            if (!isset($sections[$sectionId])) {
                $sections[$sectionId] = [
                    'id' => $sectionId,
                    'name' => $row['section_name'],
                    'students' => []
                ];
            }

            // Initialize student if not already present
            if (!isset($sections[$sectionId]['students'][$studentId])) {
                $sections[$sectionId]['students'][$studentId] = [
                    'id' => $studentId,
                    'name' => $row['student_name'],
                    'email' => $row['student_email'],
                    'courses' => []
                ];
            }

            // Initialize course if not already present
            if ($courseId !== null && !isset($sections[$sectionId]['students'][$studentId]['courses'][$courseId])) {
                $sections[$sectionId]['students'][$studentId]['courses'][$courseId] = [
                    'id' => $courseId,
                    'name' => $row['course_name'],
                    'description' => $row['course_description'],
                    'chapters' => []
                ];
            }

            // Add chapter to course if applicable
            if ($chapterId !== null) {
                $sections[$sectionId]['students'][$studentId]['courses'][$courseId]['chapters'][] = [
                    'id' => $chapterId,
                    'name' => $row['chapter_name'],
                    'content' => $row['chapter_content']
                ];
            }
        }

        // Convert associative arrays to indexed arrays
        foreach ($sections as &$section) {
            $section['students'] = array_values($section['students']);
            foreach ($section['students'] as &$student) {
                $student['courses'] = array_values($student['courses']);
            }
        }

        return array_values($sections);
    }


}
