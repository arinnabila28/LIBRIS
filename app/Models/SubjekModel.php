<?php

namespace App\Models;

use CodeIgniter\Model;

class SubjekModel extends Model
{
    protected $table         = 'subjek';
    protected $primaryKey    = 'id_subjek';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'tipe'];

    /** Daftar nama subjek/bidang (urut A–Z) untuk tipe tertentu ('buku' | 'jurnal'). */
    public function namaList(string $tipe = 'buku'): array
    {
        return array_column(
            $this->where('tipe', $tipe)->orderBy('nama', 'ASC')->findAll(),
            'nama'
        );
    }
}
