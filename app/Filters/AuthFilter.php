<?php

// app/Filters/AuthFilter.php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Periksa apakah pengguna sudah login
        if (!session()->get('user_id')) {
            return redirect()->to('/login'); // Jika tidak, alihkan ke halaman login
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada aksi setelah request di filter ini
    }
}
