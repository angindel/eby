<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'google_id' => [
                'type' => 'VARCHAR',
                'constraint' => 25
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'picture' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ]
        ]);

        $this->forge->addPrimaryKey('id_user');
        $this->forge->addUniqueKey(['google_id', 'email']);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
