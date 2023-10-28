<?php

namespace App\Models;

use CodeIgniter\Model;

class MStok extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'stok';
    protected $primaryKey       = 'id_stok';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_produk','nama','stok_awal','stok_akhir'];

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
    protected $afterFind      = ['cekStokAkhir'];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function cekStokAkhir(array $data)
    {
        if(!$data['data'])
            return $data;

        log_message('info', 'after find stok : ' . json_encode($data));
        $id_produk = [];
        foreach($data["data"] as $key => $val)
        {
            $id_produk[] = $val->id_produk;
        }
        $m_mtran = model('Mtran');
        $dmtran = $m_mtran->select('id_produk, nama, sum(total) as jumlah, sum(qty) as total')->whereIn('id_produk', $id_produk)->groupBy('id_produk')->findAll();
        $dtes = array();
        foreach($data["data"] as &$val)
        {
            foreach($dmtran as $dval)
            {
                if($val->id_produk == $dval->id_produk)
                    $val->stok_akhir = (int)$val->stok_awal - (int) $dval->total;
            }
        }

        log_message('info', 'after find stok : ' . json_encode($data));

        return $data;
    }
}
