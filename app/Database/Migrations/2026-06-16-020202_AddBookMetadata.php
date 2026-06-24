<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBookMetadata extends Migration
{
    public function up()
    {
        $this->forge->addColumn('books', [
            'no_klasifikasi'  => ['type' => 'VARCHAR', 'constraint' => 50,  'null' => true, 'after' => 'isbn_book'],
            'edisi'           => ['type' => 'VARCHAR', 'constraint' => 50,  'null' => true, 'after' => 'published_year'],
            'kota_terbit'     => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'after' => 'publisher_book'],
            'deskripsi_fisik' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'volume'          => ['type' => 'VARCHAR', 'constraint' => 50,  'null' => true],
            'subjek'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true], // pisahkan dengan koma
            'tipe'            => ['type' => 'ENUM', 'constraint' => ['fisik', 'digital'], 'default' => 'fisik'],
            'file_digital'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true], // untuk Read Now
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('books', [
            'no_klasifikasi', 'edisi', 'kota_terbit', 'deskripsi_fisik',
            'volume', 'subjek', 'tipe', 'file_digital',
        ]);
    }
}
