<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusBayarPengembalian extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pengembalian', [
            'status_bayar' => [
                'type'       => 'ENUM',
                'constraint' => ['belum', 'lunas'],
                'default'    => 'belum',
                'after'      => 'total_denda',
            ],
        ]);

        // Baris lama tanpa denda dianggap sudah lunas (tak ada yang perlu dibayar).
        $this->db->table('pengembalian')->where('total_denda', 0)->update(['status_bayar' => 'lunas']);
    }

    public function down()
    {
        $this->forge->dropColumn('pengembalian', 'status_bayar');
    }
}
