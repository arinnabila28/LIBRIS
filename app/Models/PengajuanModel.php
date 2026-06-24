<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanModel extends Model
{
    // Konfigurasi dasar tabel
    protected $table = 'pengajuan';
    protected $primaryKey = 'id_pengajuan';
    protected $useTimestamps = true;

    // Kolom-kolom yang diizinkan untuk diisi/diubah oleh sistem
    protected $allowedFields = ['id_member', 'id_book', 'tanggal_pengajuan', 'status'];

    /**
     * Fungsi khusus untuk mengambil data pengajuan
     * sekaligus menggabungkannya (JOIN) dengan tabel members dan books
     * agar kita bisa menampilkan 'name_member' dan 'title_book' di tampilan.
     */
    public function getPengajuanLengkap()
    {
        return $this->select('pengajuan.*, members.name_member, books.title_book')
                    ->join('members', 'members.id_member = pengajuan.id_member', 'left')
                    ->join('books', 'books.id_book = pengajuan.id_book', 'left')
                    ->orderBy('pengajuan.id_pengajuan', 'DESC') // Mengurutkan dari pengajuan terbaru
                    ->findAll();
    }
}