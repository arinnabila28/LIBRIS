<?php

namespace App\Models;

use CodeIgniter\Model;

class JurnalModel extends Model
{
    protected $table            = 'jurnal';
    protected $primaryKey       = 'id_jurnal';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes   = true;
    protected $deletedField     = 'deleted_at';
    protected $useTimestamps    = true;

    protected $allowedFields = [
        'judul', 'slug', 'penulis', 'nama_jurnal', 'penerbit', 'tahun',
        'volume', 'nomor', 'halaman', 'doi', 'issn', 'bidang', 'abstrak', 'file_pdf', 'cover'
    ];

    /** Slug unik dari judul; $ignoreId untuk lewati baris yang sedang diedit. */
    public function makeSlug(string $judul, ?int $ignoreId = null): string
    {
        helper('text');
        $base = url_title(strtolower($judul), '-', true) ?: 'jurnal';
        $slug = $base;
        $i    = 1;
        while (true) {
            $q = $this->where('slug', $slug);
            if ($ignoreId !== null) {
                $q = $q->where('id_jurnal !=', $ignoreId);
            }
            if ($q->countAllResults() === 0) {
                return $slug;
            }
            $slug = $base . '-' . (++$i);
        }
    }
}
