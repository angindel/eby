<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mtran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_mtran' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_produk' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'total' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true,
            ],
            'qty' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true
            ]
        ]);

        $this->forge->addPrimaryKey('id_mtran');
        $this->forge->addForeignKey('id_produk', 'produk', 'id_produk');
        $this->forge->createTable('mtran');
    }

    public function down()
    {
        $this->forge->dropTable('mtran');
    }
}
