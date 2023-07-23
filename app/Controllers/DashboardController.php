<?php

// app/Controllers/DashboardController.php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\CategoryModel;
use CodeIgniter\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Periksa apakah pengguna sudah login sebelum mengakses dashboard.
        if (!$this->isLoggedIn()) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil informasi pengguna dari sesi.
        $data['username'] = session('username');
        $bookModel = new BookModel();
        $data['books'] = $bookModel->findAll();
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->getCategories();

        return view('dashboard', $data);
    }

    private function isLoggedIn()
    {
        $this->session = session();
        return $this->session->has('user_id');
    }
}
