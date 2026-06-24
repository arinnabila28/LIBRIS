<?php

namespace App\Controllers;

use App\Models\BeritaModel;

class BeritaController extends BaseController
{
    // ══════════════════════════ PUBLIK ══════════════════════════

    // Daftar berita & dokumen (publik). Filter ?k=berita|dokumen
    public function index()
    {
        $model = new BeritaModel();
        $k     = $this->request->getGet('k');

        $q = $model->orderBy('tanggal', 'DESC')->orderBy('id_berita', 'DESC');
        if (in_array($k, ['berita', 'dokumen'], true)) {
            $q = $q->where('kategori', $k);
        }

        return view('berita/index', [
            'title'  => 'Berita & Dokumen — LIBRIS',
            'list'   => $q->findAll(),
            'filter' => $k,
        ]);
    }

    // Detail satu berita (by slug)
    public function detail($slug = null)
    {
        $model  = new BeritaModel();
        $berita = $model->where('slug', $slug)->first();
        if (! $berita) {
            return redirect()->to('berita')->with('error', 'Berita tidak ditemukan.');
        }

        // Berita lain (selain yang sedang dibuka)
        $lain = $model->where('id_berita !=', $berita['id_berita'])
            ->orderBy('tanggal', 'DESC')->orderBy('id_berita', 'DESC')
            ->findAll(4);

        return view('berita/detail', [
            'title'  => $berita['judul'] . ' — LIBRIS',
            'berita' => $berita,
            'lain'   => $lain,
        ]);
    }

    // Unduh / buka dokumen PDF
    public function file($id = null)
    {
        $berita = (new BeritaModel())->find($id);
        if (! $berita || empty($berita['file_dokumen'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Dokumen tidak ditemukan');
        }

        $path = WRITEPATH . 'uploads/berita/' . $berita['file_dokumen'];
        if (! is_file($path)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Dokumen tidak ditemukan');
        }

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="' . basename($berita['file_dokumen']) . '"')
            ->setBody(file_get_contents($path));
    }

    // ══════════════════════════ ADMIN ══════════════════════════

    // Daftar kelola (admin)
    public function kelola()
    {
        $model = new BeritaModel();
        return view('berita/admin_index', [
            'title' => 'Kelola Berita',
            'list'  => $model->orderBy('id_berita', 'DESC')->findAll(),
        ]);
    }

    public function create()
    {
        return view('berita/form', ['title' => 'Tambah Berita', 'berita' => null]);
    }

    public function store()
    {
        $rules = [
            'judul'    => 'required|min_length[3]',
            'kategori' => 'required|in_list[berita,dokumen]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new BeritaModel();
        $judul = $this->request->getPost('judul');

        $data = [
            'judul'     => $judul,
            'slug'      => $model->makeSlug($judul),
            'kategori'  => $this->request->getPost('kategori'),
            'ringkasan' => $this->request->getPost('ringkasan') ?: null,
            'isi'       => $this->request->getPost('isi') ?: null,
            'tanggal'   => $this->request->getPost('tanggal') ?: date('Y-m-d'),
            'penulis'   => session('name') ?? 'Admin',
        ];
        $img = $this->handleImage();
        $doc = $this->handleDocument();
        if ($img['error']) { return redirect()->back()->withInput()->with('error', $img['error']); }
        if ($doc['error']) { return redirect()->back()->withInput()->with('error', $doc['error']); }
        if ($img['name']) { $data['gambar'] = $img['name']; }
        if ($doc['name']) { $data['file_dokumen'] = $doc['name']; }

        $model->insert($data);
        return redirect()->to('kelola/berita')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id = null)
    {
        $berita = (new BeritaModel())->find($id);
        if (! $berita) {
            return redirect()->to('kelola/berita')->with('error', 'Berita tidak ditemukan.');
        }
        return view('berita/form', ['title' => 'Edit Berita', 'berita' => $berita]);
    }

    public function update($id = null)
    {
        $model  = new BeritaModel();
        $berita = $model->find($id);
        if (! $berita) {
            return redirect()->to('kelola/berita')->with('error', 'Berita tidak ditemukan.');
        }

        $rules = [
            'judul'    => 'required|min_length[3]',
            'kategori' => 'required|in_list[berita,dokumen]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $judul = $this->request->getPost('judul');
        $data  = [
            'judul'     => $judul,
            'slug'      => $model->makeSlug($judul, (int) $id),
            'kategori'  => $this->request->getPost('kategori'),
            'ringkasan' => $this->request->getPost('ringkasan') ?: null,
            'isi'       => $this->request->getPost('isi') ?: null,
            'tanggal'   => $this->request->getPost('tanggal') ?: $berita['tanggal'],
        ];
        $img = $this->handleImage();
        $doc = $this->handleDocument();
        if ($img['error']) { return redirect()->back()->withInput()->with('error', $img['error']); }
        if ($doc['error']) { return redirect()->back()->withInput()->with('error', $doc['error']); }
        if ($img['name']) { $data['gambar'] = $img['name']; }
        if ($doc['name']) { $data['file_dokumen'] = $doc['name']; }

        $model->update($id, $data);
        return redirect()->to('kelola/berita')->with('success', 'Berita berhasil diperbarui.');
    }

    public function delete($id = null)
    {
        (new BeritaModel())->delete($id);
        return redirect()->to('kelola/berita')->with('success', 'Berita berhasil dihapus.');
    }

    // ── Upload helpers (validasi MIME + ukuran via lib_simpan_upload) ──
    /** @return array{name: ?string, error: ?string} Gambar cover → public/uploads/berita. */
    private function handleImage(): array
    {
        return lib_simpan_upload(
            $this->request->getFile('gambar'),
            ['jpg', 'jpeg', 'png', 'webp', 'gif'],
            ['image/jpeg', 'image/png', 'image/webp', 'image/gif'],
            FCPATH . 'uploads/berita',
            5
        );
    }

    /** @return array{name: ?string, error: ?string} Dokumen PDF → writable/uploads/berita. */
    private function handleDocument(): array
    {
        return lib_simpan_upload(
            $this->request->getFile('file_dokumen'),
            ['pdf'],
            ['application/pdf'],
            WRITEPATH . 'uploads/berita',
            15
        );
    }
}
