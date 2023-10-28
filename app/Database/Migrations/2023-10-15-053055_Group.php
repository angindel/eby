<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Group extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_group' => [
                'type' => 'TINYINT',
                'constraint' => 4,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ]
        ]);

        $this->forge->addPrimaryKey('id_group');
        $this->forge->createTable('groups');
    }

    public function down()
    {
        $this->forge->dropTable('groups');
    }
}
