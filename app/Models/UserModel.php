<?php

namespace App\Models;

use Core\Database;

class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function fetchAll()
    {
        $sql = "SELECT id, name, email, role, created_at, updated_at FROM users";
        return $this->db->select($sql);
    }

    public function create($userData)
    {
        $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
        $params = [$userData['name'], $userData['email'], $userData['password'], $userData['role']];
        return $this->db->insert($sql, $params);
    }

    public function findById($id)
    {
        $sql = "SELECT id, name, email, role, created_at, updated_at FROM users WHERE id = ?";
        return $this->db->selectOne($sql, [$id]);
    }

    public function findTeacherId($id)
    {
        $sql = "SELECT id, name, email, role, created_at, updated_at FROM users WHERE id = ? AND role = 'teacher'";
        return $this->db->selectOne($sql, [$id]);
    }

    public function findStudentId($id)
    {
        $sql = "SELECT id, name, email, role, created_at, updated_at FROM users WHERE id = ? AND role = 'student'";
        return $this->db->selectOne($sql, [$id]);
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        return $this->db->selectOne($sql, [$email]);
    }

    public function update($id, $userData)
    {
        $sql = "UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?";
        $params = [$userData['name'], $userData['email'], $userData['role'], $id];
        return $this->db->update($sql, $params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id = ?";
        return $this->db->delete($sql, [$id]);
    }

    public function createAccessToken($userId, $token)
    {
        $sql = "INSERT INTO access_tokens (user_id, token) VALUES (?, ?)";
        return $this->db->insert($sql, [$userId, $token]);
    }

    public function deleteAccessToken($token)
    {
        $sql = "DELETE FROM access_tokens WHERE token = ?";
        return $this->db->delete($sql, [$token]);
    }

    public function validateAccessToken($token)
    {
        $sql = "SELECT user_id FROM access_tokens WHERE token = ?";
        return $this->db->selectOne($sql, [$token]);
    }

    public function filter(array $filters = [])
    {
        $sql = "SELECT id, name, email, role, created_at, updated_at FROM users";
        $conditions = [];
        $params = [];

        // Dynamically build the WHERE clause
        foreach ($filters as $field => $value) {
            if (is_array($value)) {
                // For array values, assume an IN clause
                $placeholders = implode(', ', array_fill(0, count($value), '?'));
                $conditions[] = "$field IN ($placeholders)";
                $params = array_merge($params, $value);
            } else {
                // For single values, assume an equality check
                $conditions[] = "$field = ?";
                $params[] = $value;
            }
        }

        // Append conditions if any
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }

        return $this->db->select($sql, $params);
    }

}