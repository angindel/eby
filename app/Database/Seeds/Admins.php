<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Admins extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'password' => '$2y$10$36gi8C.vCHtDzpkJeLjsJ.20JD805T3K.hTjr5AnpyLjNTOiIDj4G',
            'nama' => 'eby',
            'level' => 'admin'
        ];

        $this->db->table('admins')->insert($data);
    }
}
