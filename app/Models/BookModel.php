<?php

// app/Models/BookModel.php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'category_id', 'description', 'quantity', 'book_file', 'book_cover'];

    public function getBooks()
    {
        return $this->findAll();
    }

    public function getBook($id)
    {
        return $this->find($id);
    }

    public function insertBook($data)
    {
        return $this->insert($data);
    }

    public function updateBook($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteBook($id)
    {
        return $this->delete($id);
    }

    public function getBooksWithCategory()
    {
        return $this->select('books.*, categories.name')
            ->join('categories', 'categories.id = books.category_id')
            ->get()
            ->getResultArray();
    }
}
