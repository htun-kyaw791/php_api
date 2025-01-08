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
            SELECT payments.*, students.nrc_id, users.name AS student_name, 
            payment_types.paymenttypename, payment_types.paymenttypeimage,
            enrollments.status
            FROM payments
            INNER JOIN payment_types ON payment_types.paymenttypeid = payments.payment_type_id
            INNER JOIN enrollments ON enrollments.id = payments.enrollment_id
            INNER JOIN students ON payments.student_id = students.id
            INNER JOIN users ON students.user_id = users.id";
        return $this->db->select($sql);
    }

    public function findById($id)
    {
        $sql = "
            SELECT payments.*, students.nrc_id, users.name AS student_name, payment_types.paymenttypename, payment_types.paymenttypeimage
            FROM payments
            INNER JOIN payment_types ON payment_types.paymenttypeid = payments.payment_type_id
            INNER JOIN students ON payments.student_id = students.id
            INNER JOIN users ON students.user_id = users.id
            WHERE payments.id = ?";
        return $this->db->selectOne($sql, [$id]);
    }


    public function findByStudentId($student_id)
    {
        // $sql = "
        //     SELECT payments.*, students.nrc_id, users.name AS student_name, payment_types.paymenttypename, payment_types.paymenttypeimage
        //     FROM payments
        //     INNER JOIN payment_types ON payment_types.paymenttypeid = payments.payment_type_id
        //     INNER JOIN students ON payments.student_id = students.id
        //     INNER JOIN users ON students.user_id = users.id
        //     WHERE payments.student_id= ?";
        // return $this->db->selectOne($sql, [$id]);
        $sql = "SELECT * FROM payments WHERE student_id = ?";
        return $this->db->select($sql, [$student_id]);
    }

    public function create($data)
    {
        
        $sql = "
            INSERT INTO payments (payment_type_id,student_id, enrollment_id, amount, evidence_image, status) 
            VALUES (:payment_type_id, :student_id, :enrollment_id, :amount, :evidence_image, :status)";
        return $this->db->insert($sql, $data);
    }

    public function update($id, $data)
    {
        $sql = "
            UPDATE payments 
            SET payment_type_id = :payment_type_id,
                student_id = :student_id, 
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

    public function getPaymentSummary()
    {
        $sql = "
            SELECT 
                SUM(amount) AS total_revenue,
                COUNT(*) AS total_payments,
                SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) AS pending_payments,
                SUM(CASE WHEN status = 'confirmed' THEN 1 ELSE 0 END) AS confirmed_payments
            FROM payments
        ";
        return $this->db->select($sql);
    }

    // Revenue per payment type
    public function revenueByPaymentType()
    {
        $sql = "
            SELECT 
                pt.paymenttypename AS payment_type,
                SUM(p.amount) AS total_revenue
            FROM payments p
            INNER JOIN payment_types pt ON p.payment_type_id = pt.paymenttypeid
            GROUP BY pt.paymenttypename
        ";
        return $this->db->select($sql);
    }

}
