<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Slide extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('slide');
    }

    public function down()
    {
        $this->forge->dropTable('slide');
    }
}
