<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class ProdukBModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'produk';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_kategori_produk',
        'nama_produk',
        'produk_seo',
        'harga_beli',
        'harga_reseller',
        'harga_konsumen',
        'berat',
        'warna',
        'size',
        'satuan',
        'gambar',
        'keterangan',
        'created_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = ['callAfterFind'];
    protected $beforeDelete   = ['callBeforeDelete'];
    protected $afterDelete    = [];


    protected function callAfterFind(array $data)
    {
        if($data['method'] == "first")
        {
            $data['data']->warna = str_contains($data['data']->warna, ',') ? explode(',', $data['data']->warna) : $data['data']->warna;
            $data['data']->size = str_contains($data['data']->size, ',') ? explode(',', $data['data']->size) : $data['data']->size;
        }
        
        return $data;
    }

    protected function callBeforeDelete(array $data)
    {
        $db = db_connect();
        $builder = $db->table('stok');
        $builder->where('id_produk', $data['id']);
        $builder->delete();
        // $builder->delete(['id_stok' => $data['id']]);
        
        return $data;
    }
}
