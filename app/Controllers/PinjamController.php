<?php

namespace App\Controllers;

use App\Models\PengajuanModel;
use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;
use App\Models\BookModel;

class PinjamController extends BaseController
{
    // User mengajukan pinjam dari halaman detail buku
    public function ajukan()
    {
        $idMember = session('id_member');
        $idBook   = $this->request->getPost('id_book');

        if (! $idMember) {
            return redirect()->to('/katalog')->with('error', 'Akun kamu belum tertaut data member.');
        }

        $bookModel = new BookModel();
        $book      = $bookModel->find($idBook);
        if (! $book) {
            return redirect()->to('/katalog')->with('error', 'Buku tidak ditemukan.');
        }

        $pengajuanModel  = new PengajuanModel();
        $peminjamanModel = new PeminjamanModel();

        // Sudah ada pengajuan menunggu untuk buku ini?
        $menunggu = $pengajuanModel->where('id_member', $idMember)
            ->where('id_book', $idBook)->where('status', 'menunggu')->countAllResults();
        if ($menunggu > 0) {
            return redirect()->to('katalog/' . $idBook)->with('error', 'Kamu sudah mengajukan buku ini. Tunggu persetujuan admin ya.');
        }

        // Sedang meminjam buku ini (aktif, belum dikembalikan)?
        $aktif = $peminjamanModel
            ->join('pengembalian', 'pengembalian.id_peminjaman = peminjaman.id_peminjaman', 'left')
            ->where('peminjaman.id_member', $idMember)
            ->where('peminjaman.id_book', $idBook)
            ->where('pengembalian.id_peminjaman IS NULL')
            ->countAllResults();
        if ($aktif > 0) {
            return redirect()->to('katalog/' . $idBook)->with('error', 'Kamu sedang meminjam buku ini.');
        }

        if ((int) $book['stock'] <= 0) {
            return redirect()->to('katalog/' . $idBook)->with('error', 'Maaf, stok buku ini sedang kosong.');
        }

        $pengajuanModel->insert([
            'id_member'         => $idMember,
            'id_book'           => $idBook,
            'tanggal_pengajuan' => date('Y-m-d'),
            'status'            => 'menunggu',
        ]);

        return redirect()->to('katalog/' . $idBook)->with('success', 'Pengajuan pinjam terkirim! Menunggu persetujuan admin. 🎉');
    }

    // User mengembalikan buku sendiri (self-service) dari "Pinjaman Saya"
    public function kembalikan()
    {
        $idMember     = session('id_member');
        $idPeminjaman = $this->request->getPost('id_peminjaman');

        $peminjamanModel   = new PeminjamanModel();
        $pengembalianModel = new PengembalianModel();
        $bookModel         = new BookModel();

        $pinjam = $peminjamanModel->find($idPeminjaman);

        // Pastikan peminjaman ada & memang milik user yang sedang login
        if (! $pinjam || (int) $pinjam['id_member'] !== (int) $idMember) {
            return redirect()->to('pinjaman-saya')->with('error', 'Data peminjaman tidak ditemukan.');
        }

        // Cegah pengembalian ganda
        if ($pengembalianModel->where('id_peminjaman', $idPeminjaman)->countAllResults() > 0) {
            return redirect()->to('pinjaman-saya')->with('error', 'Buku ini sudah dikembalikan.');
        }

        // Hitung denda (rumus terpusat) & tentukan status bayar
        $denda = lib_hitung_denda($pinjam['tanggal_kembali']);

        $pengembalianModel->insert([
            'id_peminjaman'          => $idPeminjaman,
            'tanggal_kembali_aktual' => date('Y-m-d'),
            'total_denda'            => $denda,
            'status_bayar'           => $denda > 0 ? 'belum' : 'lunas',
        ]);

        // Kembalikan stok (+1)
        $buku = $bookModel->find($pinjam['id_book']);
        if ($buku) {
            $bookModel->update($pinjam['id_book'], ['stock' => $buku['stock'] + 1]);
        }

        $pesan = $denda > 0
            ? 'Buku dikembalikan. Ada denda Rp ' . number_format($denda, 0, ',', '.') . ' — silakan bayar di meja perpustakaan.'
            : 'Buku berhasil dikembalikan. Terima kasih! 🎉';

        return redirect()->to('pinjaman-saya')->with('success', $pesan);
    }

    // Halaman "Pinjaman Saya"
    public function saya()
    {
        $idMember          = session('id_member');
        $pengajuanModel    = new PengajuanModel();
        $peminjamanModel   = new PeminjamanModel();
        $pengembalianModel = new PengembalianModel();

        // Pengajuan menunggu / ditolak (yang disetujui pindah jadi peminjaman)
        $pengajuan = $pengajuanModel
            ->select('pengajuan.*, books.title_book')
            ->join('books', 'books.id_book = pengajuan.id_book', 'left')
            ->where('pengajuan.id_member', $idMember)
            ->whereIn('pengajuan.status', ['menunggu', 'ditolak'])
            ->orderBy('pengajuan.id_pengajuan', 'DESC')
            ->findAll();

        // Sedang dipinjam (belum dikembalikan)
        $aktif = $peminjamanModel
            ->select('peminjaman.*, books.title_book')
            ->join('books', 'books.id_book = peminjaman.id_book', 'left')
            ->join('pengembalian', 'pengembalian.id_peminjaman = peminjaman.id_peminjaman', 'left')
            ->where('peminjaman.id_member', $idMember)
            ->where('pengembalian.id_peminjaman IS NULL')
            ->orderBy('peminjaman.tanggal_kembali', 'ASC')
            ->findAll();

        // Riwayat (sudah dikembalikan)
        $riwayat = $pengembalianModel->db->table('pengembalian')
            ->select('pengembalian.*, peminjaman.tanggal_peminjaman, peminjaman.tanggal_kembali, books.title_book')
            ->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman', 'left')
            ->join('books', 'books.id_book = peminjaman.id_book', 'left')
            ->where('peminjaman.id_member', $idMember)
            ->orderBy('pengembalian.id_pengembalian', 'DESC')
            ->get()->getResultArray();

        return view('user/pinjaman_saya', [
            'title'     => 'Pinjaman Saya — LIBRIS',
            'pengajuan' => $pengajuan,
            'aktif'     => $aktif,
            'riwayat'   => $riwayat,
        ]);
    }
}
