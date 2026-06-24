<?php

namespace App\Controllers;

use App\Models\WishlistModel;

class WishlistController extends BaseController
{
    // Tambah / hapus dari wishlist (toggle)
    public function toggle()
    {
        $idUser = session('id_user');
        $idBook = $this->request->getPost('id_book');
        $from   = $this->request->getPost('from');

        $model = new WishlistModel();
        $row   = $model->where('id_user', $idUser)->where('id_book', $idBook)->first();

        if ($row) {
            $model->delete($row['id_wishlist']);
            $msg = 'Dihapus dari wishlist.';
        } else {
            $model->insert([
                'id_user'    => $idUser,
                'id_book'    => $idBook,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $msg = 'Ditambahkan ke wishlist! ♥';
        }

        $back = $from === 'wishlist' ? '/wishlist' : 'katalog/' . $idBook;
        return redirect()->to($back)->with('success', $msg);
    }

    // Halaman "Wishlist Saya"
    public function saya()
    {
        $idUser = session('id_user');
        $model  = new WishlistModel();

        $items = $model
            ->select('wishlist.*, books.title_book, books.author_book, books.tipe, books.stock, books.cover')
            ->join('books', 'books.id_book = wishlist.id_book', 'left')
            ->where('wishlist.id_user', $idUser)
            ->orderBy('wishlist.id_wishlist', 'DESC')
            ->findAll();

        return view('user/wishlist', [
            'title' => 'Wishlist Saya — LIBRIS',
            'items' => $items,
        ]);
    }
}
