<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Stok extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_stok' => [
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
            'stok_awal' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true,
            ],
            'stok_akhir' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true
            ]
        ]);
        $this->forge->addPrimaryKey('id_stok');
        $this->forge->addForeignKey('id_produk', 'produk', 'id_produk');
        $this->forge->createTable('stok');
    }

    public function down()
    {
        $this->forge->dropTable('stok');
    }
}
