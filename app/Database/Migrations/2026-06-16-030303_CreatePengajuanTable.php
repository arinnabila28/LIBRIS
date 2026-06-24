<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengajuanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengajuan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_member' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'id_book'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'tanggal_pengajuan' => ['type' => 'DATE'],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['menunggu', 'disetujui', 'ditolak'],
                'default'    => 'menunggu',
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id_pengajuan', true);
        $this->forge->addForeignKey('id_member', 'members', 'id_member', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_book', 'books', 'id_book', 'CASCADE', 'CASCADE');

        $this->forge->createTable('pengajuan');
    }

    public function down()
    {
        $this->forge->dropTable('pengajuan');
    }
}
