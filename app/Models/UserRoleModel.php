<?php

// app/Models/UserRoleModel.php

namespace App\Models;

use CodeIgniter\Model;

class UserRoleModel extends Model
{
    protected $table = 'user_roles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'role'];

    public function hasAdminRole($user_id)
    {
        $userRole = $this->where('user_id', $user_id)
            ->where('role', 'admin')
            ->first();

        return ($userRole !== null);
    }

    // Method untuk mengambil hak akses berdasarkan ID pengguna
    public function getRoleByUserId($user_id)
    {
        return $this->where('user_id', $user_id)->first();
    }

    // Method untuk mengatur hak akses baru untuk pengguna
    public function insertUserRole($data)
    {
        return $this->insert($data);
    }

    // Method untuk memperbarui hak akses pengguna
    public function updateUserRole($user_id, $data)
    {
        return $this->where('user_id', $user_id)->update($data);
    }

    // Method untuk menghapus hak akses pengguna
    public function deleteUserRole($user_id)
    {
        return $this->where('user_id', $user_id)->delete();
    }
}
