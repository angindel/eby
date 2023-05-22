<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Transaksi extends Seeder
{
    public function run()
    {
        $data = [
            'id_produk' => '17',
            'nama' => 'Gamis Ulala',
            'total' => 118000,
            'qty' => 2
        ];

        $this->db->table('mtran')->insert($data);
    }
}
