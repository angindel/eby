<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnGambarKategori extends Migration
{
    public function up()
    {
        $fields = [
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'after' => 'kategori_seo'
            ]
        ];

        $this->forge->addColumn('kategori_produk', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('gambar');
    }
}
