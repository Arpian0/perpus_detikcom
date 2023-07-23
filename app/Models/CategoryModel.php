<?php

// app/Models/CategoryModel.php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];

    public function getCategories()
    {
        return $this->findAll();
    }

    public function getCategory($id)
    {
        return $this->find($id);
    }

    public function insertCategory($data)
    {
        return $this->insert($data);
    }

    public function updateCategory($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteCategory($id)
    {
        return $this->delete($id);
    }
}
