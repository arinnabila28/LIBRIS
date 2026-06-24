<?php

namespace App\Controllers;

class PengembalianController extends BaseController
{
    public function index()
    {
        $pengembalianModel = new \App\Models\PengembalianModel();
        $peminjamanModel = new \App\Models\PeminjamanModel();
        
        // TRIK BARU: Filter agar hanya menampilkan peminjaman yang BELUM dikembalikan
        $peminjaman_aktif = $peminjamanModel->select('peminjaman.*, members.name_member, books.title_book')
                                            ->join('members', 'members.id_member = peminjaman.id_member', 'left')
                                            ->join('books', 'books.id_book = peminjaman.id_book', 'left')
                                            // Gabungkan dengan tabel pengembalian untuk mengecek status
                                            ->join('pengembalian', 'pengembalian.id_peminjaman = peminjaman.id_peminjaman', 'left')
                                            // Sembunyikan yang sudah ada di tabel pengembalian
                                            ->where('pengembalian.id_peminjaman IS NULL') 
                                            ->findAll();

        $data = [
            'riwayat' => $pengembalianModel->getRiwayatLengkap(),
            'peminjaman_aktif' => $peminjaman_aktif 
        ];
        
        return view('pengembalian/index', $data);
    }

    public function simpanPengembalian()
    {
        $id_peminjaman = $this->request->getPost('id_peminjaman');
        
        $peminjamanModel = new \App\Models\PeminjamanModel();
        $pengembalianModel = new \App\Models\PengembalianModel();
        $bookModel = new \App\Models\BookModel();

        // 1. Cari data peminjamannya
        $pinjam = $peminjamanModel->find($id_peminjaman);
        if (!$pinjam) {
            return redirect()->to('/list/pengembalian')->with('error', 'Gagal! Data peminjaman tidak ditemukan.');
        }

        // 2. Hitung Denda Otomatis (rumus terpusat di lib_helper)
        $denda = lib_hitung_denda($pinjam['tanggal_kembali']);

        // 3. PAKSA SIMPAN KE DATABASE (Menggunakan insert)
        $simpan = $pengembalianModel->insert([
            'id_peminjaman'          => $id_peminjaman,
            'tanggal_kembali_aktual' => date('Y-m-d'),
            'total_denda'            => $denda,
            'status_bayar'           => $denda > 0 ? 'belum' : 'lunas',
        ]);

        // CEK GAIB: Jika gagal simpan, munculkan notifikasi merah!
        if (!$simpan) {
            return redirect()->to('/list/pengembalian')->with('error', 'Sistem menolak menyimpan! Cek allowedFields di Model Pengembalian.');
        }

        // 4. Tambah Stok Buku (+1)
        $buku = $bookModel->find($pinjam['id_book']);
        if ($buku) {
            $bookModel->update($pinjam['id_book'], ['stock' => $buku['stock'] + 1]);
        }

        // 5. Hapus dari tabel peminjaman agar tidak menumpuk
        // Catatan: Jika setelah ini namamu di tabel berubah jadi "Member terhapus", 
        // kabari aku ya, karena kita perlu pakai trik khusus untuk riwayatnya.
        //$peminjamanModel->delete($id_peminjaman, true);

        return redirect()->to('/list/pengembalian')->with('success', 'Buku berhasil dikembalikan! Denda: Rp ' . number_format($denda, 0, ',', '.'));
    }

    // Admin menandai denda sebagai LUNAS
    public function tandaiLunas($id)
    {
        $pengembalianModel = new \App\Models\PengembalianModel();
        $row = $pengembalianModel->find($id);

        if (! $row) {
            return redirect()->to('/list/pengembalian')->with('error', 'Data pengembalian tidak ditemukan.');
        }

        $pengembalianModel->update($id, ['status_bayar' => 'lunas']);
        return redirect()->to('/list/pengembalian')->with('success', 'Denda ditandai sudah lunas.');
    }

    // Fungsi untuk menghapus riwayat pengembalian lama
    public function hapus($id)
    {
        $pengembalianModel = new \App\Models\PengembalianModel();
        
        // Hapus data berdasarkan ID
        $pengembalianModel->delete($id);
        
        return redirect()->to('/list/pengembalian')->with('success', 'Riwayat pengembalian berhasil dihapus!');
    }
}