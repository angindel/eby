<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Logo extends Seeder
{
    public function run()
    {
        $data = [
            'gambar' => 'Ebykarya-01.png'
        ];

        $this->db->table('logo')->insert($data);
    }
}
