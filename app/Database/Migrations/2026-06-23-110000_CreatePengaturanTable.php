<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengaturanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'lama_pinjam'    => ['type' => 'INT', 'constraint' => 11, 'default' => 7],     // hari
            'denda_per_hari' => ['type' => 'INT', 'constraint' => 11, 'default' => 1000],  // rupiah / hari telat
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pengaturan');

        // Satu baris pengaturan global (id = 1)
        $this->db->table('pengaturan')->insert([
            'id'             => 1,
            'lama_pinjam'    => 7,
            'denda_per_hari' => 1000,
            'updated_at'     => date('Y-m-d H:i:s'),
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('pengaturan');
    }
}
