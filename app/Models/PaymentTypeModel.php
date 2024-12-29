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
        echo $id;
        echo json_encode($data);
        $sql = "
            UPDATE payment_types 
            SET paymenttypename =        :paymenttypename, 
                paymenttypeimage = :paymenttypeimage,  
                updated_at = CURRENT_TIMESTAMP 
            WHERE  paymenttypeid = :id";
        $data['id'] = $id;
        return $this->db->update($sql, $data);
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
