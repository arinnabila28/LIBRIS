<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MemberModel;

class UserController extends BaseController
{
    // Beranda user (placeholder — katalog kini jadi landing utama setelah login)
    public function home()
    {
        return view('user/home');
    }

    // Halaman profil
    public function profile()
    {
        $userModel = new UserModel();
        $user      = $userModel->find(session('id_user'));

        $member = null;
        if ($user && $user['id_member']) {
            $member = (new MemberModel())->find($user['id_member']);
        }

        return view('user/profile', [
            'title'  => 'Profil Saya — LIBRIS',
            'user'   => $user,
            'member' => $member,
        ]);
    }

    public function updateProfile()
    {
        $id = session('id_user');

        $rules = [
            'name'  => 'required|min_length[3]',
            'email' => "required|valid_email|is_unique[users.email,id_user,{$id}]",
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $user      = $userModel->find($id);

        $name    = $this->request->getPost('name');
        $email   = $this->request->getPost('email');
        $contact = $this->request->getPost('contact');

        $userModel->update($id, ['name' => $name, 'email' => $email]);

        if ($user['id_member']) {
            (new MemberModel())->update($user['id_member'], [
                'name_member'    => $name,
                'email_member'   => $email,
                'contact_member' => $contact ?: '-',
            ]);
        }

        // Segarkan data session
        session()->set(['name' => $name, 'email' => $email]);

        return redirect()->to('/profil')->with('success', 'Profil berhasil diperbarui!');
    }
}
