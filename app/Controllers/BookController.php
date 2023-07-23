<?php

// app/Controllers/BookController.php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\CategoryModel;
use CodeIgniter\Controller;

class BookController extends Controller
{
    public function index()
    {
        $bookModel = new BookModel();
        $data['books'] = $bookModel->getBooksWithCategory();

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
        $bookModel = new BookModel();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'category_id' => 'required',
            'description' => 'required',
            'quantity' => 'required|numeric',
        ])) {
            $book = $bookModel->getBook($id);

            if ($book) {
                $data = [
                    'title' => $this->request->getPost('title'),
                    'category_id' => $this->request->getPost('category_id'),
                    'description' => $this->request->getPost('description'),
                    'quantity' => $this->request->getPost('quantity'),
                ];

                // Meng-handle file buku dan cover jika ada perubahan
                $bookFile = $this->request->getFile('book_file');
                $bookCover = $this->request->getFile('book_cover');

                if ($bookFile->isValid()) {
                    // Menghapus file lama jika ada file baru
                    unlink('./uploads/' . $book['book_file']);

                    // Upload file buku baru
                    $newBookFile = $bookFile->getRandomName();
                    $bookFile->move('./uploads', $newBookFile);
                    $data['book_file'] = $newBookFile;
                }

                if ($bookCover->isValid()) {
                    // Menghapus file lama jika ada file baru
                    unlink('./uploads/' . $book['book_cover']);

                    // Upload cover buku baru
                    $newBookCover = $bookCover->getRandomName();
                    $bookCover->move('./uploads', $newBookCover);
                    $data['book_cover'] = $newBookCover;
                }

                $bookModel->update($id, $data);

                return redirect()->to('/books')->with('success', 'Buku berhasil diperbarui.');
            }
        }

        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->getCategories();
        $data['book'] = $bookModel->getBook($id);

        return view('books/edit', $data);
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
            return redirect()->to('/books')->with('success', 'Buku berhasil dihapus.');
        } else {
            return redirect()->to('/books')->with('error', 'Buku tidak ditemukan.');
        }
    }
}