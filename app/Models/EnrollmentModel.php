<?php

namespace App\Models;

use Core\Database;
class EnrollmentModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function fetchAll()
    {
        $sql = "
            SELECT enrollments.*, users.name AS student_name,
            sections.name AS section_name
            FROM enrollments
            INNER JOIN sections ON sections.id = enrollments.section_id            
            INNER JOIN students ON students.id= enrollments.student_id
            INNER JOIN users ON users.id = students.user_id";
        return $this->db->select($sql);
    }

    public function findById($id)
    {
        $sql = "
            SELECT enrollments.*, users.name AS student_name,
             sections.name AS section_name
            FROM enrollments
            INNER JOIN sections ON sections.id = enrollments.section_id            
            INNER JOIN students ON students.id= enrollments.student_id
            INNER JOIN users ON users.id = students.user_id
            WHERE enrollments.id = ?";
        return $this->db->selectOne($sql, [$id]);
    }

    public function updateStatus($id, $status)
    {
        $sql = "UPDATE enrollments SET status = ? WHERE id = ?";
        return $this->db->update($sql, [$status, $id]);
    }

    public function create($data)
    {        
        $sql = "
            INSERT INTO enrollments (student_id, section_id, amount, status) 
            VALUES (:student_id, :section_id, :amount, :status)";
        return $this->db->insert($sql, $data);
    }

    public function update($id, $data)
    {
        $sql = "
            UPDATE enrollments 
            SET id = :id,
                student_id = :student_id, 
                section_id = :section_id, 
                amount = :amount, 
                status = :status,
                updated_at = CURRENT_TIMESTAMP 
            WHERE id = :id";
        $data['id'] = $id;
        return $this->db->update($sql, $data);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM enrollments WHERE id = ?";
        return $this->db->delete($sql, [$id]);
    }

    public function totalEnrollments()
    {
        $sql = "SELECT COUNT(*) AS total_enrollments FROM enrollments";
        return $this->db->selectOne($sql);
    }

    public function dailyEnrollmentTrends()
    {
        $sql = "
            SELECT 
                DATE(created_at) AS date, 
                COUNT(*) AS daily_count 
            FROM enrollments
            WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
            GROUP BY DATE(created_at)
            ORDER BY date ASC
        ";
        return $this->db->select($sql);
    }

    public function getStudentConfirmedSections($studentId)
{
    $sql = "
        SELECT 
            s.id AS section_id, 
            s.name AS section_name, 
            s.cost AS section_cost,
            c.id AS course_id,
            c.name AS course_name,
            c.description AS course_description,
            ch.id AS chapter_id,
            ch.name AS chapter_name,
            ch.link AS chapter_content
        FROM enrollments e
        JOIN sections s ON e.section_id = s.id
        LEFT JOIN courses c ON JSON_CONTAINS(s.course_ids, JSON_ARRAY(c.id))
        LEFT JOIN chapters ch ON ch.course_id = c.id
        WHERE e.student_id = :student_id
        AND e.status = 'confirmed'
        ORDER BY s.id, c.id, ch.id
    ";

    $params = [':student_id' => $studentId];
    $data = $this->db->select($sql, $params);

    // Process the raw data into the desired structure
    $sections = [];
    foreach ($data as $row) {
        $sectionId = $row['section_id'];
        $courseId = $row['course_id'];
        $chapterId = $row['chapter_id'];

        // Initialize section if not already present
        if (!isset($sections[$sectionId])) {
            $sections[$sectionId] = [
                'section_id' => $sectionId,
                'section_name' => $row['section_name'],
                'section_cost' => $row['section_cost'],
                'courses' => []
            ];
        }

        // Initialize course if not already present
        if ($courseId !== null && !isset($sections[$sectionId]['courses'][$courseId])) {
            $sections[$sectionId]['courses'][$courseId] = [
                'id' => $courseId,
                'name' => $row['course_name'],
                'description' => $row['course_description'],
                'chapters' => []
            ];
        }

        // Add chapter to course if applicable
        if ($chapterId !== null) {
            $sections[$sectionId]['courses'][$courseId]['chapters'][] = [
                'id' => $chapterId,
                'name' => $row['chapter_name'],
                'content' => $row['chapter_content']
            ];
        }
    }

    // Convert courses associative array to indexed array
    foreach ($sections as &$section) {
        $section['courses'] = array_values($section['courses']);
    }

    return array_values($sections);
}



    public function getStudentEnrollmentStatus($studentId)
    {
        $sql = "
            SELECT 
                e.id AS enrollment_id,
                s.id AS section_id,
                s.name AS section_name,
                e.status AS enrollment_status
            FROM enrollments e
            JOIN sections s ON e.section_id = s.id
            WHERE e.student_id = :student_id
        ";

        $params = [':student_id' => $studentId];

        return $this->db->select($sql, $params);

    }


}
