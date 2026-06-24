<?php

namespace App\Controllers;

use App\Models\MemberModel;

class MemberController extends BaseController
{
    // 1. Fungsi Halaman Utama (Wadah kosong untuk AJAX)
    public function index()
    {
        $data = [
            'title' => 'Data Member'
        ];
        return view('members/index', $data); // Nanti kita buat folder 'members'
    }

    // 2. Fungsi Memanggil Tabel Member (AJAX)
    public function ajaxTable()
    {
        $model = new MemberModel();
        $data = [
            'members' => $model->findAll()
        ];
        return view('members/table', $data);
    }

    // 3. Fungsi Memanggil Pop-up Tambah Member (AJAX)
    public function ajaxCreate()
    {
        return view('members/modal_create');
    }

    // 4. Fungsi Memanggil Pop-up Edit Member (AJAX)
    public function ajaxEdit($id)
    {
        $model = new MemberModel();
        $data = [
            'member' => $model->find($id)
        ];
        return view('members/modal_edit', $data);
    }

    // 5. Fungsi Menyimpan Data Baru ke Database
    public function store()
    {
        $model = new MemberModel();
        $data = [
            'name_member'    => $this->request->getPost('name_member'),
            'email_member'   => $this->request->getPost('email_member'),
            'contact_member' => $this->request->getPost('contact_member'),
            'status_member'  => $this->request->getPost('status_member'),
        ];
        
        $model->save($data);
        session()->setFlashdata('success', 'Data Member berhasil ditambahkan!');
        return redirect()->to('/list/members');
    }

    // 6. Fungsi Memperbarui Data ke Database
    public function update($id)
    {
        $model = new MemberModel();
        $data = [
            'name_member'    => $this->request->getPost('name_member'),
            'email_member'   => $this->request->getPost('email_member'),
            'contact_member' => $this->request->getPost('contact_member'),
            'status_member'  => $this->request->getPost('status_member'),
        ];
        
        $model->update($id, $data);
        session()->setFlashdata('success', 'Data Member berhasil diperbarui!');
        return redirect()->to('/list/members');
    }

    // 7. Fungsi Menghapus Data
    public function delete($id)
    {
        $model = new MemberModel();
        $model->delete($id);
        session()->setFlashdata('success', 'Data Member berhasil dihapus!');
        return redirect()->to('/list/members');
    }

    // Fungsi untuk menampilkan halaman Tong Sampah
    public function trash()
    {
        $model = new \App\Models\MemberModel();
        $data = [
            // onlyDeleted() digunakan untuk memanggil data yang masuk tong sampah
            'members' => $model->onlyDeleted()->findAll() 
        ];
        return view('members/trash', $data);
    }

    // Fungsi untuk mengembalikan data (Restore)
    public function restore($id)
    {
        $model = new \App\Models\MemberModel();
        // Mengubah kolom deleted_at kembali menjadi NULL
        $model->update($id, ['deleted_at' => null]); 
        
        session()->setFlashdata('success', 'Data member berhasil dikembalikan!');
        return redirect()->to('/list/members/trash');
    }

    // Fungsi untuk menghapus data secara PERMANEN
    public function deletePermanent($id)
    {
        $model = new \App\Models\MemberModel();
        
        // Parameter 'true' di bawah ini memaksa CI4 untuk menghapus permanen (Hard Delete)
        $model->delete($id, true); 
        
        session()->setFlashdata('success', 'Data member berhasil dihapus secara permanen!');
        return redirect()->to('/list/members/trash');
    }
}