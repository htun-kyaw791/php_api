<?php

namespace App\Models;

use Core\Database;

class PaymentTypeModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function fetchAll()
    {
        $sql = "SELECT paymenttypeid, paymenttypename, paymenttypeimage, created_at, updated_at FROM payment_types";
        return $this->db->select($sql);
    }

    public function create($data)
    {
        $sql = "
            INSERT INTO payment_types ( paymenttypename, paymenttypeimage) 
            VALUES ( :paymenttypename, :paymenttypeimage)";
        return $this->db->insert($sql, $data);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE payment_types SET ";
        $fields = [];
        $params = [];

        if (!empty($data['paymenttypename'])) {
            $fields[] = "paymenttypename = :paymenttypename";
            $params['paymenttypename'] = $data['paymenttypename'];
        }
        if (!empty($data['paymenttypeimage'])) {
            $fields[] = "paymenttypeimage = :paymenttypeimage";
            $params['paymenttypeimage'] = $data['paymenttypeimage'];
        }

        $fields[] = "updated_at = CURRENT_TIMESTAMP";
        $sql .= implode(", ", $fields) . " WHERE paymenttypeid = :id";
        $params['id'] = $id;

        return $this->db->update($sql, $params);
    }

    public function findPaymentTypeId($id)
    {
        $sql = "SELECT paymenttypeid, paymenttypename, paymenttypeimage, created_at, updated_at FROM payment_types WHERE paymenttypeid = ? ";
        return $this->db->selectOne($sql, [$id]);
    }

    
    public function delete($id)
    {
        $sql = "DELETE FROM payment_types WHERE paymenttypeid = ?";
        return $this->db->delete($sql, [$id]);
    }
    
}
