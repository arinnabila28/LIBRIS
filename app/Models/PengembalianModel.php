<?php

namespace App\Models;

use CodeIgniter\Model;

class PengembalianModel extends Model
{
    protected $table = 'pengembalian';
    protected $primaryKey = 'id_pengembalian';
    protected $allowedFields = ['id_peminjaman', 'tanggal_kembali_aktual', 'total_denda', 'status_bayar'];

    // Fungsi untuk menggabungkan tabel agar datanya lengkap
    public function getRiwayatLengkap()
    {
        $builder = $this->db->table('pengembalian');
        // Pilih kolom apa saja yang mau ditampilkan
        $builder->select('pengembalian.*, members.name_member, books.title_book, peminjaman.tanggal_kembali');
        
        // Gabungkan dengan tabel lain (Gunakan LEFT JOIN agar data tetap aman)
        $builder->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman', 'left');
        $builder->join('members', 'members.id_member = peminjaman.id_member', 'left');
        $builder->join('books', 'books.id_book = peminjaman.id_book', 'left');
        
        return $builder->get()->getResultArray();
    }
}