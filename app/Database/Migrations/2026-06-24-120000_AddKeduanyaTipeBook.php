<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKeduanyaTipeBook extends Migration
{
    public function up()
    {
        // Perluas enum tipe: buku bisa fisik, digital, atau keduanya
        $this->forge->modifyColumn('books', [
            'tipe' => [
                'type'       => 'ENUM',
                'constraint' => ['fisik', 'digital', 'keduanya'],
                'default'    => 'fisik',
                'null'       => false,
            ],
        ]);
    }

    public function down()
    {
        // Kembalikan keduanya → digital agar tetap valid di enum lama
        $this->db->query("UPDATE `books` SET `tipe`='digital' WHERE `tipe`='keduanya'");
        $this->forge->modifyColumn('books', [
            'tipe' => [
                'type'       => 'ENUM',
                'constraint' => ['fisik', 'digital'],
                'default'    => 'fisik',
                'null'       => false,
            ],
        ]);
    }
}
