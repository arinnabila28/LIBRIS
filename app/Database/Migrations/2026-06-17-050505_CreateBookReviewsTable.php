<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookReviewsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_review' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'id_book' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'rating'  => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 5],
            'comment' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id_review', true);
        // Satu ulasan per user per buku (bisa di-update)
        $this->forge->addUniqueKey(['id_user', 'id_book']);
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_book', 'books', 'id_book', 'CASCADE', 'CASCADE');

        $this->forge->createTable('book_reviews');
    }

    public function down()
    {
        $this->forge->dropTable('book_reviews');
    }
}
