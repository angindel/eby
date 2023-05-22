<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProsesBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pb' => [
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
                'constraint' => '255',
            ],
            'qty' => [
                'type' => 'INT',
                'constraint' => '9',
                'unsigned' => true
            ]
        ]);
        $this->forge->addPrimaryKey('id_pb');
        $this->forge->addForeignKey('id_produk', 'produk', 'id_produk');
        $this->forge->createTable('proses_barang');
    }

    public function down()
    {
        $this->forge->dropTable('proses_barang');
    }
}
