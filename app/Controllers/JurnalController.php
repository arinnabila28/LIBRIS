<?php

namespace App\Controllers;

use App\Models\JurnalModel;

class JurnalController extends BaseController
{
    // ══════════════════════════ PUBLIK ══════════════════════════

    // Daftar jurnal (publik) + pencarian + filter bidang
    public function index()
    {
        $model  = new JurnalModel();
        $cari   = trim((string) $this->request->getGet('q'));
        $bidang = trim((string) $this->request->getGet('bidang'));

        $model->orderBy('tahun', 'DESC')->orderBy('id_jurnal', 'DESC');
        if ($cari !== '') {
            $model->groupStart()
                  ->like('judul', $cari)->orLike('penulis', $cari)->orLike('nama_jurnal', $cari)
                  ->groupEnd();
        }
        if ($bidang !== '') {
            $model->where('bidang', $bidang);
        }
        $list = $model->findAll();

        // Daftar bidang untuk filter chip — dari master subjek (tipe jurnal)
        $bidangList = (new \App\Models\SubjekModel())->namaList('jurnal');

        return view('jurnal/index', [
            'title'      => 'Jurnal — LIBRIS',
            'list'       => $list,
            'cari'       => $cari,
            'bidang'     => $bidang,
            'bidangList' => $bidangList,
        ]);
    }

    // Detail jurnal (by slug)
    public function detail($slug = null)
    {
        $model  = new JurnalModel();
        $jurnal = $model->where('slug', $slug)->first();
        if (! $jurnal) {
            return redirect()->to('jurnal')->with('error', 'Jurnal tidak ditemukan.');
        }

        return view('jurnal/detail', [
            'title'  => $jurnal['judul'] . ' — LIBRIS',
            'jurnal' => $jurnal,
        ]);
    }

    // Stream PDF (wajib login — route diberi filter auth)
    public function file($id = null)
    {
        $jurnal = (new JurnalModel())->find($id);
        if (! $jurnal || empty($jurnal['file_pdf'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Berkas jurnal tidak ditemukan');
        }
        $path = WRITEPATH . 'uploads/jurnal/' . $jurnal['file_pdf'];
        if (! is_file($path)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Berkas jurnal tidak ditemukan');
        }

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="' . basename($jurnal['file_pdf']) . '"')
            ->setBody(file_get_contents($path));
    }

    // ══════════════════════════ ADMIN ══════════════════════════

    public function kelola()
    {
        $model = new JurnalModel();
        return view('jurnal/admin_index', [
            'title' => 'Kelola Jurnal',
            'list'  => $model->orderBy('id_jurnal', 'DESC')->findAll(),
        ]);
    }

    public function create()
    {
        return view('jurnal/form', [
            'title'      => 'Tambah Jurnal',
            'jurnal'     => null,
            'bidangList' => (new \App\Models\SubjekModel())->namaList('jurnal'),
        ]);
    }

    public function store()
    {
        if (! $this->validate(['judul' => 'required|min_length[3]'])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new JurnalModel();
        $judul = $this->request->getPost('judul');

        $data = $this->collect($judul, $model->makeSlug($judul));
        $up   = $this->handlePdf();
        if ($up['error']) {
            return redirect()->back()->withInput()->with('error', $up['error']);
        }
        if ($up['name']) {
            $data['file_pdf'] = $up['name'];
        }

        $cover = $this->handleCover();
        if ($cover['error']) {
            return redirect()->back()->withInput()->with('error', $cover['error']);
        }
        if ($cover['name']) {
            $data['cover'] = $cover['name'];
        }

        $model->insert($data);
        return redirect()->to('kelola/jurnal')->with('success', 'Jurnal berhasil ditambahkan.');
    }

    public function edit($id = null)
    {
        $jurnal = (new JurnalModel())->find($id);
        if (! $jurnal) {
            return redirect()->to('kelola/jurnal')->with('error', 'Jurnal tidak ditemukan.');
        }
        return view('jurnal/form', [
            'title'      => 'Edit Jurnal',
            'jurnal'     => $jurnal,
            'bidangList' => (new \App\Models\SubjekModel())->namaList('jurnal'),
        ]);
    }

    public function update($id = null)
    {
        $model  = new JurnalModel();
        $jurnal = $model->find($id);
        if (! $jurnal) {
            return redirect()->to('kelola/jurnal')->with('error', 'Jurnal tidak ditemukan.');
        }
        if (! $this->validate(['judul' => 'required|min_length[3]'])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $judul = $this->request->getPost('judul');
        $data  = $this->collect($judul, $model->makeSlug($judul, (int) $id));
        $up    = $this->handlePdf();
        if ($up['error']) {
            return redirect()->back()->withInput()->with('error', $up['error']);
        }
        if ($up['name']) {
            $data['file_pdf'] = $up['name'];
        }

        $cover = $this->handleCover();
        if ($cover['error']) {
            return redirect()->back()->withInput()->with('error', $cover['error']);
        }
        if ($cover['name']) {
            $data['cover'] = $cover['name'];
        }

        $model->update($id, $data);
        return redirect()->to('kelola/jurnal')->with('success', 'Jurnal berhasil diperbarui.');
    }

    public function delete($id = null)
    {
        (new JurnalModel())->delete($id);
        return redirect()->to('kelola/jurnal')->with('success', 'Jurnal berhasil dihapus.');
    }

    // ── Helpers ─────────────────────────────────────────────────
    /** Rangkai field dari POST. */
    private function collect(string $judul, string $slug): array
    {
        $r = $this->request;
        return [
            'judul'       => $judul,
            'slug'        => $slug,
            'penulis'     => $r->getPost('penulis') ?: null,
            'nama_jurnal' => $r->getPost('nama_jurnal') ?: null,
            'penerbit'    => $r->getPost('penerbit') ?: null,
            'tahun'       => $r->getPost('tahun') ?: null,
            'volume'      => $r->getPost('volume') ?: null,
            'nomor'       => $r->getPost('nomor') ?: null,
            'halaman'     => $r->getPost('halaman') ?: null,
            'doi'         => $r->getPost('doi') ?: null,
            'issn'        => $r->getPost('issn') ?: null,
            'bidang'      => $r->getPost('bidang') ?: null,
            'abstrak'     => $r->getPost('abstrak') ?: null,
            'cover'       => $r->getPost('cover_img') ?: null,
        ];
    }

    /** @return array{name: ?string, error: ?string} PDF jurnal → writable/uploads/jurnal. */
    private function handlePdf(): array
    {
        return lib_simpan_upload(
            $this->request->getFile('file_pdf'),
            ['pdf'],
            ['application/pdf'],
            WRITEPATH . 'uploads/jurnal',
            20
        );
    }

    private function handleCover(): array
    {
        $file = $this->request->getFile('cover_img');

        // 1. Cek apakah ada file yang diupload dan valid
        if (! $file || ! $file->isValid() || $file->hasMoved()) {
            return ['name' => null, 'error' => null];
        }

        // 2. Buat nama file acak yang aman (otomatis ada ekstensinya)
        $newName = $file->getRandomName();

        // 3. Pindahkan file ke folder public/uploads/covers/
        try {
            $file->move(FCPATH . 'uploads/covers', $newName);
            return ['name' => $newName, 'error' => null];
        } catch (\Exception $e) {
            return ['name' => null, 'error' => $e->getMessage()];
        }
    }
}
