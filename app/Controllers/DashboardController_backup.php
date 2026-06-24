<?php
namespace App\Controllers;

use CodeIgniter\Database\ConnectionInterface;

class DashboardController extends BaseController
{
    public function index(): string
    {
        $db = \Config\Database::connect();

        // KPI counts
        $totalBuku    = $db->table('books')->where('deleted_at IS NULL', null, false)->countAllResults();
        $totalMember  = $db->table('members')->where('deleted_at IS NULL', null, false)->countAllResults();
        $dipinjamAktif = $db->table('peminjaman')
            ->where('deleted_at IS NULL', null, false)
            ->whereNotIn('id_peminjaman', function($q){ 
                $q->select('id_peminjaman')->from('pengembalian'); 
            })
            ->countAllResults();

        // Buku baru bulan ini
        $bukuBaru = $db->table('books')
            ->where('MONTH(created_at) = MONTH(NOW())', null, false)
            ->where('deleted_at IS NULL', null, false)
            ->countAllResults();

        // Member baru bulan ini
        $memberBaru = $db->table('members')
            ->where('MONTH(created_at) = MONTH(NOW())', null, false)
            ->where('deleted_at IS NULL', null, false)
            ->countAllResults();

        // Denda (Rp2.000/hari keterlambatan)
        $dendaQuery = $db->query("
            SELECT COALESCE(SUM(DATEDIFF(CURDATE(), p.tanggal_kembali) * 2000), 0) as total_denda
            FROM peminjaman p
            LEFT JOIN pengembalian pg ON p.id_peminjaman = pg.id_peminjaman
            WHERE pg.id_peminjaman IS NULL
            AND CURDATE() > p.tanggal_kembali
            AND p.deleted_at IS NULL
        ");
        $denda = $dendaQuery->getRow()->total_denda ?? 0;

        // Grafik peminjaman 7 hari
        $grafikData = [];
        $grafikLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $tgl = date('Y-m-d', strtotime("-{$i} days"));
            $count = $db->table('peminjaman')
                ->where('DATE(tanggal_peminjaman)', $tgl)
                ->where('deleted_at IS NULL', null, false)
                ->countAllResults();
            $grafikLabels[] = date('D', strtotime($tgl));
            $grafikData[]   = $count;
        }

        // Jatuh tempo (3 terdekat, belum dikembalikan)
        $jatuhTempo = $db->query("
            SELECT p.id_peminjaman, m.name_member, b.title_book, p.tanggal_kembali,
                   DATEDIFF(p.tanggal_kembali, CURDATE()) as sisa_hari
            FROM peminjaman p
            JOIN members m ON p.id_member = m.id_member
            JOIN books b ON p.id_book = b.id_book
            LEFT JOIN pengembalian pg ON p.id_peminjaman = pg.id_peminjaman
            WHERE pg.id_peminjaman IS NULL AND p.deleted_at IS NULL
            ORDER BY p.tanggal_kembali ASC
            LIMIT 5
        ")->getResultArray();

        // Aktivitas terbaru
        $aktivitas = $db->query("
            SELECT 'pinjam' as tipe, m.name_member, b.title_book, p.created_at as waktu
            FROM peminjaman p
            JOIN members m ON p.id_member = m.id_member
            JOIN books b ON p.id_book = b.id_book
            WHERE p.deleted_at IS NULL
            UNION ALL
            SELECT 'kembali' as tipe, m.name_member, b.title_book, pg.created_at as waktu
            FROM pengembalian pg
            JOIN peminjaman p ON pg.id_peminjaman = p.id_peminjaman
            JOIN members m ON p.id_member = m.id_member
            JOIN books b ON p.id_book = b.id_book
            ORDER BY waktu DESC LIMIT 5
        ")->getResultArray();

        $data = [
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
        ];

        return view('dashboard', $data);
    }
}