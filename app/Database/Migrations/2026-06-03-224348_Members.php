<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Members extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_member' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name_member' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email_member' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true, // Email tidak boleh ada yang kembar
            ],
            'contact_member' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'status_member' => [
                'type'       => 'ENUM',
                'constraint' => ['Aktif', 'Nonaktif'],
                'default'    => 'Aktif',
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

        // Menjadikan id_member sebagai Primary Key
        $this->forge->addKey('id_member', true);
        
        // Membuat tabel dengan nama 'members'
        $this->forge->createTable('members');
    }

    public function down()
    {
        $this->forge->dropTable('members');
    }
}
