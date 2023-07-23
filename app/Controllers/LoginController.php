<?php

// app/Controllers/LoginController.php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\Session\Session;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function login()
    {
        $validationRules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Username atau password salah.');
        }

        // Login berhasil, atur sesi pengguna.
        $this->session = session();
        $this->session->set('user_id', $user['id']);
        $this->session->set('username', $user['username']);

        return redirect()->to('/dashboard')->with('success', 'Login berhasil!');
    }

    public function logout()
    {
        $this->session = session();
        $this->session->destroy();
        return redirect()->to('/login')->with('success', 'Logout berhasil!');
    }
}
