<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MemberModel;

class AuthController extends BaseController
{
    public function showLogin()
    {
        if (session()->get('isLoggedIn')) {
            return $this->redirectByRole();
        }
        return view('auth/login');
    }

    public function login()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user      = $userModel->findByEmail($email);

        if (! $user || ! password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Email atau password salah.');
        }

        $this->setUserSession($user);
        return $this->redirectByRole();
    }

    public function showRegister()
    {
        if (session()->get('isLoggedIn')) {
            return $this->redirectByRole();
        }
        return view('auth/register');
    }

    public function register()
    {
        $rules = [
            'name'         => 'required|min_length[3]',
            'email'        => 'required|valid_email|is_unique[users.email]',
            'password'     => 'required|min_length[6]',
            'pass_confirm' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name    = $this->request->getPost('name');
        $email   = $this->request->getPost('email');
        $contact = $this->request->getPost('contact') ?: '-';

        // 1. Tautkan ke member yang sudah ada (termasuk yang ada di tong sampah),
        //    atau buat data member baru bila belum ada.
        $memberModel = new MemberModel();
        $existing    = $memberModel->withDeleted()->where('email_member', $email)->first();

        if ($existing) {
            $idMember = $existing['id_member'];
            $memberModel->update($idMember, [
                'name_member'    => $name,
                'contact_member' => $contact,
                'status_member'  => 'Aktif',
                'deleted_at'     => null, // pulihkan kalau sempat dihapus
            ]);
        } else {
            $memberModel->insert([
                'name_member'    => $name,
                'email_member'   => $email,
                'contact_member' => $contact,
                'status_member'  => 'Aktif',
            ]);
            $idMember = $memberModel->getInsertID();
        }

        // 2. Buat akun login, tautkan ke member
        $userModel = new UserModel();
        $userModel->insert([
            'name'      => $name,
            'email'     => $email,
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'      => 'user',
            'id_member' => $idMember,
        ]);

        $user = $userModel->findByEmail($email);
        $this->setUserSession($user);

        return redirect()->to('/home')->with('success', 'Akun berhasil dibuat. Selamat datang di LIBRIS!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Kamu sudah keluar. Sampai jumpa lagi!');
    }

    private function setUserSession(array $user): void
    {
        session()->set([
            'isLoggedIn' => true,
            'id_user'    => $user['id_user'],
            'name'       => $user['name'],
            'email'      => $user['email'],
            'role'       => $user['role'],
            'id_member'  => $user['id_member'],
        ]);
    }

    private function redirectByRole()
    {
        return session()->get('role') === 'admin'
            ? redirect()->to('/dashboard')
            : redirect()->to('/home');
    }
}
