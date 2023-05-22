<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUpdatedAtProduk extends Migration
{
    public function up()
    {
        $fields = [
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'created_at'
            ]
        ];

        $this->forge->addColumn('produk', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('produk', 'updated_at');
    }
}
