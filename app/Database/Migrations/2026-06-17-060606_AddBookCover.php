<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBookCover extends Migration
{
    public function up()
    {
        $this->forge->addColumn('books', [
            'cover' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'file_digital'],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('books', 'cover');
    }
}
