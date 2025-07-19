<?php

namespace App\Controllers\Auth;


use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function attemptLogin()
{
    helper(['form']);

    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    if (!$username || !$password) {
        return redirect()->back()->withInput()->with('error', 'Username and password are required.');
    }

    $userModel = new UserModel();
    $user = $userModel->where('username', $username)->first();

    
    if (! $user) {
        $userId = $userModel->insert([
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => 'voter',
        ]);

        
        $user = $userModel->find($userId);
    } else {
        
        if (! password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }
    }

    
    session()->set([
        'user_id'    => $user['id'],
        'username'   => $user['username'],
        'role'       => $user['role'],
        'isLoggedIn' => true,
    ]);

    
    $db = \Config\Database::connect();
    $db->table('user_logins')->insert([
        'user_id' => $user['id']
    ]);

    
    if ($user['role'] === 'admin') {
        return redirect()->to('/admin/dashboard');
    }

    return redirect()->to('/vote/candidates/1');
}

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}