<?php

// app/Controllers/AuthController.php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserRoleModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('register');
    }

    public function register()
    {
        $validationRules = [
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]|max_length[255]',
            'confirm_password' => 'required|matches[password]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        $userModel = new UserModel();

        // Insert the user and get the inserted user's ID
        $userId = $userModel->insertUserAndGetId([
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ]);

        // Create a new user role with the role set to "user" for the registered user
        $userRoleModel = new UserRoleModel();
        $userRoleModel->insert([
            'user_id' => $userId,
            'role' => 'user',
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function loginForm()
    {
        return view('login');
    }

    public function login()
    {
        // Lakukan validasi login
        // Misalnya, validasi username/email dan password dengan database
        $usernameOrEmail = $this->request->getPost('username_or_email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $usernameOrEmail)
            ->orWhere('email', $usernameOrEmail)
            ->first();

        if ($user && password_verify($password, $user['password'])) {
            // Jika login berhasil, simpan informasi pengguna ke sesi
            $this->session->set('user_id', $user['id']);
            $this->session->set('username', $user['username']);

            // Tambahkan logika untuk mengatur role "admin"
            $userRoleModel = new UserRoleModel();
            $isAdmin = $userRoleModel->hasAdminRole($user['id']);
            if ($isAdmin) {
                // Jika pengguna memiliki role "admin", set sesi admin ke true
                $this->session->set('is_admin', true);
            }
            // Redirect ke halaman dashboard atau halaman lain yang sesuai
            return redirect()->to('/dashboard')->with('success', 'Login successful.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Invalid credentials.');
        }
    }

    public function logout()
    {
        // Hapus informasi pengguna dari sesi saat logout
        $this->session->remove('user_id');
        $this->session->remove('username');
        $this->session->remove('is_admin'); // Hapus sesi admin saat logout
        // Redirect ke halaman login atau halaman lain yang sesuai
        return redirect()->to('/login')->with('success', 'Logout successful.');
    }
}
