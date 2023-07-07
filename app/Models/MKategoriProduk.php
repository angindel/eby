<?php

namespace App\Models;

use CodeIgniter\Model;

class MKategoriProduk extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kategori_produk';
    protected $primaryKey       = 'id_kategori_produk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_kategori_produk','nama_kategori', 'kategori_seo', 'gambar'];
}
