<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Membatasi akses berdasarkan role. Contoh pemakaian di route: ['filter' => 'role:admin']
 */
class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (! $session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login dulu untuk melanjutkan.');
        }

        if (! empty($arguments) && ! in_array($session->get('role'), $arguments, true)) {
            // Sudah login tapi role-nya tidak diizinkan → balikkan ke beranda sesuai role
            $home = $session->get('role') === 'admin' ? '/dashboard' : '/katalog';
            return redirect()->to($home)->with('error', 'Kamu tidak punya akses ke halaman tersebut.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // tidak ada aksi
    }
}
