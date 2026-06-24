<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTipeToSubjek extends Migration
{
    public function up()
    {
        // 1. Tambah kolom tipe (buku / jurnal). Baris lama otomatis 'buku'.
        $this->forge->addColumn('subjek', [
            'tipe' => [
                'type'       => 'ENUM',
                'constraint' => ['buku', 'jurnal'],
                'default'    => 'buku',
                'after'      => 'nama',
            ],
        ]);

        // 2. Unik bukan lagi per-nama, tapi per (nama, tipe) — supaya nama yang sama
        //    boleh ada untuk buku dan jurnal sekaligus.
        try { $this->db->query('ALTER TABLE `subjek` DROP INDEX `nama`'); } catch (\Throwable $e) {}
        try { $this->db->query('ALTER TABLE `subjek` ADD UNIQUE KEY `nama_tipe` (`nama`, `tipe`)'); } catch (\Throwable $e) {}

        // 3. Seed bidang jurnal dari jurnal yang sudah ada
        $set = [];
        $rows = $this->db->table('jurnal')->select('bidang')
            ->where('bidang IS NOT NULL')->where('bidang !=', '')->get()->getResultArray();
        foreach ($rows as $r) {
            $b = trim($r['bidang']);
            if ($b !== '') {
                $set[mb_strtolower($b)] = $b;
            }
        }
        $now = date('Y-m-d H:i:s');
        foreach ($set as $nama) {
            $ada = $this->db->table('subjek')->where('nama', $nama)->where('tipe', 'jurnal')->countAllResults();
            if (! $ada) {
                $this->db->table('subjek')->insert([
                    'nama' => $nama, 'tipe' => 'jurnal', 'created_at' => $now, 'updated_at' => $now,
                ]);
            }
        }
    }

    public function down()
    {
        try { $this->db->query('ALTER TABLE `subjek` DROP INDEX `nama_tipe`'); } catch (\Throwable $e) {}
        $this->forge->dropColumn('subjek', 'tipe');
    }
}
