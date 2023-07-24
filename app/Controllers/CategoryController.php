<?php

// app/Controllers/CategoryController.php

namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->getCategories();

        return view('categories/index', $data);
    }

    public function create()
    {
        return view('categories/create');
    }

    public function store()
    {
        $categoryModel = new CategoryModel();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'name' => 'required|min_length[3]|max_length[255]'
        ])) {
            $categoryModel->insertCategory([
                'name' => $this->request->getPost('name')
            ]);

            return redirect()->to('/categories')->with('success', 'Kategori berhasil ditambahkan.');
        }

        return view('categories/create');
    }

    public function edit($id)
    {
        $categoryModel = new CategoryModel();
        $data['category'] = $categoryModel->getCategory($id);

        return view('categories/edit', $data);
    }

    public function update($id)
    {
        $categoryModel = new CategoryModel();
        $category = $categoryModel->getCategory($id);

        if ($category) {
            if ($this->request->getMethod() === 'post' && $this->validate([
                'name' => 'required|min_length[3]|max_length[255]'
            ])) {
                $data = [
                    'name' => $this->request->getPost('name')
                ];
                $categoryModel->updateCategory($id, $data);
                return redirect()->to('/categories')->with('success', 'Kategori berhasil diperbarui.');
            }

            $data['category'] = $category;
            return view('categories/edit', $data);
        }

        return redirect()->to('/categories')->with('error', 'Kategori tidak ditemukan.');
    }


    public function delete($id)
    {
        $categoryModel = new CategoryModel();
        $category = $categoryModel->getCategory($id);

        if ($category) {
            $categoryModel->deleteCategory($id);
            return redirect()->to('/categories')->with('success', 'Kategori berhasil dihapus.');
        }

        return redirect()->to('/categories')->with('error', 'Kategori tidak ditemukan.');
    }
}
