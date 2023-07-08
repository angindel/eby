<?php

namespace App\Models;

use CodeIgniter\Model;

class MDeliveryService extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'delivery_service';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama', 'gambar'];
}
