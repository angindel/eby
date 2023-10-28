<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class MTelepon extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'telepon';
    protected $primaryKey       = 'id_telp';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama','blok','jumlah','tanggal'];

    // Dates
    // protected $useTimestamps = true;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'tanggal';

    // // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    protected $afterFind      = ['callAfterFind'];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];


    protected function callAfterFind(array $data)
    {
        if($data['method'] == "findAll")
        {
            foreach($data['data'] as $d)
            {
                $time = Time::parse($d->tanggal);
                $d->tanggal = $time->toDateString();
            }
            // $time = Time::parse($data['data']->tanggal);
            // $data['data']->tanggal = $time->toDateString();
            // log_message("info", "DATA TELP : ".json_encode($data));
        }
        
        return $data;
    }
}
