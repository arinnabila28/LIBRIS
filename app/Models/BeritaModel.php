<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table            = 'berita';
    protected $primaryKey       = 'id_berita';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes   = true;
    protected $deletedField     = 'deleted_at';
    protected $useTimestamps    = true;

    protected $allowedFields = [
        'judul', 'slug', 'kategori', 'ringkasan', 'isi',
        'gambar', 'file_dokumen', 'tanggal', 'penulis',
    ];

    /**
     * Buat slug unik dari judul. $ignoreId untuk melewati baris yang sedang diedit.
     */
    public function makeSlug(string $judul, ?int $ignoreId = null): string
    {
        helper('text');
        $base = url_title(strtolower($judul), '-', true);
        if ($base === '') {
            $base = 'berita';
        }

        $slug = $base;
        $i    = 1;
        while (true) {
            $q = $this->where('slug', $slug);
            if ($ignoreId !== null) {
                $q = $q->where('id_berita !=', $ignoreId);
            }
            if ($q->countAllResults() === 0) {
                return $slug;
            }
            $slug = $base . '-' . (++$i);
        }
    }
}
