<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBeritaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_berita' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'judul'     => ['type' => 'VARCHAR', 'constraint' => 200],
            'slug'      => ['type' => 'VARCHAR', 'constraint' => 220],
            // 'berita' = pengumuman/kegiatan · 'dokumen' = berita acara resmi (PDF)
            'kategori'      => ['type' => 'ENUM', 'constraint' => ['berita', 'dokumen'], 'default' => 'berita'],
            'ringkasan'     => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
            'isi'           => ['type' => 'TEXT', 'null' => true],
            'gambar'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true], // cover (public/uploads/berita)
            'file_dokumen'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true], // PDF (writable/uploads/berita)
            'tanggal'       => ['type' => 'DATE', 'null' => true],
            'penulis'       => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id_berita', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('berita');
    }

    public function down()
    {
        $this->forge->dropTable('berita');
    }
}
