<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PeminjamanSeeder extends Seeder
{
    public function run()
    {
        $now   = date('Y-m-d H:i:s');
        $today = date('Y-m-d');

        // Peminjaman aktif (belum dikembalikan)
        $aktif = [
            // Hampir jatuh tempo / terlambat
            ['id_member'=>1, 'id_book'=>2,  'tanggal_peminjaman'=>date('Y-m-d',strtotime('-8 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('+0 days'))], // hari ini
            ['id_member'=>5, 'id_book'=>12, 'tanggal_peminjaman'=>date('Y-m-d',strtotime('-6 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('+2 days'))], // 2 hari lagi
            ['id_member'=>3, 'id_book'=>13, 'tanggal_peminjaman'=>date('Y-m-d',strtotime('-10 days')), 'tanggal_kembali'=>date('Y-m-d',strtotime('-2 days'))], // terlambat 2 hari
            ['id_member'=>7, 'id_book'=>15, 'tanggal_peminjaman'=>date('Y-m-d',strtotime('-5 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('+3 days'))], // 3 hari lagi
            ['id_member'=>9, 'id_book'=>1,  'tanggal_peminjaman'=>date('Y-m-d',strtotime('-7 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('+1 days'))], // besok
            // Peminjaman aktif lainnya
            ['id_member'=>2, 'id_book'=>10, 'tanggal_peminjaman'=>date('Y-m-d',strtotime('-3 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('+4 days'))],
            ['id_member'=>4, 'id_book'=>16, 'tanggal_peminjaman'=>date('Y-m-d',strtotime('-2 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('+5 days'))],
            ['id_member'=>6, 'id_book'=>18, 'tanggal_peminjaman'=>date('Y-m-d',strtotime('-4 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('+3 days'))],
            ['id_member'=>8, 'id_book'=>20, 'tanggal_peminjaman'=>date('Y-m-d',strtotime('-1 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('+6 days'))],
            ['id_member'=>10,'id_book'=>4,  'tanggal_peminjaman'=>date('Y-m-d',strtotime('-3 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('+4 days'))],
            ['id_member'=>11,'id_book'=>7,  'tanggal_peminjaman'=>date('Y-m-d',strtotime('-2 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('+5 days'))],
            ['id_member'=>12,'id_book'=>9,  'tanggal_peminjaman'=>date('Y-m-d',strtotime('-1 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('+6 days'))],
        ];

        // Peminjaman sudah dikembalikan (untuk grafik & aktivitas)
        $selesai = [
            ['id_member'=>2,  'id_book'=>3,  'tanggal_peminjaman'=>date('Y-m-d',strtotime('-20 days')), 'tanggal_kembali'=>date('Y-m-d',strtotime('-13 days')), 'created_at'=>date('Y-m-d H:i:s',strtotime('-1 hour'))],
            ['id_member'=>3,  'id_book'=>5,  'tanggal_peminjaman'=>date('Y-m-d',strtotime('-15 days')), 'tanggal_kembali'=>date('Y-m-d',strtotime('-8 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-3 hours'))],
            ['id_member'=>4,  'id_book'=>8,  'tanggal_peminjaman'=>date('Y-m-d',strtotime('-12 days')), 'tanggal_kembali'=>date('Y-m-d',strtotime('-5 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-5 hours'))],
            ['id_member'=>5,  'id_book'=>11, 'tanggal_peminjaman'=>date('Y-m-d',strtotime('-10 days')), 'tanggal_kembali'=>date('Y-m-d',strtotime('-3 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-1 days'))],
            ['id_member'=>6,  'id_book'=>14, 'tanggal_peminjaman'=>date('Y-m-d',strtotime('-8 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('-1 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-2 days'))],
            ['id_member'=>7,  'id_book'=>17, 'tanggal_peminjaman'=>date('Y-m-d',strtotime('-6 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('-2 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-3 days'))],
            ['id_member'=>13, 'id_book'=>19, 'tanggal_peminjaman'=>date('Y-m-d',strtotime('-5 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('-1 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-4 days'))],
            // Hari-hari grafik (supaya grafik ada datanya)
            ['id_member'=>1,  'id_book'=>6,  'tanggal_peminjaman'=>date('Y-m-d',strtotime('-6 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('-1 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-6 days'))],
            ['id_member'=>2,  'id_book'=>7,  'tanggal_peminjaman'=>date('Y-m-d',strtotime('-6 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('-1 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-6 days'))],
            ['id_member'=>3,  'id_book'=>8,  'tanggal_peminjaman'=>date('Y-m-d',strtotime('-5 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('-1 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-5 days'))],
            ['id_member'=>4,  'id_book'=>9,  'tanggal_peminjaman'=>date('Y-m-d',strtotime('-5 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('-1 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-5 days'))],
            ['id_member'=>5,  'id_book'=>10, 'tanggal_peminjaman'=>date('Y-m-d',strtotime('-5 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('-1 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-5 days'))],
            ['id_member'=>6,  'id_book'=>11, 'tanggal_peminjaman'=>date('Y-m-d',strtotime('-4 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('-1 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-4 days'))],
            ['id_member'=>7,  'id_book'=>12, 'tanggal_peminjaman'=>date('Y-m-d',strtotime('-4 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('-1 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-4 days'))],
            ['id_member'=>8,  'id_book'=>13, 'tanggal_peminjaman'=>date('Y-m-d',strtotime('-4 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('-1 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-4 days'))],
            ['id_member'=>9,  'id_book'=>14, 'tanggal_peminjaman'=>date('Y-m-d',strtotime('-3 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('+4 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-3 days'))],
            ['id_member'=>10, 'id_book'=>15, 'tanggal_peminjaman'=>date('Y-m-d',strtotime('-3 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('+4 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-3 days'))],
            ['id_member'=>11, 'id_book'=>16, 'tanggal_peminjaman'=>date('Y-m-d',strtotime('-2 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('+5 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-2 days'))],
            ['id_member'=>12, 'id_book'=>17, 'tanggal_peminjaman'=>date('Y-m-d',strtotime('-2 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('+5 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-2 days'))],
            ['id_member'=>13, 'id_book'=>18, 'tanggal_peminjaman'=>date('Y-m-d',strtotime('-1 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('+6 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-1 days'))],
            ['id_member'=>14, 'id_book'=>19, 'tanggal_peminjaman'=>date('Y-m-d',strtotime('-1 days')),  'tanggal_kembali'=>date('Y-m-d',strtotime('+6 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-1 days'))],
            ['id_member'=>15, 'id_book'=>20, 'tanggal_peminjaman'=>$today,                              'tanggal_kembali'=>date('Y-m-d',strtotime('+7 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-2 minutes'))],
            ['id_member'=>1,  'id_book'=>3,  'tanggal_peminjaman'=>$today,                              'tanggal_kembali'=>date('Y-m-d',strtotime('+7 days')),  'created_at'=>date('Y-m-d H:i:s',strtotime('-5 minutes'))],
        ];

        $peminjamanIds = [];

        foreach ($aktif as $p) {
            $this->db->table('peminjaman')->insert(array_merge($p, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }

        foreach ($selesai as $p) {
            $createdAt = $p['created_at'] ?? $now;
            unset($p['created_at']);
            $this->db->table('peminjaman')->insert(array_merge($p, [
                'created_at' => $createdAt,
                'updated_at' => $now,
            ]));
            $peminjamanIds[] = [
                'id'              => $this->db->insertID(),
                'tanggal_kembali' => $p['tanggal_kembali'],
            ];
        }

        // Insert pengembalian untuk peminjaman yang sudah selesai
        foreach ($peminjamanIds as $item) {
            $this->db->table('pengembalian')->insert([
                'id_peminjaman'          => $item['id'],
                'tanggal_kembali_aktual' => $item['tanggal_kembali'],
                'total_denda'            => 0,
            ]);
        }
    }
}
