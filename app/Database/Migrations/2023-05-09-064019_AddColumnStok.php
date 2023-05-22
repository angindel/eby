<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnStok extends Migration
{
    public function up()
    {
        $fields = [
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'stok_akhir'
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ];

        $this->forge->addColumn('stok', $fields);    }

    public function down()
    {
        $this->forge->dropColumn('stok', 'created_at');
        $this->forge->dropColumn('stok', 'updated_at');    }
}
