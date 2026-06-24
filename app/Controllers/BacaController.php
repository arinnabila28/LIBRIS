<?php

namespace App\Controllers;

use App\Models\BookModel;

class BacaController extends BaseController
{
    private function findDigital($id)
    {
        $book = (new BookModel())->find($id);
        if (! $book || ! in_array($book['tipe'] ?? 'fisik', ['digital', 'keduanya'], true)) {
            return null;
        }
        return $book;
    }

    // Halaman reader
    public function index($id = null)
    {
        $book = $this->findDigital($id);
        if (! $book) {
            return redirect()->to('katalog/' . $id)->with('error', 'Buku ini tidak tersedia untuk dibaca online.');
        }

        $path    = WRITEPATH . 'uploads/books/' . ($book['file_digital'] ?? '');
        $hasFile = ! empty($book['file_digital']) && is_file($path);

        return view('baca/read', [
            'title'   => 'Baca: ' . $book['title_book'] . ' — LIBRIS',
            'book'    => $book,
            'hasFile' => $hasFile,
        ]);
    }

    // Stream file PDF (terlindungi login + cek tipe digital)
    public function file($id = null)
    {
        $book = $this->findDigital($id);
        if (! $book || empty($book['file_digital'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File tidak ditemukan');
        }

        $path = WRITEPATH . 'uploads/books/' . $book['file_digital'];
        if (! is_file($path)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File tidak ditemukan');
        }

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="' . basename($book['file_digital']) . '"')
            ->setBody(file_get_contents($path));
    }
}
