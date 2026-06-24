<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWishlistTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_wishlist' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'id_book' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id_wishlist', true);
        // Cegah duplikat buku yang sama untuk satu user
        $this->forge->addUniqueKey(['id_user', 'id_book']);
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_book', 'books', 'id_book', 'CASCADE', 'CASCADE');

        $this->forge->createTable('wishlist');
    }

    public function down()
    {
        $this->forge->dropTable('wishlist');
    }
}
