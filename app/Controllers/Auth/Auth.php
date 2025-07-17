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

        // For now, simulate login (no DB yet)
        if (! $username || ! $password) {
            return redirect()->back()->withInput()->with('error', 'Username and password are required.');
        }

       
        session()->set([
            'id'         => 1, // Simulated ID
            'username'   => $username,
            'role'       => 'voter',
            'isLoggedIn' => true,
        ]);

        
        return redirect()->to('/vote/candidates/1');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}