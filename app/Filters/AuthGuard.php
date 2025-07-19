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

        
        if (! $session->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        
        if (! empty($arguments) && $session->get('role') !== $arguments[0]) {
            return redirect()->to('/auth/login')->with('error', 'Access denied.');
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
       
    }
}
