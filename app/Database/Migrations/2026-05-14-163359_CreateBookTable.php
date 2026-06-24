<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_book'    => ['type' => 'INT', 'constraint' => 11,'unsigned' => true, 'auto_increment' => true],
            'code_book'  => ['type' => 'VARCHAR', 'constraint' => 20],
            'isbn_book'  => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
            'title_book' => ['type' => 'VARCHAR', 'constraint' => 150],
            'author_book'     => ['type' => 'VARCHAR', 'constraint' => 100],
            'publisher_book'  => ['type' => 'VARCHAR', 'constraint' => 100],
            'published_year'       => ['type' => 'YEAR', 'null' => true],
            'description_book'=> ['type' => 'TEXT', 'null' => true],
            'stock' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id_book', true);
        $this->forge->createTable('books');
    }

    public function down()
    {
        $this->forge->dropTable('books');
    }
}
