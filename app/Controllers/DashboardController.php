<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index(): string
    {
        $db = \Config\Database::connect();

        // ── KPI ──────────────────────────────────────────────────────────
        $totalBuku = $db->table('books')
            ->where('deleted_at IS NULL', null, false)
            ->countAllResults();

        $totalMember = $db->table('members')
            ->where('deleted_at IS NULL', null, false)
            ->countAllResults();

        // Peminjaman aktif = belum ada di tabel pengembalian
        $dipinjamAktif = $db->query("
            SELECT COUNT(*) AS total FROM peminjaman p
            LEFT JOIN pengembalian pg ON p.id_peminjaman = pg.id_peminjaman
            WHERE pg.id_peminjaman IS NULL AND p.deleted_at IS NULL
        ")->getRow()->total ?? 0;

        // Buku & member baru bulan ini
        $bukuBaru = $db->table('books')
            ->where('MONTH(created_at) = MONTH(NOW())', null, false)
            ->where('YEAR(created_at)  = YEAR(NOW())', null, false)
            ->where('deleted_at IS NULL', null, false)
            ->countAllResults();

        $memberBaru = $db->table('members')
            ->where('MONTH(created_at) = MONTH(NOW())', null, false)
            ->where('YEAR(created_at)  = YEAR(NOW())', null, false)
            ->where('deleted_at IS NULL', null, false)
            ->countAllResults();

        // Denda (Rp 2.000 per hari keterlambatan)
        $dendaRow = $db->query("
            SELECT COALESCE(SUM(DATEDIFF(CURDATE(), p.tanggal_kembali) * 2000), 0) AS total
            FROM peminjaman p
            LEFT JOIN pengembalian pg ON p.id_peminjaman = pg.id_peminjaman
            WHERE pg.id_peminjaman IS NULL
              AND p.deleted_at IS NULL
              AND CURDATE() > p.tanggal_kembali
        ")->getRow();
        $denda = $dendaRow->total ?? 0;

        // ── Grafik 7 hari ────────────────────────────────────────────────
        $grafikLabels = [];
        $grafikData   = [];
        for ($i = 6; $i >= 0; $i--) {
            $tgl    = date('Y-m-d', strtotime("-{$i} days"));
            $dayLbl = ['Min','Sen','Sel','Rab','Kam','Jum','Sab'][date('w', strtotime($tgl))];
            $count  = $db->table('peminjaman')
                ->where('DATE(tanggal_peminjaman)', $tgl)
                ->where('deleted_at IS NULL', null, false)
                ->countAllResults();
            $grafikLabels[] = $dayLbl;
            $grafikData[]   = (int)$count;
        }

        // ── Jatuh Tempo ──────────────────────────────────────────────────
        $jatuhTempo = $db->query("
            SELECT p.id_peminjaman,
                   m.name_member,
                   b.title_book,
                   p.tanggal_kembali,
                   DATEDIFF(p.tanggal_kembali, CURDATE()) AS sisa_hari
            FROM peminjaman p
            JOIN members m ON p.id_member = m.id_member
            JOIN books   b ON p.id_book   = b.id_book
            LEFT JOIN pengembalian pg ON p.id_peminjaman = pg.id_peminjaman
            WHERE pg.id_peminjaman IS NULL
              AND p.deleted_at IS NULL
            ORDER BY p.tanggal_kembali ASC
            LIMIT 5
        ")->getResultArray();

        // ── Aktivitas Terbaru ─────────────────────────────────────────────
$aktivitas = $db->query("
    SELECT 'pinjam' AS tipe, m.name_member, b.title_book, p.created_at AS waktu
    FROM peminjaman p
    JOIN members m ON p.id_member = m.id_member
    JOIN books   b ON p.id_book   = b.id_book
    WHERE p.deleted_at IS NULL
    UNION ALL
    SELECT 'kembali' AS tipe, m.name_member, b.title_book, p.created_at AS waktu
    FROM pengembalian pg
    JOIN peminjaman p ON pg.id_peminjaman = p.id_peminjaman
    JOIN members m ON p.id_member = m.id_member
    JOIN books   b ON p.id_book   = b.id_book
    ORDER BY waktu DESC
    LIMIT 5
")->getResultArray();

        return view('dashboard', [
            'title'         => 'Dashboard',
            'totalBuku'     => $totalBuku,
            'totalMember'   => $totalMember,
            'dipinjamAktif' => $dipinjamAktif,
            'denda'         => $denda,
            'bukuBaru'      => $bukuBaru,
            'memberBaru'    => $memberBaru,
            'grafikLabels'  => json_encode($grafikLabels),
            'grafikData'    => json_encode($grafikData),
            'jatuhTempo'    => $jatuhTempo,
            'aktivitas'     => $aktivitas,
        ]);
    }
}
