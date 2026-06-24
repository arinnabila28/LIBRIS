<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\BookReviewModel;

class DiskusiController extends BaseController
{
    // Indeks: daftar buku + rata-rata rating & jumlah ulasan (boleh tanpa login)
    public function index()
    {
        $db = \Config\Database::connect();
        $q  = trim((string) $this->request->getGet('q'));

        $builder = $db->table('books b')
            ->select('b.id_book, b.title_book, b.author_book, b.tipe, b.cover,
                      AVG(r.rating) AS avg_rating, COUNT(r.id_review) AS jml')
            ->join('book_reviews r', 'r.id_book = b.id_book', 'left')
            ->where('b.deleted_at IS NULL');

        if ($q !== '') {
            $builder->groupStart()
                ->like('b.title_book', $q)
                ->orLike('b.author_book', $q)
                ->orLike('b.subjek', $q)
                ->groupEnd();
        }

        $books = $builder
            ->groupBy('b.id_book')
            ->orderBy('jml', 'DESC')
            ->orderBy('b.title_book', 'ASC')
            ->get()->getResultArray();

        return view('diskusi/index', [
            'title' => 'Diskusi & Rating — LIBRIS',
            'books' => $books,
            'q'     => $q,
        ]);
    }

    // Ruang diskusi satu buku
    public function room($idBook = null)
    {
        $bookModel = new BookModel();
        $book      = $bookModel->find($idBook);
        if (! $book) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku tidak ditemukan');
        }

        $reviewModel = new BookReviewModel();
        $reviews = $reviewModel
            ->select('book_reviews.*, users.name AS user_name')
            ->join('users', 'users.id_user = book_reviews.id_user', 'left')
            ->where('book_reviews.id_book', $idBook)
            ->orderBy('book_reviews.updated_at', 'DESC')
            ->findAll();

        $count = count($reviews);
        $avg   = 0;
        if ($count > 0) {
            $avg = array_sum(array_column($reviews, 'rating')) / $count;
        }

        // Ulasan milik user yang sedang login (untuk prefill form)
        $myReview = null;
        if (session('isLoggedIn')) {
            foreach ($reviews as $r) {
                if ((int) $r['id_user'] === (int) session('id_user')) {
                    $myReview = $r;
                    break;
                }
            }
        }

        return view('diskusi/room', [
            'title'    => 'Diskusi: ' . $book['title_book'] . ' — LIBRIS',
            'book'     => $book,
            'reviews'  => $reviews,
            'avg'      => $avg,
            'count'    => $count,
            'myReview' => $myReview,
        ]);
    }

    // Simpan / perbarui ulasan (login wajib)
    public function simpan()
    {
        $idUser = session('id_user');
        $idBook = $this->request->getPost('id_book');
        $rating = (int) $this->request->getPost('rating');
        $comment = trim((string) $this->request->getPost('comment'));

        $back = $this->request->getPost('back');
        $dest = $back ?: 'diskusi/' . $idBook;

        if ($rating < 1 || $rating > 5) {
            return redirect()->to($dest)->with('error', 'Pilih rating bintang dulu ya.');
        }

        $reviewModel = new BookReviewModel();
        $existing = $reviewModel->where('id_user', $idUser)->where('id_book', $idBook)->first();

        if ($existing) {
            $reviewModel->update($existing['id_review'], ['rating' => $rating, 'comment' => $comment]);
            $msg = 'Ulasanmu diperbarui! ✨';
        } else {
            $reviewModel->insert([
                'id_user' => $idUser,
                'id_book' => $idBook,
                'rating'  => $rating,
                'comment' => $comment,
            ]);
            $msg = 'Ulasan terkirim! Makasih sudah berbagi 🎉';
        }

        return redirect()->to($dest)->with('success', $msg);
    }

    // Hapus ulasan sendiri
    public function hapus($idReview = null)
    {
        $reviewModel = new BookReviewModel();
        $review = $reviewModel->find($idReview);

        if ($review && (int) $review['id_user'] === (int) session('id_user')) {
            $reviewModel->delete($idReview);
            return redirect()->to('diskusi/' . $review['id_book'])->with('success', 'Ulasanmu dihapus.');
        }

        return redirect()->to('diskusi')->with('error', 'Tidak bisa menghapus ulasan ini.');
    }
}
