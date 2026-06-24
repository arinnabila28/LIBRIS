<?php

namespace App\Controllers;

/**
 * Halaman statis / konten institusional LIBRIS
 * (visi-misi, promosi literasi informasi).
 * Konten sengaja ditaruh di sini agar mudah diedit tanpa menyentuh database.
 */
class PageController extends BaseController
{
    // ── Visi & Misi ─────────────────────────────────────────────
    public function visiMisi()
    {
        $misi = [
            'Menyediakan semua bentuk informasi yang sesuai dengan kurikulum yang berlaku.',
            'Mengelola informasi agar bisa diakses oleh pengguna dengan mudah, cepat, dan tepat.',
            'Memberikan fasilitas yang memadai kepada pengguna agar dapat mewujudkan fungsi perpustakaan sebagai sarana bantu proses belajar mengajar dan penelitian.',
            'Memberikan fasilitas ruang publik untuk masyarakat luas sebagai sarana pemberdayaan masyarakat.',
            'Menyebarkan informasi secara efektif dan efisien.',
        ];

        $nilai = [
            ['ti-heart-handshake', 'Inklusif',   'Terbuka dan ramah untuk semua kalangan pemustaka.'],
            ['ti-bulb',           'Literat',     'Mendorong berpikir kritis dan melek informasi.'],
            ['ti-device-laptop',  'Adaptif',     'Mengikuti perkembangan teknologi dan kebutuhan zaman.'],
            ['ti-award',          'Berintegritas', 'Layanan jujur, akurat, dan dapat dipercaya.'],
        ];

        return view('page/visi_misi', [
            'title' => 'Visi & Misi — LIBRIS',
            'misi'  => $misi,
            'nilai' => $nilai,
        ]);
    }

    // ── Promosi Program Literasi Informasi ──────────────────────
    public function literasi()
    {
        // Diisi pada Grup A #2
        return view('page/literasi', [
            'title' => 'Literasi Informasi — LIBRIS',
        ]);
    }

    // ── Kontak ──────────────────────────────────────────────────
    public function kontak()
    {
        return view('page/kontak', [
            'title' => 'Kontak — LIBRIS',
            'email' => 'rossalya.choirunissa-2024@fisip.unair.ac.id',
        ]);
    }
}
