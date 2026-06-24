<?php

namespace App\Controllers;

use App\Models\SubjekModel;
use App\Models\BookModel;
use App\Models\JurnalModel;

class SubjekController extends BaseController
{
    public function index()
    {
        $model      = new SubjekModel();
        $bookModel  = new BookModel();
        $jurnalModel = new JurnalModel();

        // Subjek buku + hitung pemakaian (LIKE pada kolom koma)
        $buku = $model->where('tipe', 'buku')->orderBy('nama', 'ASC')->findAll();
        foreach ($buku as &$s) {
            $s['jml'] = $bookModel->like('subjek', $s['nama'])->countAllResults();
        }
        unset($s);

        // Bidang jurnal + hitung pemakaian (cocok persis)
        $jurnal = $model->where('tipe', 'jurnal')->orderBy('nama', 'ASC')->findAll();
        foreach ($jurnal as &$s) {
            $s['jml'] = $jurnalModel->where('bidang', $s['nama'])->countAllResults();
        }
        unset($s);

        return view('subjek/index', [
            'title'  => 'Kelola Subjek & Bidang',
            'buku'   => $buku,
            'jurnal' => $jurnal,
        ]);
    }

    public function store()
    {
        $nama = trim((string) $this->request->getPost('nama'));
        $tipe = $this->request->getPost('tipe') === 'jurnal' ? 'jurnal' : 'buku';

        if (mb_strlen($nama) < 2) {
            return redirect()->to('kelola/subjek')->with('error', 'Nama minimal 2 karakter.');
        }

        $model = new SubjekModel();
        $ada   = $model->where('nama', $nama)->where('tipe', $tipe)->countAllResults();
        if ($ada) {
            return redirect()->to('kelola/subjek')->with('error', "\"{$nama}\" sudah ada untuk " . ($tipe === 'jurnal' ? 'jurnal' : 'buku') . '.');
        }

        $model->insert(['nama' => $nama, 'tipe' => $tipe]);
        return redirect()->to('kelola/subjek')->with('success', ($tipe === 'jurnal' ? 'Bidang jurnal' : 'Subjek buku') . ' berhasil ditambahkan.');
    }

    public function delete($id = null)
    {
        (new SubjekModel())->delete($id);
        return redirect()->to('kelola/subjek')->with('success', 'Data berhasil dihapus.');
    }
}
