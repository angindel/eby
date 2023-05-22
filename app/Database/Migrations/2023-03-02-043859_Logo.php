<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Logo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_logo' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ]
        ]);

        $this->forge->addPrimaryKey('id_logo');
        $this->forge->createTable('logo');
    }

    public function down()
    {
        $this->forge->dropTable('logo');
    }
}
