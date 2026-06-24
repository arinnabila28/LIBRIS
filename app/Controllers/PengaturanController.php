<?php

namespace App\Controllers;

use App\Models\PengaturanModel;

class PengaturanController extends BaseController
{
    public function index()
    {
        return view('pengaturan/index', [
            'title'      => 'Pengaturan Sirkulasi',
            'pengaturan' => lib_pengaturan(),
        ]);
    }

    public function update()
    {
        $rules = [
            'lama_pinjam'    => 'required|is_natural_no_zero',
            'denda_per_hari' => 'required|is_natural',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new PengaturanModel();
        $data  = [
            'lama_pinjam'    => (int) $this->request->getPost('lama_pinjam'),
            'denda_per_hari' => (int) $this->request->getPost('denda_per_hari'),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];

        // Pastikan baris id=1 ada (update bila ada, insert bila belum)
        if ($model->find(1)) {
            $model->update(1, $data);
        } else {
            $model->insert(['id' => 1] + $data);
        }

        return redirect()->to('kelola/pengaturan')->with('success', 'Pengaturan sirkulasi berhasil disimpan.');
    }
}
