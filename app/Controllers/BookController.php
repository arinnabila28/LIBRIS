<?php

namespace App\Controllers;
use App\Models\BookModel;

class BookController extends BaseController
{
    public function index(): string
    {
        $bookModel = new BookModel();
        $data = [
            'tittle' => 'Daftar Buku',
            'books' => $bookModel->findAll()
        ];
        return view('books/index', $data);
    }

    public function ajaxTable()
    {
        $bookModel = new BookModel();
        $data['books'] = $bookModel->findAll();
        return view('books/_table', $data);
    }
    
    public function create()
    {
        $data['title'] = 'Tambah Buku';
        return view('books/create');
    }

    public function store()
    {
        $model = new BookModel();
        $subjekArr = $this->request->getPost('subjek');
        $subjek    = is_array($subjekArr) ? implode(', ', $subjekArr) : ($subjekArr ?? '');
        $data = [
            'code_book' => $this->request->getPost('code_book'),
            'isbn_book' => $this->request->getPost('isbn_book'),
            'title_book' => $this->request->getPost('title_book'),
            'author_book' => $this->request->getPost('author_book'),
            'publisher_book' => $this->request->getPost('publisher_book'),
            'published_year' => $this->request->getPost('published_year'),
            'description_book' => $this->request->getPost('description_book'),
            'stock' => $this->request->getPost('stock'),
            'tipe' => $this->request->getPost('tipe') ?: 'fisik',
            'subjek'          => $subjek,
            'no_klasifikasi'  => $this->request->getPost('no_klasifikasi'),
            'edisi'           => $this->request->getPost('edisi'),
            'kota_terbit'     => $this->request->getPost('kota_terbit'),
            'volume'          => $this->request->getPost('volume'),
            'deskripsi_fisik' => $this->request->getPost('deskripsi_fisik'),
        ];

        $pdf = $this->handlePdfUpload();
        $cov = $this->handleCoverUpload();
        if ($pdf['error']) { return redirect()->back()->withInput()->with('error', $pdf['error']); }
        if ($cov['error']) { return redirect()->back()->withInput()->with('error', $cov['error']); }
        if ($pdf['name']) { $data['file_digital'] = $pdf['name']; }
        if ($cov['name']) { $data['cover'] = $cov['name']; }

        if ($model->save($data)) {
            session()->setFlashdata('success', 'Buku berhasil disimpan!');
            return redirect()->to('/list/books');
        }
        return redirect()->back()->withInput()->with('errors', $model->errors());
    }

    /** @return array{name: ?string, error: ?string} PDF → writable/uploads/books (validasi MIME + ukuran). */
    private function handlePdfUpload(): array
    {
        return lib_simpan_upload(
            $this->request->getFile('file_pdf'),
            ['pdf'],
            ['application/pdf'],
            WRITEPATH . 'uploads/books',
            20
        );
    }

    /** @return array{name: ?string, error: ?string} Cover → public/uploads/covers (validasi MIME + ukuran). */
    private function handleCoverUpload(): array
    {
        return lib_simpan_upload(
            $this->request->getFile('cover_img'),
            ['jpg', 'jpeg', 'png', 'webp', 'gif'],
            ['image/jpeg', 'image/png', 'image/webp', 'image/gif'],
            FCPATH . 'uploads/covers',
            5
        );
    }

   public function edit($id)
{
    $model = new BookModel();
    
    // Ambil data asli dari database berdasarkan id_book
    $book = $model->find($id);

    // Cek jika data tidak ditemukan
    if (!$book) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku dengan ID ' . $id . ' tidak ditemukan');
    }

    $data = [
        'book' => $book
    ];

    return view('books/edit', $data);
} 

public function update($id)
{
    $model = new BookModel();

    $subjekArr = $this->request->getPost('subjek');
    $subjek    = is_array($subjekArr) ? implode(', ', $subjekArr) : ($subjekArr ?? '');

    // Tangkap data dari input form (pastikan 'name' di HTML sudah sama)
    $data = [
        'code_book'        => $this->request->getPost('code_book'),
        'isbn_book'        => $this->request->getPost('isbn_book'),
        'title_book'       => $this->request->getPost('title_book'),
        'author_book'      => $this->request->getPost('author_book'),
        'publisher_book'   => $this->request->getPost('publisher_book'),
        'published_year'   => $this->request->getPost('published_year'),
        'description_book' => $this->request->getPost('description_book'),
        'stock'            => $this->request->getPost('stock'),
        'tipe'             => $this->request->getPost('tipe') ?: 'fisik',
        'subjek'           => $subjek,
        'no_klasifikasi'   => $this->request->getPost('no_klasifikasi'),
        'edisi'            => $this->request->getPost('edisi'),
        'kota_terbit'      => $this->request->getPost('kota_terbit'),
        'volume'           => $this->request->getPost('volume'),
        'deskripsi_fisik'  => $this->request->getPost('deskripsi_fisik'),
    ];

    $pdf = $this->handlePdfUpload();
    $cov = $this->handleCoverUpload();
    if ($pdf['error']) { return redirect()->back()->withInput()->with('error', $pdf['error']); }
    if ($cov['error']) { return redirect()->back()->withInput()->with('error', $cov['error']); }
    if ($pdf['name']) { $data['file_digital'] = $pdf['name']; }
    if ($cov['name']) { $data['cover'] = $cov['name']; }

    // Proses update berdasarkan ID
    if ($model->update($id, $data)) {
        session()->setFlashdata('success', 'Data buku berhasil diperbarui!');
        return redirect()->to('/list/books');
    } else {
        // Jika gagal, kembali ke halaman sebelumnya dengan pesan error
        return redirect()->back()->withInput()->with('errors', $model->errors());
    }
}

    public function delete($id)
    {
        $model = new BookModel();
       if ($model->delete($id)) {
        session()->setFlashdata('success', 'Buku berhasil dihapus!');
    } else {
        session()->setFlashdata('error', 'Gagal menghapus buku.');
    }

    return redirect()->to('/list/books');
    }

    public function trash ()
    {
        $model = new BookModel();
        $data = [
            'books' => $model->onlyDeleted()->findAll()
        ];
        return view('books/trash', $data);
    }

    public function restore($id)
    {
        $model = new BookModel();
        if ($model->update($id, ['deleted_at' => null])) {
            session()->setFlashdata('success', 'Buku berhasil dipulihkan!');
        } else {
            session()->setFlashdata('error', 'Gagal memulihkan buku.');
        }

        return redirect()->to('/book/trash');
    }

    public function purge($id)
    {
        $model = new BookModel();
        if ($model->delete($id, true)) {
            session()->setFlashdata('success', 'Buku berhasil dihapus permanen!');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus buku permanen.');
        }

        return redirect()->to('/book/trash');
    }

    public function ajaxCreate()
    {
        return view('books/modal_create', [
            'subjekList' => (new \App\Models\SubjekModel())->namaList(),
        ]);
    }

    public function ajaxEdit($id)
    {
        $model = new \App\Models\BookModel();
        return view('books/modal_edit', [
            'book'       => $model->find($id),
            'subjekList' => (new \App\Models\SubjekModel())->namaList(),
        ]);
    }
}