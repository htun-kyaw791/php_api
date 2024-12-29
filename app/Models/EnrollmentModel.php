<?php

namespace App\Models;

use Core\Database;
defined('BASEPATH') OR exit('No direct script access allowed');

class EnrollmentModel extends CI_Model {
    public function saveEnrollment($data) {
        return $this->db->insert('enrollments', $data);
    }
}
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
            SELECT enrollments.*, users.id AS student_id, users.name AS student_name,
            sections.id AS section_id, sections.name AS section_name
            FROM enrollments
            INNER JOIN sections ON sections.id = enrollments.section_id            
            INNER JOIN students ON students.id= enrollments.student_id
            INNER JOIN users ON users.id = students.user_id";
        return $this->db->select($sql);
    }

    public function findById($id)
    {
        $sql = "
            SELECT enrollments.*, users.id AS student_id, users.name AS student_name,
            sections.id AS section_id, sections.name AS section_name
            FROM enrollments
            INNER JOIN sections ON sections.id = enrollments.section_id            
            INNER JOIN students ON students.id= enrollments.student_id
            INNER JOIN users ON users.id = students.user_id
            WHERE enrollments.id = ?";
        return $this->db->selectOne($sql, [$id]);
    }

    // public function findByStudentId($studentId)
    // {
    //     $sql = "SELECT * FROM enrollments WHERE student_id = ?";
    //     return $this->db->select($sql, [$studentId]);
    // }

    public function create($data)
    {        
        $sql = "
            INSERT INTO enrollments (student_id, section_id, amount, payment_id) 
            VALUES (:student_id, :section_id, :amount, :payment_id)";
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
}
