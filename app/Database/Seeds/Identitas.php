<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Identitas extends Seeder
{
    public function run()
    {
        $data = [
            'nama_website' => 'Toko Online Ebykarya',
            'email' => 'ebykarya@gmail.com',
            'url' => 'http://www.ebikarya.online',
            'facebook' => 'Ebykarya OnlineShop',
            'instagram' => '@ebykarya',
            'rekening' => '09661245',
            'no_telp' => 'Telp. 0987654321 - Fax. 0411 431111',
            'kota_id' => '43065',
            'alamat' => 'plaju',
            'meta_deskripsi' => 'Menyajikan produk pakaian pria dan wanita terbaik, terkini, dan terpercaya',
            'meta_keyword' => 'Ada banyak produk disini, pakaian pria, pakaian wanita, hijab, style, online shop',
            'favicon' => 'favicon.ico',
            'maps' => 'https://www.google.com/maps/place/Kec.+Plaju,+Kota+Palembang,+Sumatera+Selatan/@-3.0122631,104.8105446,14z/data=!3m1!4b1!4m6!3m5!1s0x2e3b9d6d7dde7ddb:0x27d967a9c8774598!8m2!3d-2.9957414!4d104.8152091!16s%2Fg%2F1hc0g6jnm'
        ];

        $this->db->table('identitas')->insert($data);
 
    }
}
