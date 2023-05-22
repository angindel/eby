<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_produk' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_kategori_produk' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'nama_produk' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'produk_seo' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'satuan' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'harga_beli' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'harga_reseller' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'harga_konsumen' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'berat' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'diskon' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'keterangan' => [
                'type' => 'TEXT',
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id_produk');
        $this->forge->createTable('produk');
    }

    public function down()
    {
        $this->forge->dropTable('produk');
    }
}
