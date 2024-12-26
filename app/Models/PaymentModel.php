<?php

namespace App\Models;

use Core\Database;

class PaymentModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function fetchAll()
    {
        $sql = "
            SELECT payments.*, students.nrc_id, users.name AS student_name 
            FROM payments
            INNER JOIN students ON payments.student_id = students.id
            INNER JOIN users ON students.user_id = users.id";
        return $this->db->select($sql);
    }

    public function findById($id)
    {
        $sql = "
            SELECT payments.*, students.nrc_id, users.name AS student_name 
            FROM payments
            INNER JOIN students ON payments.student_id = students.id
            INNER JOIN users ON students.user_id = users.id
            WHERE payments.id = ?";
        return $this->db->selectOne($sql, [$id]);
    }

    public function findByStudentId($studentId)
    {
        $sql = "SELECT * FROM payments WHERE student_id = ?";
        return $this->db->select($sql, [$studentId]);
    }

    public function create($data)
    {
        $sql = "
            INSERT INTO payments (student_id, section_id, amount, evidence_image, status) 
            VALUES (:student_id, :section_id, :amount, :evidence_image, :status)";
        return $this->db->insert($sql, $data);
    }

    public function update($id, $data)
    {
        $sql = "
            UPDATE payments 
            SET student_id = :student_id, 
                section_id = :section_id, 
                amount = :amount, 
                evidence_image = :evidence_image, 
                status = :status, 
                updated_at = CURRENT_TIMESTAMP 
            WHERE id = :id";
        $data['id'] = $id;
        return $this->db->update($sql, $data);
    }

    public function updateStatus($id, $status)
    {
        $sql = "UPDATE payments SET status = ? WHERE id = ?";
        return $this->db->update($sql, [$status, $id]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM payments WHERE id = ?";
        return $this->db->delete($sql, [$id]);
    }
}
