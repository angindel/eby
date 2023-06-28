<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaymentChannel extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'BCA',
                'gambar' => 'bca.svg',
            ],
            [
                'nama' => 'MANDIRI',
                'gambar' => 'mandiri.svg',
            ],
            [
                'nama' => 'BRI',
                'gambar' => 'bri.png',
            ],
            [
                'nama' => 'BNI',
                'gambar' => 'bni.png',
            ],
            [
                'nama' => 'OVO',
                'gambar' => 'ovo.png',
            ],
            [
                'nama' => 'GOPAY',
                'gambar' => 'gopay.png',
            ],
            [
                'nama' => 'DANA',
                'gambar' => 'dana.png',
            ],
        ];

        $this->db->table('payment_channel')->insert($data);
    }
}
