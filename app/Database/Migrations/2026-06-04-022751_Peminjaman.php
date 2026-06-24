<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Peminjaman extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_peminjaman' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            // Kolom ini akan dihubungkan ke id_member di tabel members
            'id_member' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            // Kolom ini akan dihubungkan ke id_book di tabel books
            'id_book' => [
                'type'       => 'INT',
                'constraint' => 11, 
                'unsigned'   => true,
            ],
            'tanggal_peminjaman' => [
                'type' => 'DATE',
            ],
            'tanggal_kembali' => [
                'type' => 'DATE',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_peminjaman', true);
        
        // Membuat Relasi (Foreign Key)
        // Jika data member/buku dihapus, data peminjaman terkait ikut terhapus/menyesuaikan (CASCADE)
        $this->forge->addForeignKey('id_member', 'members', 'id_member', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_book', 'books', 'id_book', 'CASCADE', 'CASCADE');

        $this->forge->createTable('peminjaman');
    }

    public function down()
    {
        $this->forge->dropTable('peminjaman');
    }
}