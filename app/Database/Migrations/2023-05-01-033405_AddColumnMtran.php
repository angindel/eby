<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnMtran extends Migration
{
    public function up()
    {
         $fields = [
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'qty'
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ];

        $this->forge->addColumn('mtran', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('mtran', 'created_at');
        $this->forge->dropColumn('mtran', 'updated_at');
    }
}
