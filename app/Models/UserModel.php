<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'role'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null; // No updated_at field in users table
    
    protected $validationRules = [
        'username' => 'required|max_length[50]|is_unique[users.username]',
        'password' => 'required|min_length[8]',
        'role' => 'required|in_list[admin,voter]'
    ];
    
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];
    
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}
