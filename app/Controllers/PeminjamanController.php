<?php

namespace App\Controllers;

class PeminjamanController extends BaseController
{
    // 1. Menampilkan Halaman Utama
    public function index()
    {
        return view('peminjaman/index');
    }

    // 2. Memuat Tabel via AJAX (Menggunakan fungsi getPeminjamanLengkap dari Model)
    public function ajaxTable()
    {
        $peminjamanModel = new \App\Models\PeminjamanModel();
        
        $data['peminjaman'] = $peminjamanModel->getPeminjamanLengkap();
        return view('peminjaman/table', $data);
    }

    // 3. Memanggil Form Tambah (AJAX)
    public function ajaxCreate()
    {
        $memberModel = new \App\Models\MemberModel();
        $bookModel = new \App\Models\BookModel(); // Pastikan nama model bukumu BookModel

        $data = [
            'members' => $memberModel->where('status_member', 'Aktif')->findAll(), // Hanya panggil member aktif
            'books'   => $bookModel->findAll()
        ];

        return view('peminjaman/modal_create', $data);
    }

    // 4. Proses Simpan Data (CEK LIMIT MAKSIMAL & STOK BERKURANG)
    public function store()
    {
        $model = new \App\Models\PeminjamanModel();
        $bookModel = new \App\Models\BookModel();

        $id_member = $this->request->getPost('id_member');
        $id_book = $this->request->getPost('id_book');

        // =========================================================
        // FITUR BARU 1: CEK BATAS MAKSIMAL PINJAM (MAKS 4 BUKU)
        // =========================================================
        // CodeIgniter otomatis HANYA menghitung data yang belum dihapus (dikembalikan)
        $jumlahPinjamanAktif = $model->where('id_member', $id_member)->countAllResults();

        if ($jumlahPinjamanAktif >= 4) {
            session()->setFlashdata('error', 'Gagal meminjam! Member ini sudah mencapai batas maksimal peminjaman (4 buku). Harap kembalikan buku sebelumnya terlebih dahulu.');
            return redirect()->to('/list/peminjaman');
        }

        // =========================================================
        // FITUR LAMA 2: CEK KETERSEDIAAN STOK BUKU
        // =========================================================
        $buku = $bookModel->find($id_book);

        if ($buku['stock'] <= 0) {
            session()->setFlashdata('error', 'Gagal meminjam! Stok buku "' . $buku['title_book'] . '" sedang kosong.');
            return redirect()->to('/list/peminjaman');
        }

        // Rumus: Kurangi stok buku (-1)
        $bookModel->update($id_book, ['stock' => $buku['stock'] - 1]);

        // Simpan Data Peminjaman
        $model->save([
            'id_member'          => $id_member,
            'id_book'            => $id_book,
            'tanggal_peminjaman' => $this->request->getPost('tanggal_peminjaman'),
            'tanggal_kembali'    => $this->request->getPost('tanggal_kembali')
        ]);

        session()->setFlashdata('success', 'Peminjaman berhasil dicatat & Stok berkurang!');
        return redirect()->to('/list/peminjaman');
    }

    // 5. Proses Hapus Data (Soft Delete)
    public function delete($id)
    {
        $model = new \App\Models\PeminjamanModel();
        $bookModel = new \App\Models\BookModel();

        $peminjaman = $model->find($id);

        if ($peminjaman) {
            $buku = $bookModel->find($peminjaman['id_book']);
            // Rumus: Kembalikan stok buku (+1)
            $bookModel->update($buku['id_book'], ['stock' => $buku['stock'] + 1]);
            
            $model->delete($id);
            session()->setFlashdata('success', 'Buku dikembalikan (Data dihapus) & Stok buku bertambah!');
        }

        return redirect()->to('/list/peminjaman');
    }

    // 6. Memanggil Form Edit (AJAX)
    public function ajaxEdit($id)
    {
        $peminjamanModel = new \App\Models\PeminjamanModel();
        $memberModel = new \App\Models\MemberModel();
        $bookModel = new \App\Models\BookModel();

        $data = [
            'peminjaman' => $peminjamanModel->find($id),
            'members'    => $memberModel->where('status_member', 'Aktif')->findAll(),
            'books'      => $bookModel->findAll()
        ];

        return view('peminjaman/modal_edit', $data);
    }

    // 7. Proses Update Data
    public function update($id)
    {
        $model = new \App\Models\PeminjamanModel();
        $bookModel = new \App\Models\BookModel();

        $peminjamanLama = $model->find($id);
        $id_book_baru = $this->request->getPost('id_book');

        // Jika judul buku diganti di form Edit
        if ($peminjamanLama['id_book'] != $id_book_baru) {
            // a. Kembalikan stok buku yang lama (+1)
            $bukuLama = $bookModel->find($peminjamanLama['id_book']);
            $bookModel->update($bukuLama['id_book'], ['stock' => $bukuLama['stock'] + 1]);

            // b. Kurangi stok buku yang baru (-1)
            $bukuBaru = $bookModel->find($id_book_baru);
            $bookModel->update($id_book_baru, ['stock' => $bukuBaru['stock'] - 1]);
        }

        $model->update($id, [
            'id_member'          => $this->request->getPost('id_member'),
            'id_book'            => $id_book_baru,
            'tanggal_peminjaman' => $this->request->getPost('tanggal_peminjaman'),
            'tanggal_kembali'    => $this->request->getPost('tanggal_kembali')
        ]);

        session()->setFlashdata('success', 'Data peminjaman berhasil diperbarui!');
        return redirect()->to('/list/peminjaman');
    }
}