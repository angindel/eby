<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Group extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'member',
            ],
            [
                'name' => 'operator',
            ],
            [
                'name' => 'admin',
            ],
        ];

        $this->db->table('groups')->insertBatch($data);
    }
}
