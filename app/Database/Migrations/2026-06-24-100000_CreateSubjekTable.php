<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubjekTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_subjek'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_subjek', true);
        $this->forge->addUniqueKey('nama');
        $this->forge->createTable('subjek');

        // Isi awal: gabungan subjek default + subjek yang sudah dipakai di buku
        $set = [];
        foreach (['Fiksi', 'Sains', 'Sejarah', 'Filsafat', 'Bisnis'] as $d) {
            $set[mb_strtolower($d)] = $d;
        }
        $rows = $this->db->table('books')->select('subjek')
            ->where('subjek IS NOT NULL')->where('subjek !=', '')->get()->getResultArray();
        foreach ($rows as $r) {
            foreach (explode(',', $r['subjek']) as $s) {
                $s = trim($s);
                if ($s !== '') {
                    $set[mb_strtolower($s)] = $s; // dedupe case-insensitive, simpan casing pertama
                }
            }
        }

        $now   = date('Y-m-d H:i:s');
        $batch = [];
        foreach ($set as $nama) {
            $batch[] = ['nama' => $nama, 'created_at' => $now, 'updated_at' => $now];
        }
        if ($batch) {
            $this->db->table('subjek')->insertBatch($batch);
        }
    }

    public function down()
    {
        $this->forge->dropTable('subjek');
    }
}
