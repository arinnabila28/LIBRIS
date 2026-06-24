<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table            = 'peminjaman';
    protected $primaryKey       = 'id_peminjaman';
    protected $useAutoIncrement = true;
    
    // Pakai Soft Deletes seperti biasa biar aman
    protected $useSoftDeletes   = true;
    
    // Kolom yang boleh diisi
    protected $allowedFields    = ['id_member', 'id_book', 'tanggal_peminjaman', 'tanggal_kembali', 'deleted_at'];
    protected $useTimestamps    = true;

    // FUNGSI SAKTI UNTUK MENGGABUNGKAN 3 TABEL
    public function getPeminjamanLengkap($id = false)
    {
        // Memilih tabel peminjaman, lalu menggandengkannya dengan tabel members dan books
        $this->select('peminjaman.*, members.name_member, books.title_book');
        $this->join('members', 'members.id_member = peminjaman.id_member');
        $this->join('books', 'books.id_book = peminjaman.id_book');
        
        // Kalau id kosong, tampilkan semua data
        if ($id === false) {
            return $this->findAll();
        }

        // Kalau ada id, tampilkan 1 data saja (untuk keperluan Edit)
        return $this->where(['id_peminjaman' => $id])->first();
    }
}