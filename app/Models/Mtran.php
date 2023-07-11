<?php

namespace App\Models;

use CodeIgniter\Model;

class Mtran extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mtran';
    protected $primaryKey       = 'id_mtran';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_produk','nama','qty','created_at'];

}
