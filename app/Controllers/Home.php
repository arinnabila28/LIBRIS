<?php

namespace App\Controllers;

class Home extends BaseController
{
    // Landing page (SVG "LIBRIS")
    public function index()
    {
    $bookModel = new \App\Models\BookModel();
    
    // Ambil 4 buku terbaru untuk ditampilkan di Hero Wall
    $books = $bookModel->orderBy('id_book', 'DESC')->limit(4)->findAll();

    return view('landing page/index', [
        'books' => $books
    ]);
    }

    // Beranda / Home — tampil setelah landing
    public function beranda()
    {
        $db = \Config\Database::connect();

        // Bacaan teratas: buku dengan ulasan terbanyak (lalu rating tertinggi), dilengkapi yang terbaru.
        // Ambil hingga 12 untuk carousel — panah geser jadi berguna saat buku > yang muat di layar.
        $top = $db->table('books b')
            ->select('b.id_book, b.title_book, b.author_book, b.cover, b.tipe,
                      COUNT(r.id_review) AS jml, AVG(r.rating) AS avg_rating')
            ->join('book_reviews r', 'r.id_book = b.id_book', 'left')
            ->where('b.deleted_at IS NULL')
            ->groupBy('b.id_book')
            ->orderBy('jml', 'DESC')
            ->orderBy('avg_rating', 'DESC')
            ->orderBy('b.id_book', 'DESC')
            ->get(12)->getResultArray();

        return view('home/index', [
            'title' => 'Beranda — LIBRIS',
            'top'   => $top,
        ]);
    }
}
