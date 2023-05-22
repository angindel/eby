<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KategoriProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kategori_produk' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nama_kategori' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'kategori_seo' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ]
        ]);

        $this->forge->addPrimaryKey('id_kategori_produk');
        $this->forge->createTable('kategori_produk');
    }

    public function down()
    {
        $this->forge->dropTable('kategori_produk');
    }
}
