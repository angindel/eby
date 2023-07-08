<?php

namespace App\Models;

use CodeIgniter\Model;

class MPaymentChannel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'payment_channel';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama','gambar'];

}
