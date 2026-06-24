<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJurnalTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jurnal'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'judul'       => ['type' => 'VARCHAR', 'constraint' => 250],
            'slug'        => ['type' => 'VARCHAR', 'constraint' => 270],
            'penulis'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'nama_jurnal' => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true], // nama publikasi/jurnal
            'penerbit'    => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'tahun'       => ['type' => 'INT', 'constraint' => 4, 'null' => true],
            'volume'      => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'nomor'       => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],  // issue
            'halaman'     => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],  // hlm. 12-20
            'doi'         => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'issn'        => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
            'bidang'      => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true], // bidang ilmu (filter)
            'abstrak'     => ['type' => 'TEXT', 'null' => true],
            'file_pdf'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true], // writable/uploads/jurnal
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id_jurnal', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('jurnal');
    }

    public function down()
    {
        $this->forge->dropTable('jurnal');
    }
}
