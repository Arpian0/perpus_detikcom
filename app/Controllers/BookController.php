<?php

// app/Controllers/BookController.php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\CategoryModel;
use App\Models\UserRoleModel;
use CodeIgniter\Controller;

class BookController extends Controller
{
    public function index()
    {
        // Load session helper
        helper('session');

        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->getCategories();

        // Get the selected category ID from the form submission
        $category_id = $this->request->getGet('category_id');

        $bookModel = new BookModel();

        if ($category_id) {
            // Filter books by the selected category
            $data['selected_category'] = $categoryModel->getCategory($category_id);
            $data['books'] = $bookModel->getBooksWithCategory($category_id);
        } else {
            // If no category is selected, show all books
            $data['selected_category'] = null;
            $data['books'] = $bookModel->getBooksWithCategory();
        }

        // Check if user is admin, and set $is_admin variable accordingly
        $isAdmin = $this->isAdmin();
        $data['is_admin'] = $isAdmin;

        return view('books/index', $data);
    }

    public function create()
    {
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->getCategories();

        return view('books/create', $data);
    }

    public function store()
    {
        $bookModel = new BookModel();

        if ($this->request->getMethod() === 'post' && $this->validate($this->validationRules())) {
            // Meng-handle file buku dan cover
            $bookFile = $this->request->getFile('book_file');
            $bookCover = $this->request->getFile('book_cover');

            $data = [
                'title' => $this->request->getPost('title'),
                'category_id' => $this->request->getPost('category_id'),
                'description' => $this->request->getPost('description'),
                'quantity' => $this->request->getPost('quantity'),
            ];

            if ($bookFile->isValid() && !$bookFile->hasMoved()) {
                $newBookFile = $bookFile->getRandomName();
                $bookFile->move('./uploads', $newBookFile);
                $data['book_file'] = $newBookFile;
            }

            if ($bookCover->isValid() && !$bookCover->hasMoved()) {
                $newBookCover = $bookCover->getRandomName();
                $bookCover->move('./uploads', $newBookCover);
                $data['book_cover'] = $newBookCover;
            }

            $bookModel->insert($data);

            return redirect()->to('/books')->with('success', 'Buku berhasil ditambahkan.');
        } else {
            $categoryModel = new CategoryModel();
            $data['categories'] = $categoryModel->getCategories();

            return view('books/create', $data);
        }
    }

    protected function validationRules()
    {
        return [
            'title' => 'required|min_length[3]|max_length[255]',
            'category_id' => 'required',
            'description' => 'required',
            'quantity' => 'required|numeric',
            'book_file' => 'uploaded[book_file]|mime_in[book_file,application/pdf]',
            'book_cover' => 'uploaded[book_cover]|mime_in[book_cover,image/jpeg,image/jpg,image/png]',
        ];
    }

    public function read($id)
    {
        $bookModel = new BookModel();
        $book = $bookModel->getBook($id);

        if ($book) {
            $data['book'] = $book;
            return view('books/read', $data);
        } else {
            return redirect()->to('/books')->with('error', 'Buku tidak ditemukan.');
        }
    }

    public function edit($id)
    {
        $bookModel = new BookModel();
        $data['book'] = $bookModel->getBook($id);

        if ($data['book']) {
            $categoryModel = new CategoryModel();
            $data['categories'] = $categoryModel->getCategories();

            return view('books/edit', $data);
        } else {
            return redirect()->to('/books')->with('error', 'Buku tidak ditemukan.');
        }
    }

    public function update($id)
    {
        // Check if the form is submitted
        if ($this->request->getMethod() === 'post') {
            // Get the book data from the database
            $bookModel = new BookModel();
            $book = $bookModel->find($id);

            if (!$book) {
                return redirect()->to('/books')->with('error', 'Book not found.');
            }

            // Get the uploaded PDF file and image file
            $pdfFile = $this->request->getFile('book_file');
            $imageFile = $this->request->getFile('book_cover');

            // Get the updated book data from the form
            $data = [
                'title' => $this->request->getPost('title'),
                'category_id' => $this->request->getPost('category_id'),
                'description' => $this->request->getPost('description'),
                'quantity' => $this->request->getPost('quantity'),
            ];

            // Check if a new PDF file is uploaded
            if ($pdfFile->isValid() && !$pdfFile->hasMoved()) {
                // Delete the old PDF file if it exists
                if ($book['book_file']) {
                    unlink('uploads/' . $book['book_file']);
                }

                // Move the new PDF file to the uploads folder
                $newPdfName = $pdfFile->getRandomName();
                $pdfFile->move('uploads', $newPdfName);
                $data['book_file'] = $newPdfName;
            }

            // Check if a new image file is uploaded
            if ($imageFile->isValid() && !$imageFile->hasMoved()) {
                // Delete the old image file if it exists
                if ($book['book_cover']) {
                    unlink('uploads/' . $book['book_cover']);
                }

                // Move the new image file to the uploads folder
                $newImageName = $imageFile->getRandomName();
                $imageFile->move('uploads', $newImageName);
                $data['book_cover'] = $newImageName;
            }

            // Update the book data in the database
            $bookModel->update($id, $data);

            return redirect()->to('/books/form')->with('success', 'Book updated successfully.');
        }

        // If the form is not submitted, load the view for updating the book
        $bookModel = new BookModel();
        $data['book'] = $bookModel->getBook($id);

        // Load the category data from the database to populate the category dropdown
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->getCategories();

        return view('books/update', $data);
    }


    public function delete($id)
    {
        $bookModel = new BookModel();
        $book = $bookModel->find($id);

        if ($book) {
            // Hapus file buku dan cover dari direktori uploads jika ada
            if (file_exists('./uploads/' . $book['book_file'])) {
                unlink('./uploads/' . $book['book_file']);
            }

            if (file_exists('./uploads/' . $book['book_cover'])) {
                unlink('./uploads/' . $book['book_cover']);
            }

            $bookModel->delete($id);
            return redirect()->to('/books/form')->with('success', 'Buku berhasil dihapus.');
        } else {
            return redirect()->to('/books/form')->with('error', 'Buku tidak ditemukan.');
        }
    }

    // Helper function to check if user is admin
    private function isAdmin()
    {
        // Load session helper
        helper('session');

        $userRoleModel = new UserRoleModel();
        $isAdmin = session('is_admin');
        if ($isAdmin) {
            $userId = session('user_id');
            return $userRoleModel->hasAdminRole($userId);
        }
        return false;
    }
}
