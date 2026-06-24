<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengembalian extends Migration
{
    public function up() 
    {
    $this->forge->addField([
        'id_pengembalian' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
        'id_peminjaman'   => ['type' => 'INT', 'constraint' => 11],
        'tanggal_kembali_aktual' => ['type' => 'DATE'],
        'total_denda'     => ['type' => 'INT', 'constraint' => 11],
    ]);
    $this->forge->addKey('id_pengembalian', true);
    $this->forge->createTable('pengembalian');
    }

    public function down()
    {
        //
    }
}
