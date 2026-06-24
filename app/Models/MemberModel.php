<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table            = 'members';
    protected $primaryKey       = 'id_member'; // Sesuai dengan database tadi
    protected $useAutoIncrement = true;
    
    // Aktifkan Soft Deletes agar kalau dihapus masuk ke "Tong Sampah" dulu
    protected $useSoftDeletes   = true; 
    
    // Kolom yang boleh diisi
    protected $allowedFields    = ['name_member', 'email_member', 'contact_member', 'status_member','deleted_at'];

    // Aktifkan otomatis pengisian tanggal
    protected $useTimestamps = true;

    // Fungsi untuk menampilkan halaman Tong Sampah
    public function trash()
    {
        $model = new MemberModel();
        $data = [
            // onlyDeleted() digunakan untuk memanggil data yang ada di tong sampah
            'members' => $model->onlyDeleted()->findAll() 
        ];
        return view('members/trash', $data);
    }

    // Fungsi untuk mengembalikan data (Restore)
    public function restore($id)
    {
        $model = new MemberModel();
        // Mengubah kolom deleted_at kembali menjadi NULL
        $model->update($id, ['deleted_at' => null]); 
        
        session()->setFlashdata('success', 'Data member berhasil dikembalikan!');
        return redirect()->to('/list/members/trash');
    }
}