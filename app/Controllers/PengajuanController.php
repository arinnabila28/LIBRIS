<?php

namespace App\Controllers;

use App\Models\PengajuanModel;
use App\Models\PeminjamanModel;
use App\Models\BookModel;

class PengajuanController extends BaseController
{
    // Daftar pengajuan untuk admin (menunggu di atas)
    public function index()
    {
        $pengajuanModel = new PengajuanModel();
        $data = [
            'title'     => 'Pengajuan Peminjaman',
            'pengajuan' => $pengajuanModel
                ->select('pengajuan.*, members.name_member, books.title_book, books.stock')
                ->join('members', 'members.id_member = pengajuan.id_member', 'left')
                ->join('books', 'books.id_book = pengajuan.id_book', 'left')
                ->orderBy("FIELD(pengajuan.status,'menunggu','disetujui','ditolak')", '', false)
                ->orderBy('pengajuan.id_pengajuan', 'DESC')
                ->findAll(),
        ];
        return view('pengajuan/index', $data);
    }

    // Setujui → buat peminjaman 7 hari + kurangi stok
    public function setujui($id)
    {
        $pengajuanModel  = new PengajuanModel();
        $peminjamanModel = new PeminjamanModel();
        $bookModel       = new BookModel();

        $p = $pengajuanModel->find($id);
        if (! $p || $p['status'] !== 'menunggu') {
            return redirect()->to('/pengajuan')->with('error', 'Pengajuan tidak valid.');
        }

        $book = $bookModel->find($p['id_book']);
        if (! $book || (int) $book['stock'] <= 0) {
            return redirect()->to('/pengajuan')->with('error', 'Stok buku kosong, tidak bisa disetujui.');
        }

        $lama = lib_lama_pinjam();
        $peminjamanModel->insert([
            'id_member'          => $p['id_member'],
            'id_book'            => $p['id_book'],
            'tanggal_peminjaman' => date('Y-m-d'),
            'tanggal_kembali'    => date('Y-m-d', strtotime('+' . $lama . ' days')),
        ]);
        $bookModel->update($p['id_book'], ['stock' => $book['stock'] - 1]);
        $pengajuanModel->update($id, ['status' => 'disetujui']);

        return redirect()->to('/pengajuan')->with('success', "Pengajuan disetujui & peminjaman dibuat (jatuh tempo {$lama} hari).");
    }

    // Tolak pengajuan
    public function tolak($id)
    {
        $pengajuanModel = new PengajuanModel();
        $p = $pengajuanModel->find($id);
        if ($p && $p['status'] === 'menunggu') {
            $pengajuanModel->update($id, ['status' => 'ditolak']);
        }
        return redirect()->to('/pengajuan')->with('success', 'Pengajuan ditolak.');
    }
}
