<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table            = 'books';
    protected $primaryKey       = 'id_book';
    protected $useAutoIncrement = true;//created_at, updated_at
    protected $useSoftDeletes   = true;//deleted_at
    protected $allowedFields    = ['code_book', 'isbn_book', 'title_book', 'author_book', 'publisher_book', 'published_year', 'description_book', 'stock', 'deleted_at', 'no_klasifikasi', 'edisi', 'kota_terbit', 'deskripsi_fisik', 'volume', 'subjek', 'tipe', 'file_digital', 'cover'];
    protected $deletedField     = 'deleted_at';
    // Dates
    protected $useTimestamps = true;
}
