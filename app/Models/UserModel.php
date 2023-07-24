<?php

// app/Models/UserModel.php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'email', 'password'];

    // Method to insert a new user and return the inserted user's ID
    public function insertUserAndGetId(array $data)
    {
        $this->insert($data);
        return $this->getInsertID();
    }
}
