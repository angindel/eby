<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class Mtran extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mtran';
    protected $primaryKey       = 'id_mtran';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_produk','nama','qty','total','created_at'];

    private $data_before_delete = null;


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = ['u_stok_after_ins'];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = ['d_stok_before_d'];
    protected $afterDelete    = ['d_stok_after_d'];
    

    protected function u_stok_after_ins(array $data)
    {
        $res = false;
        if ($data['result'])
        {
            $stok = db_connect();
            $date = new Time('now', 'Asia/Jakarta', 'en_US');
            $res = $stok->simpleQuery("update stok s inner join produk p on s.id_produk = {$data['data']['id_produk']} set s.stok_akhir = s.stok_akhir -  {$data['data']['qty']}, s.updated_at = '{$date}'");
            if(!$res)
            {
                $this->allowCallbacks(false)->delete([ 'id' => $data['id'] ]);
            }
        }
        else {
            $this->allowCallbacks(false)->delete([ 'id' => $data['id'] ]);
        }
        // log_message('info', "update stok data -> ". json_encode($data));
        // $stok = $m_stok->allowCallbacks(false)->select('stok_akhir')->where('id_produk', $data['data']['id_produk'])->first();
        // $res = $m_stok->where('id_produk', $data['data']['id_produk'])->set('stok_akhir', (int)$stok->stok_akhir - (int)$data['data']['qty'])->update();

        return $res ? $data : false;
    }

    protected function d_stok_before_d(array $data)
    {
        $this->data_before_delete = (object)$this->allowCallbacks(false)->where('id_mtran', $data['id'])->first();

        return $data;
    }

    protected function d_stok_after_d(array $data)
    {
        $res = false;
        if(!is_null($this->data_before_delete) && $data['result'])
        {
            $m_stok = model('MStok');
            $stok = $m_stok->allowCallbacks(false)->select('stok_akhir')->where('id_produk', $this->data_before_delete->id_produk)->first();
            $res = $m_stok->where('id_produk', $this->data_before_delete->id_produk)->set('stok_akhir', intval($stok->stok_akhir) + intval($this->data_before_delete->qty))->update();
        }
        return $res ? $data : false;
    }
}
