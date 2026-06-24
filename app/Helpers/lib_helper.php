<?php

/**
 * Helper sirkulasi LIBRIS — sumber tunggal untuk kebijakan peminjaman.
 * Lama pinjam & tarif denda dibaca dari tabel `pengaturan` (baris id=1),
 * dengan fallback aman bila tabel belum ada.
 */

use Config\Database;

if (! function_exists('lib_pengaturan')) {
    /** Ambil pengaturan global (di-cache per request). */
    function lib_pengaturan(): array
    {
        static $cache = null;
        if ($cache !== null) {
            return $cache;
        }

        $defaults = ['lama_pinjam' => 7, 'denda_per_hari' => 1000];

        try {
            $row = Database::connect()->table('pengaturan')->where('id', 1)->get()->getRowArray();
            if ($row) {
                return $cache = [
                    'lama_pinjam'    => (int) ($row['lama_pinjam']    ?? $defaults['lama_pinjam']),
                    'denda_per_hari' => (int) ($row['denda_per_hari'] ?? $defaults['denda_per_hari']),
                ];
            }
        } catch (\Throwable $e) {
            // tabel belum dimigrasi / DB error → pakai default
        }

        return $cache = $defaults;
    }
}

if (! function_exists('lib_lama_pinjam')) {
    /** Lama pinjam (hari). */
    function lib_lama_pinjam(): int
    {
        return lib_pengaturan()['lama_pinjam'];
    }
}

if (! function_exists('lib_denda_per_hari')) {
    /** Tarif denda per hari telat (rupiah). */
    function lib_denda_per_hari(): int
    {
        return lib_pengaturan()['denda_per_hari'];
    }
}

if (! function_exists('lib_hitung_denda')) {
    /**
     * Hitung denda keterlambatan. Rumus tunggal dipakai di seluruh aplikasi.
     *
     * @param string|null $tanggalKembali jatuh tempo (Y-m-d)
     * @param string|null $tanggalAktual  tanggal kembali aktual (default: hari ini)
     */
    function lib_hitung_denda(?string $tanggalKembali, ?string $tanggalAktual = null, ?int $rate = null): int
    {
        if (! $tanggalKembali) {
            return 0;
        }
        $deadline = strtotime($tanggalKembali);
        $aktual   = strtotime($tanggalAktual ?: date('Y-m-d'));
        if ($aktual <= $deadline) {
            return 0;
        }
        $hari = (int) floor(($aktual - $deadline) / 86400);
        return $hari * ($rate ?? lib_denda_per_hari());
    }
}

if (! function_exists('lib_simpan_upload')) {
    /**
     * Validasi & simpan satu berkas unggahan dengan aman
     * (cek MIME server-side + batas ukuran, bukan sekadar ekstensi nama file).
     *
     * @param \CodeIgniter\HTTP\Files\UploadedFile|null $file
     * @param list<string> $ext   ekstensi yang diizinkan, mis. ['pdf']
     * @param list<string> $mime  MIME yang diizinkan, mis. ['application/pdf']
     * @param string       $destDir folder tujuan absolut
     * @param int          $maxMB batas ukuran (MB)
     *
     * @return array{name: ?string, error: ?string}
     *   name  = nama file tersimpan (null bila tak ada berkas / ditolak)
     *   error = pesan kesalahan (null bila aman atau memang tidak ada berkas)
     */
    function lib_simpan_upload($file, array $ext, array $mime, string $destDir, int $maxMB = 10): array
    {
        // Tidak ada berkas yang diunggah → bukan error
        if (! $file || $file->getError() === UPLOAD_ERR_NO_FILE) {
            return ['name' => null, 'error' => null];
        }
        if (! $file->isValid() || $file->hasMoved()) {
            return ['name' => null, 'error' => 'Berkas gagal diunggah, silakan coba lagi.'];
        }
        if ($file->getSizeByUnit('mb') > $maxMB) {
            return ['name' => null, 'error' => "Ukuran berkas melebihi {$maxMB} MB."];
        }
        if (! in_array(strtolower($file->getClientExtension()), $ext, true)
            || ! in_array($file->getMimeType(), $mime, true)) {
            return ['name' => null, 'error' => 'Tipe berkas tidak diizinkan (' . implode('/', $ext) . ' saja).'];
        }

        $newName = $file->getRandomName();
        $file->move($destDir, $newName);
        return ['name' => $newName, 'error' => null];
    }
}
