<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Not logged in
        if (! $session->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        // Role mismatch
        if (! empty($arguments) && $session->get('role') !== $arguments[0]) {
            return redirect()->to('/auth/login')->with('error', 'Access denied.');
        }

        // Otherwise continue
        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Optional: after filter logic
    }
}
