<?php

namespace App\Models;

use CodeIgniter\Model;

class MProduks extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'produk';
    protected $primaryKey       = 'id_produk';
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'id_kategori_produk',
        'nama_produk',
        'produk_seo',
        'satuan',
        'harga_beli',
        'harga_konsumen',
        'harga_reseller',
        'berat',
        'diskon',
        'gambar',
        'keterangan',
        'username',
        'created_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
